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
        <div class="col-lg-12">
            <div class="card mb-3 shadow-sm border-0">
                <div class="card-header bg-light py-2">
                    <h6 class="mb-0 fw-bold text-uppercase text-center">Competition Declaration Letter</h6>
                </div>
                <div class="card-body py-2 small">
                    <p class="text-center mb-1">
                        We are pleased to inform you that our team from the {{ $registration->user->jenis_ipta ?? '-' }}
                    </p>

                    <h6 class="fw-semibold text-center mb-0">{{ $registration->user->institution_name ?? '-' }}</h6>

                    <p class="text-center mb-2">
                        is interested in participating in the <strong>Festival Tari Borneo IX 2025</strong> to be held on:
                    </p>

                    <ul class="list-unstyled text-center mb-2">
                        <li><strong>Date: 18 November - 21 November 2025</strong></li>
                        <li><strong>Venue: Dewan Jubli, UiTM Cawangan Sarawak Kampus Samarahan</strong></li>
                    </ul>

                    <p class="mb-2">Hereby, we declare that:</p>
                    <ol class="ps-3 mb-2">
                        <li>We will adhere to all rules and regulations set by the Organising Committee throughout the
                            duration of the Festival Tari Borneo IX 2025.</li>
                        <li>We acknowledge that the Organising Committee reserves the right to make any amendments
                            throughout the programme as deemed appropriate for the benefit of all parties.</li>
                        <li>We also acknowledge that the Organising Committee has the right to revoke our participation
                            should we violate any of the participation rules.</li>
                        <li>The organiser will ensure the festival runs smoothly and safely. However, any injuries or
                            accidents occurring during FTB 2025 will be the sole responsibility of the participants.</li>
                    </ol>

                    <div class="border-top pt-2 mt-3">
                        <strong>Declared by:</strong>
                        <table class="table table-sm table-borderless mt-2 mb-0">
                            <tr>
                                <th style="width: 30%">Date</th>
                                <td>{{ $registration->user->created_at ? \Carbon\Carbon::parse($registration->user->created_at)->format('d/m/Y H:i') : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $registration->user->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Position</th>
                                <td>{{ $registration->user->position ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Identification Card / Passport / KTP No.</th>
                                <td>{{ $registration->user->ic_no ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Phone No.</th>
                                <td>{{ $registration->user->phone_no ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $registration->user->email ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <!-- Left Column: Registration Info -->
            <div class="col-md-8">
                <!-- Info Card -->
                <div class="card mb-2">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-bold text-uppercase">Registration Details</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <th style="width: 47%">Name of Institution</th>
                                <td>{{ $registration->user->institution_name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Name of Dance Group</th>
                                <td>{{ $registration->group_name }}</td>
                            </tr>
                            <tr>
                                <th>Name of Traditional Dance</th>
                                <td>{{ $registration->traditional_dance_name }}</td>
                            </tr>
                            <tr>
                                <th>Name of Creative Dance</th>
                                <td>{{ $registration->creative_dance_name }}</td>
                            </tr>
                            <tr>
                                <th>Name of Accompanying Officer</th>
                                <td>
                                    @foreach ($registration->escortOfficers as $officer)
                                        <span class="d-block">{{ $officer->name }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>Name of Choreographer</th>
                                <td>{{ $registration->koreografer_name }}</td>
                            </tr>
                            <tr>
                                <th>Name of Assistant Choreographer <i>(if any)</i></th>
                                <td>{{ $registration->assistant_koreografer_name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{!! nl2br(e($registration->address)) !!}</td>
                            </tr>
                            <tr>
                                <th>Telephone Number</th>
                                <td>{{ $registration->user->phone_no ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Email Address</th>
                                <td>{{ $registration->user->email ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Traditional Dance Synopsis</th>
                                <td>{!! nl2br(e($registration->sinopsis_traditional)) !!}</td>
                            </tr>
                            <tr>
                                <th>Creative Dance Synopsis</th>
                                <td>{!! nl2br(e($registration->sinopsis_creative)) !!}</td>
                            </tr>
                            <tr>
                                <th>Shared Folder Link</th>
                                <td>
                                    @if (!empty($registration->doc_link))
                                        <a href="{{ $registration->doc_link }}" target="_blank"><i
                                                class='bx bxs-folder-open'></i></a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Group Members -->
                @if ($registration->members && $registration->members->count())
                    <div class="accordion mb-2" id="membersAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingMembers">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseMembers" aria-expanded="false" aria-controls="collapseMembers">
                                    <h6 class="mb-0 fw-bold text-uppercase">Group Members
                                        ({{ count($registration->members) }})</h6>
                                </button>
                            </h2>
                            <div id="collapseMembers" class="accordion-collapse collapse" aria-labelledby="headingMembers"
                                data-bs-parent="#membersAccordion">
                                <div class="accordion-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Identification Card / Passport / KTP No.</th>
                                                    <th>Matric No. / Student ID</th>
                                                    <th>Role</th>
                                                    <th>Gender</th>
                                                    <th>T-Shirt Size</th>
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


                <!-- Payment -->
                @if ($registration->payments && $registration->payments->count())
                    <div class="card mb-2">
                        <div class="card-header bg-light">
                            <h6 class="mb-0 fw-bold text-uppercase">Commitment Fee Payment</h6>
                        </div>
                        <div class="card-body">
                            
                        <p class="mb-3 small">
                            We have made the payment for the Commitment Fee under the name of
                            <strong>UNIVERSITI TEKNOLOGI MARA (UITM) (UITM-AAW1)</strong>
                            (Bank Account Number: <strong>11040010001473</strong>) -
                            <strong>BANK ISLAM MALAYSIA BERHAD</strong> via the following method:
                        </p>
                            @foreach ($registration->payments as $payment)
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <th style="width:30%">Payment Method</th>
                                        <td>{{ $payment->payment_type }}</td>
                                    </tr>
                                    <tr>
                                        <th>Payment Date</th>
                                        <td>{{ $payment->date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Proof</th>
                                        <td>
                                            @if ($payment->payment_file)
                                                <a href="{{ asset('public/storage/' . $payment->payment_file) }}"
                                                    target="_blank"><i class='bx bxs-file-pdf'></i></a>
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
            </div>

            <!-- Right Column: Approval Card -->
            <div class="col-md-4">
                <!-- Application Status -->
                <div class="card mb-2">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-bold text-uppercase">Application Status</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-sm mb-0">
                            <tr>
                                <th>Status</th>
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
                            <tr>
                                <th>Submitted At</th>
                                <td>{{ $registration->submitted_at ? \Carbon\Carbon::parse($registration->submitted_at)->format('d/m/Y H:i') : '-' }}<br>By:
                                    {{ $registration->submitter->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Submitter's Remarks</th>
                                <td>{!! nl2br(e($registration->remarks_submitter ?? '-')) !!}</td>
                            </tr>
                            @if ($registration->checked_by)
                                <tr>
                                    <th>Checked At</th>
                                    <td>{{ $registration->checked_at ? \Carbon\Carbon::parse($registration->checked_at)->format('d/m/Y H:i') : '-' }}<br>By:
                                        {{ $registration->checker->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Checker's Remarks</th>
                                    <td>{!! nl2br(e($registration->remarks_checker ?? '-')) !!}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>

                <!-- Approval Form -->
                @hasanyrole('Superadmin|Admin')
                    @if ($registration->status === 'Pending Approval')
                        <div class="card mb-2">
                            <div class="card-header bg-light">
                                <h6 class="mb-0 fw-bold text-uppercase">Approval Status</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('registration.approval', $registration->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Approval Status</label>
                                        <select class="form-select" name="status" required>
                                            <option value="">Select</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Rejected">Rejected</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="remarks_checker" class="form-label">Remarks</label>
                                        <textarea class="form-control" name="remarks_checker" rows="4"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100"><i class="bx bx-check-circle"></i>
                                        Submit</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endhasanyrole
            </div>
        </div>
    @endsection
