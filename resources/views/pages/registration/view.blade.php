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
        {{-- @role('Superadmin')
            <div class="ms-auto">
                <a href="{{ route('registration.edit', $registration->id) }}">
                    <button type="button" class="btn btn-primary mt-2 mt-lg-0">Update Record</button>
                </a>
            </div>
        @endrole --}}
    </div>
    <!-- End Breadcrumb -->

    <h6 class="mb-0 text-uppercase">{{ $registration->user->institution_name }}</h6>
    <hr />

    <!-- Registration Information -->
    <div class="row">
        <div class="col-md">
            <div class="card mb-4">
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 30%">Institution Name</th>
                            <td>{{ $registration->user->institution_name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Group Name</th>
                            <td>{{ $registration->group_name }}</td>
                        </tr>
                        <tr>
                            <th>Ethnic Borneo Traditional Dance Name</th>
                            <td>{{ $registration->traditional_dance_name }}</td>
                        </tr>
                        <tr>
                            <th>Ethnic Borneo Creative Dance Name</th>
                            <td>{{ $registration->creative_dance_name }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{!! nl2br(e($registration->address)) !!}</td>
                        </tr>
                        <tr>
                            <th>Phone No.</th>
                            <td>{{ $registration->user->phone_no ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Fax No.</th>
                            <td>{{ $registration->fax_no ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Email Address</th>
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
                            <th>Choreographer Name</th>
                            <td>{{ $registration->koreografer_name }}</td>
                        </tr>
                        <tr>
                            <th>Assistant Choreographer Name</th>
                            <td>{{ $registration->assistant_koreografer_name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Synopsis of Ethnic Borneo Traditional Dance</th>
                            <td>{!! nl2br(e($registration->sinopsis_traditional)) !!}</td>
                        </tr>
                        <tr>
                            <th>Synopsis of Ethnic Borneo Creative Dance</th>
                            <td>{!! nl2br(e($registration->sinopsis_creative)) !!}</td>
                        </tr>
                        <tr>
                            <th>Shared Folder Link</th>
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
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Group Members -->
    @if ($registration->members && $registration->members->count())
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0">Group Members</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nam2</th>
                                <th>IC / Passport / KTP</th>
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
    @endif

    <!-- Payment Details -->
    @if ($registration->payments && $registration->payments->count())
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0">Commitment Fee Payment Confirmation</h6>
            </div>
            <div class="card-body">
                @foreach ($registration->payments as $payment)
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 30%">Payment Method</th>
                            <td>{{ $payment->payment_type }}</td>
                        </tr>
                        <tr>
                            <th>Payment Date</th>
                            <td>{{ $payment->date }}</td>
                        </tr>
                        <tr>
                            <th>Payment Proof</th>
                            <td>
                                @if ($payment->payment_file)
                                    <a href="{{ asset('public/storage/' . $payment->payment_file) }}" target="_blank"><i
                                            class='bx bxs-file-pdf' style="font-size: 1.5rem; color: #007bff;"></i></a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    </table>
                @endforeach
            </div>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header bg-light">
            <h6 class="mb-0">Application Status</h6>
        </div>
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tr>
                    <th>Status</th>
                    <td>{{ $registration->status }}</td>
                </tr>
                <tr>
                    <th>Submitted at</th>
                    <td>
                        {{ $registration->submitted_at ? \Carbon\Carbon::parse($registration->submitted_at)->format('d/m/Y H:i') : '-' }}
                        oleh
                        {{ $registration->submitter->name ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan Pemohon</th>
                    <td>
                        {!! nl2br(e($registration->remarks_submitter ?? '-')) !!}
                    </td>
                </tr>
                @if ($registration->checked_by)
                    <tr>
                        <th>Disemak pada</th>
                        <td>
                            {{ $registration->checked_at ? \Carbon\Carbon::parse($registration->checked_at)->format('d/m/Y H:i') : '-' }}
                            oleh
                            {{ $registration->checker->name ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Catatan Penyemak</th>
                        <td>
                            {!! nl2br(e($registration->remarks_checker ?? '-')) !!}
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    </div>

@endsection
