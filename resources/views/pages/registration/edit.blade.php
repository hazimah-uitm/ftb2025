@extends('layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pengurusan Penyertaan</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a></li>
                    @role('Peserta')
                        <li class="breadcrumb-item">
                            <a href="{{ route('registration.view', $registration->id ?? 0) }}">Maklumat Penyertaan</a>
                        </li>
                    @else
                        <li class="breadcrumb-item">
                            <a href="{{ route('registration') }}">Senarai Penyertaan</a>
                        </li>
                    @endrole
                    <li class="breadcrumb-item active" aria-current="page">{{ $str_mode }} Penyertaan</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <h6 class="mb-0 text-uppercase">{{ $str_mode }} Penyertaan</h6>
    <hr />

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Maklumat tidak lengkap</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ $save_route }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                {{-- Institution Name from User --}}

                <div class="row g-3 mb-2">

                    <h6 class="text-primary text-uppercase">Butiran Kumpulan</h6>
                    <div class="col-12">
                        <label class="form-label">Nama Institusi</label>
                        <input type="text" class="form-control"
                            value="{{ $institution_name ?? ($registration->user->institution_name ?? '-') }}" readonly>
                    </div>

                    <div class="col-12">
                        <label for="group_name" class="form-label">Nama Kumpulan</label>
                        <input type="text" class="form-control {{ $errors->has('group_name') ? 'is-invalid' : '' }}"
                            id="group_name" name="group_name"
                            value="{{ old('group_name', $registration->group_name ?? '') }}" readonly>
                        @if ($errors->has('group_name'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('group_name') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-6">
                        <label for="traditional_dance_name" class="form-label">Nama Tarian Tradisional Etnik Borneo</label>
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
                        <label for="creative_dance_name" class="form-label">Nama Tarian Kreatif Etnik Borneo</label>
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

                    {{-- @for ($i = 0; $i < 2; $i++)
                        <div class="col-6">
                            <label for="escort_officers_{{ $i }}_name" class="form-label">Name of Accompanying
                                Officer
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
                        <label for="koreografer_name" class="form-label">Name of Choreographer</label>
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
                        <label for="assistant_koreografer_name" class="form-label">Name of Assistant Choreographer <i>(if
                                any)</i></label>
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
                    </div> --}}

                    <div class="col-12">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" id="address" name="address">{{ old('address', $registration->address ?? '') }}</textarea>
                        @if ($errors->has('address'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('address') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-6">
                        <label class="form-label">No. Telefon</label>
                        <input type="text" class="form-control"
                            value="{{ $phone_no ?? ($registration->user->phone_no ?? '-') }}" readonly>
                    </div>

                    <div class="col-6">
                        <label class="form-label">Alamat Emel</label>
                        <input type="text" class="form-control"
                            value="{{ $email ?? ($registration->user->email ?? '-') }}" readonly>
                    </div>

                    <div class="col-12">
                        <label for="doc_link" class="form-label mb-1">Pautan Google Drive</label>
                        <div class="text-muted small ps-3 mt-0 mb-2">
                            <i class="bx bx-info-circle me-1"></i>
                            Pastikan akses diberikan kepada <strong>ftb2025@gmail.com</strong> <br>
                            <i class="bx bx-info-circle me-1"></i>
                            Contoh pautan:
                            <em>https://drive.google.com/file/d/1AbCDeFGhIjkLMNOPqrStuVwxyz123456/view?usp=sharing</em>
                        </div>
                        <span data-bs-toggle="tooltip" data-bs-placement="right"
                            title="Sila letak pautan url Google Drive"><input type="url"
                                class="form-control {{ $errors->has('doc_link') ? 'is-invalid' : '' }}" name="doc_link"
                                value="{{ old('doc_link', $registration->doc_link ?? '') }}" readonly></span>
                        @if ($errors->has('doc_link'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('doc_link') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-12">
                        <label for="sinopsis_traditional" class="form-label">Sinopsis Tarian Tradisional Etnik
                            Borneo</label>
                        <textarea class="form-control {{ $errors->has('sinopsis_traditional') ? 'is-invalid' : '' }}" id="sinopsis_traditional"
                            name="sinopsis_traditional">{{ old('sinopsis_traditional', $registration->sinopsis_traditional ?? '') }}</textarea>
                        @if ($errors->has('sinopsis_traditional'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('sinopsis_traditional') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-12">
                        <label for="sinopsis_creative" class="form-label">Sinopsis Tarian Kreatif Etnik Borneo</label>
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
                    <h6 class="text-primary text-uppercase mb-0">Ahli Kumpulan <i>(Maksimum 25)</i></h6>
                    <div class="text-muted small ps-3 mt-2 mb-1">
                        <i class="bx bx-info-circle me-1"></i>
                        Tidak lebih daripada <b>25 orang termasuk Pegawai Pengiring, Koreografer, Penari & Kru.</b>
                        <br>
                        <i class="bx bx-info-circle me-1"></i>
                        Bilangan penari di atas pentas adalah <b>minimum 10 orang dan maksimum 14 orang.</b>
                    </div>

                    <div id="members-container">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle" id="members-table">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Penuh</th>
                                        <th>No. KP / Passport</th>
                                        <th>No. Matrik</th>
                                        <th>Peranan</th>
                                        <th>Jantina</th>
                                        <th>Saiz Baju</th>
                                        <th>Padam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $members =
                                            old('members') ??
                                            $registration->members
                                                ->map(function ($m) {
                                                    return [
                                                        'name' => $m->name,
                                                        'ic_no' => $m->ic_no,
                                                        'student_id' => $m->student_id,
                                                        'peranan' => $m->peranan,
                                                        'jantina' => $m->jantina,
                                                        'saiz_baju' => $m->saiz_baju,
                                                    ];
                                                })
                                                ->toArray();
                                    @endphp

                                    @foreach ($members as $index => $member)
                                        <tr class="member-row">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>
                                                <input type="text" name="members[{{ $index }}][name]"
                                                    class="form-control {{ $errors->has("members.$index.name") ? 'is-invalid' : '' }}"
                                                    value="{{ old("members.$index.name", $member['name']) }}">
                                                @if ($errors->has("members.$index.name"))
                                                    <div class="invalid-feedback d-block">
                                                        {{ $errors->first("members.$index.name") }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" name="members[{{ $index }}][ic_no]"
                                                    class="form-control {{ $errors->has("members.$index.ic_no") ? 'is-invalid' : '' }}"
                                                    value="{{ old("members.$index.ic_no", $member['ic_no']) }}">
                                                @if ($errors->has("members.$index.ic_no"))
                                                    <div class="invalid-feedback d-block">
                                                        {{ $errors->first("members.$index.ic_no") }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" name="members[{{ $index }}][student_id]"
                                                    class="form-control {{ $errors->has("members.$index.student_id") ? 'is-invalid' : '' }}"
                                                    value="{{ old("members.$index.student_id", $member['student_id']) }}">
                                                @if ($errors->has("members.$index.student_id"))
                                                    <div class="invalid-feedback d-block">
                                                        {{ $errors->first("members.$index.student_id") }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <select name="members[{{ $index }}][peranan]"
                                                    class="form-select {{ $errors->has("members.$index.peranan") ? 'is-invalid' : '' }}">
                                                    <option value="">Pilih</option>
                                                    @foreach (['Penari', 'Kru', 'Pegawai Pengiring', 'Koreografer', 'Pembantu Koreografer'] as $role)
                                                        <option value="{{ $role }}"
                                                            {{ old("members.$index.peranan", $member['peranan']) == $role ? 'selected' : '' }}>
                                                            {{ $role }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has("members.$index.peranan"))
                                                    <div class="invalid-feedback d-block">
                                                        {{ $errors->first("members.$index.peranan") }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <select name="members[{{ $index }}][jantina]"
                                                    class="form-select {{ $errors->has("members.$index.jantina") ? 'is-invalid' : '' }}">
                                                    <option value="">Pilih</option>
                                                    <option value="Lelaki"
                                                        {{ old("members.$index.jantina", $member['jantina']) == 'Lelaki' ? 'selected' : '' }}>
                                                        Lelaki</option>
                                                    <option value="Perempuan"
                                                        {{ old("members.$index.jantina", $member['jantina']) == 'Perempuan' ? 'selected' : '' }}>
                                                        Perempuan</option>
                                                </select>
                                                @if ($errors->has("members.$index.jantina"))
                                                    <div class="invalid-feedback d-block">
                                                        {{ $errors->first("members.$index.jantina") }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <select name="members[{{ $index }}][saiz_baju]"
                                                    class="form-select {{ $errors->has("members.$index.saiz_baju") ? 'is-invalid' : '' }}">
                                                    <option value="">Pilih</option>
                                                    @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                                        <option value="{{ $size }}"
                                                            {{ old("members.$index.saiz_baju", $member['saiz_baju']) == $size ? 'selected' : '' }}>
                                                            {{ $size }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has("members.$index.saiz_baju"))
                                                    <div class="invalid-feedback d-block">
                                                        {{ $errors->first("members.$index.saiz_baju") }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($index > 0)
                                                    <button type="button" class="btn btn-danger btn-sm remove-member">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                @else
                                                    –
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end mt-1 mb-3">
                            <button type="button" class="btn btn-info btn-sm" id="add-member-btn">
                                <i class="bx bx-plus"></i> Tambah Ahli
                            </button>
                            <div class="d-flex justify-content-end mt-2">
                                <div id="max-member-alert" class="col-4 alert alert-warning d-none small mb-0">
                                    <i class="bx bx-error-circle me-1"></i>
                                    Jumlah maksimum <strong>25 orang ahli kumpulan</strong> telah dicapai.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Template for new members -->
                    <template id="member-row-template">
                        <tr class="member-row">
                            <td class="text-center">__NO__</td>
                            @foreach (['name', 'ic_no', 'student_id'] as $field)
                                <td>
                                    <input type="text" name="members[__INDEX__][{{ $field }}]"
                                        class="form-control">
                                </td>
                            @endforeach
                            <td>
                                <select name="members[__INDEX__][peranan]" class="form-select">
                                    <option value="">Pilih</option>
                                    @foreach (['Penari', 'Kru', 'Pegawai Pengiring', 'Koreografer', 'Pembantu Koreografer'] as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="members[__INDEX__][jantina]" class="form-select">
                                    <option value="">Pilih</option>
                                    <option value="Lelaki">Lelaki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </td>
                            <td>
                                <select name="members[__INDEX__][saiz_baju]" class="form-select">
                                    <option value="">Pilih</option>
                                    @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $s)
                                        <option value="{{ $s }}">{{ $s }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm remove-member">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </template>

                    {{-- Payment --}}
                    <hr class="my-2">
                    <h6 class="text-primary">PENGESAHAN PEMBAYARAN YURAN KOMITMEN</h6>

                    <div class="mb-1 mt-0">

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

                <button type="submit" class="btn btn-primary">{{ $str_mode }}</button>
            </form>
        </div>
    </div>
    <!-- End Page Wrapper -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addBtn = document.getElementById('add-member-btn');
            const tableBody = document.querySelector('#members-table tbody');
            const rowTemplate = document.getElementById('member-row-template').innerHTML;

            function updateNumbers() {
                [...tableBody.querySelectorAll('tr')].forEach((tr, idx) => {
                    tr.querySelector('td:first-child').textContent = idx + 1;
                });
            }

            function addRow(data = {}) {
                const index = tableBody.querySelectorAll('tr').length;
                let html = rowTemplate.replace(/__INDEX__/g, index).replace(/__NO__/g, index + 1);

                const temp = document.createElement('tbody');
                temp.innerHTML = html.trim();
                const row = temp.firstElementChild;

                // Fill data
                Object.keys(data).forEach(key => {
                    const input = row.querySelector(`[name="members[${index}][${key}]"]`);
                    if (input) input.value = data[key];
                });

                tableBody.appendChild(row);
                updateNumbers();
            }

            // Delegated event for delete button
            tableBody.addEventListener('click', function(e) {
                if (e.target.closest('.remove-member')) {
                    const row = e.target.closest('tr');
                    row.remove();
                    updateNumbers();
                }
            });

            const alertBox = document.getElementById('max-member-alert');
            let alertTimeout = null;

            addBtn.addEventListener('click', function() {
                const currentCount = tableBody.querySelectorAll('tr').length;

                if (currentCount >= 25) {
                    alertBox.classList.remove('d-none');

                    // Reset timeout kalau alert ditekan berulang
                    if (alertTimeout) clearTimeout(alertTimeout);

                    alertTimeout = setTimeout(() => {
                        alertBox.classList.add('d-none');
                    }, 10000); // 5000ms = 5 saat

                    alertBox.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    return;
                } else {
                    alertBox.classList.add('d-none');
                }

                addRow();
            });
        });
    </script>

@endsection
