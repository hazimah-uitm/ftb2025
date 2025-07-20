@extends('layouts.master')
@section('content')
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pengurusan Penyertaan</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a></li>
                    @hasanyrole('Superadmin|Admin')
                        <li class="breadcrumb-item"><a href="{{ route('registration') }}">Senarai Penyertaan</a></li>
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
                    <h6 class="mb-0 fw-bold text-uppercase text-center">SURAT AKUAN PERTANDINGAN</h6>
                </div>
                <div class="card-body py-2 small">
                    <p class="text-center mb-2">
                        Sukacita dimaklumkan bahawa pasukan kami dari {{ $registration->user->jenis_ipta ?? '-' }}
                    </p>

                    <h6 class="fw-semibold text-center mb-2">{{ $registration->user->institution_name ?? '-' }}</h6>

                    <p class="text-center mb-0">
                        berminat untuk menyertai <strong>Festival Tari Borneo IX (Edisi ke-9) 2025</strong> pada:
                    </p>

                    <ul class="list-unstyled text-center mb-2">
                        <li><strong>Tarikh: 18 November - 21 November 2025</strong></li>
                        <li><strong>Tempat: Dewan Jubli, UiTM Cawangan Sarawak Kampus Samarahan</strong></li>
                    </ul>

                    <p class="mb-2">Dengan ini;</p>
                    <ol class="ps-3 mb-2">
                        <li>Kami akan mematuhi setiap peraturan dan syarat seperti yang ditetapkan oleh pihak Jawatankuasa
                            Penganjur sepanjang berlangsungnya Festival Tari Borneo IX (Edisi Ke-9) 2025.</li>
                        <li>Kami mengakui bahawa pihak Jawatankuasa Penganjur berhak membuat sebarang pindaan sepanjang
                            program mengikut kesesuaian demi kebaikan semua pihak.</li>
                        <li>Kami juga mengakui bahawa pihak Jawatankuasa Penganjur berhak membatalkan penyertaan kami
                            sekiranya kami melanggar peraturan penyertaan yang telah ditetapkan.</li>
                        <li>Pihak penganjur akan memastikan festival berjalan dengan lancar dan selamat. Namun begitu,
                            sebarang kecederaan atau kemalangan sepanjang FTB 2025 berlangsung adalah atas tanggung jawab
                            peserta.</li>
                    </ol>

                    <div class="border-top pt-2 mt-3">
                        <strong>Diperakui oleh:</strong>
                        <table class="table table-sm table-borderless mt-2 mb-0">
                            <tr>
                                <th style="width: 30%">Tarikh</th>
                                <td>{{ $registration->user->created_at ? \Carbon\Carbon::parse($registration->user->created_at)->format('d/m/Y H:i') : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $registration->user->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Jawatan</th>
                                <td>{{ $registration->user->position ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>No. Kad Pengenalan / Passport / KTP</th>
                                <td>{{ $registration->user->ic_no ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>No. Telefon</th>
                                <td>{{ $registration->user->phone_no ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Alamat Emel</th>
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
                        <h6 class="mb-0 fw-bold text-uppercase">Butiran Kumpulan</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <th style="width: 47%">Nama Institusi</th>
                                <td>{{ $registration->user->institution_name ?? '-' }}</td>
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
                            {{-- <tr>
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
                            </tr> --}}
                            <tr>
                                <th>Alamat</th>
                                <td>{!! nl2br(e($registration->address)) !!}</td>
                            </tr>
                            <tr>
                                <th>No. Telefon</th>
                                <td>{{ $registration->user->phone_no ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Alamat Emel</th>
                                <td>{{ $registration->user->email ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Pautan Google Drive</th>
                                <td>
                                    @if (!empty($registration->doc_link))
                                        <a href="{{ $registration->doc_link }}" target="_blank"><i
                                                class='bx bxs-folder-open fs-5'></i></a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Sinopsis Tarian Tradisional Etnik Borneo</th>
                                <td>{!! nl2br(e($registration->sinopsis_traditional)) !!}</td>
                            </tr>
                            <tr>
                                <th>Sinopsis Tarian Kreatif Etnik Borneo</th>
                                <td>{!! nl2br(e($registration->sinopsis_creative)) !!}</td>
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
                                    <h6 class="mb-0 fw-bold text-uppercase">Ahli Kumpulan
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
                                                    <th>Nama</th>
                                                    <th class="text-wrap">No. Kad Pengenalan / Passport / No. KTP</th>
                                                    <th class="text-wrap">No. Matrik / Kad Pelajar</th>
                                                    <th>Peranan</th>
                                                    <th>Jantina</th>
                                                    <th>Saiz Baju</th>
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
                            <h6 class="mb-0 fw-bold text-uppercase">PENGESAHAN PEMBAYARAN YURAN KOMITMEN</h6>
                        </div>
                        <div class="card-body">

                            <p class="mb-3 small">
                                Pihak kami telah membuat pembayaran Yuran Komitmen atas nama
                                <strong>UNIVERSITI TEKNOLOGI MARA (UITM) (UITM-AAW1)</strong>
                                (No. Akaun Bank : <strong>11040010001473</strong>) - BANK ISLAM MALAYSIA BERHAD melalui
                                kaedah berikut:
                            </p>
                            @foreach ($registration->payments as $payment)
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <th style="width:30%">Kaedah Bayaran</th>
                                        <td>{{ $payment->payment_type }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tarikh Bayaran</th>
                                        <td>{{ $payment->date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bukti Bayaran</th>
                                        <td>
                                            @if ($payment->payment_file)
                                                <a href="{{ asset('public/storage/' . $payment->payment_file) }}"
                                                    target="_blank"><i class='bx bxs-file-pdf fs-4'></i></a>
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
                        <h6 class="mb-0 fw-bold text-uppercase">Status Penyertaan</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-sm mb-0">
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if ($registration->status == 'Diluluskan')
                                        <span class="badge bg-success">Diluluskan</span>
                                    @elseif ($registration->status == 'Dibatalkan')
                                        <span class="badge bg-danger">Dibatalkan</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Menunggu Kelulusan</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Dihantar</th>
                                <td>{{ $registration->submitted_at ? \Carbon\Carbon::parse($registration->submitted_at)->format('d/m/Y H:i') : '-' }} oleh
                                    {{ $registration->submitter->name ?? '-' }}</td>
                            </tr>
                            @if ($registration->checked_by)
                                <tr>
                                    <th>Disemak</th>
                                    <td>{{ $registration->checked_at ? \Carbon\Carbon::parse($registration->checked_at)->format('d/m/Y H:i') : '-' }} oleh
                                        {{ $registration->checker->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Catatan Admin</th>
                                    <td>{!! nl2br(e($registration->remarks_checker ?? '-')) !!}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>

                <!-- Approval Form -->
                @hasanyrole('Superadmin|Admin')
                    @if ($registration->status === 'Menunggu Kelulusan')
                        <div class="card mb-2">
                            <div class="card-header bg-light">
                                <h6 class="mb-0 fw-bold text-uppercase">Status Penyertaan</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('registration.approval', $registration->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status Kelulusan</label>
                                        <select class="form-select" name="status" required>
                                            <option value="">Pilih Status Kelulusan</option>
                                            <option value="Diluluskan">Diluluskan</option>
                                            <option value="Dibatalkan">Dibatalkan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="remarks_checker" class="form-label">Catatan</label>
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
