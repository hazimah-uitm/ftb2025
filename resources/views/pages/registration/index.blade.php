@extends('layouts.master')
@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Participation Management</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Participation List</li>
                </ol>
            </nav>
        </div>
        @role('Superadmin')
            <div class="ms-auto">
                <a href="{{ route('registration.trash') }}">
                    <button type="button" class="btn btn-primary mt-2 mt-lg-0">Deleted Record List</button>
                </a>
            </div>
        @endrole
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Participation List</h6>
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
                        <i class="bx bxs-plus-square"></i> Register
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Institution Name</th>
                            <th>Group Name</th>
                            <th>Name</th>
                            <th>Phone No.</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                        @if ($registration->status == 'Approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif ($registration->status == 'Rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @else
                                            <span class="badge bg-warning">Pending Approval</span>
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
                                            @if ($registration->status == 'Pending Approval')
                                                <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#approvalModal{{ $registration->id }}"><i
                                                        class='bx bx-check-circle'></i>
                                                    Approval
                                                </button>
                                            @endif
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
                                <td colspan="7">No record</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="mt-3 d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <span class="mr-2 mx-1">Records per page</span>
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
                        Showing {{ $registrationList->firstItem() }} hingga {{ $registrationList->lastItem() }}
                        from
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
                        <h5 class="modal-title" id="deleteModalLabel">Record Deletion Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @isset($registration)
                            Are you sure you want to delete this record? <span style="font-weight: 600;">
                                {{ ucfirst($registration->name) }}</span>?
                        @else
                            No record
                        @endisset
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        @isset($registration)
                            <form class="d-inline" method="POST"
                                action="{{ route('registration.destroy', $registration->id) }}">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger">Delete</button>
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
                        <h5 class="modal-title">Participation Approval: {{ $registration->user->institution_name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-sm table-striped table-borderless mb-3">
                            <tr>
                                <th>Institution Name</th>
                                <td>{{ $registration->user->institution_name }}</td>
                            </tr>
                            <tr>
                                <th>Group Name</th>
                                <td>{{ $registration->group_name }}</td>
                            </tr>
                            <tr>
                                <th>Traditional Dance Name</th>
                                <td>{{ $registration->traditional_dance_name }}</td>
                            </tr>
                            <tr>
                                <th>Creative Dance Name</th>
                                <td>{{ $registration->creative_dance_name }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{!! nl2br(e($registration->address)) !!}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $registration->user->phone_no ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $registration->user->email ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Escort Officers</th>
                                <td>
                                    @if ($registration->escortOfficers && $registration->escortOfficers->count())
                                        @foreach ($registration->escortOfficers as $index => $officer)
                                            {{ $officer->name }}<br>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Shared Folder</th>
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
                                        <th style="width: 30%">Payment Method</th>
                                        <td>{{ $payment->payment_type }}</td>
                                    </tr>
                                    <tr>
                                        <th>Payment Date</th>
                                        <td>{{ $payment->date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Proof of Payment</th>
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
                                <th>Submitted at</th>
                                <td>
                                    {{ $registration->submitted_at ? \Carbon\Carbon::parse($registration->submitted_at)->format('d/m/Y H:i') : '-' }}
                                    by {{ $registration->submitter->name ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Submitter's Remarks</th>
                                <td>{!! nl2br(e($registration->remarks_submitter ?? '-')) !!}</td>
                            </tr>
                        </table>

                        <hr>

                        <form method="POST" action="{{ route('registration.approval', $registration->id) }}">
                            {{ csrf_field() }}
                            <div class="mb-3">
                                <label for="status" class="form-label">Approval Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="">Select Approval Status</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="remarks_checker" class="form-label">Checker's Remarks</label>
                                <textarea name="remarks_checker" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Submit</button>
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
