<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
	<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
	<div class="me-3">
		<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
		<span class="icon-menu"></span>
		</button>
	</div>
	<div>
		<a class="navbar-brand brand-logo" href="{{ asset('/') }}">
			<img src="{{ asset('storage/assets/images/logo.png') }}" alt="Logo" />
		</a>
		<a class="navbar-brand brand-logo-mini" href="{{ asset('/') }}">
			<img src="{{ asset('storage/assets/images/logo.png') }}" alt="Logo" />
		</a>
	</div>
	</div>
	<div class="navbar-menu-wrapper d-flex align-items-top">
		<ul class="navbar-nav">
			<li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
				<h1 class="welcome-text">Selamat datang, <span class="text-black fw-bold">{{ $logged_user->nama }}</span></h1>
			</li>
		</ul>
		<ul class="navbar-nav ms-auto">
			<li class="nav-item dropdown d-none d-lg-block user-dropdown">
				<a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
					<img class="img-xs rounded-circle" src="{{ asset('storage/assets/images/').'/'.$logged_user->foto }}" alt="Profile image"> 
				</a>
				<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
					<div class="dropdown-header text-center">
						<img class="img-md rounded-circle" src="{{ asset('storage/assets/images/user.png') }}" style="max-width: 50px;" alt="Profile image">
						<p class="mb-1 mt-3 font-weight-semibold">{{ $logged_user->nama }}</p>
						<p class="fw-light text-muted mb-0">{{ $logged_user->email }}</p>
					</div>
					<a class="dropdown-item" href="{{ asset('/logout') }}"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Log Out</a>
				</div>
			</li>
		</ul>
		<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
			<span class="mdi mdi-menu"></span>
		</button>
	</div>
</nav>