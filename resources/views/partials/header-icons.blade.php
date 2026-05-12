{{-- Partial: Header Icons (Notif + Pesan + Keranjang + Profil) --}}
{{-- CSS notifikasi harus ada di halaman yang include partial ini --}}

@auth
{{-- Notifikasi --}}
<div class="icon-wrapper" style="position:relative;">
    <button class="icon-btn" title="Notifikasi" onclick="toggleNotifDropdown(event)">
        <svg viewBox="0 0 24 24">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
        </svg>
        <span class="notif-badge" id="notifBadge" style="display:none;">0</span>
    </button>
    <span class="icon-label">Notifikasi</span>

    <div class="notif-dropdown" id="notifDropdown">
        <div class="notif-header">
            <span>Notifikasi</span>
            <button onclick="markAllRead()" class="notif-read-all">Tandai semua dibaca</button>
        </div>
        <div class="notif-list" id="notifList">
            <div class="notif-empty">Tidak ada notifikasi</div>
        </div>
    </div>
</div>


@endauth
