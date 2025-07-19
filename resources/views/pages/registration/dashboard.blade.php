@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        {{-- Header --}}
        <div class="text-center mb-3">
            <img src="{{ asset('public/assets/images/logo-ftb1.png') }}" alt="FTB Logo" class="img-fluid mb-2"
                style="max-height: 80px;">
            <h4 class="fw-bold mb-1">FESTIVAL TARI BORNEO IX (9th EDITION) 2025</h4>
            <hr class="mx-auto" style="width: 120px; border-top: 2px solid #6c757d; opacity: 0.6;">
            <h6 class="mb-0">DEWAN JUBLI, SAMARAHAN CAMPUS</h6>
            <h6 class="mb-0">UiTM SARAWAK BRANCH</h6>
            <p class="text-muted small mt-1 mb-0"><strong>18 – 21 NOVEMBER 2025</strong></p>
            <p class="text-muted small mb-0">ANJURAN UiTM SARAWAK BRANCH</p>
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
                                <h6 class="mb-1 text-muted">Jumlah Pendaftaran</h6>
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
                                <h6 class="mb-1 text-muted">Menunggu Kelulusan</h6>
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
                                <h6 class="mb-1 text-muted">Pendaftaran Diluluskan</h6>
                                <h4 class="fw-bold text-success mb-0">{{ $approvedRegistrations }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Approval Management -->
            <div class="card border-start border-4 border-info shadow-sm mb-4"
                style="background: linear-gradient(to right, #f8f9fa, #ffffff);">
                <div
                    class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center py-3 px-4">
                    <div class="d-flex align-items-start">
                        <i class="bx bx-cog fs-4 text-info me-3"></i>
                        <div>
                            <div class="fw-semibold">Pengurusan Permohonan</div>
                            <small class="text-muted">Papar dan urus pendaftaran peserta</small>
                        </div>
                    </div>
                    <div class="mt-3 mt-md-0">
                        <a href="{{ route('registration') }}" class="btn btn-sm btn-info">
                            <i class="bx bx-list-check me-1"></i> Pengurusan Permohonan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Competition Rules -->
            <div class="card border-start border-4 border-secondary shadow-sm mb-4"
                style="background: linear-gradient(to right, #f4f4f4, #ffffff);">
                <div
                    class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center py-3 px-4">
                    <div class="d-flex align-items-start">
                        <i class="bx bx-book fs-4 text-secondary me-3"></i>
                        <div>
                            <div class="fw-semibold">Syarat dan Kriteria Permarkahan Pertandingan</div>
                            <small class="text-muted">Sila baca Syarat dan Kriteria Permarkahan Pertandingan sebelum
                                mendaftar.</small>
                        </div>
                    </div>
                    <div class="mt-3 mt-md-0">
                        <a href="{{ asset('public/storage/SYARAT & KRITERIA PERMARKAHAN FTB2025.pdf') }}"
                            class="btn btn-sm btn-secondary" target="_blank">
                            <i class="bx bx-book-open me-1"></i> Papar Syarat dan Kriteria Permarkahan Pertandingan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="card border shadow-sm mb-4" style="background: linear-gradient(to right, #f8f9fa, #ffffff);">
                <div class="card-body py-3 px-4">
                    <div class="d-flex flex-column flex-md-row">
                        {{-- Icon --}}
                        <div class="mb-3 mb-md-0 me-md-3 text-center text-md-start">
                            <i class="bx bx-info-circle fs-4 text-primary"></i>
                        </div>

                        {{-- Text content --}}
                        <div class="flex-fill">
                            <div class="fw-semibold mb-2">Maklumat Tambahan</div>
                            <ul class="mb-0 small ps-3 ps-md-0">
                                <li>
                                    Untuk maklumat lanjut, sila layari
                                    <a href="https://kenyalang.uitm.edu.my/ftb2025" target="_blank">
                                        kenyalang.uitm.edu.my/ftb2025
                                    </a>.
                                </li>
                                <li>
                                    Semua pendaftaran mestilah diselesaikan melalui sistem, berserta surat pengisytiharan,
                                    selewat-lewatnya pada <strong>31 Ogos 2025 (Ahad)</strong>.
                                </li>
                                <li>Hubungi:
                                    <ul class="mb-0">
                                        <li><strong>Cik Melinda Anak Jindu</strong> – 082 678 059 /
                                            <a href="mailto:mel@uitm.edu.my">mel@uitm.edu.my</a>
                                        </li>
                                        <li><strong>Cik Lydia Jimbie Anak Anthony</strong> – 082 677 058 /
                                            <a href="mailto:lydia@uitm.edu.my">lydia@uitm.edu.my</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- USER VIEW --}}

            <!-- Participation Status -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card border-start border-4 border-success shadow-sm h-100"
                        style="background: linear-gradient(135deg, #e6fff5, #ffffff);">
                        <div class="card-body d-flex align-items-center">
                            <i class="bx bx-check-circle fs-1 text-success me-3"></i>
                            <div>
                                <h6 class="mb-1 text-muted">Pendaftaran Diluluskan</h6>
                                <h4 class="fw-bold text-success mb-0">{{ $approvedRegistrations }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card border-start border-4 border-primary shadow-sm mb-4 h-100"
                        style="background: linear-gradient(to right, #f4f4f4, #ffffff);">
                        <div
                            class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center py-3 px-4">
                            <div class="d-flex align-items-start">
                                <i class="bx bx-user-check fs-4 text-primary me-3"></i>
                                <div>
                                    <div class="fw-semibold">Status Penyertaan</div>
                                    @if ($registration)
                                        <p class="mb-2 small"><strong>Status:</strong>
                                            @if ($registration->status == 'Approved')
                                                <span class="badge bg-success">Diluluskan</span>
                                            @elseif ($registration->status == 'Rejected')
                                                <span class="badge bg-danger">Dibatalkan</span>
                                            @else
                                                <span class="badge bg-warningxt-primary">Menunggu Kelulusan</span>
                                            @endif
                                        </p>
                                    @else
                                        <p class="mb-2 small">Anda belum menghantar sebarang penyertaan.</p>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3 mt-md-0">
                                @if ($registration)
                                    <a href="{{ route('registration.view', $registration->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="bx bx-show me-1"></i> Papar Maklumat Penyertaan
                                    </a>
                                @else
                                    <a href="{{ route('registration.create') }}" class="btn btn-sm btn-primary">
                                        <i class="bx bx-pencil me-1"></i> Daftar Sekarang
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Competition Rules -->
            <div class="card border-start border-4 border-warning shadow-sm mb-4"
                style="background: linear-gradient(to right, #f4f4f4, #ffffff);">
                <div
                    class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center py-3 px-4">
                    <div class="d-flex align-items-start">
                        <i class="bx bx-book fs-4 text-warning me-3"></i>
                        <div>
                            <div class="fw-semibold">Syarat dan Kriteria Permarkahan Pertandingan</div>
                            <small class="text-muted">Sila baca Syarat dan Kriteria Permarkahan Pertandingan sebelum
                                mendaftar.</small>
                        </div>
                    </div>
                    <div class="mt-3 mt-md-0">
                        <a href="{{ asset('public/storage/SYARAT & KRITERIA PERMARKAHAN FTB2025.pdf') }}"
                            class="btn btn-sm btn-warning" target="_blank">
                            <i class="bx bx-book-open me-1"></i> Papar Syarat dan Kriteria Permarkahan Pertandingan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="card border shadow-sm mb-4" style="background: linear-gradient(to right, #f8f9fa, #ffffff);">
                <div class="card-body py-3 px-4">
                    <div class="d-flex flex-column flex-md-row">
                        {{-- Icon --}}
                        <div class="mb-3 mb-md-0 me-md-3 text-center text-md-start">
                            <i class="bx bx-info-circle fs-4 text-primary"></i>
                        </div>

                        {{-- Text content --}}
                        <div class="flex-fill">
                            <div class="fw-semibold mb-2">Maklumat Tambahan</div>
                            <ul class="mb-0 small ps-3 ps-md-0">
                                <li>
                                    Untuk maklumat lanjut, sila layari
                                    <a href="https://kenyalang.uitm.edu.my/ftb2025" target="_blank">
                                        kenyalang.uitm.edu.my/ftb2025
                                    </a>.
                                </li>
                                <li>
                                    Semua pendaftaran mestilah diselesaikan melalui sistem, berserta surat
                                    pengisytiharan,
                                    selewat-lewatnya pada <strong>31 Ogos 2025 (Ahad)</strong>.
                                </li>
                                <li>Hubungi:
                                    <ul class="mb-0">
                                        <li><strong>Cik Melinda Anak Jindu</strong> – 082 678 059 /
                                            <a href="mailto:mel@uitm.edu.my">mel@uitm.edu.my</a>
                                        </li>
                                        <li><strong>Cik Lydia Jimbie Anak Anthony</strong> – 082 677 058 /
                                            <a href="mailto:lydia@uitm.edu.my">lydia@uitm.edu.my</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        @endif
    </div>
@endsection
