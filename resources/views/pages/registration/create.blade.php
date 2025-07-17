@extends('layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Participation Management</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('registration') }}">Participation List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Participation Form</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <h6 class="mb-0 text-uppercase">Participation Form</h6>
    <hr />

    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ $save_route }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                {{-- Institution Name from User --}}

                <div class="row g-3 mb-2">

                    <h6 class="text-primary text-uppercase">Group Details</h6>
                    <div class="col-12">
                        <label class="form-label">Institution Name</label>
                        <input type="text" class="form-control"
                            value="{{ $institution_name ?? ($registration->user->institution_name ?? '-') }}" readonly>
                    </div>

                    <div class="col-12">
                        <label for="group_name" class="form-label">Group Name</label>
                        <input type="text" class="form-control {{ $errors->has('group_name') ? 'is-invalid' : '' }}"
                            id="group_name" name="group_name"
                            value="{{ old('group_name', $registration->group_name ?? '') }}">
                        @if ($errors->has('group_name'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('group_name') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-6">
                        <label for="traditional_dance_name" class="form-label">Ethnic Borneo Traditional Dance Name</label>
                        <input type="text"
                            class="form-control {{ $errors->has('traditional_dance_name') ? 'is-invalid' : '' }}"
                            id="traditional_dance_name" name="traditional_dance_name"
                            value="{{ old('traditional_dance_name', $registration->traditional_dance_name ?? '') }}">
                        @if ($errors->has('traditional_dance_name'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('traditional_dance_name') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-6">
                        <label for="creative_dance_name" class="form-label">Ethnic Borneo Creative Dance Name</label>
                        <input type="text"
                            class="form-control {{ $errors->has('creative_dance_name') ? 'is-invalid' : '' }}"
                            id="creative_dance_name" name="creative_dance_name"
                            value="{{ old('creative_dance_name', $registration->creative_dance_name ?? '') }}">
                        @if ($errors->has('creative_dance_name'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('creative_dance_name') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    @for ($i = 0; $i < 2; $i++)
                        <div class="col-6">
                            <label for="escort_officers_{{ $i }}_name" class="form-label">Escort Officer Name
                                {{ $i + 1 }}</label>
                            <input type="text"
                                class="form-control {{ $errors->has('escort_officers.' . $i . '.name') ? 'is-invalid' : '' }}"
                                id="escort_officers_{{ $i }}_name"
                                name="escort_officers[{{ $i }}][name]"
                                value="{{ old('escort_officers.' . $i . '.name', $registration->escortOfficers[$i]->name ?? '') }}">
                            @if ($errors->has('escort_officers.' . $i . '.name'))
                                <div class="invalid-feedback">
                                    @foreach ($errors->get('escort_officers.' . $i . '.name') as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endfor

                    <div class="col-6">
                        <label for="koreografer_name" class="form-label">Choreographer Name</label>
                        <input type="text"
                            class="form-control {{ $errors->has('koreografer_name') ? 'is-invalid' : '' }}"
                            id="koreografer_name" name="koreografer_name"
                            value="{{ old('koreografer_name', $registration->koreografer_name ?? '') }}">
                        @if ($errors->has('koreografer_name'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('koreografer_name') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-6">
                        <label for="assistant_koreografer_name" class="form-label">Choreographer Name (If any)</label>
                        <input type="text"
                            class="form-control {{ $errors->has('assistant_koreografer_name') ? 'is-invalid' : '' }}"
                            id="assistant_koreografer_name" name="assistant_koreografer_name"
                            value="{{ old('assistant_koreografer_name', $registration->assistant_koreografer_name ?? '') }}">
                        @if ($errors->has('assistant_koreografer_name'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('assistant_koreografer_name') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" id="address" name="address">{{ old('address', $registration->address ?? '') }}</textarea>
                        @if ($errors->has('address'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('address') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-4">
                        <label class="form-label">Telephone No.</label>
                        <input type="text" class="form-control"
                            value="{{ $phone_no ?? ($registration->user->phone_no ?? '-') }}" readonly>
                    </div>

                    <div class="col-4">
                        <label for="fax_no" class="form-label">Fax No.</label>
                        <input type="text" class="form-control {{ $errors->has('fax_no') ? 'is-invalid' : '' }}"
                            id="fax_no" name="fax_no" value="{{ old('fax_no', $registration->fax_no ?? '') }}">
                        @if ($errors->has('fax_no'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('fax_no') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-4">
                        <label class="form-label">Email Address</label>
                        <input type="text" class="form-control"
                            value="{{ $email ?? ($registration->user->email ?? '-') }}" readonly>
                    </div>

                    <div class="col-12">
                        <label for="doc_link" class="form-label">Shared Folder (Allow access for
                            <strong>ftb2025@gmail.com</strong>)</label>
                        <span data-bs-toggle="tooltip" data-bs-placement="right"
                            title="Sila letak pautan url shared folder"><input type="url"
                                class="form-control {{ $errors->has('doc_link') ? 'is-invalid' : '' }}" name="doc_link"
                                value="{{ old('doc_link') }}"></span>
                        @if ($errors->has('doc_link'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('doc_link') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-12">
                        <label for="sinopsis_traditional" class="form-label">Synopsis of Ethnic Borneo Traditional
                            Dance</label>
                        <textarea class="form-control {{ $errors->has('sinopsis_traditional') ? 'is-invalid' : '' }}"
                            id="sinopsis_traditional" name="sinopsis_traditional">{{ old('sinopsis_traditional', $registration->sinopsis_traditional ?? '') }}</textarea>
                        @if ($errors->has('sinopsis_traditional'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('sinopsis_traditional') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-12">
                        <label for="sinopsis_creative" class="form-label">Synopsis of Ethnic Borneo Creative Dance</label>
                        <textarea class="form-control {{ $errors->has('sinopsis_creative') ? 'is-invalid' : '' }}" id="sinopsis_creative"
                            name="sinopsis_creative">{{ old('sinopsis_creative', $registration->sinopsis_creative ?? '') }}</textarea>
                        @if ($errors->has('sinopsis_creative'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('sinopsis_creative') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- GROUP MEMBER --}}
                    <hr class="my-4">
                    <h6 class="text-primary text-uppercase">Group Members (Max 25)</h6>

                    <div id="members-container">
                        <div class="card mb-3 member-item">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                <span class="fw-semibold">Member <span class="member-number">1</span></span>
                                <!-- This Remove button is hidden for the first member -->
                                <button type="button" class="btn btn-danger btn-sm remove-member d-none">
                                    <i class="bx bx-trash"></i> Remove
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="members[0][name]" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">IC / Passport / KTP</label>
                                        <input type="text" name="members[0][ic_no]" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Student ID</label>
                                        <input type="text" name="members[0][student_id]" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Role</label>
                                        <select name="members[0][peranan]" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Penari">Penari</option>
                                            <option value="Krew">Krew</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Gender</label>
                                        <select name="members[0][jantina]" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Shirt Size</label>
                                        <input type="text" name="members[0][saiz_baju]" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-2">
                        <button type="button" class="btn btn-info btn-sm" id="add-member-btn">
                            <i class="bx bx-plus"></i> Add Member
                        </button>
                    </div>

                    <!-- Template for new members -->
                    <template id="member-template">
                        <div class="card mb-3 member-item">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                <span class="fw-semibold">Member <span class="member-number">__NO__</span></span>
                                <button type="button" class="btn btn-danger btn-sm remove-member">
                                    <i class="bx bx-trash"></i> Remove
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="members[__INDEX__][name]" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">IC / Passport / KTP</label>
                                        <input type="text" name="members[__INDEX__][ic_no]" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Student ID</label>
                                        <input type="text" name="members[__INDEX__][student_id]" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Role</label>
                                        <select name="members[__INDEX__][peranan]" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Penari">Penari</option>
                                            <option value="Krew">Krew</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Gender</label>
                                        <select name="members[__INDEX__][jantina]" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Shirt Size</label>
                                        <input type="text" name="members[__INDEX__][saiz_baju]" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    {{-- Payment --}}
                    <hr class="my-2">
                    <h6 class="text-primary">COMMITMENT FEE PAYMENT CONFIRMATION</h6>

                    <div class="mb-1 mt-0">

                        <p class="mb-2 mt-2">
                            <i class="bx bx-info-circle"></i>
                            <span class="ms-1">
                                We have made the payment for the Commitment Fee under the name of
                                <strong>UNIVERSITI TEKNOLOGI MARA (UITM) (UITM-AAW1)</strong>
                                (Bank Account Number : <strong>11040010001473</strong>) - BANK ISLAM MALAYSIA BERHAD via
                                the following method:
                            </span>
                        </p>

                        <div class="border rounded p-3 mb-2 bg-light">
                            <div class="mb-2 fw-semibold">Choose Payment Method <span class="text-danger">*</span>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment[payment_type]"
                                    id="method1"
                                    value="Direct deposit into the UiTMKS account at BANK ISLAM MALAYSIA BERHAD branch"
                                    {{ old('payment.payment_type', $registration->payments[0]->payment_type ?? '') == 'Direct Deposit' ? 'checked' : '' }}>
                                <label class="form-check-label" for="method1">
                                    Direct deposit into the UiTMKS account at BANK ISLAM MALAYSIA BERHAD branch.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment[payment_type]"
                                    id="method2"
                                    value="Payment made via Interbank GIRO (IBG) Transfer or Telegraphic Transfer (for international payments)"
                                    {{ old('payment.payment_type', $registration->payments[0]->payment_type ?? '') == 'Interbank GIRO / Telegraphic Transfer' ? 'checked' : '' }}>
                                <label class="form-check-label" for="method2">
                                    Payment made via Interbank GIRO (IBG) Transfer or Telegraphic Transfer (for
                                    international payments).
                                </label>
                            </div>
                            @if ($errors->has('payment.payment_type'))
                                <div class="text-danger mt-1 small">
                                    {{ $errors->first('payment.payment_type') }}
                                </div>
                            @endif
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Payment Date <span
                                        class="text-danger">*</span></label>
                                <input type="date"
                                    class="form-control {{ $errors->has('payment.date') ? 'is-invalid' : '' }}"
                                    name="payment[date]"
                                    value="{{ old('payment.date', $registration->payments[0]->date ?? '') }}">
                                @if ($errors->has('payment.date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('payment.date') }}
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Upload Payment Proof (PDF / Image) <span
                                        class="text-danger">*</span></label>
                                <input type="file" name="payment[payment_file]" class="form-control">
                                @if (!empty($registration->payments[0]->payment_file))
                                    <small class="d-block mt-1">
                                        Current File:
                                        <a href="{{ asset('storage/' . $registration->payments[0]->payment_file) }}"
                                            target="_blank">View</a>
                                    </small>
                                @endif
                            </div>
                        </div>

                        <div class="alert alert-info mt-2 small p-3">
                            <p class="mb-2"><strong>Note:</strong></p>
                            <ol class="mb-2 ps-3">
                                <li class="mb-2">
                                    Participants may choose <b>one</b> of the following methods to pay the participation
                                    fee:
                                    <ul class="mb-2">
                                        <li>Direct deposit into UiTMKS account at <b>BANK ISLAM MALAYSIA BERHAD</b>, account
                                            number: <b>11040010001473</b>, at any branch.</li>
                                        <li><b>Interbank GIRO (IBG) Transfer</b> or <b>Telegraphic Transfer</b> (for
                                            international payments).</li>
                                    </ul>
                                </li>
                                <li class="mb-2">
                                    Each group is required to upload a copy of the <b>proof of payment transaction</b>
                                    together with this form.
                                </li>
                                <li class="mb-2">
                                    Bank information for payments is as follows:
                                    <div class="card border-0 shadow-sm mt-2 mb-1">
                                        <div class="card-body p-2">
                                            <table class="table table-borderless table-striped table-sm mb-0">
                                                <tr>
                                                    <td>Account Name:</td>
                                                    <td><strong>UNIVERSITI TEKNOLOGI MARA (UITM) (UITM-AAW1)</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Bank Account Number:</td>
                                                    <td><strong>11040010001473</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Bank Name:</td>
                                                    <td><strong>BANK ISLAM MALAYSIA BERHAD</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Bank Address:</td>
                                                    <td><strong>UITM KAMPUS SAMARAHAN, JALAN MERANEK, 94300 KOTA
                                                            SAMARAHAN</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Swift Code:</td>
                                                    <td><strong>BIMBMYKL</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Fee Amount:</td>
                                                    <td><strong>RM1,500 / Group</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Payment Reference:</td>
                                                    <td><strong>FTB2025</strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-2">
                                    The <b>Registration Form</b> along with the <b>proof of payment</b> must be submitted to
                                    the organiser on or before <b>31 August 2025 (Sunday)</b>.
                                </li>
                                <li>
                                    For further information or inquiries, please contact:
                                    <ul class="mb-0">
                                        <li>Cik Melinda Anak Jindu (082 678 059) / <a
                                                href="mailto:mel@uitm.edu.my">mel@uitm.edu.my</a></li>
                                        <li>Cik Lydia Jimbie Anak Anthony (082 677 058) / <a
                                                href="mailto:lydia@uitm.edu.my">lydia@uitm.edu.my</a></li>
                                    </ul>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">{{ $str_mode }}</button>
            </form>

        </div>
    </div>
    <!-- End Page Wrapper -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('members-container');
            const templateHtml = document.getElementById('member-template').innerHTML;
            const addBtn = document.getElementById('add-member-btn');

            let count = 1; // already have 1 member

            addBtn.addEventListener('click', function() {
                if (count >= 25) {
                    alert('Maximum 25 members allowed.');
                    return;
                }

                const index = count;
                const newHtml = templateHtml
                    .replace(/__INDEX__/g, index)
                    .replace(/__NO__/g, index + 1);

                const div = document.createElement('div');
                div.innerHTML = newHtml;
                container.appendChild(div);

                count++;
                updateNumbers();
            });

            container.addEventListener('click', function(e) {
                if (e.target.closest('.remove-member')) {
                    const allItems = container.querySelectorAll('.member-item');
                    if (allItems.length === 1) {
                        alert('At least one member is required.');
                        return;
                    }
                    e.target.closest('.member-item').remove();
                    count--;
                    updateNumbers();
                }
            });

            function updateNumbers() {
                const numbers = container.querySelectorAll('.member-number');
                numbers.forEach((el, idx) => {
                    el.textContent = idx + 1;
                });
            }
        });
    </script>

@endsection
