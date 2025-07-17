@extends('layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pengurusan Pengguna</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user') }}">Senarai Pengguna</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $str_mode }} Pengguna</li>
                </ol>
            </nav>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">{{ $str_mode }} Pengguna</h6>
    <hr />

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ $save_route }}">
                {{ csrf_field() }}

                <div class="mb-3">
                    <label for="institution_name" class="form-label">Institution Name</label>
                    <input type="text" class="form-control {{ $errors->has('institution_name') ? 'is-invalid' : '' }}"
                        name="institution_name" id="institution_name"
                        value="{{ old('institution_name') ?? ($user->institution_name ?? '') }}">
                    @if ($errors->has('institution_name'))
                        <div class="invalid-feedback">
                            @foreach ($errors->get('institution_name') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="jenis_ipta" class="form-label">Type of Higher Education Institution</label>
                    <select class="form-select {{ $errors->has('jenis_ipta') ? 'is-invalid' : '' }}" name="jenis_ipta"
                        id="jenis_ipta">
                        <option disabled {{ old('jenis_ipta', $user->jenis_ipta ?? '') == '' ? 'selected' : '' }}>Select
                            Type</option>
                        @foreach (['University', 'University College', 'College', 'Teacher Training Institute', 'Polytechnic', 'Community College'] as $type)
                            <option value="{{ $type }}"
                                {{ old('jenis_ipta', $user->jenis_ipta ?? '') == $type ? 'selected' : '' }}>
                                {{ $type }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('jenis_ipta'))
                        <div class="invalid-feedback">
                            @foreach ($errors->get('jenis_ipta') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        id="name" name="name" value="{{ old('name') ?? ($user->name ?? '') }}">
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            @foreach ($errors->get('name') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="ic_no" class="form-label">IC. No / Passport / KTP</label>
                    <input type="text" class="form-control {{ $errors->has('ic_no') ? 'is-invalid' : '' }}"
                        id="ic_no" name="ic_no" value="{{ old('ic_no') ?? ($user->ic_no ?? '') }}">
                    @if ($errors->has('ic_no'))
                        <div class="invalid-feedback">
                            @foreach ($errors->get('ic_no') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        id="email" name="email" value="{{ old('email') ?? ($user->email ?? '') }}">
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            @foreach ($errors->get('email') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="phone_no" class="form-label">Phone Number</label>
                    <input type="number" class="form-control {{ $errors->has('phone_no') ? 'is-invalid' : '' }}"
                        id="phone_no" name="phone_no" value="{{ old('phone_no') ?? ($user->phone_no ?? '') }}">
                    @if ($errors->has('phone_no'))
                        <div class="invalid-feedback">
                            @foreach ($errors->get('phone_no') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}"
                        id="position" name="position" value="{{ old('position') ?? ($user->position ?? '') }}">
                    @if ($errors->has('position'))
                        <div class="invalid-feedback">
                            @foreach ($errors->get('position') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">User Role</label>
                    <div>
                        @foreach ($roles as $role)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="roles[]" id="{{ $role->name }}"
                                    value="{{ $role->name }}"
                                    {{ in_array($role->name, $user->roles->pluck('name')->toArray()) ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $role->name }}">
                                    {{ ucwords(str_replace('-', ' ', $role->name)) }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @if ($errors->has('roles'))
                        <div class="invalid-feedback d-block">
                            @foreach ($errors->get('roles') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="publish_status" class="form-label">Status</label>
                    <div class="form-check">
                        <input type="radio" id="aktif" name="publish_status" value="1"
                            {{ ($user->publish_status ?? '') == 'Aktif' ? 'checked' : '' }}>
                        <label class="form-check-label" for="aktif">Aktif</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="tidak_aktif" name="publish_status" value="0"
                            {{ ($user->publish_status ?? '') == 'Tidak Aktif' ? 'checked' : '' }}>
                        <label class="form-check-label" for="tidak_aktif">Tidak Aktif</label>
                    </div>
                    @if ($errors->has('publish_status'))
                        <div class="invalid-feedback">
                            @foreach ($errors->get('publish_status') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">{{ $str_mode }}</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('phone_no').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/-/g, '');
        });
    </script>
@endsection
