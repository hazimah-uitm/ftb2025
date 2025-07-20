@extends('layouts.app')

@section('content')
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card shadow mb-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <div
                                        class="d-flex align-items-center justify-content-center flex-column flex-md-row mb-0">
                                        <img src="{{ asset('public/assets/images/logo-ftb1.png') }}"
                                            class="img-fluid logo-icon-login" alt="logo icon"
                                            style="max-width: 100%; height: auto;">
                                    </div>
                                    <div class="mb-3">
                                        <h4 class="logo-text-login mb-0">FESTIVAL TARI BORNEO IX (EDISI KE-9) 2025</h4>
                                        <h6 class="logo-subtitle-login mb-0">
                                            ANJURAN UiTM CAWANGAN SARAWAK
                                        </h6>
                                    </div>
                                </div>

                                <div class="border p-4 rounded">
                                    <div class="text-center mb-4">
                                        <h5 class="text-primary fw-semibold">LOG MASUK</h5>
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @if ($errors->count() == 1)
                                                <p class="mb-0">{!! $errors->first() !!}</p>
                                            @else
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{!! $error !!}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    @endif
                                    <div class="form-body">
                                        <form method="POST" action="{{ route('login') }}" class="row g-2">
                                            {{ csrf_field() }}
                                            <div class="col-12">
                                                <label for="email" class="form-label">Alamat Emel</label>
                                                <input type="text" class="form-control" id="email" name="email"
                                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            </div>
                                            <div class="col-12">
                                                <label for="password" class="form-label">Kata Laluan</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0" id="password"
                                                        name="password" required autocomplete="current-password">
                                                    <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="remember"
                                                        id="flexSwitchCheckChecked" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Ingat
                                                        saya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-7 text-end">
                                                <a class="text-muted" href="{{ route('password.request') }}">Reset Kata
                                                    Laluan</a> <br> <a href="{{ route('firsttimelogin.form') }}">Pengesahan
                                                    Akaun</a>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="bx bxs-lock-open"></i> Log Masuk</button>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center">
                                                <div class="d-grid">
                                                    <a href="{{ route('register') }}" class="btn btn-warning">
                                                        <i class='bx bxs-user-plus'></i> Daftar
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('manual-pengguna') }}"
                                target="_blank" class="btn btn-info btn-sm"><i class="bx bxs-file-pdf me-2"></i>Manual Pengguna
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end wrapper-->
@endsection
