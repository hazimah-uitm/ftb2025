@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="d-flex align-items-center justify-content-center min-vh-100 py-4">
            <div class="container">
                <div class="text-center">
                    <div class="d-flex align-items-center justify-content-center flex-column flex-md-row mb-0">
                        <img src="{{ asset('public/assets/images/logo-ftb1.png') }}" class="img-fluid logo-icon-login"
                            alt="logo icon" style="max-width: 100%; height: auto;">
                    </div>
                    <div class="mb-3">
                        <h4 class="logo-text-login mb-0">FESTIVAL TARI BORNEO IX (EDISI KE-9) 2025</h4>
                        <h6 class="logo-subtitle-login mb-0">ORGANISED BY UiTM CAWANGAN SARAWAK</h6>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-8">

                        <!-- Full form starts -->
                        <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <!-- Declaration Card -->
                            <div class="card shadow mb-4">
                                <div class="card-header text-center bg-light">
                                    <h5 class="mb-0">SURAT AKUAN PERTANDINGAN</h5>
                                </div>
                                <div class="card-body p-4" style="max-height: 500px; overflow-y: auto;">
                                    <p>Sukacita dimaklumkan bahawa pasukan kami:</p>

                                    <div class="row mb-3">
                                        <div class="col-md-6 mb-2">
                                            <input type="text" name="institution_name"
                                                class="form-control form-control-sm border-0 border-bottom rounded-0 shadow-none"
                                                placeholder="Sila isikan nama institusi" required
                                                value="{{ old('institution_name') }}">
                                            @if ($errors->has('institution_name'))
                                                <div class="text-danger small">
                                                    @foreach ($errors->get('institution_name') as $error)
                                                        {{ $error }}
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <select name="jenis_ipta"
                                                class="form-select form-select-sm border-0 border-bottom rounded-0 shadow-none"
                                                required>
                                                <option value="" disabled {{ old('jenis_ipta') ? '' : 'selected' }}>
                                                    Jenis Institut Pengajian Tinggi</option>
                                                <option value="Universiti"
                                                    {{ old('jenis_ipta') == 'Universiti' ? 'selected' : '' }}>Universiti
                                                </option>
                                                <option value="Kolej Universiti"
                                                    {{ old('jenis_ipta') == 'Kolej Universiti' ? 'selected' : '' }}>
                                                    Kolej Universiti</option>
                                                <option value="Kolej"
                                                    {{ old('jenis_ipta') == 'Kolej' ? 'selected' : '' }}>Kolej</option>
                                                <option value="Institut Perguruan"
                                                    {{ old('jenis_ipta') == 'Institut Perguruan' ? 'selected' : '' }}>
                                                    Institut Perguruan</option>
                                                <option value="Politeknik"
                                                    {{ old('jenis_ipta') == 'Politeknik' ? 'selected' : '' }}>Politeknik
                                                </option>
                                                <option value="Kolej Komuniti"
                                                    {{ old('jenis_ipta') == 'Kolej Komuniti' ? 'selected' : '' }}>
                                                    Kolej Komuniti</option>
                                            </select>
                                        </div>
                                    </div>

                                    <p>
                                        berminat untuk menyertai <b>Festival Tari Borneo IX (Edisi ke-9) 2025</b> pada:
                                    </p>

                                    <ul>
                                        <li><b>Tarikh: 18 November - 21 November 2025</b></li>
                                        <li><b>Tempat: Dewan Jubli, UiTM Cawangan Sarawak Kampus Samarahan</b></li>
                                    </ul>
                                    <p>Dengan ini;</p>
                                    <ol>
                                        <li>Kami akan mematuhi setiap peraturan dan syarat seperti yang ditetapkan oleh pihak Jawatankuasa Penganjur sepanjang berlangsungnya Festival Tari Borneo IX (Edisi Ke-9) 2025.</li>
                                        <li>Kami mengakui bahawa pihak Jawatankuasa Penganjur berhak membuat sebarang pindaan sepanjang program mengikut kesesuaian demi kebaikan semua pihak.</li>
                                        <li>Kami juga mengakui bahawa pihak Jawatankuasa Penganjur berhak membatalkan penyertaan kami sekiranya kami melanggar peraturan penyertaan yang telah ditetapkan.</li>
                                        <li>Pihak penganjur akan memastikan festival berjalan dengan lancar dan selamat. Namun begitu, sebarang kecederaan atau kemalangan sepanjang FTB 2025 berlangsung adalah atas tanggung jawab peserta.</li>
                                    </ol>

                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" id="consentCheckbox" name="consent"
                                            {{ old('consent') ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="consentCheckbox">
                                            Saya telah membaca dan bersetuju dengan Surat Akuan Pertandingan di atas.
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Registration Card -->
                            <div class="card shadow mt-4" id="account-registration">
                                <div class="card-header bg-light text-center">
                                    <h5 class="mb-0">DAFTAR AKAUN</h5>
                                </div>

                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label for="name" class="form-label">Nama Penuh</label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                id="name" name="name" value="{{ old('name') }}" required>
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    @foreach ($errors->get('name') as $error)
                                                        {{ $error }}
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-md-6">
                                            <label for="ic_no" class="form-label">No. Kad Pengenalan / Passport / KTP</label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('ic_no') ? 'is-invalid' : '' }}"
                                                id="ic_no" name="ic_no" value="{{ old('ic_no') }}" required>
                                            @if ($errors->has('ic_no'))
                                                <div class="invalid-feedback">
                                                    @foreach ($errors->get('ic_no') as $error)
                                                        {{ $error }}
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-md-6">
                                            <label for="position" class="form-label">Jawatan</label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}"
                                                id="position" name="position" value="{{ old('position') }}" required>
                                            @if ($errors->has('position'))
                                                <div class="invalid-feedback">
                                                    @foreach ($errors->get('position') as $error)
                                                        {{ $error }}
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-md-6">
                                            <label for="phone_no" class="form-label">No. Telefon</label>
                                            <input type="number"
                                                class="form-control {{ $errors->has('phone_no') ? 'is-invalid' : '' }}"
                                                id="phone_no" name="phone_no" value="{{ old('phone_no') }}" required>
                                            @if ($errors->has('phone_no'))
                                                <div class="invalid-feedback">
                                                    @foreach ($errors->get('phone_no') as $error)
                                                        {{ $error }}
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Alamat Emel</label>
                                            <input type="email"
                                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                id="email" name="email" value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                                <div class="invalid-feedback">
                                                    @foreach ($errors->get('email') as $error)
                                                        {{ $error }}
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-md-6">
                                            <label for="password" class="form-label">Kata Laluan</label>
                                            <input type="password"
                                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                id="password" name="password" required>
                                            @if ($errors->has('password'))
                                                <div class="invalid-feedback">
                                                    @foreach ($errors->get('password') as $error)
                                                        {{ $error }}
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-md-6">
                                            <label for="password-confirm" class="form-label">Sahkan Kata Laluan</label>
                                            <input type="password" class="form-control" id="password-confirm"
                                                name="password_confirmation" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <p class="mb-0">Anda sudah mempunyai akaun? <a href="{{ route('login') }}">Log Masuk</a></p>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="bx bxs-user-plus"></i> Daftar Akaun
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- Full form ends -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('consentCheckbox');
        checkbox.addEventListener('change', function () {
            if (this.checked) {
                document.getElementById('account-registration').scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
</script>

@endsection
