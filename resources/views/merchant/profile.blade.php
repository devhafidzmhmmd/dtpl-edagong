@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@endpush
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Merchant /</span> Store Profile</h4>

    <!-- Header -->
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="user-profile-header-banner">
            <img src="{{ asset('assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top" />
          </div>
          <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
              @if(Auth::user()->store_logo)
                <img
                  src="{{ asset('storage/' . Auth::user()->store_logo) }}"
                  alt="Store logo"
                  class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
              @else
                <img
                  src="{{ asset('assets/img/avatars/14.png') }}"
                  alt="Store logo"
                class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
              @endif
            </div>
            <div class="flex-grow-1 mt-3 mt-sm-5">
              <div
                class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                <div class="user-profile-info">
                  <h4>{{ Auth::user()->store_name ?: 'Store Name' }}</h4>
                  <ul
                    class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                    <li class="list-inline-item"><i class="ti ti-store"></i> {{ Auth::user()->umkm_category ?: 'UMKM Category' }}</li>
                    <li class="list-inline-item"><i class="ti ti-map-pin"></i> {{ Auth::user()->city ?: 'City' }}</li>
                    <li class="list-inline-item"><i class="ti ti-calendar"></i> Joined {{ Auth::user()->created_at->format('F Y') }}</li>
                  </ul>
                </div>
                <div class="d-flex gap-2">
                  @if(Auth::user()->is_verified)
                    <span class="btn btn-success">
                      <i class="ti ti-check me-1"></i>Verified
                    </span>
                  @else
                    <span class="btn btn-warning">
                      <i class="ti ti-clock me-1"></i>Pending Verification
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
              ><i class="ti-xs ti ti-store me-1"></i> Store Profile</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0);"
              ><i class="ti-xs ti ti-package me-1"></i> Products</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0);"
              ><i class="ti-xs ti ti-chart-bar me-1"></i> Analytics</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0);"
              ><i class="ti-xs ti ti-settings me-1"></i> Settings</a
            >
          </li>
        </ul>
      </div>
    </div>
    <!--/ Navbar pills -->

    <!-- Store Profile Content -->
    <div class="row">
      <div class="col-xl-4 col-lg-5 col-md-5">
        <!-- Store Information -->
        <div class="card mb-4">
          <div class="card-body">
            <small class="card-text text-uppercase">Store Information</small>
            <ul class="list-unstyled mb-4 mt-3">
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-store"></i><span class="fw-bold mx-2">Store Name:</span> 
                <span>{{ Auth::user()->store_name ?: 'Not set' }}</span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-user"></i><span class="fw-bold mx-2">Owner:</span> 
                <span>{{ Auth::user()->store_owner_name ?: Auth::user()->name }}</span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-tag"></i><span class="fw-bold mx-2">Category:</span> 
                <span>{{ Auth::user()->umkm_category ?: 'Not set' }}</span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-map-pin"></i><span class="fw-bold mx-2">Location:</span> 
                <span>{{ Auth::user()->city ?: 'Not set' }}</span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-phone"></i><span class="fw-bold mx-2">Phone:</span> 
                <span>{{ Auth::user()->phone ?: 'Not set' }}</span>
              </li>
            </ul>
            <small class="card-text text-uppercase">Contact Information</small>
            <ul class="list-unstyled mb-4 mt-3">
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-mail"></i><span class="fw-bold mx-2">Email:</span>
                <span>{{ Auth::user()->email }}</span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-map-pin"></i><span class="fw-bold mx-2">Address:</span>
                <span>{{ Auth::user()->address ?: 'Not set' }}</span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-building"></i><span class="fw-bold mx-2">Province:</span>
                <span>{{ Auth::user()->province ?: 'Not set' }}</span>
              </li>
            </ul>
            <small class="card-text text-uppercase">Status</small>
            <ul class="list-unstyled mb-0 mt-3">
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-check"></i><span class="fw-bold mx-2">Verification:</span> 
                <span class="badge {{ Auth::user()->is_verified ? 'bg-success' : 'bg-warning' }}">
                  {{ Auth::user()->is_verified ? 'Verified' : 'Pending' }}
                </span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-calendar"></i><span class="fw-bold mx-2">Member Since:</span>
                <span>{{ Auth::user()->created_at->format('M Y') }}</span>
              </li>
            </ul>
          </div>
        </div>
        <!--/ Store Information -->
        
        <!-- Store Statistics -->
        <div class="card mb-4">
          <div class="card-body">
            <p class="card-text text-uppercase">Store Statistics</p>
            <ul class="list-unstyled mb-0">
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-package"></i><span class="fw-bold mx-2">Products:</span> 
                <span>0</span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-shopping-cart"></i><span class="fw-bold mx-2">Orders:</span>
                <span>0</span>
              </li>
              <li class="d-flex align-items-center">
                <i class="ti ti-eye"></i><span class="fw-bold mx-2">Views:</span> 
                <span>0</span>
              </li>
            </ul>
          </div>
        </div>
        <!--/ Store Statistics -->
      </div>
      <div class="col-xl-8 col-lg-7 col-md-7">
        <!-- Store Profile Form -->
        <div class="card card-action mb-4">
          <div class="card-header align-items-center">
            <h5 class="card-action-title mb-0">Complete Your Store Profile</h5>
            <div class="card-action-element">
              <button type="button" class="btn btn-primary" onclick="document.getElementById('storeForm').submit()">
                <i class="ti ti-device-floppy me-1"></i>Save Changes
                </button>
            </div>
          </div>
          <div class="card-body">
            <form id="storeForm" action="{{ route('merchant.profile.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              
              <div class="row">
                <!-- Store Logo Upload -->
                <div class="col-md-6 mb-3">
                  <label for="store_logo" class="form-label">Store Logo</label>
                  <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <div class="button-wrapper">
                      @if(Auth::user()->store_logo)
                        <img src="{{ asset('storage/' . Auth::user()->store_logo) }}" alt="Store logo" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                      @else
                        <img src="{{ asset('assets/img/avatars/14.png') }}" alt="Store logo" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                      @endif
                      <div class="button-wrapper">
                        <label for="store_logo" class="btn btn-primary me-2 mb-4" tabindex="0">
                          <span class="d-none d-sm-block">Upload new logo</span>
                          <i class="ti ti-upload d-block d-sm-none"></i>
                          <input type="file" id="store_logo" name="store_logo" class="account-file-input" hidden accept="image/png, image/jpeg" />
                        </label>
                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                          <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                          <span class="d-none d-sm-block">Reset</span>
                        </button>
                  </div>
                      <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 2MB</p>
                    </div>
                  </div>
                  @error('store_logo')
                    <div class="text-danger mt-1">{{ $message }}</div>
                  @enderror
                </div>
                
                <!-- Store Name -->
                <div class="col-md-6 mb-3">
                  <label for="store_name" class="form-label">Store Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('store_name') is-invalid @enderror" id="store_name" name="store_name" value="{{ old('store_name', Auth::user()->store_name) }}" placeholder="Enter your store name" required />
                  @error('store_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                  </div>

              <div class="row">
                <!-- Store Owner Name -->
                <div class="col-md-6 mb-3">
                  <label for="store_owner_name" class="form-label">Store Owner Name</label>
                  <input type="text" class="form-control @error('store_owner_name') is-invalid @enderror" id="store_owner_name" name="store_owner_name" value="{{ old('store_owner_name', Auth::user()->store_owner_name) }}" placeholder="Enter store owner name" />
                  @error('store_owner_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <!-- UMKM Category -->
                <div class="col-md-6 mb-3">
                  <label for="umkm_category" class="form-label">UMKM Category</label>
                  <select class="form-select @error('umkm_category') is-invalid @enderror" id="umkm_category" name="umkm_category">
                    <option value="">Select category</option>
                    <option value="food_beverage" {{ old('umkm_category', Auth::user()->umkm_category) == 'food_beverage' ? 'selected' : '' }}>Food & Beverage</option>
                    <option value="fashion" {{ old('umkm_category', Auth::user()->umkm_category) == 'fashion' ? 'selected' : '' }}>Fashion</option>
                    <option value="handicraft" {{ old('umkm_category', Auth::user()->umkm_category) == 'handicraft' ? 'selected' : '' }}>Handicraft</option>
                    <option value="technology" {{ old('umkm_category', Auth::user()->umkm_category) == 'technology' ? 'selected' : '' }}>Technology</option>
                    <option value="beauty_health" {{ old('umkm_category', Auth::user()->umkm_category) == 'beauty_health' ? 'selected' : '' }}>Beauty & Health</option>
                    <option value="home_garden" {{ old('umkm_category', Auth::user()->umkm_category) == 'home_garden' ? 'selected' : '' }}>Home & Garden</option>
                    <option value="other" {{ old('umkm_category', Auth::user()->umkm_category) == 'other' ? 'selected' : '' }}>Other</option>
                  </select>
                  @error('umkm_category')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
          </div>

              <!-- Store Description -->
              <div class="mb-3">
                <label for="store_description" class="form-label">Store Description</label>
                <textarea class="form-control @error('store_description') is-invalid @enderror" id="store_description" name="store_description" rows="4" placeholder="Describe your store, products, and what makes you unique...">{{ old('store_description', Auth::user()->store_description) }}</textarea>
                @error('store_description')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
        </div>

        <div class="row">
                <!-- Address -->
                <div class="col-md-6 mb-3">
                  <label for="address" class="form-label">Address</label>
                  <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" placeholder="Enter your store address">{{ old('address', Auth::user()->address) }}</textarea>
                  @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  </div>
                
                <!-- Area/Landmark -->
                <div class="col-md-6 mb-3">
                  <label for="area_landmark" class="form-label">Area/Landmark</label>
                  <input type="text" class="form-control @error('area_landmark') is-invalid @enderror" id="area_landmark" name="area_landmark" value="{{ old('area_landmark', Auth::user()->area_landmark) }}" placeholder="e.g., Near Mall, Main Street" />
                  @error('area_landmark')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="row">
                <!-- City -->
                <div class="col-md-4 mb-3">
                  <label for="city" class="form-label">City</label>
                  <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', Auth::user()->city) }}" placeholder="Enter city" />
                  @error('city')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                        </div>
                
                <!-- Province -->
                <div class="col-md-4 mb-3">
                  <label for="province" class="form-label">Province</label>
                  <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" value="{{ old('province', Auth::user()->province) }}" placeholder="Enter province" />
                  @error('province')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                    </div>
                
                <!-- Postal Code -->
                <div class="col-md-4 mb-3">
                  <label for="postal_code" class="form-label">Postal Code</label>
                  <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" value="{{ old('postal_code', Auth::user()->postal_code) }}" placeholder="Enter postal code" />
                  @error('postal_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                    </div>
              </div>

              <div class="row">
                <!-- Phone -->
                <div class="col-md-6 mb-3">
                  <label for="phone" class="form-label">Phone Number</label>
                  <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="Enter phone number" />
                  @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
            </div>
                
                <!-- Product Category -->
                <div class="col-md-6 mb-3">
                  <label for="product_category" class="form-label">Product Category</label>
                  <input type="text" class="form-control @error('product_category') is-invalid @enderror" id="product_category" name="product_category" value="{{ old('product_category', Auth::user()->product_category) }}" placeholder="e.g., Handmade Crafts, Organic Food" />
                  @error('product_category')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2">
                  <i class="ti ti-device-floppy me-1"></i>Save Changes
                </button>
                <button type="button" class="btn btn-outline-secondary">
                  <i class="ti ti-x me-1"></i>Cancel
                </button>
              </div>
            </form>
          </div>
        </div>
        <!--/ Store Profile Form -->
      </div>
    </div>
    <!--/ Store Profile Content -->
  </div>
</div>

<script>
// Image upload preview
document.addEventListener('DOMContentLoaded', function() {
  const fileInput = document.getElementById('store_logo');
  const uploadedAvatar = document.getElementById('uploadedAvatar');
  
  if (fileInput) {
    fileInput.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
        // Check file size (2MB = 2 * 1024 * 1024 bytes)
        if (file.size > 2 * 1024 * 1024) {
          alert('File size must be less than 2MB');
          fileInput.value = '';
          return;
        }
        
        // Check file type
        if (!file.type.match('image.*')) {
          alert('Please select an image file');
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
      @if(Auth::user()->store_logo)
        uploadedAvatar.src = '{{ asset("storage/" . Auth::user()->store_logo) }}';
      @else
        uploadedAvatar.src = '{{ asset("assets/img/avatars/14.png") }}';
      @endif
    });
  }
});
</script>
@endsection