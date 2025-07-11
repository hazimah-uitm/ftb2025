@extends('layouts.app')

@section('content')
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center min-vh-100 py-2 mt-2">
            <div class="container">
                <div class="text-center">
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
                        <div class="card shadow-sm">
                            <div class="card-body p-3">
                                <div class="border p-3 rounded">
                                    <div class="text-center mb-2">
                                        <h3 class="">Register Account</h3>
                                    </div>
                                    <form method="POST" action="{{ route('register.store') }}"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <div class="row g-2">

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
                                                <label for="ic_no" class="form-label"> ID Number (IC No. / Passport / KTP)</label>
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
                                                <input type="text"
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

                                            <div class="col-12 d-grid mt-3">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bx bxs-user-plus"></i> Register Account
                                                </button>
                                            </div>

                                            <div class="col-12 text-center">
                                                <p class="mb-0 mt-2">Already have an account? <a
                                                        href="{{ route('login') }}">Login</a></p>
                                            </div>
                                        </div>
                                    </form>
                                </div><!-- card-body -->
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end wrapper-->
@endsection
