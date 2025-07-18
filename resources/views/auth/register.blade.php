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
                                <div class="card-header text-center text-white" style="background-color: #03244c;">
                                    <h5 class="mb-0 text-white">COMPETITION DECLARATION LETTER</h5>
                                </div>
                                <div class="card-body p-4" style="max-height: 500px; overflow-y: auto;">
                                    <p>We are pleased to inform you that our team from:</p>

                                    <div class="row mb-3">
                                        <div class="col-md-6 mb-2">
                                            <input type="text" name="institution_name"
                                                class="form-control form-control-sm border-0 border-bottom rounded-0 shadow-none"
                                                placeholder="Institution Name" required
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
                                                    Type of Higher Education Institution</option>
                                                <option value="University"
                                                    {{ old('jenis_ipta') == 'University' ? 'selected' : '' }}>University
                                                </option>
                                                <option value="University College"
                                                    {{ old('jenis_ipta') == 'University College' ? 'selected' : '' }}>
                                                    University College</option>
                                                <option value="College"
                                                    {{ old('jenis_ipta') == 'College' ? 'selected' : '' }}>College</option>
                                                <option value="Teacher Training Institute"
                                                    {{ old('jenis_ipta') == 'Teacher Training Institute' ? 'selected' : '' }}>
                                                    Teacher Training Institute</option>
                                                <option value="Polytechnic"
                                                    {{ old('jenis_ipta') == 'Polytechnic' ? 'selected' : '' }}>Polytechnic
                                                </option>
                                                <option value="Community College"
                                                    {{ old('jenis_ipta') == 'Community College' ? 'selected' : '' }}>
                                                    Community College</option>
                                            </select>
                                        </div>
                                    </div>

                                    <p>
                                        is interested in participating in the <b>Festival Tari Borneo IX 2025</b> to be held
                                        on:
                                    </p>

                                    <ul>
                                        <li><b>Date: 18 November - 21 November 2025</b></li>
                                        <li><b>Venue: Dewan Jubli, UiTM Cawangan Sarawak Kampus Samarahan</b></li>
                                    </ul>
                                    <p>Hereby, we declare that;</p>
                                    <ol>
                                        <li>We will adhere to all rules and regulations set by the Organising Committee
                                            throughout the duration of the Festival Tari Borneo IX 2025.</li>
                                        <li>We acknowledge that the Organising Committee reserves the right to make any
                                            amendments throughout the programme as deemed appropriate for the benefit of all
                                            parties.</li>
                                        <li>We also acknowledge that the Organising Committee has the right to revoke our
                                            participation should we violate any of the participation rules.</li>
                                        <li>The organiser will ensure the festival runs smoothly and safely. However, any
                                            injuries or accidents occurring during FTB 2025 will be the sole responsibility
                                            of
                                            the participants.</li>
                                    </ol>

                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" id="consentCheckbox" name="consent"
                                            {{ old('consent') ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="consentCheckbox">
                                            I have read and agreed to the above Competition Declaration Letter.
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Registration Card -->
                            <div class="card shadow mt-4" id="account-registration">
                                <div class="card-header text-center text-white" style="background-color: #03244c;">
                                    <h5 class="mb-0 text-white">ACCOUNT REGISTRATION</h5>
                                </div>

                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label for="name" class="form-label">Full Name</label>
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
                                            <label for="ic_no" class="form-label">Identification Card / Passport / KTP
                                                Number</label>
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
                                            <label for="position" class="form-label">Position</label>
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
                                            <label for="phone_no" class="form-label">Phone Number</label>
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
                                            <label for="email" class="form-label">Email Address</label>
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
                                            <label for="password" class="form-label">Password</label>
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
                                            <label for="password-confirm" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" id="password-confirm"
                                                name="password_confirmation" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <p class="mb-0">Already have account? <a href="{{ route('login') }}">Login</a></p>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="bx bxs-user-plus"></i> Register Account
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
