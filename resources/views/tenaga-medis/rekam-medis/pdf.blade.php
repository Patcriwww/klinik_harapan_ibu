<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekam Medis</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #1e293b; }
        .header { text-align: center; border-bottom: 2px solid #2563eb; padding-bottom: 12px; margin-bottom: 20px; }
        .title { font-size: 20px; font-weight: bold; margin-bottom: 4px; }
        .subtitle { font-size: 12px; color: #64748b; }
        .section { margin-bottom: 14px; }
        .label { font-weight: bold; color: #475569; margin-bottom: 4px; }
        .box { border: 1px solid #cbd5e1; padding: 10px; border-radius: 6px; min-height: 35px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        td { padding: 7px; border: 1px solid #cbd5e1; vertical-align: top; }
        .td-label { width: 30%; font-weight: bold; background: #f1f5f9; }
        .footer { margin-top: 35px; width: 100%; }
        .sign { width: 40%; float: right; text-align: center; }

        body{
            font-family: DejaVu Sans;
            font-size:12px;
            color:#334155;
        }

        .header{
            margin-bottom:25px;
        }

        .title{
            font-size:22px;
            font-weight:bold;
            color:#2563eb;
        }

        .subtitle{
            color:#64748b;
        }

        .section-title{
            background:#2563eb;
            color:white;
            padding:8px 12px;
            font-weight:bold;
            margin-top:18px;
            margin-bottom:10px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        td{
            border:1px solid #dbeafe;
            padding:8px;
        }

        .label{
            width:25%;
            font-weight:bold;
            background:#eff6ff;
        }
    </style>
</head>
<body>

    @php
        $logo = public_path('admin/assets/img/logo.png');
    @endphp

    <div class="header">
        <table width="100%" style="border:0; margin-bottom:15px;">
            <tr>
                <td width="90" style="border:0; vertical-align:middle;">
                    <img src="{{ $logo }}"
                        width="70"
                        height="70">
                </td>

                <td style="border:0; vertical-align:middle;">
                    <div style="
                        font-size:26px;
                        font-weight:bold;
                        color:#2563eb;
                        margin-bottom:4px;">
                        KLINIK HARAPAN IBU
                    </div>

                    <div style="
                        font-size:15px;
                        color:#64748b;">
                        Klinik Ibu dan Anak
                    </div>

                    <div style="
                        margin-top:8px;
                        font-size:12px;
                        color:#475569;">
                        Jl. Harapan Ibu No. 01<br>
                        Telp. (021) 12345678
                    </div>
                </td>

                <td style="
                    border:0;
                    text-align:right;
                    vertical-align:middle;">

                    <div style="
                        font-size:22px;
                        font-weight:bold;
                        color:#1e3a8a;">
                        REKAM MEDIS
                    </div>

                    <div style="
                        color:#64748b;
                        font-size:12px;">
                        Dokumen Resmi Pemeriksaan Pasien
                    </div>

                </td>
            </tr>
        </table>

        <hr style="
            border:none;
            border-top:3px solid #2563eb;
            margin-top:10px;">
    </div>

    <table>
        <tr>
            <td class="td-label">Nama Pasien</td>
            <td>{{ $rekamMedis->pasien->name ?? '-' }}</td>
            <td class="td-label">Tanggal Pemeriksaan</td>
            <td>{{ \Carbon\Carbon::parse($rekamMedis->tanggal_pemeriksaan)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td class="td-label">Dokter</td>
            <td>{{ $rekamMedis->tenagaMedis->nama ?? '-' }}</td>
            <td class="td-label">Nomor Antrian</td>
            <td>{{ $rekamMedis->booking->nomor_antrian ?? '-' }}</td>
        </tr>
        <tr>
            <td class="td-label">Kode Booking</td>
            <td>{{ $rekamMedis->booking->kode_booking ?? '-' }}</td>
            <td class="td-label">Tekanan Darah</td>
            <td>{{ $rekamMedis->tekanan_darah ?? '-' }}</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="td-label">Berat Badan</td>
            <td>{{ $rekamMedis->berat_badan ?? '-' }} kg</td>
            <td class="td-label">Tinggi Badan</td>
            <td>{{ $rekamMedis->tinggi_badan ?? '-' }} cm</td>
        </tr>
        <tr>
            <td class="td-label">Lingkar Kepala</td>
            <td>{{ $rekamMedis->lingkar_kepala ?? '-' }} cm</td>
            <td class="td-label">Suhu Tubuh</td>
            <td>{{ $rekamMedis->suhu ?? '-' }} °C</td>
        </tr>
    </table>

    <div class="section">
        <div class="label">Keluhan</div>
        <div class="box">{{ $rekamMedis->keluhan ?? '-' }}</div>
    </div>

    <div class="section">
        <div class="label">Diagnosa</div>
        <div class="box">{{ $rekamMedis->diagnosa ?? '-' }}</div>
    </div>

    <div class="section">
        <div class="label">Tindakan</div>
        <div class="box">{{ $rekamMedis->tindakan ?? '-' }}</div>
    </div>

    <div class="section">
        <div class="label">Resep Obat</div>
        <div class="box">{{ $rekamMedis->resep_obat ?? '-' }}</div>
    </div>

    <div class="section">
        <div class="label">Catatan Dokter</div>
        <div class="box">{{ $rekamMedis->catatan_dokter ?? '-' }}</div>
    </div>

    <div class="footer">
        <div class="sign">
            <p>Dokter Pemeriksa</p>
            <br><br><br>
            <strong>{{ $rekamMedis->tenagaMedis->nama ?? '-' }}</strong>
        </div>
    </div>

</body>
</html>