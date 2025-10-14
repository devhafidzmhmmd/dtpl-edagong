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
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

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
                  <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                      <path d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.264012 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0014999 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z" id="path-1"></path>
                      <path d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z" id="path-3"></path>
                      <path d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z" id="path-4"></path>
                      <path d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z" id="path-5"></path>
                    </defs>
                    <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                        <g id="Icon" transform="translate(27.000000, 15.000000)">
                          <g id="Mask" transform="translate(0.000000, 8.000000)">
                            <mask id="mask-2" fill="white">
                              <use xlink:href="#path-1"></use>
                            </mask>
                            <use fill="#696cff" xlink:href="#path-1"></use>
                            <g id="Path-3" mask="url(#mask-2)">
                              <use fill="#696cff" xlink:href="#path-3"></use>
                              <use fill-opacity="0.2" fill="#ffffff" xlink:href="#path-3"></use>
                            </g>
                            <g id="Path-4" mask="url(#mask-2)">
                              <use fill="#696cff" xlink:href="#path-4"></use>
                              <use fill-opacity="0.2" fill="#ffffff" xlink:href="#path-4"></use>
                            </g>
                          </g>
                          <g id="Triangle" transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                            <use fill="#696cff" xlink:href="#path-5"></use>
                            <use fill-opacity="0.2" fill="#ffffff" xlink:href="#path-5"></use>
                          </g>
                        </g>
                      </g>
                    </g>
                  </svg>
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
