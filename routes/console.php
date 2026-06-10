<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\UserNotification;
use Carbon\Carbon;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Command: bersihkan notifikasi yang sudah lewat 1 hari
Artisan::command('notifications:cleanup', function () {
    $deleted = UserNotification::where('created_at', '<', Carbon::now()->subDay())->delete();
    $this->info("Berhasil menghapus {$deleted} notifikasi lama.");
})->purpose('Hapus notifikasi yang sudah lebih dari 1 hari');

// Jadwalkan cleanup otomatis setiap jam
Schedule::command('notifications:cleanup')->hourly();
