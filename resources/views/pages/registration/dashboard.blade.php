@extends('layouts.master')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="text-center mb-4">
        <img src="{{ asset('public/assets/images/logo-ftb1.png') }}" alt="FTB Logo" style="max-height: 80px;">
        <h4 class="mt-2 mb-1 fw-bold">FESTIVAL TARI BORNEO IX (9th EDITION) 2025</h4>
        <h6 class="mb-1">DEWAN JUBLI, SAMARAHAN CAMPUS</h6>
        <h6 class="mb-1">UiTM SARAWAK BRANCH</h6>
        <p class="mb-0 small text-muted"><strong>18 – 21 NOVEMBER 2025</strong></p>
        <p class="mb-0 small text-muted">ORGANISED BY UiTM SARAWAK BRANCH</p>
    </div>

    {{-- ADMIN VIEW --}}
    @if ($user->hasRole('Admin') || $user->hasRole('Superadmin'))
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Registrations</h5>
                        <h3>{{ $totalRegistrations }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Pending Approvals</h5>
                        <h3>{{ $pendingRegistrations }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Approved Registrations</h5>
                        <h3>{{ $approvedRegistrations }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-dark text-white">Approval Management</div>
            <div class="card-body">
                <p>View and manage all competition registrations submitted by participants.</p>
                <a href="{{ route('registration') }}" class="btn btn-outline-primary">
                    <i class="bx bx-list-check"></i> Manage Registrations
                </a>
            </div>
        </div>
    @else
        {{-- USER VIEW --}}
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                Participation Status
            </div>
            <div class="card-body">
                @if ($registration)
                    <p><strong>Status:</strong> {{ $registration->status }}</p>
                    <a href="{{ route('registration.view', $registration->id) }}" class="btn btn-sm btn-info">
                        <i class="bx bx-show"></i> View Registration Details
                    </a>
                @else
                    <p>You have not submitted a registration yet.</p>
                    <a href="{{ route('registration.create') }}" class="btn btn-sm btn-success">
                        <i class="bx bx-pencil"></i> Register Now
                    </a>
                @endif
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                COMPETITION RULES & JUDGING CRITERIA
            </div>
            <div class="card-body">
                <p class="mb-2">
                    Please read the full official competition rules and judging criteria before submitting your registration.
                </p>
                <a href="{{ asset('public/storage/rules_ftb2025.pdf') }}" class="btn btn-outline-dark btn-sm" target="_blank">
                    <i class="bx bx-book"></i> View Full Competition Rules & Judging Criteria
                </a>
            </div>
        </div>
    @endif

</div>
@endsection
