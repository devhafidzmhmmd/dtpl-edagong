<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets') }}/"
  data-template="horizontal-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Daftar Sebagai Penjual UMKM - Edagon</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />

    <!-- Page CSS -->

    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover authentication-bg">
      <div class="authentication-inner row">
        <!-- Left Text -->
        <div
          class="d-none d-lg-flex col-lg-4 align-items-center justify-content-center p-5 auth-cover-bg-color position-relative auth-multisteps-bg-height">
          <img
            src="{{ asset('assets/img/illustrations/auth-register-multisteps-illustration.png') }}"
            alt="auth-register-multisteps"
            class="img-fluid"
            width="280" />

          <img
            src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}"
            alt="auth-register-multisteps"
            class="platform-bg"
            data-app-light-img="illustrations/bg-shape-image-light.png"
            data-app-dark-img="illustrations/bg-shape-image-dark.png" />
        </div>
        <!-- /Left Text -->

        <!--  Multi Steps Registration -->
        <div class="d-flex col-lg-8 align-items-center justify-content-center p-sm-5 p-3">
          <div class="w-px-700">
            <div id="multiStepsValidation" class="bs-stepper shadow-none">
              <div class="bs-stepper-header border-bottom-0">
                <div class="step" data-target="#accountDetailsValidation">
                  <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle"><i class="ti ti-smart-home ti-sm"></i></span>
                    <span class="bs-stepper-label">
                      <span class="bs-stepper-title">Akun</span>
                      <span class="bs-stepper-subtitle">Data Akun Penjual</span>
                    </span>
                  </button>
                </div>
                <div class="line">
                  <i class="ti ti-chevron-right"></i>
                </div>
                <div class="step" data-target="#personalInfoValidation">
                  <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle"><i class="ti ti-users ti-sm"></i></span>
                    <span class="bs-stepper-label">
                      <span class="bs-stepper-title">Pribadi</span>
                      <span class="bs-stepper-subtitle">Data Pribadi Penjual</span>
                    </span>
                  </button>
                </div>
                <div class="line">
                  <i class="ti ti-chevron-right"></i>
                </div>
                <div class="step" data-target="#billingLinksValidation">
                  <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle"><i class="ti ti-file-text ti-sm"></i></span>
                    <span class="bs-stepper-label">
                      <span class="bs-stepper-title">Toko</span>
                      <span class="bs-stepper-subtitle">Informasi Toko</span>
                    </span>
                  </button>
                </div>
              </div>
              <div class="bs-stepper-content">
                <form id="multiStepsForm" action="{{ route('umkm.register') }}" method="POST">
                    @csrf
                  <!-- Account Details -->
                  <div id="accountDetailsValidation" class="content">
                    <div class="content-header mb-4">
                      <h3 class="mb-1">Informasi Akun Penjual</h3>
                      <p>Masukkan data akun untuk mulai berjualan</p>
                    </div>
                    <div class="row g-3">
                      <div class="col-sm-12">
                        <label class="form-label" for="multiStepsEmail">Email</label>
                        <input
                          type="email"
                          name="multiStepsEmail"
                          id="multiStepsEmail"
                          class="form-control"
                          placeholder="email@contoh.com"
                          aria-label="john.doe" />
                      </div>
                      <div class="col-sm-6 form-password-toggle">
                        <label class="form-label" for="multiStepsPass">Kata Sandi</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="password"
                            id="multiStepsPass"
                            name="multiStepsPass"
                            class="form-control"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="multiStepsPass2" />
                          <span class="input-group-text cursor-pointer" id="multiStepsPass2"
                            ><i class="ti ti-eye-off"></i
                          ></span>
                        </div>
                      </div>
                      <div class="col-sm-6 form-password-toggle">
                        <label class="form-label" for="multiStepsConfirmPass">Konfirmasi Kata Sandi</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="password"
                            id="multiStepsConfirmPass"
                            name="multiStepsConfirmPass"
                            class="form-control"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="multiStepsConfirmPass2" />
                          <span class="input-group-text cursor-pointer" id="multiStepsConfirmPass2"
                            ><i class="ti ti-eye-off"></i
                          ></span>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="multiStepsURL">Nama Toko</label>
                        <input
                          type="text"
                          name="multiStepsURL"
                          id="multiStepsURL"
                          class="form-control"
                          placeholder="Nama Toko Anda"
                          aria-label="nama_toko" />
                      </div>
                      <div class="col-12 d-flex justify-content-between mt-4">
                        <button class="btn btn-label-secondary btn-prev" disabled>
                          <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                          <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                        </button>
                        <button class="btn btn-primary btn-next">
                          <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Selanjutnya</span>
                          <i class="ti ti-arrow-right ti-xs"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <!-- Personal Info -->
                  <div id="personalInfoValidation" class="content">
                    <div class="content-header mb-4">
                      <h3 class="mb-1">Informasi Pribadi Penjual</h3>
                      <p>Masukkan data pribadi Anda sebagai penjual UMKM</p>
                    </div>
                    <div class="row g-3">
                      <div class="col-sm-6">
                        <label class="form-label" for="multiStepsFirstName">Nama Depan</label>
                        <input
                          type="text"
                          id="multiStepsFirstName"
                          name="multiStepsFirstName"
                          class="form-control"
                          placeholder="Ahmad" />
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="multiStepsLastName">Nama Belakang</label>
                        <input
                          type="text"
                          id="multiStepsLastName"
                          name="multiStepsLastName"
                          class="form-control"
                          placeholder="Rahman" />
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="multiStepsMobile">Nomor Telepon</label>
                        <div class="input-group">
                          <span class="input-group-text">ID (+62)</span>
                          <input
                            type="text"
                            id="multiStepsMobile"
                            name="multiStepsMobile"
                            class="form-control multi-steps-mobile"
                            placeholder="812 3456 7890" />
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="multiStepsPincode">Kode Pos</label>
                        <input
                          type="text"
                          id="multiStepsPincode"
                          name="multiStepsPincode"
                          class="form-control multi-steps-pincode"
                          placeholder="12345"
                          maxlength="5" />
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="multiStepsAddress">Alamat Lengkap</label>
                        <input
                          type="text"
                          id="multiStepsAddress"
                          name="multiStepsAddress"
                          class="form-control"
                          placeholder="Jl. Contoh No. 123, RT/RW 01/02" />
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="multiStepsArea">Patokan Lokasi</label>
                        <input
                          type="text"
                          id="multiStepsArea"
                          name="multiStepsArea"
                          class="form-control"
                          placeholder="Dekat Masjid, Sekolah, dll" />
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="multiStepsCity">Kota</label>
                        <input type="text" id="multiStepsCity" name="multiStepsCity" class="form-control" placeholder="Jakarta" />
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="multiStepsState">Provinsi</label>
                        <select id="multiStepsState" name="multiStepsState" class="select2 form-select" data-allow-clear="true">
                          <option value="">Pilih Provinsi</option>
                          <option value="DKI">DKI Jakarta</option>
                          <option value="JABAR">Jawa Barat</option>
                          <option value="JATENG">Jawa Tengah</option>
                          <option value="JATIM">Jawa Timur</option>
                          <option value="BANTEN">Banten</option>
                          <option value="YOGYA">DI Yogyakarta</option>
                          <option value="BALI">Bali</option>
                          <option value="SUMBAR">Sumatera Barat</option>
                          <option value="SUMSEL">Sumatera Selatan</option>
                          <option value="SUMEDANG">Sumatera Utara</option>
                          <option value="RIAU">Riau</option>
                          <option value="KEPRI">Kepulauan Riau</option>
                          <option value="LAMPUNG">Lampung</option>
                          <option value="BENGKULU">Bengkulu</option>
                          <option value="JAMBI">Jambi</option>
                          <option value="ACEH">Aceh</option>
                          <option value="KALBAR">Kalimantan Barat</option>
                          <option value="KALTENG">Kalimantan Tengah</option>
                          <option value="KALSEL">Kalimantan Selatan</option>
                          <option value="KALTIM">Kalimantan Timur</option>
                          <option value="KALUT">Kalimantan Utara</option>
                          <option value="SULSEL">Sulawesi Selatan</option>
                          <option value="SULTENG">Sulawesi Tengah</option>
                          <option value="SULUT">Sulawesi Utara</option>
                          <option value="GORONTALO">Gorontalo</option>
                          <option value="SULTRA">Sulawesi Tenggara</option>
                          <option value="MALUKU">Maluku</option>
                          <option value="MALUT">Maluku Utara</option>
                          <option value="PAPUA">Papua</option>
                          <option value="PAPBAR">Papua Barat</option>
                          <option value="NTB">Nusa Tenggara Barat</option>
                          <option value="NTT">Nusa Tenggara Timur</option>
                        </select>
                      </div>
                      <div class="col-12 d-flex justify-content-between mt-4">
                        <button class="btn btn-label-secondary btn-prev">
                          <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                          <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                        </button>
                        <button class="btn btn-primary btn-next">
                          <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Selanjutnya</span>
                          <i class="ti ti-arrow-right ti-xs"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <!-- Billing Links -->
                  <div id="billingLinksValidation" class="content">
                    <div class="content-header">
                      <h3 class="mb-1">Informasi Toko</h3>
                      <p>Lengkapi informasi toko Anda untuk memulai berjualan</p>
                    </div>
                    <!-- Kategori UMKM -->
                    <div class="row gap-md-0 gap-3 my-4">
                      <div class="col-md">
                        <div class="form-check custom-option custom-option-icon">
                          <label class="form-check-label custom-option-content" for="mikroOption">
                            <span class="custom-option-body">
                              <span class="custom-option-title fs-4 mb-1">Mikro</span>
                              <small class="fs-6">Usaha dengan omzet < Rp 300 juta/tahun</small>
                              <span class="d-flex justify-content-center">
                                <i class="ti ti-building-store fs-2 text-primary"></i>
                              </span>
                            </span>
                            <input
                              name="umkmCategory"
                              class="form-check-input"
                              type="radio"
                              value="mikro"
                              id="mikroOption" />
                          </label>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-check custom-option custom-option-icon">
                          <label class="form-check-label custom-option-content" for="kecilOption">
                            <span class="custom-option-body">
                              <span class="custom-option-title fs-4 mb-1">Kecil</span>
                              <small class="fs-6">Usaha dengan omzet Rp 300 juta - 2,5 miliar/tahun</small>
                              <span class="d-flex justify-content-center">
                                <i class="ti ti-building-warehouse fs-2 text-primary"></i>
                              </span>
                            </span>
                            <input
                              name="umkmCategory"
                              class="form-check-input"
                              type="radio"
                              value="kecil"
                              id="kecilOption"
                              checked />
                          </label>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-check custom-option custom-option-icon">
                          <label class="form-check-label custom-option-content" for="menengahOption">
                            <span class="custom-option-body">
                              <span class="custom-option-title fs-4 mb-1">Menengah</span>
                              <small class="fs-6">Usaha dengan omzet Rp 2,5 - 50 miliar/tahun</small>
                              <span class="d-flex justify-content-center">
                                <i class="ti ti-building-skyscraper fs-2 text-primary"></i>
                              </span>
                            </span>
                            <input
                              name="umkmCategory"
                              class="form-check-input"
                              type="radio"
                              value="menengah"
                              id="menengahOption" />
                          </label>
                        </div>
                      </div>
                    </div>
                    <!--/ Kategori UMKM -->
                    <div class="content-header mb-4">
                      <h3 class="mb-1">Informasi Toko Lanjutan</h3>
                      <p>Lengkapi detail toko dan verifikasi</p>
                    </div>
                    <!-- Informasi Toko -->
                    <div class="row g-3">
                      <div class="col-md-12">
                        <label class="form-label w-100" for="multiStepsCard">Kategori Produk</label>
                        <select id="multiStepsCard" class="form-select" name="productCategory">
                          <option value="">Pilih Kategori Produk</option>
                          <option value="makanan">Makanan & Minuman</option>
                          <option value="fashion">Fashion & Aksesoris</option>
                          <option value="elektronik">Elektronik & Gadget</option>
                          <option value="kecantikan">Kecantikan & Kesehatan</option>
                          <option value="rumah">Rumah & Dekorasi</option>
                          <option value="olahraga">Olahraga & Hobi</option>
                          <option value="otomotif">Otomotif & Aksesoris</option>
                          <option value="buku">Buku & Alat Tulis</option>
                          <option value="mainan">Mainan & Games</option>
                          <option value="lainnya">Lainnya</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label" for="multiStepsName">Nama Pemilik Toko</label>
                        <input
                          type="text"
                          id="multiStepsName"
                          class="form-control"
                          name="storeOwnerName"
                          placeholder="Nama Lengkap Pemilik" />
                      </div>
                      <div class="col-md-6">
                        <label class="form-label" for="multiStepsExDate">Nomor KTP</label>
                        <input
                          type="text"
                          id="multiStepsExDate"
                          class="form-control"
                          name="ktpNumber"
                          placeholder="1234567890123456"
                          maxlength="16" />
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="multiStepsCvv">Deskripsi Toko</label>
                        <textarea
                            id="multiStepsCvv"
                          class="form-control"
                          name="storeDescription"
                          rows="3"
                          placeholder="Ceritakan tentang toko Anda, produk yang dijual, dan keunggulan toko..."></textarea>
                      </div>
                      <div class="col-md-12">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="termsCheck" name="termsCheck" required>
                          <label class="form-check-label" for="termsCheck">
                            Saya menyetujui <a href="#" class="text-primary">Syarat dan Ketentuan</a> serta <a href="#" class="text-primary">Kebijakan Privasi</a> Edagon
                          </label>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="verificationCheck" name="verificationCheck" required>
                          <label class="form-check-label" for="verificationCheck">
                            Saya menyatakan bahwa informasi yang diberikan adalah benar dan siap untuk proses verifikasi
                          </label>
                        </div>
                      </div>
                      <div class="col-12 d-flex justify-content-between mt-4">
                        <button class="btn btn-label-secondary btn-prev">
                          <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                          <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                        </button>
                        <button type="submit" class="btn btn-success btn-next btn-submit" id="submitBtn">Daftar Sebagai Penjual</button>
                      </div>
                    </div>
                    <!--/ Informasi Toko -->
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- / Multi Steps Registration -->
      </div>
    </div>

    <script>
      // Check selected custom option
      window.Helpers.initCustomOptionCheck();
      
      // Custom validation for UMKM registration
      document.addEventListener('DOMContentLoaded', function() {
        // Add Indonesian phone number validation
        const phoneInput = document.getElementById('multiStepsMobile');
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
        
        // Add KTP number validation
        const ktpInput = document.getElementById('multiStepsExDate');
        if (ktpInput) {
          ktpInput.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '').substring(0, 16);
          });
        }
        
        // Add postal code validation
        const postalInput = document.getElementById('multiStepsPincode');
        if (postalInput) {
          postalInput.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '').substring(0, 5);
          });
        }

        // Email validation with real-time check
        const emailInput = document.getElementById('multiStepsEmail');
        if (emailInput) {
          let emailTimeout;
          emailInput.addEventListener('input', function(e) {
            clearTimeout(emailTimeout);
            const email = e.target.value;
            
            if (email && email.includes('@')) {
              emailTimeout = setTimeout(() => {
                checkEmailAvailability(email);
              }, 500);
            }
          });
        }


        // Form submission handling
        const form = document.getElementById('multiStepsForm');
        if (form) {
          form.addEventListener('submit', function(e) {
            e.preventDefault();
            submitForm();
          });
        }
      });

      // Check email availability
      function checkEmailAvailability(email) {
        fetch('{{ route("umkm.check-email") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({ email: email })
        })
        .then(response => response.json())
        .then(data => {
          const emailInput = document.getElementById('multiStepsEmail');
          if (data.available) {
            emailInput.classList.remove('is-invalid');
            emailInput.classList.add('is-valid');
            removeErrorMessage(emailInput);
          } else {
            emailInput.classList.remove('is-valid');
            emailInput.classList.add('is-invalid');
            showErrorMessage(emailInput, data.message);
          }
        })
        .catch(error => {
          console.error('Error checking email:', error);
        });
      }


      // Show error message
      function showErrorMessage(input, message) {
        removeErrorMessage(input);
        const errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        errorDiv.textContent = message;
        input.parentNode.appendChild(errorDiv);
      }

      // Remove error message
      function removeErrorMessage(input) {
        const existingError = input.parentNode.querySelector('.invalid-feedback');
        if (existingError) {
          existingError.remove();
        }
      }

      // Submit form
      function submitForm() {
        const form = document.getElementById('multiStepsForm');
        const submitBtn = document.getElementById('submitBtn');
        const formData = new FormData(form);

        // Disable submit button
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Mendaftar...';

        fetch(form.action, {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Show success message
            showSuccessMessage(data.message);
            // Redirect or show success page
            setTimeout(() => {
              window.location.href = '/home';
            }, 2000);
          } else {
            // Show validation errors
            showValidationErrors(data.errors);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          showErrorMessage(document.getElementById('submitBtn'), 'Terjadi kesalahan. Silakan coba lagi.');
        })
        .finally(() => {
          // Re-enable submit button
          submitBtn.disabled = false;
          submitBtn.innerHTML = 'Daftar Sebagai Penjual';
        });
      }

      // Show validation errors
      function showValidationErrors(errors) {
        // Clear previous errors
        document.querySelectorAll('.is-invalid').forEach(el => {
          el.classList.remove('is-invalid');
        });
        document.querySelectorAll('.invalid-feedback').forEach(el => {
          el.remove();
        });

        // Show new errors
        Object.keys(errors).forEach(field => {
          const input = document.querySelector(`[name="${field}"]`);
          if (input) {
            input.classList.add('is-invalid');
            showErrorMessage(input, errors[field][0]);
          }
        });
      }

      // Show success message
      function showSuccessMessage(message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-success alert-dismissible fade show';
        alertDiv.innerHTML = `
          <i class="ti ti-check-circle me-2"></i>
          ${message}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        
        const form = document.getElementById('multiStepsForm');
        form.parentNode.insertBefore(alertDiv, form);
      }
    </script>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/pages-auth-multisteps.js') }}"></script>
  </body>
</html>