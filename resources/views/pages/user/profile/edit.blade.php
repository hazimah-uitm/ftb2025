@extends('layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="page-breadcrumb mb-3">
        <div class="row align-items-center">
            <div class="col-12 col-md-9 d-flex align-items-center">
                <div class="breadcrumb-title pe-3">Edit Profil Pengguna</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('profile.show', ['id' => $user->id]) }}">Profil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <h6 class="mb-0 text-uppercase">Edit Profil {{ $user->name }}</h6>
    <hr />

    <div class="container">
        <div class="main-body">
            <div class="row">
                <!-- Sidebar (User Info) -->
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <form method="POST" action="{{ $save_route }}" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <!-- User Image -->
                                    <img src="{{ !empty($user->profile_image) ? asset('public/storage/' . $user->profile_image) : asset('public/assets/images/avatars/user.png') }}"
                                        alt="Profile Image" class="rounded-circle p-1 bg-primary profile-preview"
                                        width="150" height="150">

                                    <!-- Profile Image Upload Form -->
                                    <div class="d-flex gap-2 justify-content-center mt-2">
                                        <input type="file" name="profile_image" id="profile_image"
                                            class="form-control d-none">
                                        <label for="profile_image" class="btn btn-primary">Edit Gambar</label>
                                        <button type="button" id="remove_photo" class="btn btn-danger">Padam
                                            Gambar</button>
                                    </div>
                                    <!-- Hidden Input to Indicate Photo Removal -->
                                    <input type="hidden" name="remove_photo" id="remove_photo_input" value="0">
                                </div>
                                <hr class="my-4">
                                {{ csrf_field() }}
                                {{ method_field('put') }}

                                @php
                                    $userRole = auth()->user();
                                    $isPesertaAtauAdmin = $userRole->hasAnyRole(['Peserta', 'Admin']);
                                    $isSuperadmin = $userRole->hasRole('Superadmin');
                                @endphp

                                <!-- Name Field -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        value="{{ old('name', $user->name) }}" {{ $isSuperadmin ? '' : 'readonly' }}>
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            @foreach ($errors->get('name') as $error)
                                                {{ $error }}
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- Email Field -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Alamat Emel</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                        value="{{ old('email', $user->email) }}" {{ $isSuperadmin ? '' : 'readonly' }}>
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            @foreach ($errors->get('email') as $error)
                                                {{ $error }}
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- Staff ID Field -->
                                <div class="mb-3">
                                    <label for="ic_no" class="form-label">No. Kad Pengenalan / Passport / KTP</label>
                                    <input type="text" name="ic_no" id="ic_no"
                                        class="form-control {{ $errors->has('ic_no') ? 'is-invalid' : '' }}"
                                        value="{{ old('ic_no', $user->ic_no) }}" {{ $isSuperadmin ? '' : 'readonly' }}>
                                    @if ($errors->has('ic_no'))
                                        <div class="invalid-feedback">
                                            @foreach ($errors->get('ic_no') as $error)
                                                {{ $error }}
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- Position Field -->
                                <div class="mb-3">
                                    <label for="position_id" class="form-label">Jawatan</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}"
                                        id="position" name="position"
                                        value="{{ old('position') ?? ($user->position ?? '') }}">
                                    @if ($errors->has('position'))
                                        <div class="invalid-feedback">
                                            @foreach ($errors->get('position') as $error)
                                                {{ $error }}
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- Office Phone Field -->
                                <div class="mb-3">
                                    <label for="phone_no" class="form-label">No. Tel</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('phone_no') ? 'is-invalid' : '' }}"
                                        id="phone_no" name="phone_no"
                                        value="{{ old('phone_no') ?? ($user->phone_no ?? '') }}">
                                    @if ($errors->has('phone_no'))
                                        <div class="invalid-feedback">
                                            @foreach ($errors->get('phone_no') as $error)
                                                {{ $error }}
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Edit Profile Form -->
    <script>
        const fileInput = document.getElementById('profile_image');
        const previewImg = document.querySelector('.profile-preview');
        const removeButton = document.getElementById('remove_photo');
        const removeInput = document.getElementById('remove_photo_input');

        // Preview uploaded image
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // When Remove Photo button is clicked, set the input to 1
        removeButton.addEventListener('click', function() {
            removeInput.value = '1'; // Mark photo for removal
            document.querySelector('.profile-preview').src =
                'https://via.placeholder.com/150'; // Set placeholder image
        });
    </script>


@endsection
