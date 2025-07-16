@extends('layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pengurusan Pendaftaran</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('registration') }}">Senarai Pendaftaran</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Maklumat {{ $registration->user->institution_name }}</li>
                </ol>
            </nav>
        </div>
        @role('Superadmin')
            <div class="ms-auto">
                <a href="{{ route('registration.edit', $registration->id) }}">
                    <button type="button" class="btn btn-primary mt-2 mt-lg-0">Kemaskini Maklumat</button>
                </a>
            </div>
        @endrole
    </div>
    <!-- End Breadcrumb -->

    <h6 class="mb-0 text-uppercase">Maklumat {{ $registration->user->institution_name }}</h6>
    <hr />

    <!-- Campus Information Table -->
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 30%">Nama Institusi</th>
                            <td>{{ $registration->user->institution_name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Nama Kumpulan</th>
                            <td>{{ $registration->group_name }}</td>
                        </tr>
                        <tr>
                            <th>Nama Tarian Tradisional</th>
                            <td>{{ $registration->traditional_dance_name }}</td>
                        </tr>
                        <tr>
                            <th>Nama Tarian Kreatif</th>
                            <td>{{ $registration->creative_dance_name }}</td>
                        </tr>
                        <tr>
                            <th>Nama Koreografer</th>
                            <td>{{ $registration->koreografer_name }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pembantu Koreografer</th>
                            <td>{{ $registration->assistant_koreografer_name }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{!! nl2br(e($registration->address)) !!}</td>
                        </tr>
                        <tr>
                            <th>Sinopsis Tarian Tradisional</th>
                            <td>{!! nl2br(e($registration->sinopsis_traditional)) !!}</td>
                        </tr>
                        <tr>
                            <th>Sinopsis Tarian Kreatif</th>
                            <td>{!! nl2br(e($registration->sinopsis_creative)) !!}</td>
                        </tr>
                        <tr>
                            <th>No. Faks</th>
                            <td>{{ $registration->fax_no }}</td>
                        </tr>
                        <tr>
                            <th>Pautan Dokumen</th>
                            <td>
                                @if (!empty($registration->doc_link))
                                    <a href="{{ $registration->doc_link }}" target="_blank" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="Buka pautan shared folder">
                                        <i class='bx bxs-folder-open' style="font-size: 1.2rem; color: #007bff;"></i>
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Campus Information Table -->
    <!-- End Page Wrapper -->
@endsection
