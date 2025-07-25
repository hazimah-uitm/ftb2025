@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5">
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
                                    <div class="text-center mb-4">
                                        <h5 class="text-primary fw-semibold">Pengesahan Akaun</h5>
                                        <p class="text-muted">Masukkan alamat emel anda untuk menerima pautan pengesahan
                                            emel baru
                                        </p>
                                    </div>

                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('firsttimelogin.send') }}">
                                        {{ csrf_field() }}
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Alamat Emel</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                required value="{{ old('email') }}">
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Hantar Pautan</button>
                                        </div>
                                        <div class="mt-3 text-center">
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
@endsection
