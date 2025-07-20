@extends('layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="page-breadcrumb mb-3">
        <div class="row align-items-center">
            <!-- Breadcrumb Title and Navigation -->
            <div class="col-12 col-md-9 d-flex align-items-center">
                <div class="breadcrumb-title pe-3">Profil Pengguna</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profil {{ $user->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <h6 class="mb-0 text-uppercase">Profil {{ $user->name }}</h6>
    <hr />

    <div class="container">
        <div class="main-body">
            <!-- Profile Layout -->
            <div class="row">
                <!-- Sidebar (User Info) -->
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <!-- User Image -->
                                 <img src="{{ !empty($user->profile_image) ? asset('public/storage/' . $user->profile_image) : asset('public/assets/images/avatars/user.png') }}"
                                    alt="Profile Image" class="rounded-circle p-1 bg-primary" width="150" height="150">
                                <!-- User Name and Position -->
                                <div class="d-flex flex-column align-items-center text-center">
                                    <h5 class="mt-3">{{ $user->name }}</h5>
                                    <p class="text-muted">{{ $user->position ?? '-' }}</p>
                                    <!-- Button Group (Horizontal) -->
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ route('profile.edit', ['id' => $user->id]) }}"
                                            class="btn btn-primary">Kemaskini Profil</a>
                                        <a href="{{ route('profile.change-password', ['id' => $user->id]) }}"
                                            class="btn btn-warning">Tukar Kata Laluan</a>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <table class="table table-borderless mt-2">
                                <tr class="border-bottom">
                                    <th width="30%">Nama Penuh</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Institusi</th>
                                    <td>{{ $user->institution_name }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th>Jenis IPTA</th>
                                    <td>{{ $user->jenis_ipta }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th>Nombor Pengenalan</th>
                                    <td>{{ $user->ic_no }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th>Alamat Emel</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th>Jawatan</th>
                                    <td>{{ $user->position }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th>Nombor Telefon</th>
                                    <td>{{ $user->phone_no }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th>Status</th>
                                    <td>{{ $user->publish_status }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Main Content -->
        </div>
    </div>
    </div>
    <!-- End Profile Layout -->
@endsection
