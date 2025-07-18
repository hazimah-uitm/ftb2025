@extends('layouts.master')
@section('content')
<!-- Breadcrumb -->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Participation Management</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a></li>
                @hasanyrole('Superadmin|Admin')
                    <li class="breadcrumb-item"><a href="{{ route('registration') }}">Participation List</a></li>
                @endhasanyrole
                <li class="breadcrumb-item active" aria-current="page">{{ $registration->user->institution_name }}</li>
            </ol>
        </nav>
    </div>
</div>

<h6 class="mb-0 text-uppercase">{{ $registration->user->institution_name }}</h6>
<hr />

<!-- Main Content: Two Column Layout -->
<div class="row">
    <!-- Left Column: Registration Info -->
    <div class="col-md-8">
        <!-- Info Card -->
        <div class="card mb-4">
            <div class="card-header bg-light"><strong>Registration Details</strong></div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr><th style="width: 30%">Institution Name</th><td>{{ $registration->user->institution_name ?? '-' }}</td></tr>
                    <tr><th>Group Name</th><td>{{ $registration->group_name }}</td></tr>
                    <tr><th>Traditional Dance Name</th><td>{{ $registration->traditional_dance_name }}</td></tr>
                    <tr><th>Creative Dance Name</th><td>{{ $registration->creative_dance_name }}</td></tr>
                    <tr><th>Address</th><td>{!! nl2br(e($registration->address)) !!}</td></tr>
                    <tr><th>Phone No.</th><td>{{ $registration->user->phone_no ?? '-' }}</td></tr>
                    <tr><th>Fax No.</th><td>{{ $registration->fax_no ?? '-' }}</td></tr>
                    <tr><th>Email Address</th><td>{{ $registration->user->email ?? '-' }}</td></tr>
                    <tr><th>Escort Officers</th>
                        <td>
                            @foreach ($registration->escortOfficers as $officer)
                                <span class="d-block">{{ $officer->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr><th>Choreographer</th><td>{{ $registration->koreografer_name }}</td></tr>
                    <tr><th>Assistant Choreographer</th><td>{{ $registration->assistant_koreografer_name ?? '-' }}</td></tr>
                    <tr><th>Traditional Dance Synopsis</th><td>{!! nl2br(e($registration->sinopsis_traditional)) !!}</td></tr>
                    <tr><th>Creative Dance Synopsis</th><td>{!! nl2br(e($registration->sinopsis_creative)) !!}</td></tr>
                    <tr><th>Shared Folder Link</th>
                        <td>
                            @if (!empty($registration->doc_link))
                                <a href="{{ $registration->doc_link }}" target="_blank"><i class='bx bxs-folder-open'></i></a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Payment -->
        @if ($registration->payments && $registration->payments->count())
            <div class="card mb-4">
                <div class="card-header bg-light"><strong>Commitment Fee</strong></div>
                <div class="card-body">
                    @foreach ($registration->payments as $payment)
                        <table class="table table-borderless table-sm">
                            <tr><th style="width:30%">Payment Method</th><td>{{ $payment->payment_type }}</td></tr>
                            <tr><th>Payment Date</th><td>{{ $payment->date }}</td></tr>
                            <tr><th>Proof</th>
                                <td>
                                    @if ($payment->payment_file)
                                        <a href="{{ asset('public/storage/' . $payment->payment_file) }}" target="_blank"><i class='bx bxs-file-pdf'></i></a>
                                    @else -
                                    @endif
                                </td>
                            </tr>
                        </table>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Group Members -->
        @if ($registration->members && $registration->members->count())
            <div class="accordion mb-4" id="membersAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingMembers">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMembers">
                            Group Members ({{ count($registration->members) }})
                        </button>
                    </h2>
                    <div id="collapseMembers" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>ID</th>
                                            <th>Student ID</th>
                                            <th>Role</th>
                                            <th>Gender</th>
                                            <th>Shirt Size</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registration->members as $index => $member)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $member->name }}</td>
                                                <td>{{ $member->ic_no }}</td>
                                                <td>{{ $member->student_id ?? '-' }}</td>
                                                <td>{{ $member->peranan }}</td>
                                                <td>{{ $member->jantina }}</td>
                                                <td>{{ $member->saiz_baju }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Right Column: Approval Card -->
    <div class="col-md-4">
        <!-- Application Status -->
        <div class="card mb-4">
            <div class="card-header bg-light"><strong>Application Status</strong></div>
            <div class="card-body">
                <table class="table table-borderless table-sm mb-0">
                    <tr><th>Status</th>
                        <td>
                            @if ($registration->status == 'Approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif ($registration->status == 'Rejected')
                                <span class="badge bg-danger">Rejected</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending Approval</span>
                            @endif
                        </td>
                    </tr>
                    <tr><th>Submitted At</th><td>{{ $registration->submitted_at ? \Carbon\Carbon::parse($registration->submitted_at)->format('d/m/Y H:i') : '-' }}<br>By: {{ $registration->submitter->name ?? '-' }}</td></tr>
                    <tr><th>Submitter's Remarks</th><td>{!! nl2br(e($registration->remarks_submitter ?? '-')) !!}</td></tr>
                    @if ($registration->checked_by)
                        <tr><th>Checked At</th><td>{{ $registration->checked_at ? \Carbon\Carbon::parse($registration->checked_at)->format('d/m/Y H:i') : '-' }}<br>By: {{ $registration->checker->name ?? '-' }}</td></tr>
                        <tr><th>Checker's Remarks</th><td>{!! nl2br(e($registration->remarks_checker ?? '-')) !!}</td></tr>
                    @endif
                </table>
            </div>
        </div>

        <!-- Approval Form -->
        @hasanyrole('Superadmin|Admin')
            @if ($registration->status === 'Pending Approval')
                <div class="card mb-4">
                    <div class="card-header bg-light"><strong>Approve / Reject</strong></div>
                    <div class="card-body">
                        <form action="{{ route('registration.approval', $registration->id) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="mb-3">
                                <label for="remarks_checker" class="form-label">Remarks</label>
                                <textarea class="form-control" name="remarks_checker" rows="4"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Approval Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="">Select</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success w-100"><i class="bx bx-check-circle"></i> Submit</button>
                        </form>
                    </div>
                </div>
            @endif
        @endhasanyrole
    </div>
</div>
@endsection
