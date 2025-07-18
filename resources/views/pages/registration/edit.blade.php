@extends('layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pengurusan Pendaftaran</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('registration') }}">Senarai Pendaftaran</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $str_mode }} Pendaftaran</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <h6 class="mb-0 text-uppercase">{{ $str_mode }} Pendaftaran</h6>
    <hr />

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ $save_route }}">
                {{ csrf_field() }}

                {{-- Institution Name (readonly) --}}
                <div class="mb-3">
                    <label class="form-label">Nama Institusi</label>
                    <input type="text" class="form-control" value="{{ $registration->user->institution_name ?? '' }}"
                        readonly>
                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                </div>

                <div class="mb-3">
                    <label for="group_name" class="form-label">Nama Kumpulan</label>
                    <input type="text" class="form-control {{ $errors->has('group_name') ? 'is-invalid' : '' }}"
                        id="group_name" name="group_name" value="{{ old('group_name', $registration->group_name ?? '') }}">
                    @if ($errors->has('group_name'))
                        <div class="invalid-feedback">
                            @foreach ($errors->get('group_name') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="traditional_dance_name" class="form-label">Nama Tarian Tradisional</label>
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

                <div class="mb-3">
                    <label for="creative_dance_name" class="form-label">Nama Tarian Kreatif</label>
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

                <div class="mb-3">
                    <label for="koreografer_name" class="form-label">Nama Koreografer</label>
                    <input type="text" class="form-control {{ $errors->has('koreografer_name') ? 'is-invalid' : '' }}"
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

                <div class="mb-3">
                    <label for="assistant_koreografer_name" class="form-label">Nama Penolong Koreografer</label>
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

                <div class="mb-3">
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

                <div class="mb-3">
                    <label for="sinopsis_traditional" class="form-label">Sinopsis Tarian Tradisional</label>
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

                <div class="mb-3">
                    <label for="sinopsis_creative" class="form-label">Sinopsis Tarian Kreatif</label>
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

                <div class="mb-3">
                    <label for="doc_link" class="form-label">Pautan Dokumen</label>
                    <input type="text" class="form-control {{ $errors->has('doc_link') ? 'is-invalid' : '' }}"
                        id="doc_link" name="doc_link" value="{{ old('doc_link', $registration->doc_link ?? '') }}">
                    @if ($errors->has('doc_link'))
                        <div class="invalid-feedback">
                            @foreach ($errors->get('doc_link') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="Pending Approval"
                            {{ $registration->status == 'Pending Approval' ? 'selected' : '' }}>Submitted &
                            Waiting for Approval</option>
                        <option value="approved" {{ $registration->status == 'approved' ? 'selected' : '' }}>Approved
                        </option>
                        <option value="rejected" {{ $registration->status == 'rejected' ? 'selected' : '' }}>Rejected
                        </option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">{{ $str_mode }}</button>
            </form>
        </div>
    </div>
    <!-- End Page Wrapper -->
@endsection
