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
                    <li class="breadcrumb-item active" aria-current="page">Borang Penyertaan</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <h6 class="mb-0 text-uppercase">Borang Penyertaan</h6>
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
                        <div class="card mb-3 member-item">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                <span class="fw-semibold">Ahli <span class="member-number">1</span></span>
                                <!-- This Remove button is hidden for the first member -->
                                <button type="button" class="btn btn-danger btn-sm remove-member d-none">
                                    <i class="bx bx-trash"></i> Padam
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    @php
                                        $authUser = auth()->user();
                                    @endphp

                                    <div class="col-md-4">
                                        <label class="form-label">Nama Penuh</label>
                                        <input type="text" name="members[0][name]"
                                            class="form-control {{ $errors->has('members.0.name') ? 'is-invalid' : '' }}"
                                            value="{{ old('members.0.name', $authUser->name ?? '') }}">
                                        @if ($errors->has('members.0.name'))
                                            <div class="invalid-feedback">
                                                @foreach ($errors->get('members.0.name') as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">No. Kad Pengenalan / Passport / No. KTP</label>
                                        <input type="text" name="members[0][ic_no]"
                                            class="form-control {{ $errors->has('members.0.ic_no') ? 'is-invalid' : '' }}"
                                            value="{{ old('members.0.ic_no', $authUser->ic_no ?? '') }}">
                                        @if ($errors->has('members.0.ic_no'))
                                            <div class="invalid-feedback">
                                                @foreach ($errors->get('members.0.ic_no') as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">No. Matrik / Kad Pelajar</label>
                                        <input type="text" name="members[0][student_id]"
                                            class="form-control {{ $errors->has('members.0.student_id') ? 'is-invalid' : '' }}"
                                            value="{{ old('members.0.student_id') }}">
                                        @if ($errors->has('members.0.student_id'))
                                            <div class="invalid-feedback">
                                                @foreach ($errors->get('members.0.student_id') as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Peranan</label>
                                        <select name="members[0][peranan]"
                                            class="form-select {{ $errors->has('members.0.peranan') ? 'is-invalid' : '' }}">
                                            <option value="">Sila Pilih Peranan</option>
                                            <option value="Penari"
                                                {{ old('members.0.peranan') == 'Penari' ? 'selected' : '' }}>Penari
                                            </option>
                                            <option value="Kru"
                                                {{ old('members.0.peranan') == 'Kru' ? 'selected' : '' }}>Kru</option>
                                            <option value="Pegawai Pengiring"
                                                {{ old('members.0.peranan') == 'Pegawai Pengiring' ? 'selected' : '' }}>
                                                Pegawai Pengiring</option>
                                            <option value="Koreografer"
                                                {{ old('members.0.peranan') == 'Koreografer' ? 'selected' : '' }}>
                                                Koreografer</option>
                                            <option value="Pembantu Koreografer"
                                                {{ old('members.0.peranan') == 'Pembantu Koreografer' ? 'selected' : '' }}>
                                                Pembantu Koreografer</option>
                                        </select>
                                        @if ($errors->has('members.0.peranan'))
                                            <div class="invalid-feedback">
                                                @foreach ($errors->get('members.0.peranan') as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Jantina</label>
                                        <select name="members[0][jantina]"
                                            class="form-select {{ $errors->has('members.0.jantina') ? 'is-invalid' : '' }}">
                                            <option value="">Pilih Jantina</option>
                                            <option value="Lelaki"
                                                {{ old('members.0.jantina') == 'Lelaki' ? 'selected' : '' }}>Lelaki
                                            </option>
                                            <option value="Perempuan"
                                                {{ old('members.0.jantina') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                            </option>
                                        </select>
                                        @if ($errors->has('members.0.jantina'))
                                            <div class="invalid-feedback">
                                                @foreach ($errors->get('members.0.jantina') as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Saiz Baju</label>
                                        <select name="members[0][saiz_baju]"
                                            class="form-select {{ $errors->has('members.0.saiz_baju') ? 'is-invalid' : '' }}">
                                            <option value="">Pilih Saiz Baju</option>
                                            <option value="S"
                                                {{ old('members.0.saiz_baju') == 'S' ? 'selected' : '' }}>S</option>
                                            <option value="M"
                                                {{ old('members.0.saiz_baju') == 'M' ? 'selected' : '' }}>M</option>
                                            <option value="L"
                                                {{ old('members.0.saiz_baju') == 'L' ? 'selected' : '' }}>L</option>
                                            <option value="XL"
                                                {{ old('members.0.saiz_baju') == 'XL' ? 'selected' : '' }}>XL</option>
                                            <option value="XXL"
                                                {{ old('members.0.saiz_baju') == 'XXL' ? 'selected' : '' }}>XXL</option>
                                        </select>
                                        @if ($errors->has('members.0.saiz_baju'))
                                            <div class="invalid-feedback">
                                                @foreach ($errors->get('members.0.saiz_baju') as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-2">
                        <button type="button" class="btn btn-info btn-sm" id="add-member-btn">
                            <i class="bx bx-plus"></i> Tambah Ahli
                        </button>
                    </div>

                    <!-- Template for new members -->
                    <template id="member-template">
                        <div class="card mb-3 member-item">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                <span class="fw-semibold">Ahli <span class="member-number">__NO__</span></span>
                                <button type="button" class="btn btn-danger btn-sm remove-member">
                                    <i class="bx bx-trash"></i> Padam
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Nama Penuh</label>
                                        <input type="text" name="members[__INDEX__][name]"
                                            class="form-control {{ $errors->has('members.__INDEX__.name') ? 'is-invalid' : '' }}"
                                            value="{{ old('members.__INDEX__.name') }}">
                                        @if ($errors->has('members.__INDEX__.name'))
                                            <div class="invalid-feedback">
                                                @foreach ($errors->get('members.__INDEX__.name') as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">No. Kad Pengenalan / Passport / No. KTP</label>
                                        <input type="text" name="members[__INDEX__][ic_no]"
                                            class="form-control {{ $errors->has('members.__INDEX__.ic_no') ? 'is-invalid' : '' }}"
                                            value="{{ old('members.__INDEX__.ic_no') }}">
                                        @if ($errors->has('members.__INDEX__.ic_no'))
                                            <div class="invalid-feedback">
                                                @foreach ($errors->get('members.__INDEX__.ic_no') as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">ID Pelajar</label>
                                        <input type="text" name="members[__INDEX__][student_id]"
                                            class="form-control {{ $errors->has('members.__INDEX__.student_id') ? 'is-invalid' : '' }}"
                                            value="{{ old('members.__INDEX__.student_id') }}">
                                        @if ($errors->has('members.__INDEX__.student_id'))
                                            <div class="invalid-feedback">
                                                @foreach ($errors->get('members.__INDEX__.student_id') as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Peranan</label>
                                        <select name="members[__INDEX__][peranan]"
                                            class="form-select {{ $errors->has('members.__INDEX__.peranan') ? 'is-invalid' : '' }}">
                                            <option value="">Pilih</option>
                                            <option value="Penari"
                                                {{ old('members.__INDEX__.peranan') == 'Penari' ? 'selected' : '' }}>Penari
                                            </option>
                                            <option value="Kru"
                                                {{ old('members.__INDEX__.peranan') == 'Kru' ? 'selected' : '' }}>Kru
                                            </option>
                                            <option value="Pegawai Pengiring"
                                                {{ old('members.__INDEX__.peranan') == 'Pegawai Pengiring' ? 'selected' : '' }}>
                                                Pegawai Pengiring</option>
                                            <option value="Koreografer"
                                                {{ old('members.__INDEX__.peranan') == 'Koreografer' ? 'selected' : '' }}>
                                                Koreografer</option>
                                            <option value="Pembantu Koreografer"
                                                {{ old('members.__INDEX__.peranan') == 'Pembantu Koreografer' ? 'selected' : '' }}>
                                                Pembantu Koreografer</option>
                                        </select>
                                        @if ($errors->has('members.__INDEX__.peranan'))
                                            <div class="invalid-feedback">
                                                @foreach ($errors->get('members.__INDEX__.peranan') as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Jantina</label>
                                        <select name="members[__INDEX__][jantina]"
                                            class="form-select {{ $errors->has('members.__INDEX__.jantina') ? 'is-invalid' : '' }}">
                                            <option value="">Pilih</option>
                                            <option value="Lelaki"
                                                {{ old('members.__INDEX__.jantina') == 'Lelaki' ? 'selected' : '' }}>Lelaki
                                            </option>
                                            <option value="Perempuan"
                                                {{ old('members.__INDEX__.jantina') == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @if ($errors->has('members.__INDEX__.jantina'))
                                            <div class="invalid-feedback">
                                                @foreach ($errors->get('members.__INDEX__.jantina') as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Saiz Baju</label>
                                        <select name="members[__INDEX__][saiz_baju]"
                                            class="form-control {{ $errors->has('members.__INDEX__.saiz_baju') ? 'is-invalid' : '' }}">
                                            <option value="">Pilih Saiz</option>
                                            <option value="S"
                                                {{ old('members.__INDEX__.saiz_baju') == 'S' ? 'selected' : '' }}>S
                                            </option>
                                            <option value="M"
                                                {{ old('members.__INDEX__.saiz_baju') == 'M' ? 'selected' : '' }}>M
                                            </option>
                                            <option value="L"
                                                {{ old('members.__INDEX__.saiz_baju') == 'L' ? 'selected' : '' }}>L
                                            </option>
                                            <option value="XL"
                                                {{ old('members.__INDEX__.saiz_baju') == 'XL' ? 'selected' : '' }}>XL
                                            </option>
                                            <option value="XXL"
                                                {{ old('members.__INDEX__.saiz_baju') == 'XXL' ? 'selected' : '' }}>XXL
                                            </option>
                                        </select>

                                        @if ($errors->has('members.__INDEX__.saiz_baju'))
                                            <div class="invalid-feedback">
                                                @foreach ($errors->get('members.__INDEX__.saiz_baju') as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    {{-- Payment --}}
                    <hr class="my-2">
                    <h6 class="text-primary">PENGESAHAN PEMBAYARAN YURAN KOMITMEN</h6>

                    <div class="mb-1 mt-0">

                        <p class="mb-2 mt-2">
                            <i class="bx bx-info-circle"></i>
                            <span class="ms-1">
                                Pihak kami telah membuat pembayaran Yuran Komitmen atas nama
                                <strong>UNIVERSITI TEKNOLOGI MARA (UITM) (UITM-AAW1)</strong>
                                (No. Akaun Bank : <strong>11040010001473</strong>) - BANK ISLAM MALAYSIA BERHAD melalui
                                kaedah berikut:
                            </span>
                        </p>

                        <div class="border rounded p-3 mb-2 bg-light">
                            <div class="mb-2 fw-semibold">Pilih kaedah bayaran <span class="text-danger">*</span>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment[payment_type]"
                                    id="method1"
                                    value="Deposit terus ke akaun UiTMKS di cawangan BANK ISLAM MALAYSIA BERHAD"
                                    {{ old('payment.payment_type', $registration->payments[0]->payment_type ?? '') == 'Deposit terus ke akaun UiTMKS di cawangan BANK ISLAM MALAYSIA BERHAD' ? 'checked' : '' }}>
                                <label class="form-check-label" for="method1">
                                    Deposit terus ke akaun UiTMKS di cawangan BANK ISLAM MALAYSIA BERHAD.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment[payment_type]"
                                    id="method2"
                                    value="Bayaran dibuat melalui pindahan wang (IBG Transfer) atau Telegraphic Transfer  (Bayaran dari luar negara)"
                                    {{ old('payment.payment_type', $registration->payments[0]->payment_type ?? '') == 'Bayaran dibuat melalui pindahan wang (IBG Transfer) atau Telegraphic Transfer  (Bayaran dari luar negara)' ? 'checked' : '' }}>
                                <label class="form-check-label" for="method2">
                                    Bayaran dibuat melalui pindahan wang (IBG Transfer) atau Telegraphic Transfer (Bayaran
                                    dari luar negara).
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
                                <label class="form-label fw-semibold">Tarikh Bayaran <span
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
                                <label class="form-label fw-semibold">
                                    Muat naik Bukti Pembayaran (PDF)
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="file" name="payment[payment_file]" class="form-control">
                                @if (session('uploaded_payment_file'))
                                    <small class="d-block mt-1 text-success">
                                        Fail telah dimuat naik:
                                        <a href="{{ asset('public/storage/' . session('uploaded_payment_file')) }}"
                                            target="_blank">Papar</a>
                                    </small>
                                @endif
                                @if ($errors->has('payment.payment_file'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('payment.payment_file') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="alert alert-info mt-2 small p-3">
                            <p class="mb-2"><strong>Nota:</strong></p>
                            <ol class="mb-2 ps-3">
                                <li class="mb-2">
                                    Peserta boleh memilih salah satu kaedah untuk membuat pembayaran yuran penyertaan
                                    seperti berikut:
                                    <ul class="mb-2">
                                        <li>Deposit terus ke akaun UiTMKS di BANK ISLAM MALAYSIA BERHAD bernombor:
                                            <b>11040010001473</b>, di mana-mana cawangan <b>BANK ISLAM MALAYSIA BERHAD.</b>
                                        </li>
                                        <li>Bayaran dibuat melalui pindaan wang (IBG Transfers) atau Telegraphic Transfer
                                            (bayaran daripada luar negara).</li>
                                    </ul>
                                </li>
                                <li class="mb-2">
                                    Setiap kumpulan dikehendaki mengepilkan bersama salinan bukti transaksi bayaran bersama
                                    borang ini.
                                </li>
                                <li class="mb-2">
                                    Maklumat bank UiTMKS untuk bayaran adalah seperti berikut:
                                    <div class="card border-0 shadow-sm mt-2 mb-1">
                                        <div class="card-body p-2">
                                            <table class="table table-borderless table-striped table-sm mb-0">
                                                <tr>
                                                    <td>Penama Akaun:</td>
                                                    <td><strong>UNIVERSITI TEKNOLOGI MARA (UITM) (UITM-AAW1)</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>No. Akaun Bank:</td>
                                                    <td><strong>11040010001473</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Syarikat Bank:</td>
                                                    <td><strong>BANK ISLAM MALAYSIA BERHAD</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat Bank:</td>
                                                    <td><strong>UITM KAMPUS SAMARAHAN, JALAN MERANEK, 94300 KOTA
                                                            SAMARAHAN</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Swift Code:</td>
                                                    <td><strong>BIMBMYKL</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah Yuran:</td>
                                                    <td><strong>RM1,500 / Kumpulan</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Rujukan Bayaran:</td>
                                                    <td><strong>FTB2025</strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-2">
                                    Semua pendaftaran mestilah diselesaikan melalui sistem, berserta surat akuan
                                    pertandingan,
                                    selewat-lewatnya pada <strong>31 Ogos 2025 (Ahad)</strong>.
                                </li>
                                <li>
                                    Untuk maklumat lanjut atau sebarang pertanyaan, sila hubungi:
                                    <ul class="mb-0">
                                        <li>Cik Melinda Anak Jindu (+6082 678 059) / <a
                                                href="mailto:mel@uitm.edu.my">mel@uitm.edu.my</a></li>
                                        <li>Cik Lydia Jimbie Anak Anthony (+6082 677 058) / <a
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
    <!-- End Page Wrapper -->
    @if (old('members'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const oldMembers = @json(old('members'));
                const container = document.getElementById('members-container');
                const templateHtml = document.getElementById('member-template').innerHTML;

                // Kosongkan semua yang dimount dari DB supaya guna old sahaja
                container.innerHTML = '';

                oldMembers.forEach((member, index) => {
                    let html = templateHtml
                        .replace(/__INDEX__/g, index)
                        .replace(/__NO__/g, index + 1);

                    const div = document.createElement('div');
                    div.innerHTML = html;
                    container.appendChild(div);

                    // Isi semula value lama ke dalam field
                    Object.keys(member).forEach((key) => {
                        const input = div.querySelector(`[name="members[${index}][${key}]"]`);
                        if (input) {
                            if (input.tagName === 'SELECT') {
                                [...input.options].forEach(opt => {
                                    if (opt.value == member[key]) opt.selected = true;
                                });
                            } else {
                                input.value = member[key];
                            }
                        }
                    });
                });

                // Update nombor ahli
                const updateNumbers = () => {
                    const numbers = container.querySelectorAll('.member-number');
                    numbers.forEach((el, idx) => {
                        el.textContent = idx + 1;
                    });
                };
                updateNumbers();
            });
        </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addBtn = document.getElementById('add-member-btn');
            const container = document.getElementById('members-container');
            const templateHtml = document.getElementById('member-template').innerHTML;

            function updateMemberNumbers() {
                const numbers = container.querySelectorAll('.member-number');
                numbers.forEach((el, idx) => {
                    el.textContent = idx + 1;
                });
            }

            function attachRemoveButtons() {
                container.querySelectorAll('.remove-member').forEach(button => {
                    button.removeEventListener('click', removeHandler);
                    button.addEventListener('click', removeHandler);
                });
            }

            function removeHandler(e) {
                e.target.closest('.member-item').remove();
                updateMemberNumbers();
            }

            function addMember(memberData = {}) {
                const index = container.querySelectorAll('.member-item').length;
                let html = templateHtml
                    .replace(/__INDEX__/g, index)
                    .replace(/__NO__/g, index + 1);

                const div = document.createElement('div');
                div.innerHTML = html;
                container.appendChild(div);

                // Set value if provided
                Object.keys(memberData).forEach((key) => {
                    const input = div.querySelector(`[name="members[${index}][${key}]"]`);
                    if (input) {
                        if (input.tagName === 'SELECT') {
                            [...input.options].forEach(opt => {
                                if (opt.value == memberData[key]) opt.selected = true;
                            });
                        } else {
                            input.value = memberData[key];
                        }
                    }
                });

                updateMemberNumbers();
                attachRemoveButtons();
            }

            // Initialize remove buttons if not using old
            attachRemoveButtons();

            // Tambah ahli baru apabila klik
            if (addBtn) {
                addBtn.addEventListener('click', () => addMember());
            }

            // Kalau guna old(members), tambah semula ahli
            @if (old('members'))
                const oldMembers = @json(old('members'));
                container.innerHTML = '';
                oldMembers.forEach(m => addMember(m));
            @endif
        });
    </script>

@endsection
