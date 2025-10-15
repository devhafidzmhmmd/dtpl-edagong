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

    <title>Daftar Sebagai Pembeli - Edagon</title>

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

        <!-- Buyer Registration Form -->
        <div class="d-flex col-lg-8 align-items-center justify-content-center p-sm-5 p-3">
          <div class="w-px-400">
            <div class="app-brand justify-content-center">
              <a href="{{ route('product.index') }}" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <img src="{{ asset('logo.png') }}" alt="Edagon Logo" width="40" height="40" style="object-fit: contain;">
                </span>
                <span class="app-brand-text demo text-body fw-bolder">Edagon</span>
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Selamat Datang di Edagon! 👋</h4>
            <p class="mb-4">Daftar sebagai pembeli untuk mulai berbelanja</p>

            <form id="buyerRegistrationForm" class="mb-3" action="{{ route('buyer.register') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                  type="text"
                  class="form-control"
                  id="email"
                  name="email"
                  placeholder="Masukkan email Anda"
                  autofocus />
              </div>
              <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Kata Sandi</label>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>
              </div>
              <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi</label>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password_confirmation"
                    class="form-control"
                    name="password_confirmation"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password_confirmation" />
                  <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="first_name" class="form-label">Nama Depan</label>
                    <input
                      type="text"
                      class="form-control"
                      id="first_name"
                      name="first_name"
                      placeholder="Ahmad" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="last_name" class="form-label">Nama Belakang</label>
                    <input
                      type="text"
                      class="form-control"
                      id="last_name"
                      name="last_name"
                      placeholder="Rahman" />
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <div class="input-group">
                  <span class="input-group-text">ID (+62)</span>
                  <input
                    type="text"
                    class="form-control"
                    id="phone"
                    name="phone"
                    placeholder="812 3456 7890" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="postal_code" class="form-label">Kode Pos</label>
                    <input
                      type="text"
                      class="form-control"
                      id="postal_code"
                      name="postal_code"
                      placeholder="12345"
                      maxlength="5" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="city" class="form-label">Kota</label>
                    <input
                      type="text"
                      class="form-control"
                      id="city"
                      name="city"
                      placeholder="Jakarta" />
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="province" class="form-label">Provinsi</label>
                <select id="province" name="province" class="select2 form-select" data-allow-clear="true">
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
              <div class="mb-3">
                <label for="address" class="form-label">Alamat Lengkap</label>
                <input
                  type="text"
                  class="form-control"
                  id="address"
                  name="address"
                  placeholder="Jl. Contoh No. 123, RT/RW 01/02" />
              </div>
              <div class="mb-3">
                <label for="area_landmark" class="form-label">Patokan Lokasi (Opsional)</label>
                <input
                  type="text"
                  class="form-control"
                  id="area_landmark"
                  name="area_landmark"
                  placeholder="Dekat Masjid, Sekolah, dll" />
              </div>
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="terms_check" name="terms_check" required>
                  <label class="form-check-label" for="terms_check">
                    Saya menyetujui <a href="#" class="text-primary">Syarat dan Ketentuan</a> serta <a href="#" class="text-primary">Kebijakan Privasi</a> Edagon
                  </label>
                </div>
              </div>
              <button class="btn btn-primary d-grid w-100" type="submit" id="submitBtn">Daftar Sebagai Pembeli</button>
            </form>

            <p class="text-center">
              <span>Sudah punya akun?</span>
              <a href="{{ route('login') }}">
                <span>Masuk di sini</span>
              </a>
            </p>
            <p class="text-center">
              <span>Ingin berjualan?</span>
              <a href="{{ route('umkm.register.show') }}">
                <span>Daftar sebagai Penjual UMKM</span>
              </a>
            </p>
          </div>
        </div>
        <!-- /Buyer Registration Form -->
      </div>
    </div>

    <script>
      // Custom validation for buyer registration
      document.addEventListener('DOMContentLoaded', function() {
        // Add Indonesian phone number validation
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
        
        // Add postal code validation
        const postalInput = document.getElementById('postal_code');
        if (postalInput) {
          postalInput.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '').substring(0, 5);
          });
        }

        // Email validation with real-time check
        const emailInput = document.getElementById('email');
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
        const form = document.getElementById('buyerRegistrationForm');
        if (form) {
          form.addEventListener('submit', function(e) {
            e.preventDefault();
            submitForm();
          });
        }
      });

      // Check email availability
      function checkEmailAvailability(email) {
        fetch('{{ route("buyer.check-email") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({ email: email })
        })
        .then(response => response.json())
        .then(data => {
          const emailInput = document.getElementById('email');
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
        const form = document.getElementById('buyerRegistrationForm');
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
          submitBtn.innerHTML = 'Daftar Sebagai Pembeli';
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
        
        const form = document.getElementById('buyerRegistrationForm');
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
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
  </body>
</html>
