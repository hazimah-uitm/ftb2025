@extends('layouts.master')
@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pengurusan Penyertaan</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Senarai Penyertaan</li>
                </ol>
            </nav>
        </div>
        {{-- @role('Superadmin')
            <div class="ms-auto">
                <a href="{{ route('registration.trash') }}">
                    <button type="button" class="btn btn-primary mt-2 mt-lg-0">Senarai Rekod Dipadam</button>
                </a>
            </div>
        @endrole --}}
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Senarai Penyertaan</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <div class="position-relative">
                    <form action="{{ route('registration.search') }}" method="GET" id="searchForm"
                        class="d-lg-flex align-items-center gap-3">
                        <div class="input-group">
                            <input type="text" class="form-control rounded" placeholder="Carian..." name="search"
                                value="{{ request('search') }}" id="searchInput">

                            <input type="hidden" name="perPage" value="{{ request('perPage', 10) }}">
                            <button type="submit" class="btn btn-primary ms-1 rounded" id="searchButton">
                                <i class="bx bx-search"></i>
                            </button>
                            <button type="button" class="btn btn-secondary ms-1 rounded" id="resetButton">
                                Reset
                            </button>
                        </div>
                    </form>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('registration.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                        <i class="bx bxs-plus-square"></i> Daftar
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Nama Institusi</th>
                            <th>Nama Kumpulan</th>
                            <th>Nama</th>
                            <th>No. Telefon</th>
                            <th>Status</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @if (count($registrationList) > 0)
                            @foreach ($registrationList as $registration)
                                <tr>
                                    <td>{{ ($registrationList->currentPage() - 1) * $registrationList->perPage() + $loop->iteration }}
                                    </td>
                                    <td>{{ $registration->user->institution_name ?? '-' }}</td>
                                    <td>{{ $registration->group_name }}</td>
                                    <td>{{ $registration->user->name ?? '-' }}</td>
                                    <td>{{ $registration->user->phone_no ?? '-' }}</td>
                                    <td>
                                        @if ($registration->status == 'Diluluskan')
                                            <span class="badge bg-success">Diluluskan</span>
                                        @elseif ($registration->status == 'Dibatalkan')
                                            <span class="badge bg-danger">Dibatalkan</span>
                                        @else
                                            <span class="badge bg-warning">Menunggu Kelulusan</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('registration.view', $registration->id) }}"
                                            class="btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Papar">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        @hasanyrole('Superadmin|Admin')
                                            <a href="{{ route('registration.edit', $registration->id) }}"
                                                class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Kemaskini">
                                                <i class="bx bxs-edit"></i>
                                            </a>
                                            @if ($registration->status == 'Menunggu Kelulusan')
                                                <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#approvalModal{{ $registration->id }}"><i
                                                        class='bx bx-check-circle'></i>
                                                    Semak
                                                </button>
                                            @endif
                                            <a href="{{ route('registration.pdf', $registration->id) }}"
                                                class="btn btn-warning btn-sm" target="_blank">
                                                <i class="bx bxs-file-pdf"></i> PDF
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $registration->id }}" title="Padam">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        @endhasanyrole
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">Tiada rekod</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="mt-3 d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <span class="mr-2 mx-1">Rekod per halaman</span>
                    <form action="{{ route('registration.search') }}" method="GET" id="perPageForm"
                        class="d-flex align-items-center">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <select name="perPage" id="perPage" class="form-select form-select-sm"
                            onchange="document.getElementById('perPageForm').submit()">
                            <option value="10" {{ Request::get('perPage') == '10' ? 'selected' : '' }}>10</option>
                            <option value="20" {{ Request::get('perPage') == '20' ? 'selected' : '' }}>20</option>
                            <option value="30" {{ Request::get('perPage') == '30' ? 'selected' : '' }}>30</option>
                        </select>
                    </form>
                </div>

                <div class="d-flex justify-content-end align-items-center">
                    <span class="mx-2 mt-2 small text-muted">
                        Menunjukkan {{ $registrationList->firstItem() }} hingga {{ $registrationList->lastItem() }}
                        form-control
                        {{ $registrationList->total() }} record(s)
                    </span>
                    <div class="pagination-wrapper">
                        {{ $registrationList->appends([
                                'search' => request('search'),
                            ])->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    @foreach ($registrationList as $registration)
        <div class="modal fade" id="deleteModal{{ $registration->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Pengesahan Padam Rekod</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @isset($registration)
                            Adakah anda pasti untuk padam rekod <span style="font-weight: 600;">
                                {{ ucfirst($registration->name) }}</span>?
                        @else
                            Tiada Rekod
                        @endisset
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        @isset($registration)
                            <form class="d-inline" method="POST"
                                action="{{ route('registration.destroy', $registration->id) }}">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger">Padam</button>
                            </form>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Approval Modal -->
    @foreach ($registrationList as $registration)
        <div class="modal fade" id="approvalModal{{ $registration->id }}" tabindex="-1"
            aria-labelledby="approvalModalLabel{{ $registration->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Kelulusan Penyertaan: {{ $registration->user->institution_name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-sm table-striped table-borderless mb-3">
                            <tr>
                                <th>Nama Institusi</th>
                                <td>{{ $registration->user->institution_name }}</td>
                            </tr>
                            <tr>
                                <th>Nama Kumpulan</th>
                                <td>{{ $registration->group_name }}</td>
                            </tr>
                            <tr>
                                <th>Nama Tarian Tradisional Etnik Borneo</th>
                                <td>{{ $registration->traditional_dance_name }}</td>
                            </tr>
                            <tr>
                                <th>Nama Tarian Kreatif Etnik Borneo</th>
                                <td>{{ $registration->creative_dance_name }}</td>
                            </tr>
                            <tr>
                                <th>Alamat Emel</th>
                                <td>{!! nl2br(e($registration->address)) !!}</td>
                            </tr>
                            <tr>
                                <th>No. Telefon</th>
                                <td>{{ $registration->user->phone_no ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Emel</th>
                                <td>{{ $registration->user->email ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Pautan Google Drive</th>
                                <td>
                                    @if (!empty($registration->doc_link))
                                        <a href="{{ $registration->doc_link }}" target="_blank">
                                            <i class='bx bxs-folder-open' style="font-size: 1.2rem; color: #007bff;"></i>
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>

                            @if ($registration->payments && $registration->payments->count())
                                @foreach ($registration->payments as $payment)
                                    <tr>
                                        <th style="width: 30%">Kaedah Pembayaran</th>
                                        <td>{{ $payment->payment_type }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tarikh Bayaran</th>
                                        <td>{{ $payment->date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bukti Pembayaran</th>
                                        <td>
                                            @if ($payment->payment_file)
                                                <a href="{{ asset('public/storage/' . $payment->payment_file) }}"
                                                    target="_blank">
                                                    <i class='bx bxs-file-pdf'
                                                        style="font-size: 1.5rem; color: #007bff;"></i>
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            <tr>
                                <th>Dihantar pada</th>
                                <td>
                                    {{ $registration->submitted_at ? \Carbon\Carbon::parse($registration->submitted_at)->format('d/m/Y H:i') : '-' }}
                                    oleh {{ $registration->submitter->name ?? '-' }}
                                </td>
                            </tr>
                        </table>

                        <hr>

                        <form method="POST" action="{{ route('registration.approval', $registration->id) }}">
                            {{ csrf_field() }}
                            <div class="mb-3">
                                <label for="status" class="form-label">Status Kelulusan</label>
                                <select name="status" class="form-select" required>
                                    <option value="">Pilih Status Kelulusan</option>
                                    <option value="Diluluskan">Diluluskan</option>
                                    <option value="Dibatalkan">Dibatalkan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="remarks_checker" class="form-label">Catatan Admin</label>
                                <textarea name="remarks_checker" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-success">Hantar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-submit the form on input change
            document.getElementById('searchInput').addEventListener('input', function() {
                document.getElementById('searchForm').submit();
            });

            // Reset form
            document.getElementById('resetButton').addEventListener('click', function() {
                // Redirect to the base route to clear query parameters
                window.location.href = "{{ route('registration') }}";
            });
        });
    </script>
    <!--end page wrapper -->
@endsection
