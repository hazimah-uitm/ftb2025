@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        {{-- Header --}}
        <div class="text-center my-4">
            <img src="{{ asset('public/assets/images/logo-ftb1.png') }}" alt="FTB Logo" class="mb-2"
                style="max-height: 80px;">
            <h4 class="fw-bold mb-1">FESTIVAL TARI BORNEO IX (9th EDITION) 2025</h4>
            <h6 class="mb-0">DEWAN JUBLI, SAMARAHAN CAMPUS</h6>
            <h6 class="mb-0">UiTM SARAWAK BRANCH</h6>
            <p class="text-muted small mt-1 mb-0"><strong>18 – 21 NOVEMBER 2025</strong></p>
            <p class="text-muted small mb-0">ORGANISED BY UiTM SARAWAK BRANCH</p>
        </div>

        {{-- ADMIN VIEW --}}
        @if ($user->hasRole('Admin') || $user->hasRole('Superadmin'))
            <div class="row g-3 mb-4">
                <!-- Total Registrations -->
                <div class="col-md-4">
                    <div class="card border-start border-4 border-primary shadow-sm h-100"
                        style="background: linear-gradient(135deg, #f0f4ff, #ffffff);">
                        <div class="card-body d-flex align-items-center">
                            <i class="bx bx-user-circle fs-1 text-primary me-3"></i>
                            <div>
                                <h6 class="mb-1 text-muted">Total Registrations</h6>
                                <h4 class="fw-bold text-primary mb-0">{{ $totalRegistrations }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Approvals -->
                <div class="col-md-4">
                    <div class="card border-start border-4 border-warning shadow-sm h-100"
                        style="background: linear-gradient(135deg, #fff8e1, #ffffff);">
                        <div class="card-body d-flex align-items-center">
                            <i class="bx bx-time-five fs-1 text-warning me-3"></i>
                            <div>
                                <h6 class="mb-1 text-muted">Pending Approvals</h6>
                                <h4 class="fw-bold text-warning mb-0">{{ $pendingRegistrations }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Approved Registrations -->
                <div class="col-md-4">
                    <div class="card border-start border-4 border-success shadow-sm h-100"
                        style="background: linear-gradient(135deg, #e6fff5, #ffffff);">
                        <div class="card-body d-flex align-items-center">
                            <i class="bx bx-check-circle fs-1 text-success me-3"></i>
                            <div>
                                <h6 class="mb-1 text-muted">Approved Registrations</h6>
                                <h4 class="fw-bold text-success mb-0">{{ $approvedRegistrations }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Approval Management -->
            <div class="card border shadow-sm mb-4" style="background: linear-gradient(to right, #f8f9fa, #ffffff);">
                <div
                    class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center py-3 px-4">
                    <div class="d-flex align-items-start">
                        <i class="bx bx-cog fs-4 text-secondary me-3"></i>
                        <div>
                            <div class="fw-semibold">Approval Management</div>
                            <small class="text-muted">View and manage participant registrations</small>
                        </div>
                    </div>
                    <div class="mt-3 mt-md-0">
                        <a href="{{ route('registration') }}" class="btn btn-sm btn-primary">
                            <i class="bx bx-list-check me-1"></i> Manage
                        </a>
                    </div>
                </div>
            </div>
        @else
            {{-- USER VIEW --}}
            
            <div class="card border-0 shadow-sm bg-light mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Additional Information</h6>
                    <ul class="mb-2">
                        <li>For more information regarding the Festival Tari Borneo IX 2025, please visit the official
                            FTB2025 website at <a href="https://kenyalang.uitm.edu.my/ftb2025"
                                target="_blank">kenyalang.uitm.edu.my/ftb2025</a>.</li>
                        <li>The competition declaration letter and participation form can be downloaded from the stated
                            website and must be fully completed on or before <strong>31 August 2025 (Sunday)</strong>.</li>
                        <li>For any announcements or inquiries related to this matter, please contact the following
                            officers:
                            <ul>
                                <li><strong>Cik Melinda Anak Jindu</strong> (082 678 059) / <a
                                        href="mailto:mel@uitm.edu.my">mel@uitm.edu.my</a></li>
                                <li><strong>Cik Lydia Jimbie Anak Anthony</strong> (082 677 058) / <a
                                        href="mailto:lydia@uitm.edu.my">lydia@uitm.edu.my</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-dark text-white">
                            Participation Status
                        </div>
                        <div class="card-body">
                            @if ($registration)
                                <p class="mb-2"><strong>Status </strong>
                                    @if ($registration->status == 'Approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif ($registration->status == 'Rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending Approval</span>
                                    @endif
                                </p>
                                <a href="{{ route('registration.view', $registration->id) }}"
                                    class="btn btn-sm btn-primary">
                                    <i class="bx bx-show me-1"></i> View Registration Details
                                </a>
                            @else
                                <p class="mb-2">You have not submitted a registration yet.</p>
                                <a href="{{ route('registration.create') }}" class="btn btn-sm btn-success">
                                    <i class="bx bx-pencil me-1"></i> Register Now
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-dark text-white">
                            Competition Rules & Judging Criteria
                        </div>
                        <div class="card-body">
                            <p class="mb-2">Please read the competition rules and judging criteria before
                                register.</p>
                            <a href="{{ asset('public/storage/rules_ftb2025.pdf') }}" class="btn btn-dark btn-sm"
                                target="_blank">
                                <i class="bx bx-book me-1"></i> View Full Competition Rules
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
