@extends('backoffice.layouts.app')

@section('breadcrumb', 'Laporan Klinik')
@section('title', 'Laporan Klinik')

@section('content')
<style>
    .report-page{padding:26px}
    .report-header{display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:24px}
    .report-title{font-size:32px;font-weight:900;color:#1e293b;margin:0}
    .report-subtitle{color:#94a3b8;margin-top:8px;font-size:15px}
    .filter-box{display:flex;gap:10px;align-items:center}
    .filter-box select{height:48px;border:1px solid #e2e8f0;border-radius:15px;padding:0 14px;font-weight:800;color:#475569}
    .btn-filter{height:48px;border:none;border-radius:15px;background:#2563eb;color:white;padding:0 18px;font-weight:900;cursor:pointer}
    .stat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-bottom:24px}
    .stat-card{background:#fff;border-radius:24px;padding:22px;box-shadow:0 10px 24px rgba(15,23,42,.08)}
    .stat-label{font-size:12px;color:#64748b;font-weight:900;text-transform:uppercase}
    .stat-value{font-size:30px;font-weight:900;color:#1e293b;margin-top:14px}
    .stat-note{font-size:13px;color:#94a3b8;margin-top:6px;font-weight:700}
    .grid-2{display:grid;grid-template-columns:1.4fr .8fr;gap:22px;margin-bottom:22px}
    .card{background:#fff;border-radius:24px;padding:24px;box-shadow:0 10px 24px rgba(15,23,42,.08)}
    .card-title{font-size:20px;font-weight:900;color:#1e293b;margin-bottom:18px}
    .chart-box{height:330px}
    .status-list{display:grid;gap:12px}
    .status-item{display:flex;justify-content:space-between;align-items:center;background:#f8fafc;border-radius:16px;padding:14px 16px;font-weight:900;color:#334155}
    .badge{padding:7px 13px;border-radius:999px;background:#eff6ff;color:#2563eb;font-size:12px;font-weight:900}
    .doctor-list{display:grid;gap:14px}
    .doctor-item{display:flex;justify-content:space-between;align-items:center;background:#f8fafc;border-radius:18px;padding:16px}
    .doctor-name{font-weight:900;color:#1e293b}
    .doctor-spec{font-size:12px;color:#94a3b8;margin-top:4px;font-weight:700}
    table{width:100%;border-collapse:separate;border-spacing:0 12px;min-width:900px}
    th{text-align:left;color:#64748b;font-size:12px;text-transform:uppercase;padding:12px 16px}
    td{background:#fff;padding:16px;border-top:1px solid #f1f5f9;border-bottom:1px solid #f1f5f9;color:#334155;font-weight:700}
    td:first-child{border-left:1px solid #f1f5f9;border-radius:16px 0 0 16px}
    td:last-child{border-right:1px solid #f1f5f9;border-radius:0 16px 16px 0}
    .table-responsive{overflow-x:auto}

    @media(max-width:1100px){
        .stat-grid{grid-template-columns:repeat(2,1fr)}
        .grid-2{grid-template-columns:1fr}
    }

    @media(max-width:700px){
        .stat-grid{grid-template-columns:1fr}
        .report-header{flex-direction:column;align-items:flex-start}
    }
</style>

<div class="report-page">
    <div class="report-header">
        <div>
            <h1 class="report-title">Laporan Klinik</h1>
            <p class="report-subtitle">
                Ringkasan performa klinik berdasarkan pasien, booking, pembayaran, dan rekam medis.
            </p>
        </div>

        <form method="GET" action="{{ route('pimpinan.laporan-klinik.index') }}" class="filter-box">
            <select name="tahun">
                @for($y = now()->year; $y >= now()->year - 5; $y--)
                    <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endfor
            </select>

            <button type="submit" class="btn-filter">Filter</button>
        </form>
    </div>

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-label">Total Pasien</div>
            <div class="stat-value">{{ $totalPasien }}</div>
            <div class="stat-note">Pasien terdaftar</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Tenaga Medis</div>
            <div class="stat-value">{{ $totalTenagaMedis }}</div>
            <div class="stat-note">Tenaga medis aktif</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Total Booking</div>
            <div class="stat-value">{{ $totalBooking }}</div>
            <div class="stat-note">Booking tahun {{ $tahun }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Pendapatan</div>
            <div class="stat-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            <div class="stat-note">Pembayaran berhasil</div>
        </div>
    </div>

    <div class="grid-2">
        <div class="card">
            <div class="card-title">Grafik Booking Bulanan</div>
            <div class="chart-box">
                <canvas id="bookingChart"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="card-title">Status Booking</div>

            <div class="status-list">
                <div class="status-item">
                    <span>Menunggu</span>
                    <span class="badge">{{ $statusBooking['menunggu'] ?? 0 }}</span>
                </div>
                <div class="status-item">
                    <span>Diproses</span>
                    <span class="badge">{{ $statusBooking['diproses'] ?? 0 }}</span>
                </div>
                <div class="status-item">
                    <span>Selesai</span>
                    <span class="badge">{{ $statusBooking['selesai'] ?? 0 }}</span>
                </div>
                <div class="status-item">
                    <span>Batal</span>
                    <span class="badge">{{ $statusBooking['batal'] ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid-2">
        <div class="card">
            <div class="card-title">Grafik Pendapatan Bulanan</div>
            <div class="chart-box">
                <canvas id="pendapatanChart"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="card-title">Dokter Paling Banyak Dibooking</div>

            <div class="doctor-list">
                @forelse($dokterTerfavorit as $item)
                    <div class="doctor-item">
                        <div>
                            <div class="doctor-name">
                                {{ $item->tenagaMedis->nama ?? '-' }}
                            </div>
                            <div class="doctor-spec">
                                {{ $item->tenagaMedis->spesialis ?? '-' }}
                            </div>
                        </div>

                        <span class="badge">{{ $item->total }} booking</span>
                    </div>
                @empty
                    <div style="color:#94a3b8;font-weight:800;">
                        Belum ada data booking.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-title">Rekam Medis Terbaru</div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Keluhan</th>
                        <th>Diagnosa</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($rekamMedisTerbaru as $item)
                        <tr>
                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal_pemeriksaan)->format('d/m/Y') }}
                            </td>
                            <td>{{ $item->pasien->name ?? '-' }}</td>
                            <td>{{ $item->tenagaMedis->nama ?? '-' }}</td>
                            <td>{{ $item->keluhan ?? '-' }}</td>
                            <td>{{ $item->diagnosa ?? '-' }}</td>
                            <td>{{ $item->tindakan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;color:#94a3b8;padding:35px;">
                                Belum ada rekam medis.
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
    const labels = @json($labels);

    new Chart(document.getElementById('bookingChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Booking',
                data: @json($bookingData),
                borderWidth: 1,
                borderRadius: 12
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    new Chart(document.getElementById('pendapatanChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pendapatan',
                data: @json($pendapatanData),
                borderWidth: 3,
                tension: .35,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endsection