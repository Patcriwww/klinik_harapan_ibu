<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Exports\PasienExport;
use App\Exports\BookingExport;
use App\Exports\PembayaranExport;
use App\Exports\RekamMedisExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\ActivityLogger;

class ExportController extends Controller
{
    public function pasien()
    {
        ActivityLogger::log('Export Excel', 'Pasien', 'Admin melakukan export data pasien.');

        return Excel::download(new PasienExport, 'data-pasien.xlsx');
    }

    public function booking()
    {
        ActivityLogger::log('Export Excel', 'Booking', 'Admin melakukan export data booking konsultasi.');

        return Excel::download(new BookingExport, 'data-booking.xlsx');
    }

    public function pembayaran()
    {
        ActivityLogger::log('Export Excel', 'Pembayaran', 'Admin melakukan export data pembayaran.');

        return Excel::download(new PembayaranExport, 'data-pembayaran.xlsx');
    }

    public function rekamMedis()
    {
        ActivityLogger::log('Export Excel', 'Rekam Medis', 'Admin melakukan export data rekam medis.');

        return Excel::download(new RekamMedisExport, 'data-rekam-medis.xlsx');
    }
}