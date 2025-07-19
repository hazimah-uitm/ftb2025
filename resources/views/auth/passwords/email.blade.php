@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="text-center">
                    <div class="d-flex align-items-center justify-content-center flex-column flex-md-row mb-0">
                        <img src="{{ asset('public/assets/images/logo-ftb1.png') }}" class="img-fluid logo-icon-login"
                            alt="logo icon" style="max-width: 100%; height: auto;">
                    </div>
                    <div class="mb-3">
                        <h4 class="logo-text-login mb-0">FESTIVAL TARI BORNEO IX (EDISI KE-9) 2025</h4>
                        <h6 class="logo-subtitle-login mb-0">
                            ORGANISED BY UiTM CAWANGAN SARAWAK
                        </h6>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center mb-4">
                                        <h3>{{ __('Lupa Kata Laluan') }}</h3>
                                    </div>
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <div class="form-body">
                                        <form method="POST" action="{{ route('password.email') }}" class="row g-4">
                                            {{ csrf_field() }}

                                            <div class="col-12">
                                                <label for="email" class="form-label">Alamat Emel</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                    id="email" name="email" value="{{ old('email') }}">
                                                @if ($errors->has('email'))
                                                    <div class="invalid-feedback">
                                                        @foreach ($errors->get('email') as $error)
                                                           {!! $error !!}
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-12 d-grid mt-3">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class='bx bx-mail-send'></i>
                                                    {{ __('Hantar') }}
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
@endsection
