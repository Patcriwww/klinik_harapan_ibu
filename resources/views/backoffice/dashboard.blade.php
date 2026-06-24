@extends('backoffice.layouts.app')

@section('breadcrumb', 'Dashboard')
@section('title', 'Dashboard Admin')

@section('content')
<style>
    .admin-dashboard {
        padding: 26px;
    }

    .dashboard-title {
        font-size: 30px;
        font-weight: 900;
        color: #1e293b;
        margin: 0;
    }

    .dashboard-subtitle {
        color: #94a3b8;
        margin-top: 8px;
        font-size: 15px;
    }

    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-top: 26px;
        margin-bottom: 24px;
    }

    .kpi-card {
        background: #ffffff;
        border-radius: 22px;
        padding: 22px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
        border: 1px solid #f1f5f9;
    }

    .kpi-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .kpi-label {
        font-size: 13px;
        color: #64748b;
        font-weight: 900;
        text-transform: uppercase;
    }

    .kpi-icon {
        width: 46px;
        height: 46px;
        border-radius: 16px;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
    }

    .kpi-value {
        font-size: 30px;
        font-weight: 900;
        color: #1e293b;
        margin-top: 16px;
    }

    .kpi-note {
        font-size: 13px;
        color: #94a3b8;
        margin-top: 6px;
        font-weight: 700;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 1.4fr .8fr;
        gap: 22px;
        margin-bottom: 24px;
    }

    .panel-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 24px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
        border: 1px solid #f1f5f9;
    }

    .panel-title {
        font-size: 20px;
        font-weight: 900;
        color: #1e293b;
        margin-bottom: 18px;
    }

    .chart-wrapper {
        height: 280px;
    }

    .system-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .system-item {
        display: flex;
        justify-content: space-between;
        background: #f8fafc;
        border-radius: 16px;
        padding: 14px 16px;
    }

    .system-label {
        color: #64748b;
        font-weight: 800;
        font-size: 14px;
    }

    .system-value {
        color: #2563eb;
        font-weight: 900;
        font-size: 15px;
    }

    .booking-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
        min-width: 950px;
    }

    .booking-table th {
        text-align: left;
        padding: 12px 16px;
        font-size: 12px;
        color: #64748b;
        text-transform: uppercase;
        font-weight: 900;
    }

    .booking-table td {
        background: #ffffff;
        padding: 16px;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 14px;
    }

    .booking-table td:first-child {
        border-left: 1px solid #f1f5f9;
        border-radius: 16px 0 0 16px;
    }

    .booking-table td:last-child {
        border-right: 1px solid #f1f5f9;
        border-radius: 0 16px 16px 0;
    }

    .queue-number {
        font-size: 24px;
        font-weight: 900;
        color: #2563eb;
    }

    .small-muted {
        color: #94a3b8;
        font-size: 12px;
        margin-top: 4px;
    }

    .badge {
        display: inline-block;
        padding: 7px 13px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
    }

    .badge-menunggu {
        background: #fef3c7;
        color: #d97706;
    }

    .badge-diproses {
        background: #dbeafe;
        color: #2563eb;
    }

    .badge-selesai {
        background: #dcfce7;
        color: #16a34a;
    }

    .badge-batal {
        background: #fee2e2;
        color: #dc2626;
    }

    .pay-pending {
        background: #fef3c7;
        color: #d97706;
    }

    .pay-menunggu_verifikasi {
        background: #dbeafe;
        color: #2563eb;
    }

    .pay-dibayar {
        background: #dcfce7;
        color: #16a34a;
    }

    .pay-ditolak {
        background: #fee2e2;
        color: #dc2626;
    }

    .table-responsive {
        overflow-x: auto;
    }

    @media(max-width: 1200px) {
        .kpi-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    @media(max-width: 700px) {
        .kpi-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="admin-dashboard">

    <div>
        <h1 class="dashboard-title">Dashboard Admin</h1>
        <p class="dashboard-subtitle">
            Ringkasan operasional Klinik Harapan Ibu dan Anak.
        </p>
    </div>

    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-top">
                <div class="kpi-label">Total Pasien</div>
                <div class="kpi-icon" style="background:#0ea5e9;">👥</div>
            </div>
            <div class="kpi-value">{{ $totalPasien }}</div>
            <div class="kpi-note">Pasien terdaftar</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-top">
                <div class="kpi-label">Tenaga Medis</div>
                <div class="kpi-icon" style="background:#6366f1;">🩺</div>
            </div>
            <div class="kpi-value">{{ $totalTenagaMedis }}</div>
            <div class="kpi-note">Dokter, bidan, dan tenaga kesehatan aktif</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-top">
                <div class="kpi-label">Booking Hari Ini</div>
                <div class="kpi-icon" style="background:#22c55e;">📅</div>
            </div>
            <div class="kpi-value">{{ $bookingHariIni }}</div>
            <div class="kpi-note">Konsultasi terjadwal hari ini</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-top">
                <div class="kpi-label">Pembayaran Pending</div>
                <div class="kpi-icon" style="background:#f97316;">💳</div>
            </div>
            <div class="kpi-value">{{ $pembayaranPending }}</div>
            <div class="kpi-note">Menunggu proses/verifikasi admin</div>
        </div>
    </div>

    <div class="dashboard-grid">
        <div class="panel-card">
            <div class="panel-title">Grafik Booking 7 Hari Terakhir</div>
            <div class="chart-wrapper">
                <canvas id="bookingChart"></canvas>
            </div>
        </div>

        <div class="panel-card">
            <div class="panel-title">Status Sistem</div>

            <div class="system-list">
                <div class="system-item">
                    <span class="system-label">Status Sistem</span>
                    <span class="system-value">Aktif</span>
                </div>

                <div class="system-item">
                    <span class="system-label">Total Booking</span>
                    <span class="system-value">{{ $totalBooking }}</span>
                </div>

                <div class="system-item">
                    <span class="system-label">Total Rekam Medis</span>
                    <span class="system-value">{{ $totalRekamMedis }}</span>
                </div>

                <div class="system-item">
                    <span class="system-label">Total Pendapatan</span>
                    <span class="system-value">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </span>
                </div>

                @foreach($statusBooking as $status)
                    <div class="system-item">
                        <span class="system-label">Booking {{ ucfirst($status->status) }}</span>
                        <span class="system-value">{{ $status->total }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="panel-card">
        <div class="panel-title">Booking Terbaru</div>

        <div class="table-responsive">
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>Antrian</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Jadwal</th>
                        <th>Pembayaran</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($bookingTerbaru as $booking)
                        @php
                            $statusClass = 'badge-' . $booking->status;
                            $payStatus = $booking->pembayaran->status ?? 'pending';
                            $payClass = 'pay-' . $payStatus;
                        @endphp

                        <tr>
                            <td>
                                <div class="queue-number">{{ $booking->nomor_antrian }}</div>
                                <div class="small-muted">{{ $booking->kode_booking }}</div>
                            </td>

                            <td>
                                <strong>{{ $booking->pasien->name ?? '-' }}</strong>
                                <div class="small-muted">{{ $booking->pasien->email ?? '-' }}</div>
                            </td>

                            <td>
                                <strong>{{ $booking->tenagaMedis->nama ?? '-' }}</strong>
                                <div class="small-muted">{{ $booking->tenagaMedis->spesialis ?? '-' }}</div>
                            </td>

                            <td>
                                <strong>
                                    {{ $booking->tanggal_konsultasi ? \Carbon\Carbon::parse($booking->tanggal_konsultasi)->format('d/m/Y') : '-' }}
                                </strong>
                                <div class="small-muted">
                                    {{ $booking->jam_konsultasi ? \Carbon\Carbon::parse($booking->jam_konsultasi)->format('H:i') . ' WIB' : '-' }}
                                </div>
                            </td>

                            <td>
                                <strong>
                                    Rp {{ number_format($booking->pembayaran->nominal ?? 0, 0, ',', '.') }}
                                </strong>
                                <div style="margin-top:8px;">
                                    <span class="badge {{ $payClass }}">
                                        {{ ucwords(str_replace('_', ' ', $payStatus)) }}
                                    </span>
                                </div>
                            </td>

                            <td>
                                <span class="badge {{ $statusClass }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;color:#94a3b8;padding:32px;">
                                Belum ada data booking terbaru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('bookingChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($booking7Hari->pluck('tanggal')),
            datasets: [{
                label: 'Total Booking',
                data: @json($booking7Hari->pluck('total')),
                backgroundColor: '#0ea5e9',
                borderRadius: 12,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    },
                    grid: {
                        color: '#f1f5f9'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endsection