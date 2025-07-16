@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="d-flex align-items-center justify-content-center min-vh-100 py-4">
            <div class="container">
                <div class="text-center mb-3">
                    <div class="d-flex align-items-center justify-content-center flex-column flex-md-row">
                        <img src="{{ asset('public/assets/images/logo-ftb1.png') }}" class="logo-icon-login" alt="logo icon">
                    </div>
                    <h4 class="logo-text-login mb-0">FESTIVAL TARI BORNEO IX (EDISI KE-9) 2025</h4>
                    <h6 class="logo-subtitle-login mb-0">ANJURAN UiTM CAWANGAN SARAWAK</h6>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-8">

                        <!-- Step 1: Surat Akuan -->
                        <div class="card shadow mb-4" id="step1Card">
                            <div class="card-header text-center text-white" style="background-color: #03244c;">
                                <h5 class="mb-0 text-white">SURAT AKUAN PERTANDINGAN</h5>
                            </div>
                            <div class="card-body p-4" style="max-height: 500px; overflow-y: auto;">
                                {{-- <p class="text-center fw-bold mb-2">FESTIVAL TARI BORNEO IX (EDISI KE-9) 2025</p>
                                <p class="text-center mb-3">
                                    ANJURAN UiTM CAWANGAN SARAWAK<br>
                                    18 NOVEMBER - 21 NOVEMBER 2025<br>
                                    DEWAN JUBLI, UITM CAWANGAN SARAWAK KAMPUS SAMARAHAN
                                </p>
                                <hr> --}}
                                <p>
                                    Sukacita dimaklumkan bahawa pasukan kami dari:
                                </p>

                                <div class="row mb-3">
                                    <div class="col-md-6 mb-2">
                                        <input type="text" id="institutionInput"
                                            class="form-control form-control-sm border-0 border-bottom rounded-0 shadow-none"
                                            placeholder="Nama Institusi" required>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <select id="jenisIptaSelect"
                                            class="form-select form-select-sm border-0 border-bottom rounded-0 shadow-none"
                                            required>
                                            <option value="" disabled selected>Jenis IPTA</option>
                                            <option>Universiti</option>
                                            <option>Kolej Universiti</option>
                                            <option>Kolej</option>
                                            <option>Institusi Perguruan</option>
                                            <option>Politeknik</option>
                                            <option>Kolej Komuniti</option>
                                        </select>
                                    </div>
                                </div>


                                <p>
                                    berminat untuk menyertai Festival Tari Borneo IX (Edisi Ke-9) 2025 pada:
                                </p>

                                <ul>
                                    <li>Tarikh: 18 November - 21 November 2025</li>
                                    <li>Tempat: Dewan Jubli, UiTM Cawangan Sarawak Kampus Samarahan</li>
                                </ul>
                                <p>Dengan ini;</p>
                                <ol>
                                    <li>Kami akan mematuhi setiap peraturan dan syarat seperti yang ditetapkan oleh pihak
                                        Jawatankuasa Penganjur sepanjang berlangsungnya festival.</li>
                                    <li>Kami mengakui bahawa pihak Jawatankuasa Penganjur berhak membuat sebarang pindaan
                                        sepanjang program mengikut kesesuaian demi kebaikan semua pihak.</li>
                                    <li>Kami juga mengakui bahawa pihak Jawatankuasa Penganjur berhak membatalkan penyertaan
                                        kami sekiranya kami melanggar peraturan penyertaan yang telah ditetapkan.</li>
                                    <li>Pihak penganjur akan memastikan festival berjalan dengan lancar dan selamat. Namun
                                        begitu, sebarang kecederaan atau kemalangan sepanjang FTB 2025 berlangsung adalah
                                        atas tanggung jawab peserta.</li>
                                </ol>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="consentCheckbox">
                                    <label class="form-check-label" for="consentCheckbox">
                                        Saya telah membaca dan bersetuju dengan Surat Akuan Pertandingan di atas.
                                    </label>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <p class="mb-0">
                                    Sudah ada akaun? <a href="{{ route('login') }}">Log Masuk</a>
                                </p>
                                <button id="nextButton" class="btn btn-primary btn-sm" disabled>Seterusnya <i
                                        class='bx bx-right-arrow-alt'></i></button>
                            </div>
                        </div>

                        <!-- Step 2: Form Pendaftaran -->
                        <div class="card shadow" id="step2Card" style="display: none;">
                            <div class="card-header text-center text-white" style="background-color: #03244c;">
                                <h5 class="mb-0 text-white">Borang Pendaftaran Akaun</h5>
                            </div>

                            <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <input type="hidden" id="hiddenInstitution" name="institution_name"
                                    value="{{ old('institution_name', '') }}">

                                <input type="hidden" id="hiddenJenisIpta" name="jenis_ipta"
                                    value="{{ old('jenis_ipta', '') }}">

                                <div class="card-body p-4">
                                    <div class="row g-3">

                                        <div class="col-md-6">
                                            <label class="form-label">Nama Institusi</label>
                                            <input type="text" id="displayInstitution" class="form-control" readonly
                                                value="{{ old('institution_name', '') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Jenis IPTA</label>
                                            <input type="text" id="displayJenisIpta" class="form-control" readonly
                                                value="{{ old('jenis_ipta', '') }}">
                                        </div>

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
                                            <label for="ic_no" class="form-label">Nombor Pengenalan (IC / Passport /
                                                KTP)</label>
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
                                            <label for="phone_no" class="form-label">Nombor Telefon</label>
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
                                    <button type="button" id="backButton" class="btn btn-sm btn-secondary">
                                        <i class='bx bx-left-arrow-alt'></i> Kembali
                                    </button>
                                    <div>
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="bx bxs-user-plus"></i> Daftar Akaun
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- card -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nextButton = document.getElementById('nextButton');
            const backButton = document.getElementById('backButton');
            const consentCheckbox = document.getElementById('consentCheckbox');
            const institutionInput = document.getElementById('institutionInput');
            const jenisIptaSelect = document.getElementById('jenisIptaSelect');
            const step1Card = document.getElementById('step1Card');
            const step2Card = document.getElementById('step2Card');

            const hiddenInstitution = document.getElementById('hiddenInstitution');
            const hiddenJenisIpta = document.getElementById('hiddenJenisIpta');

            function validateStep1() {
                if (
                    consentCheckbox.checked &&
                    institutionInput.value.trim() !== '' &&
                    jenisIptaSelect.value !== ''
                ) {
                    nextButton.disabled = false;
                } else {
                    nextButton.disabled = true;
                }
            }

            institutionInput.addEventListener('input', validateStep1);
            jenisIptaSelect.addEventListener('change', validateStep1);
            consentCheckbox.addEventListener('change', validateStep1);

            nextButton.addEventListener('click', function() {
                hiddenInstitution.value = institutionInput.value;
                hiddenJenisIpta.value = jenisIptaSelect.value;

                document.getElementById('displayInstitution').value = institutionInput.value;
                document.getElementById('displayJenisIpta').value = jenisIptaSelect.value;

                step1Card.style.display = 'none';
                step2Card.style.display = 'block';
            });

            backButton.addEventListener('click', function() {
                step2Card.style.display = 'none';
                step1Card.style.display = 'block';
            });
        });
    </script>
@endsection
