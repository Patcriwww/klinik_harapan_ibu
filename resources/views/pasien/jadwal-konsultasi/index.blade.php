@extends('backoffice.layouts.app')

@section('breadcrumb', 'Booking Jadwal')
@section('title', 'Jadwal Konsultasi')

@section('content')
<style>
    .booking-page {
        padding: 26px;
    }

    .booking-card-main {
        background: #ffffff;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 8px 22px rgba(15, 23, 42, .08);
    }

    .booking-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 24px;
        margin-bottom: 28px;
    }

    .breadcrumb-text {
        font-size: 13px;
        color: #94a3b8;
        margin-bottom: 8px;
    }

    .booking-title-row {
        display: flex;
        align-items: center;
        gap: 18px;
        flex-wrap: wrap;
    }

    .booking-title {
        font-size: 34px;
        line-height: 1.1;
        font-weight: 900;
        color: #0f172a;
        margin: 0;
    }
    .date-card {
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .booking-subtitle {
        color: #64748b;
        font-size: 16px;
        margin-top: 8px;
    }

    .header-actions {
        display: flex;
        gap: 12px;
        align-items: center;
        flex-shrink: 0;
    }

    .btn-pill {
        border-radius: 999px;
        padding: 13px 24px;
        font-size: 14px;
        font-weight: 800;
        text-decoration: none;
        border: none;
        box-shadow: 0 8px 18px rgba(15, 23, 42, .14);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .btn-danger {
        background: #c91f1f;
        color: white;
    }

    .btn-white {
        background: white;
        color: #334155;
    }

    .btn-green {
        background: #8af08d;
        color: #14532d;
    }

    .booking-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 360px;
        gap: 28px;
        align-items: start;
    }

    .date-section {
        background: #eef3f9;
        border-radius: 28px;
        padding: 24px;
        box-shadow: 0 8px 16px rgba(15, 23, 42, .12);
        margin-bottom: 24px;
    }

    .section-title {
        font-size: 17px;
        font-weight: 900;
        color: #1e293b;
        margin-bottom: 18px;
    }

    .date-list {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 16px;
    }

    .date-card {
        height: 108px;
        border: none;
        border-radius: 18px;
        background: white;
        color: #94a3b8;
        box-shadow: 0 7px 12px rgba(15, 23, 42, .14);
        cursor: pointer;
    }

    .date-card.active {
        background: #006fd6;
        color: white;
    }

    .date-num {
        display: block;
        font-size: 28px;
        font-weight: 900;
        margin: 4px 0;
    }

    .filter-card {
        background: white;
        border-radius: 22px;
        padding: 18px;
        box-shadow: 0 8px 16px rgba(15, 23, 42, .08);
        margin-bottom: 24px;
    }

    .filter-card form {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .filter-card select {
        height: 44px;
        min-width: 240px;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 0 14px;
        color: #475569;
        outline: none;
    }

    .filter-card button {
        height: 44px;
        border: none;
        border-radius: 14px;
        padding: 0 20px;
        background: #006fd6;
        color: white;
        font-weight: 800;
        cursor: pointer;
    }

    .doctor-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
    }

    .doctor-card {
        background: white;
        border-radius: 26px;
        padding: 20px;
        box-shadow: 0 9px 18px rgba(15, 23, 42, .14);
    }

    .doctor-top {
        display: flex;
        gap: 16px;
        margin-bottom: 18px;
        align-items: flex-start;
    }

    .doctor-photo {
        width: 76px !important;
        height: 76px !important;
        border-radius: 18px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .doctor-specialist {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 999px;
        background: #dcfce7;
        color: #15803d;
        font-size: 11px;
        font-weight: 900;
        margin-bottom: 8px;
    }

    .doctor-name {
        font-size: 18px;
        font-weight: 900;
        color: #0f172a;
        margin: 0;
    }

    .doctor-review {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 6px;
    }

    .doctor-info {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .doctor-info span:first-child {
        color: #94a3b8;
    }

    .doctor-info span:last-child {
        color: #0f172a;
        font-weight: 800;
        text-align: right;
    }
    .doctor-card.selected {
        border: 2px solid #006fd6;
        background: #f8fbff;
    }

    .btn-booking.selected {
        background: #006fd6;
        color: white;
    }

    .btn-booking {
        width: 100%;
        height: 46px;
        margin-top: 12px;
        border: none;
        border-radius: 16px;
        background: #eef3f9;
        color: #006fd6;
        font-weight: 900;
        cursor: pointer;
        box-shadow: 0 6px 10px rgba(15, 23, 42, .14);
    }

    .btn-booking:hover {
        background: #006fd6;
        color: white;
    }

    .right-panel {
        background: white;
        border-radius: 28px;
        padding: 24px;
        box-shadow: 0 9px 20px rgba(15, 23, 42, .14);
        position: sticky;
        top: 24px;
    }

    .time-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-bottom: 24px;
    }

    .time-btn {
        height: 48px;
        border: none;
        border-radius: 16px;
        background: white;
        color: #334155;
        font-weight: 800;
        box-shadow: 0 5px 10px rgba(15, 23, 42, .16);
        cursor: pointer;
    }

    .time-btn.active,
    .time-btn:hover {
        background: #006fd6;
        color: white;
    }

    .keluhan {
        width: 100%;
        min-height: 130px;
        border: none;
        border-radius: 18px;
        background: #eef3f9;
        padding: 16px;
        resize: vertical;
        color: #475569;
        outline: none;
        font-size: 14px;
    }

    .summary {
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 16px;
        margin: 22px 0;
    }

    .summary-title {
        font-size: 12px;
        font-weight: 900;
        color: #94a3b8;
        letter-spacing: 1px;
        margin-bottom: 14px;
    }

    .summary-box {
        background: #eef3f9;
        border-radius: 16px;
        padding: 16px;
    }
        .date-card.disabled {
        opacity: .45;
        cursor: not-allowed;
        box-shadow: none;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        font-size: 13px;
        margin-bottom: 10px;
    }

    .summary-row:last-child {
        margin-bottom: 0;
    }

    .summary-row span:first-child {
        color: #94a3b8;
    }

    .summary-row span:last-child {
        color: #1e293b;
        font-weight: 800;
        text-align: right;
    }

    .btn-confirm {
        width: 100%;
        height: 54px;
        border: none;
        border-radius: 18px;
        background: #1696f3;
        color: white;
        font-weight: 900;
        cursor: pointer;
        box-shadow: 0 8px 16px rgba(22, 150, 243, .22);
    }

    .doctor-meta {
        flex: 1;
        min-width: 0;
    }

    .favorite-form {
        margin-left: auto;
    }

    .favorite-btn {
        width: 42px;
        height: 42px;
        border: none;
        border-radius: 50%;
        background: #f8fafc;
        font-size: 21px;
        cursor: pointer;
        box-shadow: 0 6px 16px rgba(15, 23, 42, .12);
        transition: .2s;
    }

    .favorite-btn.active {
        background: #fee2e2;
        color: #dc2626;
    }

    .favorite-btn:hover {
        transform: scale(1.08);
    }

    @media (max-width: 1200px) {
        .booking-layout {
            grid-template-columns: 1fr;
        }

        .right-panel {
            position: static;
        }
    }

    @media (max-width: 768px) {
        .booking-header {
            flex-direction: column;
        }

        .header-actions {
            flex-wrap: wrap;
        }

        .date-list,
        .doctor-grid,
        .time-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="booking-page">
    <div class="booking-card-main">

        <div class="booking-header">
            <div>
                <div class="breadcrumb-text">
                    Beranda / <span style="color:#006fd6;font-weight:800;">Booking Jadwal</span>
                </div>

                <div class="booking-title-row">
                    <h1 class="booking-title">Booking Jadwal Dokter</h1>
                    <button type="button" class="btn-pill btn-danger">⚠ Kunjungan Darurat</button>
                </div>

                <p class="booking-subtitle">
                    Temukan kenyamanan konsultasi dengan tenaga medis ahli kami.
                </p>
            </div>

            <div class="header-actions">
                <a href="{{ route('pasien.jadwal-konsultasi.riwayat') }}" class="btn-pill btn-white">
                    Lihat Riwayat
                </a> 
                <a href="{{ route('pasien.dokter-favorit.index') }}" class="btn-pill btn-green">❤ Dokter Favorit</a>
            </div>
        </div>

        <div class="booking-layout">

            <div class="left-area">

                <div class="date-section">
                    <div class="section-title">📅 Pilih Tanggal Konsultasi</div>

                    <div class="date-list">
                        @php
                            $dates = collect(range(0, 5))->map(function ($i) {
                                $date = now()->addDays($i);

                                return [
                                    'day' => $date->translatedFormat('D'),
                                    'date' => $date->format('d'),
                                    'month' => $date->translatedFormat('M'),
                                    'full_date' => $date->format('Y-m-d'),
                                    'active' => $i === 0,
                                    'disabled' => $date->isPast() && !$date->isToday(),
                                ];
                            });
                        @endphp

                        @foreach($dates as $date)
                        <a href="{{ route('pasien.jadwal-konsultasi.index', ['tanggal' => $date['full_date'], 'spesialis' => request('spesialis')]) }}"
                            class="date-card {{ $date['full_date'] == $selectedDate ? 'active' : '' }}">
                            <span style="font-size:12px;">{{ $date['day'] }}</span>
                            <span class="date-num">{{ $date['date'] }}</span>
                            <span style="font-size:12px;">{{ $date['month'] }}</span>

                            @if($date['active'])
                                <span style="font-size:10px;">Hari ini</span>
                            @endif
                        </a>
                        @endforeach
                    </div>
                </div>

                <div class="filter-card">
                    <form method="GET" action="{{ route('pasien.jadwal-konsultasi.index') }}">
                        <input type="hidden" name="tanggal" value="{{ $selectedDate }}">
                        <select name="spesialis">
                            <option value="">Semua Spesialis</option>
                            @foreach($spesialisList as $spesialis)
                                <option value="{{ $spesialis }}" {{ request('spesialis') == $spesialis ? 'selected' : '' }}>
                                    {{ $spesialis }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit">Filter Dokter</button>
                    </form>
                </div>

                <div class="doctor-grid">
                    @forelse($dokters as $dokter)
                        @php
                            $jadwal = $dokter->jadwalPraktik->first();
                        @endphp

                        <div class="doctor-card">
                           <div class="doctor-top">
                                @if($dokter->foto)
                                    <img src="{{ asset('storage/'.$dokter->foto) }}"
                                        class="doctor-photo"
                                        alt="{{ $dokter->nama }}">
                                @else
                                    <div class="doctor-photo"
                                        style="background:#dbeafe;color:#2563eb;display:flex;align-items:center;justify-content:center;font-weight:900;">
                                        {{ strtoupper(substr($dokter->nama, 0, 1)) }}
                                    </div>
                                @endif

                                <div class="doctor-meta">
                                    <span class="doctor-specialist">{{ $dokter->spesialis }}</span>
                                    <h6 class="doctor-name">{{ $dokter->nama }}</h6>
                                    <div class="doctor-review">⭐ 4.9 (120+ Review)</div>
                                </div>

                                <form action="{{ route('pasien.dokter-favorit.toggle', $dokter->id) }}"
                                    method="POST"
                                    class="favorite-form">
                                    @csrf

                                    <button type="submit"
                                            class="favorite-btn {{ in_array($dokter->id, $favoritDokterIds ?? []) ? 'active' : '' }}"
                                            title="Tambah/Hapus Favorit">
                                        {{ in_array($dokter->id, $favoritDokterIds ?? []) ? '❤️' : '🤍' }}
                                    </button>
                                </form>
                            </div>

                            <div class="doctor-info">
                                <span>Jam Praktek</span>
                                <span>
                                    @if($jadwal)
                                        {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>

                            <div class="doctor-info">
                                <span>Kuota</span>
                                <span style="color:#006fd6;">{{ $jadwal->kuota ?? 0 }} Pasien</span>
                            </div>

                            <button type="button"
                                    class="btn-booking"
                                    data-dokter-id="{{ $dokter->id }}"
                                    data-jadwal-id="{{ $jadwal->id ?? '' }}"
                                    data-kuota="{{ $jadwal->kuota ?? 0 }}"
                                    onclick="selectDokter(this, '{{ $dokter->nama }}', '{{ $jadwal ? $jadwal->hari : '-' }}', '{{ $jadwal ? \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') : '-' }}', '{{ $jadwal->kuota ?? 0 }}')">
                                Booking Sekarang
                            </button>
                        </div>
                    @empty
                        <div class="doctor-card" style="grid-column:1/-1;text-align:center;color:#94a3b8;">
                            Belum ada dokter tersedia.
                        </div>
                    @endforelse
                </div>

            </div>

            <div class="right-panel">
                <div class="section-title">🕘 Pilih Jam Tersedia</div>

                <div class="time-grid">
                    @foreach(['08:00', '09:00', '10:00', '11:00', '12:00', '13:00'] as $jam)
                        <button type="button" class="time-btn" onclick="selectJam(this, '{{ $jam }} WIB')">
                            {{ $jam }} WIB
                        </button>
                    @endforeach
                </div>

                <div class="section-title" style="font-size:15px;margin-bottom:10px;">
                    📋 Keluhan Pasien
                </div>

                <textarea id="keluhan"
                          class="keluhan"
                          placeholder="Jelaskan gejala atau keluhan kesehatan Anda secara singkat..."></textarea>

                <p style="font-size:11px;color:#94a3b8;margin-top:10px;">
                    Informasi ini akan langsung dikirimkan ke dokter Anda.
                </p>

                <div class="summary">
                    <div class="summary-title">RINGKASAN BOOKING</div>

                    <div class="summary-box">
                        <div class="summary-row">
                            <span>Dokter</span>
                            <span id="summaryDokter">-</span>
                        </div>
                        <div class="summary-row">
                            <span>Jadwal</span>
                            <span id="summaryJadwal">-</span>
                        </div>
                        <div class="summary-row">
                            <span>Jam</span>
                            <span id="summaryJam">-</span>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn-confirm" onclick="confirmBooking()">
                    Konfirmasi Booking
                </button>

                <p style="text-align:center;font-size:11px;color:#94a3b8;margin-top:16px;">
                    Dengan mengonfirmasi, Anda menyetujui Syarat & Ketentuan Klinik Harapan Ibu.
                </p>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let selectedDokter = '-';
    let selectedJadwal = '-';
    let selectedJam = '-';
    let selectedTanggal = "{{ $selectedDate }}";
    let selectedDokterId = null;
    let selectedJadwalId = null;
    let selectedKuota = 0;

    function selectDokter(button, dokter, hari, jam, kuota) {
        kuota = parseInt(kuota);

        if (!kuota || kuota <= 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Kuota Penuh',
                text: 'Jadwal dokter ini sudah tidak memiliki kuota tersedia.'
            });
            return;
        }

        selectedDokter = dokter;
        selectedJadwal = hari + ' ' + jam;
        selectedKuota = kuota;
        selectedDokterId = button.dataset.dokterId;
        selectedJadwalId = button.dataset.jadwalId;

        document.querySelectorAll('.doctor-card').forEach(card => {
            card.classList.remove('selected');
        });

        document.querySelectorAll('.btn-booking').forEach(btn => {
            btn.classList.remove('selected');
            btn.innerText = 'Booking Sekarang';
        });

        button.closest('.doctor-card').classList.add('selected');
        button.classList.add('selected');
        button.innerText = '✓ Dokter Dipilih';

        document.getElementById('summaryDokter').innerText = selectedDokter;
        document.getElementById('summaryJadwal').innerText = selectedJadwal;

        Swal.fire({
            icon: 'success',
            title: 'Dokter dipilih',
            text: dokter,
            timer: 1200,
            showConfirmButton: false
        });
    }
    function selectTanggal(button, tanggal) {
        document.querySelectorAll('.date-card').forEach(btn => {
            btn.classList.remove('active');
        });

        button.classList.add('active');
        selectedTanggal = tanggal;
    }

    function selectJam(button, jam) {
        selectedJam = jam;
        document.getElementById('summaryJam').innerText = selectedJam;

        document.querySelectorAll('.time-btn').forEach(btn => {
            btn.classList.remove('active');
        });

        button.classList.add('active');
    }

    function confirmBooking() {
    const keluhan = document.getElementById('keluhan').value;

    if (!selectedDokterId || !selectedJadwalId) {
        Swal.fire({
            icon: 'warning',
            title: 'Pilih Dokter',
            text: 'Silakan pilih dokter terlebih dahulu.'
        });
        return;
    }

    if (!selectedJam || selectedJam === '-') {
        Swal.fire({
            icon: 'warning',
            title: 'Pilih Jam',
            text: 'Silakan pilih jam konsultasi terlebih dahulu.'
        });
        return;
    }

    if (!keluhan.trim()) {
        Swal.fire({
            icon: 'warning',
            title: 'Isi Keluhan',
            text: 'Silakan isi keluhan pasien terlebih dahulu.'
        });
        return;
    }

    fetch("{{ route('pasien.jadwal-konsultasi.store') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            "Accept": "application/json"
        },
        body: JSON.stringify({
            tenaga_medis_id: selectedDokterId,
            jadwal_praktik_id: selectedJadwalId,
            tanggal_konsultasi: selectedTanggal,
            jam_konsultasi: selectedJam.replace(' WIB', ''),
            keluhan: keluhan
        })
    })
    .then(async response => {
        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || 'Booking gagal.');
        }

        return data;
        })
        .then(data => {
            Swal.fire({
                icon: 'success',
                title: 'Booking Berhasil!',
                html: `
                    <div style="font-size:16px;margin-top:10px;">
                        Nomor Antrian:<br>
                        <strong style="font-size:28px;color:#2563eb;">${data.nomor_antrian}</strong>
                        <br><br>
                        Kode Booking:<br>
                        <strong>${data.kode_booking}</strong>
                        <br><br>
                        <span style="color:#64748b;font-size:14px;">
                            Invoice pembayaran berhasil dibuat otomatis.
                            Silakan lanjutkan pembayaran melalui menu Pembayaran.
                        </span>
                    </div>
                `,
                confirmButtonColor: '#2563eb'
            }).then(() => {
                window.location.href = "{{ route('pasien.jadwal-konsultasi.riwayat') }}";
            });
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Booking Gagal',
                text: error.message
            });
        });
    }
</script>
@endpush