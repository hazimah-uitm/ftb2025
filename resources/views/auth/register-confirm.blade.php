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
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 justify-content-center">
                    <div class="col mx-auto">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="border p-2 rounded">
                                    <div class="text-center mb-4">
                                        <h3>{{ __('Registration Successful!') }}</h3>
                                    </div>

                                    <div class="text-center mb-3">
                                        <p class="mb-2">
                                            {{ __('
                                            Please check your email for the verification link before logging in.') }}
                                        </p>
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
