@extends('backoffice.layouts.app')

@section('breadcrumb', 'Catatan Pertumbuhan')
@section('title', 'Catatan Pertumbuhan')

@section('content')
<style>
    .growth-page {
        padding: 26px;
    }

    .growth-header {
        margin-bottom: 24px;
    }

    .growth-title {
        font-size: 30px;
        font-weight: 900;
        color: #1e293b;
        margin: 0;
    }

    .growth-subtitle {
        color: #94a3b8;
        margin-top: 8px;
        font-size: 15px;
    }

    .growth-stat-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 24px;
    }

    .growth-stat-card {
        background: #ffffff;
        border-radius: 22px;
        padding: 22px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
        border: 1px solid #f1f5f9;
    }

    .growth-stat-label {
        font-size: 13px;
        color: #64748b;
        font-weight: 900;
        text-transform: uppercase;
    }

    .growth-stat-value {
        font-size: 30px;
        font-weight: 900;
        color: #1e293b;
        margin-top: 12px;
    }

    .growth-stat-note {
        font-size: 13px;
        color: #94a3b8;
        font-weight: 700;
        margin-top: 6px;
    }

    .growth-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 22px;
    }

    .growth-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 24px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
        border: 1px solid #f1f5f9;
    }

    .growth-card-title {
        font-size: 20px;
        font-weight: 900;
        color: #1e293b;
        margin-bottom: 18px;
    }

    .chart-box {
        height: 320px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .growth-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
        min-width: 900px;
    }

    .growth-table th {
        text-align: left;
        padding: 12px 16px;
        font-size: 12px;
        color: #64748b;
        text-transform: uppercase;
        font-weight: 900;
    }

    .growth-table td {
        background: #ffffff;
        padding: 16px;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 14px;
        font-weight: 700;
    }

    .growth-table td:first-child {
        border-left: 1px solid #f1f5f9;
        border-radius: 16px 0 0 16px;
    }

    .growth-table td:last-child {
        border-right: 1px solid #f1f5f9;
        border-radius: 0 16px 16px 0;
    }

    .metric-badge {
        display: inline-block;
        padding: 7px 13px;
        border-radius: 999px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 12px;
        font-weight: 900;
    }

    .empty-growth {
        text-align: center;
        padding: 45px;
        border: 1px dashed #cbd5e1;
        border-radius: 22px;
        background: #f8fafc;
        color: #94a3b8;
        font-weight: 800;
    }

    @media(max-width: 1200px) {
        .growth-stat-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media(max-width: 700px) {
        .growth-stat-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="growth-page">

    <div class="growth-header">
        <h1 class="growth-title">Catatan Pertumbuhan</h1>
        <p class="growth-subtitle">
            Pantau perkembangan berat badan, tinggi badan, lingkar kepala, suhu, dan riwayat pemeriksaan.
        </p>
    </div>

    @php
        $latest = $records->last();

        $labels = $records->map(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal_pemeriksaan)->format('d/m/Y');
        })->values();

        $beratData = $records->pluck('berat_badan')->map(fn($value) => $value ? (float) $value : null)->values();
        $tinggiData = $records->pluck('tinggi_badan')->map(fn($value) => $value ? (float) $value : null)->values();
        $lingkarData = $records->pluck('lingkar_kepala')->map(fn($value) => $value ? (float) $value : null)->values();
        $suhuData = $records->pluck('suhu')->map(fn($value) => $value ? (float) $value : null)->values();
    @endphp

    <div class="growth-stat-grid">
        <div class="growth-stat-card">
            <div class="growth-stat-label">Berat Badan Terakhir</div>
            <div class="growth-stat-value">
                {{ $latest->berat_badan ?? '-' }} kg
            </div>
            <div class="growth-stat-note">Data terakhir pemeriksaan</div>
        </div>

        <div class="growth-stat-card">
            <div class="growth-stat-label">Tinggi Badan Terakhir</div>
            <div class="growth-stat-value">
                {{ $latest->tinggi_badan ?? '-' }} cm
            </div>
            <div class="growth-stat-note">Data terakhir pemeriksaan</div>
        </div>

        <div class="growth-stat-card">
            <div class="growth-stat-label">Lingkar Kepala</div>
            <div class="growth-stat-value">
                {{ $latest->lingkar_kepala ?? '-' }} cm
            </div>
            <div class="growth-stat-note">Data terakhir pemeriksaan</div>
        </div>

        <div class="growth-stat-card">
            <div class="growth-stat-label">Suhu Tubuh</div>
            <div class="growth-stat-value">
                {{ $latest->suhu ?? '-' }} °C
            </div>
            <div class="growth-stat-note">Data terakhir pemeriksaan</div>
        </div>
    </div>

    @if($records->count() > 0)
        <div class="growth-grid">

            <div class="growth-card">
                <div class="growth-card-title">Grafik Berat Badan</div>
                <div class="chart-box">
                    <canvas id="beratChart"></canvas>
                </div>
            </div>

            <div class="growth-card">
                <div class="growth-card-title">Grafik Tinggi Badan</div>
                <div class="chart-box">
                    <canvas id="tinggiChart"></canvas>
                </div>
            </div>

            <div class="growth-card">
                <div class="growth-card-title">Grafik Lingkar Kepala</div>
                <div class="chart-box">
                    <canvas id="lingkarChart"></canvas>
                </div>
            </div>

            <div class="growth-card">
                <div class="growth-card-title">Grafik Suhu Tubuh</div>
                <div class="chart-box">
                    <canvas id="suhuChart"></canvas>
                </div>
            </div>

            <div class="growth-card">
                <div class="growth-card-title">Riwayat Pemeriksaan Pertumbuhan</div>

                <div class="table-responsive">
                    <table class="growth-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Berat</th>
                                <th>Tinggi</th>
                                <th>Lingkar Kepala</th>
                                <th>Suhu</th>
                                <th>Tekanan Darah</th>
                                <th>Dokter</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($records as $item)
                                <tr>
                                    <td>
                                        {{ \Carbon\Carbon::parse($item->tanggal_pemeriksaan)->format('d/m/Y') }}
                                    </td>

                                    <td>
                                        <span class="metric-badge">
                                            {{ $item->berat_badan ?? '-' }} kg
                                        </span>
                                    </td>

                                    <td>
                                        <span class="metric-badge">
                                            {{ $item->tinggi_badan ?? '-' }} cm
                                        </span>
                                    </td>

                                    <td>
                                        <span class="metric-badge">
                                            {{ $item->lingkar_kepala ?? '-' }} cm
                                        </span>
                                    </td>

                                    <td>
                                        <span class="metric-badge">
                                            {{ $item->suhu ?? '-' }} °C
                                        </span>
                                    </td>

                                    <td>
                                        {{ $item->tekanan_darah ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $item->tenagaMedis->nama ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    @else
        <div class="empty-growth">
            Belum ada data pertumbuhan. Data akan muncul setelah tenaga medis mengisi rekam medis.
        </div>
    @endif

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labels = @json($labels);
    const beratData = @json($beratData);
    const tinggiData = @json($tinggiData);
    const lingkarData = @json($lingkarData);
    const suhuData = @json($suhuData);

    function createLineChart(elementId, label, data, suffix) {
        const ctx = document.getElementById(elementId);

        if (!ctx) return;

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    borderWidth: 3,
                    tension: 0.35,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw + ' ' + suffix;
                            }
                        }
                    },
                    legend: {
                        labels: {
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        ticks: {
                            callback: function(value) {
                                return value + ' ' + suffix;
                            }
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
    }

    createLineChart('beratChart', 'Berat Badan', beratData, 'kg');
    createLineChart('tinggiChart', 'Tinggi Badan', tinggiData, 'cm');
    createLineChart('lingkarChart', 'Lingkar Kepala', lingkarData, 'cm');
    createLineChart('suhuChart', 'Suhu Tubuh', suhuData, '°C');
</script>
@endsection