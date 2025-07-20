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
                        Tidak lebih daripada <b>25 orang termasuk Pegawai Pengiring, Koreografer, Penari & Kru.</b><br>
                        Bilangan penari di atas pentas adalah <b>minimum 10 orang dan maksimum 14 orang.</b>
                    </div>

                    <div id="members-container">
                        @foreach ($registration->members as $index => $member)
                            <div class="card mb-3 member-item">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                    <span class="fw-semibold">Ahli <span
                                            class="member-number">{{ $index + 1 }}</span></span>
                                    <button type="button"
                                        class="btn btn-danger btn-sm remove-member {{ $index == 0 ? 'd-none' : '' }}">
                                        <i class="bx bx-trash"></i> Padam
                                    </button>
                                </div>
                                <div class="card-body row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Nama Penuh</label>
                                        <input type="text" name="members[{{ $index }}][name]"
                                            class="form-control {{ $errors->has("members.$index.name") ? 'is-invalid' : '' }}"
                                            value="{{ old("members.$index.name", $member->name) }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">No. Kad Pengenalan / Passport / No. KTP</label>
                                        <input type="text" name="members[{{ $index }}][ic_no]"
                                            class="form-control {{ $errors->has("members.$index.ic_no") ? 'is-invalid' : '' }}"
                                            value="{{ old("members.$index.ic_no", $member->ic_no) }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">No. Matrik / Kad Pelajar</label>
                                        <input type="text" name="members[{{ $index }}][student_id]"
                                            class="form-control {{ $errors->has("members.$index.student_id") ? 'is-invalid' : '' }}"
                                            value="{{ old("members.$index.student_id", $member->student_id) }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Peranan</label>
                                        <select name="members[{{ $index }}][peranan]"
                                            class="form-select {{ $errors->has("members.$index.peranan") ? 'is-invalid' : '' }}">
                                            <option value="">Sila Pilih Peranan</option>
                                            @foreach (['Penari', 'Kru', 'Pegawai Pengiring', 'Koreografer', 'Pembantu Koreografer'] as $role)
                                                <option value="{{ $role }}"
                                                    {{ old("members.$index.peranan", $member->peranan) == $role ? 'selected' : '' }}>
                                                    {{ $role }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Jantina</label>
                                        <select name="members[{{ $index }}][jantina]"
                                            class="form-select {{ $errors->has("members.$index.jantina") ? 'is-invalid' : '' }}">
                                            <option value="">Pilih Jantina</option>
                                            <option value="Lelaki"
                                                {{ old("members.$index.jantina", $member->jantina) == 'Lelaki' ? 'selected' : '' }}>
                                                Lelaki
                                            </option>
                                            <option value="Perempuan"
                                                {{ old("members.$index.jantina", $member->jantina) == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Saiz Baju</label>
                                        <select name="members[{{ $index }}][saiz_baju]"
                                            class="form-select {{ $errors->has("members.$index.saiz_baju") ? 'is-invalid' : '' }}">
                                            <option value="">Pilih Saiz Baju</option>
                                            @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                                <option value="{{ $size }}"
                                                    {{ old("members.$index.saiz_baju", $member->saiz_baju) == $size ? 'selected' : '' }}>
                                                    {{ $size }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-end mt-2">
                        <button type="button" class="btn btn-info btn-sm" id="add-member-btn">
                            <i class="bx bx-plus"></i> Tambah Ahli
                        </button>
                    </div>

                    <template id="member-template">
                        <div class="card mb-3 member-item">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                <span class="fw-semibold">Ahli <span class="member-number">__NO__</span></span>
                                <button type="button" class="btn btn-danger btn-sm remove-member">
                                    <i class="bx bx-trash"></i> Padam
                                </button>
                            </div>
                            <div class="card-body row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Nama Penuh</label>
                                    <input type="text" name="members[__INDEX__][name]" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">No. Kad Pengenalan / Passport / No. KTP</label>
                                    <input type="text" name="members[__INDEX__][ic_no]" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">No. Matrik / Kad Pelajar</label>
                                    <input type="text" name="members[__INDEX__][student_id]" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Peranan</label>
                                    <select name="members[__INDEX__][peranan]" class="form-select">
                                        <option value="">Sila Pilih Peranan</option>
                                        <option value="Penari">Penari</option>
                                        <option value="Kru">Kru</option>
                                        <option value="Pegawai Pengiring">Pegawai Pengiring</option>
                                        <option value="Koreografer">Koreografer</option>
                                        <option value="Pembantu Koreografer">Pembantu Koreografer</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Jantina</label>
                                    <select name="members[__INDEX__][jantina]" class="form-select">
                                        <option value="">Pilih Jantina</option>
                                        <option value="Lelaki">Lelaki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Saiz Baju</label>
                                    <select name="members[__INDEX__][saiz_baju]" class="form-select">
                                        <option value="">Pilih Saiz</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
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
            const container = document.getElementById('members-container');
            const templateHtml = document.getElementById('member-template').innerHTML;
            const addBtn = document.getElementById('add-member-btn');

            // Mula dari jumlah member sedia ada
            let count = container.querySelectorAll('.member-item').length;

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

                // Re-index name attributes (optional, if strict indexing required)
                const items = container.querySelectorAll('.member-item');
                items.forEach((item, idx) => {
                    item.querySelectorAll('input, select').forEach((input) => {
                        if (input.name) {
                            input.name = input.name.replace(/\d+/, idx);
                        }
                    });
                });
            }
        });
    </script>
@endsection
