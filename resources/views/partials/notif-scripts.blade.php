{{-- Partial: Notification JavaScript --}}
@auth
<script>
(function() {
    function loadNotifications() {
        fetch('/api/notifications', { headers: { 'Accept': 'application/json' } })
            .then(r => r.json())
            .then(data => {
                if (!data.success) return;
                const badge = document.getElementById('notifBadge');
                const list  = document.getElementById('notifList');
                if (!badge || !list) return;

                if (data.unread_count > 0) {
                    badge.textContent = data.unread_count > 9 ? '9+' : data.unread_count;
                    badge.style.display = 'flex';
                } else {
                    badge.style.display = 'none';
                }

                if (!data.notifications.length) {
                    list.innerHTML = '<div class="notif-empty">Tidak ada notifikasi</div>';
                    return;
                }

                const iconMap = { success: '✔', info: 'i', warning: '!' };
                list.innerHTML = data.notifications.map(n => `
                    <div class="notif-item ${n.is_read ? '' : 'unread'}" onclick="readNotif(${n.id})">
                        <div class="notif-icon ${n.type}">${iconMap[n.type] || 'i'}</div>
                        <div class="notif-content">
                            <div class="notif-title">${n.title}</div>
                            <div class="notif-msg">${n.message}</div>
                            <div class="notif-time">${timeAgo(n.created_at)}</div>
                        </div>
                    </div>
                `).join('');
            })
            .catch(() => {});
    }

    window.toggleNotifDropdown = function(e) {
        e.stopPropagation();
        const dropdown = document.getElementById('notifDropdown');
        if (!dropdown) return;
        dropdown.classList.toggle('active');
        if (dropdown.classList.contains('active')) loadNotifications();
    };

    window.markAllRead = function() {
        fetch('/api/notifications/read-all', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        }).then(() => loadNotifications());
    };

    window.readNotif = function(id) {
        fetch(`/api/notifications/${id}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        }).then(() => loadNotifications());
    };

    window.timeAgo = function(dateStr) {
        const diff = Math.floor((Date.now() - new Date(dateStr)) / 1000);
        if (diff < 60)    return 'Baru saja';
        if (diff < 3600)  return Math.floor(diff/60) + ' menit lalu';
        if (diff < 86400) return Math.floor(diff/3600) + ' jam lalu';
        return Math.floor(diff/86400) + ' hari lalu';
    };

    // Tutup dropdown saat klik di luar
    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('notifDropdown');
        if (dropdown && !e.target.closest('#notifDropdown') && !e.target.closest('[onclick="toggleNotifDropdown(event)"]')) {
            dropdown.classList.remove('active');
        }
    });

    // Load saat halaman siap + polling tiap 30 detik
    document.addEventListener('DOMContentLoaded', function() {
        loadNotifications();
        setInterval(loadNotifications, 30000);
    });
})();
</script>
@endauth
