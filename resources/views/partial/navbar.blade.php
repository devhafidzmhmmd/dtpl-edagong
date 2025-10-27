<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="container-xxl">
      <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{ url('/') }}" class="app-brand-link gap-2">
          <img src="{{ asset('horiz_logo.png') }}" alt="Edagon Logo" height="52" style="object-fit: contain;">
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
          @auth
          @if(Auth::user()->user_type === 'buyer')
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
            @endif

            <!-- Admin Products Link -->
            @if(Auth::user()->hasRole('merchant'))
            <li class="nav-item me-2 me-xl-0">
              <a class="nav-link" href="{{ route('vanilo.admin.product.index') }}" target="_blank">
                <i class="ti ti-package ti-md"></i>
                <span class="d-none d-xl-inline">Manage Products</span>
              </a>
            </li>
            @endif
            <!--/ Admin Products Link -->
          @endauth

          <!-- Style Switcher -->
          <li class="nav-item me-2 me-xl-0">
            <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
              <i class="ti ti-md"></i>
            </a>
          </li>
          <!--/ Style Switcher -->

          <!-- Notification -->
          @auth
          <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
            <a
              class="nav-link dropdown-toggle hide-arrow"
              href="javascript:void(0);"
              data-bs-toggle="dropdown"
              data-bs-auto-close="outside"
              aria-expanded="false">
              <i class="ti ti-bell ti-md"></i>
              @if(Auth::user()->unreadNotificationsCount() > 0)
                <span class="badge bg-danger rounded-pill badge-notifications">{{ Auth::user()->unreadNotificationsCount() }}</span>
              @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-end py-0">
              <li class="dropdown-menu-header border-bottom">
                <div class="dropdown-header d-flex align-items-center py-3">
                  <h5 class="text-body mb-0 me-auto">Notifikasi</h5>
                  @if(Auth::user()->unreadNotificationsCount() > 0)
                    <a
                      href="javascript:void(0)"
                      class="dropdown-notifications-all text-body"
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Tandai semua sebagai dibaca"
                      onclick="markAllAsRead()"
                      ><i class="ti ti-mail-opened fs-4"></i
                    ></a>
                  @endif
                </div>
              </li>
              <li class="dropdown-notifications-list scrollable-container">
                <ul class="list-group list-group-flush">
                  @forelse(Auth::user()->notifications()->latest()->take(5)->get() as $notification)
                    <li class="list-group-item list-group-item-action dropdown-notifications-item {{ $notification->is_read ? '' : 'bg-light' }}">
                      <div class="d-flex" onclick="window.location.href = '{{ route('vanilo.admin.order.show', $notification->data['order_id']) }}'">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar">
                            <span class="avatar-initial rounded-circle {{ $notification->type === 'order_placed' ? 'bg-label-success' : 'bg-label-info' }}">
                              @if($notification->type === 'order_placed')
                                <i class="ti ti-shopping-cart"></i>
                              @else
                                <i class="ti ti-info-circle"></i>
                              @endif
                            </span>
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="mb-1">{{ $notification->title }}</h6>
                          <p class="mb-0">{{ $notification->message }}</p>
                          <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                        @if(!$notification->is_read)
                          <div class="flex-shrink-0">
                            <span class="badge bg-primary rounded-pill">Baru</span>
                          </div>
                        @endif
                      </div>
                    </li>
                  @empty
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
                          <h6 class="mb-1">Selamat Datang!</h6>
                          <p class="mb-0">Belum ada notifikasi.</p>
                          <small class="text-muted">Baru saja</small>
                        </div>
                      </div>
                    </li>
                  @endforelse
                </ul>
              </li>
              <li class="dropdown-menu-footer border-top">
                <a
                  href="javascript:void(0);"
                  class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                  Lihat semua notifikasi
                </a>
              </li>
            </ul>
          </li>
          @endauth
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

  <script>
    function markAllAsRead() {
      fetch('{{ route("notifications.mark-all-as-read") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Reload the page to update the notification count
          location.reload();
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
    }

    // Auto-refresh notification count every 30 seconds
    setInterval(function() {
      fetch('{{ route("notifications.unread-count") }}')
        .then(response => response.json())
        .then(data => {
          const badge = document.querySelector('.badge-notifications');
          if (data.count > 0) {
            if (badge) {
              badge.textContent = data.count;
              badge.style.display = 'inline';
            } else {
              // Create badge if it doesn't exist
              const bellIcon = document.querySelector('.ti-bell');
              if (bellIcon) {
                const newBadge = document.createElement('span');
                newBadge.className = 'badge bg-danger rounded-pill badge-notifications';
                newBadge.textContent = data.count;
                bellIcon.parentNode.appendChild(newBadge);
              }
            }
          } else {
            if (badge) {
              badge.style.display = 'none';
            }
          }
        })
        .catch(error => {
          console.error('Error fetching notification count:', error);
        });
    }, 30000);
  </script>