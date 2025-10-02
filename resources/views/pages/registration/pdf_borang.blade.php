<div class="logo-header">
    <img src="{{ $logoBase64 }}" alt="FTB Logo" height="120">
</div>

<div style="text-align: center; margin-bottom: 20px;">
    <h3>BORANG PENYERTAAN</h3>
    <h3>FESTIVAL TARI BORNEO IX (EDISI KE-9) 2025</h3>
    <h4>DEWAN JUBLI, UiTM CAWANGAN SARAWAK, KAMPUS SAMARAHAN </h4>
    <h4>(3 Disember 2025 - 4 Disember 2025)</h4>
    <h4>ANJURAN UiTM CAWANGAN SARAWAK</h4>
</div>

<div class="section-title">A. BUTIRAN KUMPULAN</div>
<table>
    <tr>
        <th style="width: 40%;">Nama Institusi</th>
        <td>{{ $registration->user->institution_name }}</td>
    </tr>
    <tr>
        <th>Nama Kumpulan</th>
        <td>{{ $registration->group_name }}</td>
    </tr>
    <tr>
        <th>Nama Tarian Tradisional Etnik Borneo</th>
        <td>{{ $registration->traditional_dance_name }}</td>
    </tr>
    <tr>
        <th>Nama Tarian Kreatif Etnik Borneo</th>
        <td>{{ $registration->creative_dance_name }}</td>
    </tr>
    <tr>
        <th>Alamat</th>
        <td>{{ $registration->address }}</td>
    </tr>
    <tr>
        <th>No. Telefon</th>
        <td>{{ $registration->user->phone_no }}</td>
    </tr>
    <tr>
        <th>E-mel</th>
        <td>{{ $registration->user->email }}</td>
    </tr>
    <tr>
        <th>Sinopsis Tarian Tradisional Etnik Borneo</th>
        <td>{!! nl2br(e($registration->sinopsis_traditional)) !!}</td>
    </tr>
    <tr>
        <th>Sinopsis Tarian Kreatif Etnik Borneo</th>
        <td>{!! nl2br(e($registration->sinopsis_creative)) !!}</td>
    </tr>
    <tr>
        <th>Status Kelulusan</th>
        <td>{{ $registration->status }}</td>
    </tr>
</table>

<div class="section-title">B. MAKLUMAT KUMPULAN</div>
<table>
    <thead>
        <tr>
            <th style="text-align: center">Bil.</th>
            <th style="text-align: center">Nama</th>
            <th style="text-align: center">No. Kad Pengenalan / Passport / No. KTP</th>
            <th style="text-align: center">No. Matrik / Kad Pelajar</th>
            <th style="text-align: center">Peranan</th>
            <th style="text-align: center">L</th>
            <th style="text-align: center">P</th>
            <th style="text-align: center">Saiz Baju</th>
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
@if ($registration->payments && $registration->payments->count())
    <table>
        <tr>
            <th>Kaedah Bayaran</th>
            <td>
                <span class="checkbox">{!! ($registration->payments[0]->payment_type ?? '') ==
                'Deposit terus ke akaun UiTMKS di cawangan BANK ISLAM MALAYSIA BERHAD'
                    ? '&#9745;'
                    : '&#9744;' !!}</span> Deposit terus ke akaun UiTMKS di cawangan BANK
                ISLAM
                MALAYSIA BERHAD<br>
                <span class="checkbox">{!! ($registration->payments[0]->payment_type ?? '') ==
                'Bayaran dibuat melalui pindahan wang (IBG Transfer) atau Telegraphic Transfer  (Bayaran dari luar negara)'
                    ? '&#9745;'
                    : '&#9744;' !!}</span> Bayaran dibuat melalui pindahan wang (IBG
                Transfer)
                atau Telegraphic Transfer (Bayaran dari luar negara)
            </td>
        </tr>
        <tr>
            <th>Tarikh Bayaran</th>
            <td>{{ $registration->payments[0]->date ?? '-' }}</td>
        </tr>
        <tr>
            <th>Bukti Bayaran</th>
            <td>
                @if (!empty($registration->payments[0]->payment_file))
                    <a href="{{ asset('public/storage/' . $registration->payments[0]->payment_file) }}"
                        target="_blank">
                        [Pautan Fail]
                    </a>
                @else
                    Tiada
                @endif
            </td>
        </tr>
    </table>
@else
    <p class="text-muted">Tiada maklumat pembayaran direkodkan.</p>
@endif
