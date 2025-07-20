<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Borang Penyertaan FTB2025</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; line-height: 1.5; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        h3, h4 { text-align: center; margin: 5px 0; }
        .section-title { font-weight: bold; margin-top: 20px; }
        .logo-header { text-align: center; margin-bottom: 10px; }
        .checkbox { font-family: DejaVu Sans, sans-serif; font-size: 12pt;}
        .tickbox { font-family: DejaVu Sans, sans-serif; font-size: 12pt;}
    </style>
</head>
<body>
    <div class="logo-header">
        <img src="{{ asset('public/assets/images/logo-ftb1.png') }}" alt="Logo FTB" height="90">
    </div>

    <h3>BORANG PENYERTAAN</h3>
    <h4>FESTIVAL TARI BORNEO IX (EDISI KE-9) 2025</h4>
    <h4>18 - 21 NOVEMBER 2025 | DEWAN JUBLI, UiTM CAWANGAN SARAWAK</h4>

    <div class="section-title">A. BUTIRAN KUMPULAN</div>
    <table>
        <tr><th style="width: 40%">Nama Institusi</th><td>{{ $registration->user->institution_name }}</td></tr>
        <tr><th>Nama Kumpulan</th><td>{{ $registration->group_name }}</td></tr>
        <tr><th>Nama Tarian Tradisional Etnik Borneo</th><td>{{ $registration->traditional_dance_name }}</td></tr>
        <tr><th>Nama Tarian Kreatif Etnik Borneo</th><td>{{ $registration->creative_dance_name }}</td></tr>
        <tr><th>Nama Pegawai Pengiring</th><td>{{ $registration->members->where('peranan','Pengiring')->pluck('name')->implode(', ') ?: '-' }}</td></tr>
        <tr><th>Nama Koreografer</th><td>{{ $registration->koreografer_name ?? '-' }}</td></tr>
        <tr><th>Nama Pembantu Koreografer</th><td>{{ $registration->assistant_koreografer_name ?? '-' }}</td></tr>
        <tr><th>Alamat</th><td>{{ $registration->address }}</td></tr>
        <tr><th>No. Telefon</th><td>{{ $registration->user->phone_no }}</td></tr>
        <tr><th>E-mel</th><td>{{ $registration->user->email }}</td></tr>
        <tr><th>Sinopsis Tarian Tradisional Etnik Borneo</th><td>{!! nl2br(e($registration->sinopsis_traditional)) !!}</td></tr>
        <tr><th>Sinopsis Tarian Kreatif Etnik Borneo</th><td>{!! nl2br(e($registration->sinopsis_creative)) !!}</td></tr>
        <tr><th>Status Kelulusan</th><td>{{ $registration->status }}</td></tr>
    </table>

    <div class="section-title">B. MAKLUMAT KUMPULAN</div>
    <table>
        <thead>
            <tr>
                <th>BIL</th>
                <th>NAMA AHLI</th>
                <th>NO. K/P / KTP</th>
                <th>NO. MATRIK</th>
                <th>PERANAN</th>
                <th>L</th>
                <th>P</th>
                <th>SAIZ BAJU</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registration->members as $index => $member)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->ic_no }}</td>
                <td>{{ $member->student_id ?: '-' }}</td>
                <td>{{ $member->peranan }}</td>
                <td style="text-align: center" class="tickbox">{!! $member->jantina == 'Lelaki' ? '&#10003;' : '' !!}</td>
                <td style="text-align: center" class="tickbox">{!! $member->jantina == 'Perempuan' ? '&#10003;' : '' !!}</td>
                <td>{{ $member->saiz_baju }}</td>
            </tr>
            @endforeach
            {{-- @for ($i = $registration->members->count(); $i < 25; $i++)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td colspan="7">&nbsp;</td>
            </tr>
            @endfor --}}
        </tbody>
    </table>

    <div class="section-title">C. PENGESAHAN PEMBAYARAN YURAN KOMITMEN</div>
    <table>
        <tr>
            <th>Kaedah Bayaran</th>
            <td>
                <span class="checkbox">{!! ($registration->payments[0]->payment_type ?? '') == 'Deposit terus ke akaun UiTMKS di cawangan BANK ISLAM MALAYSIA BERHAD' ? '&#9745;' : '&#9744;' !!}</span> Deposit terus ke akaun UiTMKS di cawangan BANK ISLAM MALAYSIA BERHAD<br>
                <span class="checkbox">{!! ($registration->payments[0]->payment_type ?? '') == 'Bayaran dibuat melalui pindahan wang (IBG Transfer) atau Telegraphic Transfer  (Bayaran dari luar negara)' ? '&#9745;' : '&#9744;' !!}</span> Bayaran dibuat melalui pindahan wang (IBG Transfer) atau Telegraphic Transfer  (Bayaran dari luar negara)
            </td>
        </tr>
        <tr><th>Tarikh Bayaran</th><td>{{ $registration->payments[0]->date ?? '-' }}</td></tr>
        <tr><th>Bukti Bayaran</th><td>{{ $registration->payments[0]->payment_file ?? '-' }}</td></tr>
    </table>
</body>
</html>
