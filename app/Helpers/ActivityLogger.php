<?php

namespace App\Helpers;

use App\Models\ActivityLog;

class ActivityLogger
{
    public static function log($aksi, $modul = null, $deskripsi = null)
    {
        $user = auth()->user();

        ActivityLog::create([
            'user_id' => $user?->id,
            'role' => $user ? $user->getRoleNames()->first() : null,
            'aksi' => $aksi,
            'modul' => $modul,
            'deskripsi' => $deskripsi,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}