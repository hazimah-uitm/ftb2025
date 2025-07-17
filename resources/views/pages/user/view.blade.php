@extends('layouts.master')

@section('content')
<!-- Breadcrumb -->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Pengurusan Pengguna</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('user') }}">Senarai Pengguna</a></li>
                <li class="breadcrumb-item active" aria-current="page">Maklumat {{ ucfirst($user->name) }}</li>
            </ol>
        </nav>
    </div>
    {{-- <div class="ms-auto">
        <a href="{{ route('user.edit', $user->id) }}">
            <button type="button" class="btn btn-primary mt-2 mt-lg-0">Kemaskini Maklumat</button>
        </a>
    </div> --}}
</div>
<!-- End Breadcrumb -->

<h6 class="mb-0 text-uppercase">Maklumat {{ ucfirst($user->name) }}</h6>
<hr />

<!-- Campus Information Table -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Nama Penuh</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Institusi</th>
                        <td>{{ $user->institution_name }}</td>
                    </tr>
                    <tr>
                        <th>Jenis IPTA</th>
                        <td>{{ $user->jenis_ipta }}</td>
                    </tr>
                    <tr>
                        <th>Nombor Pengenalan</th>
                        <td>{{ $user->ic_no }}</td>
                    </tr>
                    <tr>
                        <th>Alamat Emel</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Jawatan</th>
                        <td>{{ $user->position }}</td>
                    </tr>
                    <tr>
                        <th>Nombor Telefon</th>
                        <td>{{ $user->phone_no }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $user->publish_status }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Campus Information Table -->
<!-- End Page Wrapper -->
@endsection