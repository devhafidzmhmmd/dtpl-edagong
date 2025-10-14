<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="container-xxl">
      <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{ url('/') }}" class="app-brand-link gap-2">
          <span class="app-brand-logo demo">
            <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                fill="#7367F0" />
              <path
                opacity="0.06"
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                fill="#161616" />
              <path
                opacity="0.06"
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                fill="#161616" />
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                fill="#7367F0" />
            </svg>
          </span>
          <span class="app-brand-text demo menu-text fw-bold">{{ config('app.name', 'Laravel') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
          <i class="ti ti-x ti-sm align-middle"></i>
        </a>
      </div>

      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="ti ti-menu-2 ti-sm"></i>
        </a>
      </div>

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">
          <!-- Order History Link -->
          <li class="nav-item me-2 me-xl-0">
            <a class="nav-link" href="{{ route('order.index') }}">
              <i class="ti ti-history ti-md"></i>
              <span class="d-xl-inline">{{ __('Order History') }}</span>
            </a>
          </li>

          <!-- Shop Link -->
          <li class="nav-item me-2 me-xl-0">
            <a class="nav-link" href="{{ route('cart.show') }}">
              <i class="ti ti-shopping-cart ti-md"></i>
              <span class="d-xl-inline">Cart</span>
              @if (Cart::isNotEmpty())
                <span class="badge bg-primary rounded-pill badge-notifications">{{ Cart::itemCount() }}</span>
              @endif
            </a>
          </li>
          <!--/ Shop Link -->

          <!-- Admin Products Link -->
          @auth
            @if(Auth::user()->hasRole('admin') || Auth::user()->user_type === 'umkm_seller')
            <li class="nav-item me-2 me-xl-0">
              <a class="nav-link" href="{{ route('vanilo.admin.product.index') }}" target="_blank">
                <i class="ti ti-package ti-md"></i>
                <span class="d-none d-xl-inline">Manage Products</span>
              </a>
            </li>
            @endif
          @endauth
          <!--/ Admin Products Link -->

          <!-- Style Switcher -->
          <li class="nav-item me-2 me-xl-0">
            <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
              <i class="ti ti-md"></i>
            </a>
          </li>
          <!--/ Style Switcher -->

          <!-- Notification -->
          <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
            <a
              class="nav-link dropdown-toggle hide-arrow"
              href="javascript:void(0);"
              data-bs-toggle="dropdown"
              data-bs-auto-close="outside"
              aria-expanded="false">
              <i class="ti ti-bell ti-md"></i>
              <span class="badge bg-danger rounded-pill badge-notifications">0</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end py-0">
              <li class="dropdown-menu-header border-bottom">
                <div class="dropdown-header d-flex align-items-center py-3">
                  <h5 class="text-body mb-0 me-auto">Notifications</h5>
                  <a
                    href="javascript:void(0)"
                    class="dropdown-notifications-all text-body"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Mark all as read"
                    ><i class="ti ti-mail-opened fs-4"></i
                  ></a>
                </div>
              </li>
              <li class="dropdown-notifications-list scrollable-container">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item list-group-item-action dropdown-notifications-item">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar">
                          <span class="avatar-initial rounded-circle bg-label-info">
                            <i class="ti ti-info-circle"></i>
                          </span>
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="mb-1">Welcome!</h6>
                        <p class="mb-0">You have no notifications yet.</p>
                        <small class="text-muted">Just now</small>
                      </div>
                    </div>
                  </li>
                </ul>
              </li>
              <li class="dropdown-menu-footer border-top">
                <a
                  href="javascript:void(0);"
                  class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                  View all notifications
                </a>
              </li>
            </ul>
          </li>
          <!--/ Notification -->

          <!-- User -->
          @guest
            <li class="nav-item me-2 me-xl-0">
              <a class="nav-link" href="{{ route('login') }}">
                <i class="ti ti-login ti-md"></i>
                <span class="d-none d-xl-inline">Login</span>
              </a>
            </li>
            <li class="nav-item dropdown me-2 me-xl-0">
              <a class="nav-link dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ti ti-user-plus ti-md"></i>
                <span class="d-none d-xl-inline">Daftar</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="{{ route('buyer.register.show') }}">
                    <i class="ti ti-shopping-cart me-2 ti-sm"></i>
                    <span class="align-middle">Sebagai Pembeli</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('umkm.register.show') }}">
                    <i class="ti ti-building-store me-2 ti-sm"></i>
                    <span class="align-middle">Sebagai Penjual UMKM</span>
                  </a>
                </li>
              </ul>
            </li>
          @else
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
              <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                  <span class="avatar-initial rounded-circle bg-primary">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                  </span>
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="javascript:void(0);">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                          <span class="avatar-initial rounded-circle bg-primary">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                          </span>
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                        <small class="text-muted">{{ Auth::user()->email }}</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <div class="dropdown-divider"></div>
                </li>
                <li>
                  @if(Auth::user()->isBuyer())
                    <a class="dropdown-item" href="{{ route('buyer.profile.show') }}">
                      <i class="ti ti-user-check me-2 ti-sm"></i>
                      <span class="align-middle">Profil Saya</span>
                    </a>
                  @elseif(Auth::user()->isUmkmSeller())
                    <a class="dropdown-item" href="{{ route('merchant.profile') }}">
                      <i class="ti ti-user-check me-2 ti-sm"></i>
                      <span class="align-middle">Profil Toko</span>
                    </a>
                  @else
                    <a class="dropdown-item" href="{{ route('merchant.profile') }}">
                      <i class="ti ti-user-check me-2 ti-sm"></i>
                      <span class="align-middle">My Profile</span>
                    </a>
                  @endif
                </li>
                <li>
                  <a class="dropdown-item" href="javascript:void(0);">
                    <i class="ti ti-settings me-2 ti-sm"></i>
                    <span class="align-middle">Settings</span>
                  </a>
                </li>
                @role('admin')
                <li>
                  <a class="dropdown-item" href="{{ config('konekt.app_shell.ui.url') }}">
                    <i class="ti ti-shield me-2 ti-sm"></i>
                    <span class="align-middle">Admin Panel</span>
                  </a>
                </li>
                @endrole
                <li>
                  <div class="dropdown-divider"></div>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ti ti-logout me-2 ti-sm"></i>
                    <span class="align-middle">Log Out</span>
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </li>
              </ul>
            </li>
          @endguest
          <!--/ User -->
        </ul>
      </div>

      <!-- Search Small Screens -->
      <div class="navbar-search-wrapper search-input-wrapper container-xxl d-none">
        <input
          type="text"
          class="form-control search-input border-0"
          placeholder="Search..."
          aria-label="Search..." />
        <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
      </div>
    </div>
  </nav>