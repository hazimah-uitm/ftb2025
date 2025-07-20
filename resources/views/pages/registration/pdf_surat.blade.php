<div class="logo-header">
    <img src="{{ $logoBase64 }}" alt="FTB Logo" height="120">
</div>

<div style="text-align: center; margin-bottom: 20px;">
    <h3>SURAT AKUAN PERTANDINGAN</h3>
    <h3>FESTIVAL TARI BORNEO IX (EDISI KE-9) 2025</h3>
    <h4>ANJURAN UiTM CAWANGAN SARAWAK</h4>
    <p><strong>18 - 21 NOVEMBER 2025</strong><br>
        <strong>DEWAN JUBLI, UiTM CAWANGAN SARAWAK, KAMPUS SAMARAHAN</strong></p>
</div>

<p>Sukacita dimaklumkan bahawa pasukan kami dari {{ $registration->user->jenis_ipta ?? '-' }}
    <strong>{{ $registration->user->institution_name }}</strong> berminat untuk menyertai <strong>Festival Tari Borneo
        IX (Edisi ke-9) 2025</strong> pada:
</p>

<ul style="margin-left: 30px;">
    <li><strong>Tarikh: 18 November - 21 November 2025</strong></li>
    <li><strong>Tempat: Dewan Jubli, UiTM Cawangan Sarawak, Kampus Samarahan</strong></li>
</ul>

<p>Dengan ini:</p>
<ol>
    <li>Kami akan mematuhi setiap peraturan dan syarat seperti yang ditetapkan oleh pihak Jawatankuasa
        Penganjur sepanjang berlangsungnya Festival Tari Borneo IX (Edisi Ke-9) 2025.</li>
    <li>Kami mengakui bahawa pihak Jawatankuasa Penganjur berhak membuat sebarang pindaan sepanjang
        program mengikut kesesuaian demi kebaikan semua pihak.</li>
    <li>Kami juga mengakui bahawa pihak Jawatankuasa Penganjur berhak membatalkan penyertaan kami
        sekiranya kami melanggar peraturan penyertaan yang telah ditetapkan.</li>
    <li>Pihak penganjur akan memastikan festival berjalan dengan lancar dan selamat. Namun begitu,
        sebarang kecederaan atau kemalangan sepanjang FTB 2025 berlangsung adalah atas tanggung jawab
        peserta.</li>
</ol>

<br>
<table style="width: 100%;">
    <tr>
        <th style="width: 40%;">Tarikh</th>
        <td>{{ \Carbon\Carbon::parse($registration->user->created_at)->format('d/m/Y') }}</td>
    </tr>
    <tr>
        <th>Nama</th>
        <td>{{ $registration->user->name }}</td>
    </tr>
    <tr>
        <th>Jawatan</th>
        <td>{{ $registration->user->position }}</td>
    </tr>
    <tr>
        <th>No. Kad Pengenalan / Passport / KTP</th>
        <td>{{ $registration->user->ic_no }}</td>
    </tr>
    <tr>
        <th>No. Telefon</th>
        <td>{{ $registration->user->phone_no }}</td>
    </tr>
    <tr>
        <th>Alamat Emel</th>
        <td>{{ $registration->user->email }}</td>
    </tr>
</table>
