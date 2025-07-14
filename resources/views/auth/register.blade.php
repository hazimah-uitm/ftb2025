@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="d-flex align-items-center justify-content-center min-vh-100 py-4">
        <div class="container">
            <div class="text-center mb-4">
                <div class="d-flex align-items-center justify-content-center flex-column flex-md-row mb-4">
                    <img src="{{ asset('public/assets/images/putih.png') }}" class="logo-icon-login" alt="logo icon">
                    <div class="ms-3">
                        <h4 class="logo-text-login mb-0">FTB2025</h4>
                        <h6 class="logo-subtitle-login mb-0">Festival Tari Borneo 2025</h6>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <!-- Surat Akuan -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header text-center">
                            <h5 class="mb-0">SURAT AKUAN PERTANDINGAN</h5>
                        </div>
                        <div class="card-body p-4" style="max-height: 500px; overflow-y: auto; background-color: #f8f9fa;">
                            <p class="text-center fw-bold mb-2">FESTIVAL TARI BORNEO IX (EDISI KE-9) 2025</p>
                            <p class="text-center mb-3">
                                ANJURAN UiTM CAWANGAN SARAWAK<br>
                                18 NOVEMBER - 21 NOVEMBER 2025<br>
                                DEWAN JUBLI, UITM CAWANGAN SARAWAK KAMPUS SAMARAHAN
                            </p>

                            <p>
                                Sukacita dimaklumkan bahawa pasukan kami dari 
                                <span class="fw-bold" id="live-institution">____________________</span>
                                (universiti / Kolej Universiti / Kolej / Institusi Perguruan / Politeknik / Kolej Komuniti)
                                berminat untuk menyertai Festival Tari Borneo IX (Edisi Ke-9) 2025 pada:
                            </p>

                            <ul>
                                <li>Tarikh: 18 November - 21 November 2025</li>
                                <li>Tempat: Dewan Jubli, UiTM Cawangan Sarawak Kampus Samarahan</li>
                            </ul>

                            <p>Dengan ini;</p>
                            <ol>
                                <li>Kami akan mematuhi setiap peraturan dan syarat seperti yang ditetapkan oleh pihak Jawatankuasa Penganjur sepanjang berlangsungnya Festival Tari Borneo IX (Edisi Ke-9) 2025.</li>
                                <li>Kami mengakui bahawa pihak Jawatankuasa Penganjur berhak membuat sebarang pindaan sepanjang program mengikut kesesuaian demi kebaikan semua pihak.</li>
                                <li>Kami juga mengakui bahawa pihak Jawatankuasa Penganjur berhak membatalkan penyertaan kami sekiranya kami melanggar peraturan penyertaan yang telah ditetapkan.</li>
                                <li>Pihak penganjur akan memastikan festival berjalan dengan lancar dan selamat. Namun begitu, sebarang kecederaan atau kemalangan sepanjang FTB 2025 berlangsung adalah atas tanggung jawab peserta.</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Borang Pendaftaran -->
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="institution_name" class="form-label">Nama Institusi</label>
                                        <input type="text"
                                               class="form-control {{ $errors->has('institution_name') ? 'is-invalid' : '' }}"
                                               id="institution_name" name="institution_name"
                                               value="{{ old('institution_name') }}" required>
                                        @if ($errors->has('institution_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('institution_name') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Nama Penuh</label>
                                        <input type="text"
                                               class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                               id="name" name="name"
                                               value="{{ old('name') }}" required>
                                        @if ($errors->has('name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <label for="ic_no" class="form-label">Nombor Pengenalan (IC / Passport / KTP)</label>
                                        <input type="text"
                                               class="form-control {{ $errors->has('ic_no') ? 'is-invalid' : '' }}"
                                               id="ic_no" name="ic_no"
                                               value="{{ old('ic_no') }}" required>
                                        @if ($errors->has('ic_no'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('ic_no') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Alamat Emel</label>
                                        <input type="email"
                                               class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                               id="email" name="email"
                                               value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <label for="position" class="form-label">Jawatan</label>
                                        <input type="text"
                                               class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}"
                                               id="position" name="position"
                                               value="{{ old('position') }}" required>
                                        @if ($errors->has('position'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('position') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <label for="phone_no" class="form-label">Nombor Telefon</label>
                                        <input type="text"
                                               class="form-control {{ $errors->has('phone_no') ? 'is-invalid' : '' }}"
                                               id="phone_no" name="phone_no"
                                               value="{{ old('phone_no') }}" required>
                                        @if ($errors->has('phone_no'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('phone_no') }}
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
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password-confirm" class="form-label">Sahkan Kata Laluan</label>
                                        <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="form-check mt-4 mb-3">
                                    <input class="form-check-input {{ $errors->has('consent') ? 'is-invalid' : '' }}"
                                           type="checkbox" id="consent" name="consent" value="1" required>
                                    <label class="form-check-label" for="consent">
                                        Saya telah membaca dan bersetuju dengan Surat Akuan Pertandingan di atas.
                                    </label>
                                    @if ($errors->has('consent'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('consent') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bx bxs-user-plus"></i> Daftar Akaun
                                    </button>
                                </div>

                                <div class="text-center mt-3">
                                    <p class="mb-0">Sudah ada akaun? <a href="{{ route('login') }}">Log Masuk</a></p>
                                </div>
                            </form>
                        </div>
                    </div><!-- card -->

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const institutionInput = document.getElementById('institution_name');
        const liveInstitution = document.getElementById('live-institution');
        institutionInput.addEventListener('input', function() {
            liveInstitution.textContent = this.value.trim() ? this.value : '____________________';
        });
    });
</script>
@endsection
