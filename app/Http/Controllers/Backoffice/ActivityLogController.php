<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ActivityLogger;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = ActivityLog::with('user')
            ->when($request->user_id, function ($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })
            ->when($request->aksi, function ($query) use ($request) {
                $query->where('aksi', 'ILIKE', '%' . $request->aksi . '%');
            })
            ->when($request->modul, function ($query) use ($request) {
                $query->where('modul', $request->modul);
            })
            ->when($request->tanggal, function ($query) use ($request) {
                $query->whereDate('created_at', $request->tanggal);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $users = User::orderBy('name')->get();

        $moduls = ActivityLog::select('modul')
            ->whereNotNull('modul')
            ->distinct()
            ->orderBy('modul')
            ->pluck('modul');

        return view('backoffice.activity-log.index', compact(
            'logs',
            'users',
            'moduls'
        ));
    }
}