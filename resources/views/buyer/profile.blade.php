@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@endpush
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pembeli /</span> Profil Saya</h4>

    <!-- Header -->
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="user-profile-header-banner">
            <img src="{{ asset('assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top" />
          </div>
          <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
              @if(Auth::user()->profile_picture)
                <img
                  src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                  alt="Profile picture"
                  class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
              @else
                <img
                  src="{{ asset('assets/img/avatars/1.png') }}"
                  alt="Profile picture"
                class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
              @endif
            </div>
            <div class="flex-grow-1 mt-3 mt-sm-5">
              <div
                class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                <div class="user-profile-info">
                  <h4>{{ Auth::user()->name }}</h4>
                  <ul
                    class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                    <li class="list-inline-item"><i class="ti ti-shopping-cart"></i> Pembeli</li>
                    <li class="list-inline-item"><i class="ti ti-map-pin"></i> {{ Auth::user()->city ?: 'Kota belum diisi' }}</li>
                    <li class="list-inline-item"><i class="ti ti-calendar"></i> Bergabung {{ Auth::user()->created_at->format('F Y') }}</li>
                  </ul>
                </div>
                <div class="d-flex gap-2">
                  @if(Auth::user()->is_verified)
                    <span class="btn btn-success">
                      <i class="ti ti-check me-1"></i>Terverifikasi
                    </span>
                  @else
                    <span class="btn btn-warning">
                      <i class="ti ti-clock me-1"></i>Menunggu Verifikasi
                    </span>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Header -->

    <!-- Navbar pills -->
    <div class="row">
      <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-sm-row mb-4">
          <li class="nav-item">
            <a class="nav-link active" href="javascript:void(0);"
              ><i class="ti-xs ti ti-user me-1"></i> Profil Saya</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('order.index') }}"
              ><i class="ti-xs ti ti-shopping-bag me-1"></i> Pesanan Saya</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('cart.show') }}"
              ><i class="ti-xs ti ti-shopping-cart me-1"></i> Keranjang</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0);"
              ><i class="ti-xs ti ti-heart me-1"></i> Wishlist</a
            >
          </li>
        </ul>
      </div>
    </div>
    <!--/ Navbar pills -->

    <!-- Profile Content -->
    <div class="row">
      <div class="col-xl-4 col-lg-5 col-md-5">
        <!-- Personal Information -->
        <div class="card mb-4">
          <div class="card-body">
            <small class="card-text text-uppercase">Informasi Pribadi</small>
            <ul class="list-unstyled mb-4 mt-3">
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-user"></i><span class="fw-bold mx-2">Nama:</span> 
                <span>{{ Auth::user()->name }}</span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-mail"></i><span class="fw-bold mx-2">Email:</span> 
                <span>{{ Auth::user()->email }}</span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-phone"></i><span class="fw-bold mx-2">Telepon:</span> 
                <span>{{ Auth::user()->phone ?: 'Belum diisi' }}</span>
              </li>
            </ul>
            <small class="card-text text-uppercase">Alamat</small>
            <ul class="list-unstyled mb-4 mt-3">
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-map-pin"></i><span class="fw-bold mx-2">Alamat:</span>
                <span>{{ Auth::user()->address ?: 'Belum diisi' }}</span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-building"></i><span class="fw-bold mx-2">Kota:</span>
                <span>{{ Auth::user()->city ?: 'Belum diisi' }}</span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-map"></i><span class="fw-bold mx-2">Provinsi:</span>
                <span>{{ Auth::user()->province ?: 'Belum diisi' }}</span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-mailbox"></i><span class="fw-bold mx-2">Kode Pos:</span>
                <span>{{ Auth::user()->postal_code ?: 'Belum diisi' }}</span>
              </li>
            </ul>
            <small class="card-text text-uppercase">Status</small>
            <ul class="list-unstyled mb-0 mt-3">
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-check"></i><span class="fw-bold mx-2">Verifikasi:</span> 
                <span class="badge {{ Auth::user()->is_verified ? 'bg-success' : 'bg-warning' }}">
                  {{ Auth::user()->is_verified ? 'Terverifikasi' : 'Menunggu' }}
                </span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-calendar"></i><span class="fw-bold mx-2">Member Sejak:</span>
                <span>{{ Auth::user()->created_at->format('M Y') }}</span>
              </li>
            </ul>
          </div>
        </div>
        <!--/ Personal Information -->
        
        <!-- Shopping Statistics -->
        <div class="card mb-4">
          <div class="card-body">
            <p class="card-text text-uppercase">Statistik Belanja</p>
            <ul class="list-unstyled mb-0">
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-shopping-bag"></i><span class="fw-bold mx-2">Total Pesanan:</span> 
                <span>0</span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-shopping-cart"></i><span class="fw-bold mx-2">Item di Keranjang:</span>
                <span>0</span>
              </li>
              <li class="d-flex align-items-center">
                <i class="ti ti-heart"></i><span class="fw-bold mx-2">Wishlist:</span> 
                <span>0</span>
              </li>
            </ul>
          </div>
        </div>
        <!--/ Shopping Statistics -->
      </div>
      <div class="col-xl-8 col-lg-7 col-md-7">
        <!-- Profile Form -->
        <div class="card card-action mb-4">
          <div class="card-header align-items-center">
            <h5 class="card-action-title mb-0">Edit Profil Saya</h5>
            <div class="card-action-element">
              <button type="button" class="btn btn-primary" onclick="document.getElementById('profileForm').submit()">
                <i class="ti ti-device-floppy me-1"></i>Simpan Perubahan
                </button>
            </div>
          </div>
          <div class="card-body">
            @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="ti ti-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            <form id="profileForm" action="{{ route('buyer.profile.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              
              <div class="row">
                <!-- Profile Picture Upload -->
                <div class="col-md-6 mb-3">
                  <label for="profile_picture" class="form-label">Foto Profil</label>
                  <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <div class="button-wrapper">
                      @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile picture" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                      @else
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Profile picture" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                      @endif
                      <div class="button-wrapper">
                        <label for="profile_picture" class="btn btn-primary me-2 mb-4" tabindex="0">
                          <span class="d-none d-sm-block">Upload foto baru</span>
                          <i class="ti ti-upload d-block d-sm-none"></i>
                          <input type="file" id="profile_picture" name="profile_picture" class="account-file-input" hidden accept="image/png, image/jpeg, image/jpg, image/gif" />
                        </label>
                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                          <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                          <span class="d-none d-sm-block">Reset</span>
                        </button>
                  </div>
                      <p class="text-muted mb-0">Format JPG, PNG, atau GIF. Maksimal 2MB</p>
                    </div>
                  </div>
                  @error('profile_picture')
                    <div class="text-danger mt-1">{{ $message }}</div>
                  @enderror
                </div>
                
                <!-- Email -->
                <div class="col-md-6 mb-3">
                  <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" placeholder="Masukkan email Anda" required />
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                  </div>

              <div class="row">
                <!-- First Name -->
                <div class="col-md-6 mb-3">
                  <label for="first_name" class="form-label">Nama Depan <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', Auth::user()->first_name) }}" placeholder="Masukkan nama depan" required />
                  @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <!-- Last Name -->
                <div class="col-md-6 mb-3">
                  <label for="last_name" class="form-label">Nama Belakang <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', Auth::user()->last_name) }}" placeholder="Masukkan nama belakang" required />
                  @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
          </div>

              <div class="row">
                <!-- Phone -->
                <div class="col-md-6 mb-3">
                  <label for="phone" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-text">ID (+62)</span>
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="812 3456 7890" required />
                  </div>
                  @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
            </div>
                
                <!-- Postal Code -->
                <div class="col-md-6 mb-3">
                  <label for="postal_code" class="form-label">Kode Pos <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" value="{{ old('postal_code', Auth::user()->postal_code) }}" placeholder="12345" maxlength="5" required />
                  @error('postal_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

        <div class="row">
                <!-- Address -->
                <div class="col-md-12 mb-3">
                  <label for="address" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                  <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" placeholder="Masukkan alamat lengkap Anda" required>{{ old('address', Auth::user()->address) }}</textarea>
                  @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  </div>
              </div>

              <div class="row">
                <!-- Area/Landmark -->
                <div class="col-md-6 mb-3">
                  <label for="area_landmark" class="form-label">Patokan Lokasi</label>
                  <input type="text" class="form-control @error('area_landmark') is-invalid @enderror" id="area_landmark" name="area_landmark" value="{{ old('area_landmark', Auth::user()->area_landmark) }}" placeholder="Dekat Masjid, Sekolah, dll" />
                  @error('area_landmark')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <!-- City -->
                <div class="col-md-6 mb-3">
                  <label for="city" class="form-label">Kota <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', Auth::user()->city) }}" placeholder="Masukkan kota" required />
                  @error('city')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                        </div>
              </div>

              <div class="row">
                <!-- Province -->
                <div class="col-md-12 mb-3">
                  <label for="province" class="form-label">Provinsi <span class="text-danger">*</span></label>
                  <select id="province" name="province" class="select2 form-select @error('province') is-invalid @enderror" data-allow-clear="true" required>
                    <option value="">Pilih Provinsi</option>
                    <option value="DKI" {{ old('province', Auth::user()->province) == 'DKI' ? 'selected' : '' }}>DKI Jakarta</option>
                    <option value="JABAR" {{ old('province', Auth::user()->province) == 'JABAR' ? 'selected' : '' }}>Jawa Barat</option>
                    <option value="JATENG" {{ old('province', Auth::user()->province) == 'JATENG' ? 'selected' : '' }}>Jawa Tengah</option>
                    <option value="JATIM" {{ old('province', Auth::user()->province) == 'JATIM' ? 'selected' : '' }}>Jawa Timur</option>
                    <option value="BANTEN" {{ old('province', Auth::user()->province) == 'BANTEN' ? 'selected' : '' }}>Banten</option>
                    <option value="YOGYA" {{ old('province', Auth::user()->province) == 'YOGYA' ? 'selected' : '' }}>DI Yogyakarta</option>
                    <option value="BALI" {{ old('province', Auth::user()->province) == 'BALI' ? 'selected' : '' }}>Bali</option>
                    <option value="SUMBAR" {{ old('province', Auth::user()->province) == 'SUMBAR' ? 'selected' : '' }}>Sumatera Barat</option>
                    <option value="SUMSEL" {{ old('province', Auth::user()->province) == 'SUMSEL' ? 'selected' : '' }}>Sumatera Selatan</option>
                    <option value="SUMEDANG" {{ old('province', Auth::user()->province) == 'SUMEDANG' ? 'selected' : '' }}>Sumatera Utara</option>
                    <option value="RIAU" {{ old('province', Auth::user()->province) == 'RIAU' ? 'selected' : '' }}>Riau</option>
                    <option value="KEPRI" {{ old('province', Auth::user()->province) == 'KEPRI' ? 'selected' : '' }}>Kepulauan Riau</option>
                    <option value="LAMPUNG" {{ old('province', Auth::user()->province) == 'LAMPUNG' ? 'selected' : '' }}>Lampung</option>
                    <option value="BENGKULU" {{ old('province', Auth::user()->province) == 'BENGKULU' ? 'selected' : '' }}>Bengkulu</option>
                    <option value="JAMBI" {{ old('province', Auth::user()->province) == 'JAMBI' ? 'selected' : '' }}>Jambi</option>
                    <option value="ACEH" {{ old('province', Auth::user()->province) == 'ACEH' ? 'selected' : '' }}>Aceh</option>
                    <option value="KALBAR" {{ old('province', Auth::user()->province) == 'KALBAR' ? 'selected' : '' }}>Kalimantan Barat</option>
                    <option value="KALTENG" {{ old('province', Auth::user()->province) == 'KALTENG' ? 'selected' : '' }}>Kalimantan Tengah</option>
                    <option value="KALSEL" {{ old('province', Auth::user()->province) == 'KALSEL' ? 'selected' : '' }}>Kalimantan Selatan</option>
                    <option value="KALTIM" {{ old('province', Auth::user()->province) == 'KALTIM' ? 'selected' : '' }}>Kalimantan Timur</option>
                    <option value="KALUT" {{ old('province', Auth::user()->province) == 'KALUT' ? 'selected' : '' }}>Kalimantan Utara</option>
                    <option value="SULSEL" {{ old('province', Auth::user()->province) == 'SULSEL' ? 'selected' : '' }}>Sulawesi Selatan</option>
                    <option value="SULTENG" {{ old('province', Auth::user()->province) == 'SULTENG' ? 'selected' : '' }}>Sulawesi Tengah</option>
                    <option value="SULUT" {{ old('province', Auth::user()->province) == 'SULUT' ? 'selected' : '' }}>Sulawesi Utara</option>
                    <option value="GORONTALO" {{ old('province', Auth::user()->province) == 'GORONTALO' ? 'selected' : '' }}>Gorontalo</option>
                    <option value="SULTRA" {{ old('province', Auth::user()->province) == 'SULTRA' ? 'selected' : '' }}>Sulawesi Tenggara</option>
                    <option value="MALUKU" {{ old('province', Auth::user()->province) == 'MALUKU' ? 'selected' : '' }}>Maluku</option>
                    <option value="MALUT" {{ old('province', Auth::user()->province) == 'MALUT' ? 'selected' : '' }}>Maluku Utara</option>
                    <option value="PAPUA" {{ old('province', Auth::user()->province) == 'PAPUA' ? 'selected' : '' }}>Papua</option>
                    <option value="PAPBAR" {{ old('province', Auth::user()->province) == 'PAPBAR' ? 'selected' : '' }}>Papua Barat</option>
                    <option value="NTB" {{ old('province', Auth::user()->province) == 'NTB' ? 'selected' : '' }}>Nusa Tenggara Barat</option>
                    <option value="NTT" {{ old('province', Auth::user()->province) == 'NTT' ? 'selected' : '' }}>Nusa Tenggara Timur</option>
                  </select>
                  @error('province')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <!-- Password Change Section -->
              <div class="card mb-4">
                <div class="card-header">
                  <h6 class="card-title mb-0">Ubah Kata Sandi</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="current_password" class="form-label">Kata Sandi Saat Ini</label>
                      <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" placeholder="Masukkan kata sandi saat ini" />
                      @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="new_password" class="form-label">Kata Sandi Baru</label>
                      <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" placeholder="Masukkan kata sandi baru" />
                      @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="new_password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                      <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Konfirmasi kata sandi baru" />
                    </div>
                  </div>
                </div>
              </div>

              <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2">
                  <i class="ti ti-device-floppy me-1"></i>Simpan Perubahan
                </button>
                <button type="button" class="btn btn-outline-secondary">
                  <i class="ti ti-x me-1"></i>Batal
                </button>
              </div>
            </form>
          </div>
        </div>
        <!--/ Profile Form -->
      </div>
    </div>
    <!--/ Profile Content -->
  </div>
</div>

<script>
// Image upload preview
document.addEventListener('DOMContentLoaded', function() {
  const fileInput = document.getElementById('profile_picture');
  const uploadedAvatar = document.getElementById('uploadedAvatar');
  
  if (fileInput) {
    fileInput.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
        // Check file size (2MB = 2 * 1024 * 1024 bytes)
        if (file.size > 2 * 1024 * 1024) {
          alert('Ukuran file maksimal 2MB');
          fileInput.value = '';
          return;
        }
        
        // Check file type
        if (!file.type.match('image.*')) {
          alert('Silakan pilih file gambar');
          fileInput.value = '';
          return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
          uploadedAvatar.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    });
  }
  
  // Reset button functionality
  const resetBtn = document.querySelector('.account-image-reset');
  if (resetBtn) {
    resetBtn.addEventListener('click', function() {
      fileInput.value = '';
      @if(Auth::user()->profile_picture)
        uploadedAvatar.src = '{{ asset("storage/" . Auth::user()->profile_picture) }}';
      @else
        uploadedAvatar.src = '{{ asset("assets/img/avatars/1.png") }}';
      @endif
    });
  }

  // Phone number formatting
  const phoneInput = document.getElementById('phone');
  if (phoneInput) {
    phoneInput.addEventListener('input', function(e) {
      let value = e.target.value.replace(/\D/g, '');
      if (value.startsWith('0')) {
        value = '62' + value.substring(1);
      } else if (!value.startsWith('62')) {
        value = '62' + value;
      }
      e.target.value = value;
    });
  }
  
  // Postal code validation
  const postalInput = document.getElementById('postal_code');
  if (postalInput) {
    postalInput.addEventListener('input', function(e) {
      e.target.value = e.target.value.replace(/\D/g, '').substring(0, 5);
    });
  }
});
</script>
@endsection
