{{-- Partial: Notification CSS --}}
<style>
.notif-badge {
    position: absolute; top: -5px; right: -5px;
    background: #d32f2f; color: white; border-radius: 50%;
    width: 18px; height: 18px; font-size: 11px; font-weight: bold;
    display: flex; align-items: center; justify-content: center;
}
.notif-dropdown {
    display: none; position: absolute; top: calc(100% + 10px); right: -10px;
    width: 320px; background: white; border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.15); z-index: 2000; overflow: hidden;
}
.notif-dropdown.active { display: block; }
.notif-header {
    display: flex; justify-content: space-between; align-items: center;
    padding: 14px 16px; border-bottom: 1px solid #f0f0f0;
    font-weight: 600; font-size: 14px; color: #2c2c2c;
}
.notif-read-all { background: none; border: none; color: #8b7355; font-size: 12px; cursor: pointer; font-weight: 600; }
.notif-read-all:hover { text-decoration: underline; }
.notif-list { max-height: 320px; overflow-y: auto; }
.notif-item {
    display: flex; gap: 12px; padding: 12px 16px;
    border-bottom: 1px solid #f9f9f9; cursor: pointer; transition: background 0.2s;
}
.notif-item:hover { background: #faf8f5; }
.notif-item.unread { background: #fdf6ee; }
.notif-item.unread:hover { background: #f9efe0; }
.notif-icon { width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 16px; }
.notif-icon.success { background: #e8f5e9; }
.notif-icon.info    { background: #e3f2fd; }
.notif-icon.warning { background: #fff3e0; }
.notif-content { flex: 1; }
.notif-title { font-size: 13px; font-weight: 600; color: #2c2c2c; margin-bottom: 2px; }
.notif-msg   { font-size: 12px; color: #6b6b6b; line-height: 1.4; }
.notif-time  { font-size: 11px; color: #aaa; margin-top: 3px; }
.notif-empty { padding: 30px 16px; text-align: center; color: #aaa; font-size: 13px; }
</style>
