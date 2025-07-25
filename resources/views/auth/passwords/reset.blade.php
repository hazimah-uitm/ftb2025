@extends('layouts.app')

@section('content')
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card shadow">
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
                                    <div class="text-center mb-4 text-uppercase">
                                        @if (request()->query('type') == 'reset')
                                            <h5 class="text-primary fw-semibold">Reset Kata Laluan</h5>
                                        @else
                                            <h5 class="text-primary fw-semibold">Set Kata Laluan</h5>
                                        @endif
                                    </div>


                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @if ($errors->count() == 1)
                                                <p class="mb-0">{{ $errors->first() }}</p>
                                            @else
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    @endif
                                    <div class="form-body">
                                        <form method="POST" action="{{ route('password.update') }}" class="row g-4">
                                            {{ csrf_field() }}

                                            <input type="hidden" name="token" value="{{ $token }}">

                                            <div class="col-12">
                                                <label for="email" class="form-label">Alamat Emel</label>
                                                <input type="email"
                                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                    id="email" name="email" value="{{ old('email', $email ?? '') }}"
                                                    readonly>
                                                @if ($errors->has('email'))
                                                    <div class="invalid-feedback">
                                                        @foreach ($errors->get('email') as $error)
                                                            {{ $error }}
                                                        @endforeach
                                                    </div>
                                                @endif
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

                                            <div class="col-12">
                                                <label for="password-confirm" class="form-label">Sahkan Kata Laluan</label>
                                                <div class="input-group" id="show_hide_password_confirm">
                                                    <input id="password-confirm" type="password"
                                                        class="form-control border-end-0" name="password_confirmation"
                                                        required autocomplete="new-password">
                                                    <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                </div>
                                            </div>

                                            <div class="col-12 d-grid mt-3">
                                                <button type="submit" class="btn btn-primary"><i class='bx bx-reset'></i>
                                                    {{ __('Submit') }}
                                                </button>
                                            </div>
                                            <div class="col-12 text-center">
                                                <a href="{{ route('login') }}">Kembali ke Log Masuk</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end wrapper-->
@endsection
