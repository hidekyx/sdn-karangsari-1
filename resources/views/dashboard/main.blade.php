<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SDN Karangsari 1 Tangerang - Admin Dashboard</title>

    <link rel="stylesheet" href="{{ asset('storage/back-assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/back-assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/back-assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/back-assets/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/back-assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/back-assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/back-assets/js/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/back-assets/css/vertical-layout-light/style.css') }}">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">	
    <link rel="shortcut icon" href="{{ asset('storage/assets/images/logo.png') }}" />
</head>
<body>
<div class="container-scroller">
	@if($page == "Login")
		@include('dashboard.login')
	@else
		@include('dashboard.header')
		<div class="container-fluid page-body-wrapper">
			@include('dashboard.sidenav')
			<div class="main-panel">
				<div class="content-wrapper">
				<div class="row">
					<div class="col-sm-12">
					<div class="home-tab" style="padding: 0px 0;">
						<div class="tab-content tab-content-basic" style="padding: 0px 1rem 2rem 1rem;">
						<div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
							<div class="row">
								@if($logged_user->role == "Guru")
									@if($page == "Dashboard")
										@include('dashboard.guru.home')
									@elseif($page == "Absensi - Create")
										@include('dashboard.guru.absensi_create')
									@elseif($page == "Absensi - Edit")
										@include('dashboard.guru.absensi_edit')
									@elseif($page == "Absensi - List")
										@include('dashboard.guru.absensi_list')
									@elseif($page == "Absensi - Detail")
										@include('dashboard.guru.absensi_detail')
									@endif
								@elseif($logged_user->role == "Admin")
									@if($page == "Siswa - List")
										@include('dashboard.admin.list_siswa')
									@elseif($page == "Siswa - Tambah")
										@include('dashboard.admin.tambah_siswa')
									@elseif($page == "Siswa - Edit")
										@include('dashboard.admin.edit_siswa')
									@elseif($page == "Guru - List")
										@include('dashboard.admin.list_guru')
									@elseif($page == "Guru - Tambah")
										@include('dashboard.admin.tambah_guru')
									@elseif($page == "Guru - Edit")
										@include('dashboard.admin.edit_guru')
									@elseif($page == "Jadwal - List")
										@include('dashboard.admin.list_jadwal')
									@elseif($page == "Jadwal - Tambah")
										@include('dashboard.admin.tambah_jadwal')
									@elseif($page == "Jadwal - Edit")
										@include('dashboard.admin.edit_jadwal')
									@elseif($page == "Kelas - List")
										@include('dashboard.admin.list_kelas')
									@elseif($page == "Sarpras - List")
										@include('dashboard.admin.list_sarpras')
									@elseif($page == "Sarpras - Tambah")
										@include('dashboard.admin.tambah_sarpras')
									@elseif($page == "Sarpras - Edit")
										@include('dashboard.admin.edit_sarpras')
									@elseif($page == "Kegiatan - List")
										@include('dashboard.admin.list_kegiatan')
									@elseif($page == "Kegiatan - Tambah")
										@include('dashboard.admin.tambah_kegiatan')
									@elseif($page == "Kegiatan - Edit")
										@include('dashboard.admin.edit_kegiatan')
									@endif
								@endif
							</div>
						</div>
						</div>
					</div>
					</div>
				</div>
				</div>
				@include('dashboard.footer')
			</div>
		</div>
	@endif
</div>
    <script src="{{ asset('storage/back-assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('storage/back-assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('storage/back-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('storage/back-assets/js/progress-bar.js') }}"></script>
    <script src="{{ asset('storage/back-assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('storage/back-assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('storage/back-assets/js/template.js') }}"></script>
    <script src="{{ asset('storage/back-assets/js/settings.js') }}"></script>
    <script src="{{ asset('storage/back-assets/js/todolist.js') }}"></script>
    <script src="{{ asset('storage/back-assets/js/jquery.cookie.js') }}"></script>
    <script src="{{ asset('storage/back-assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('storage/back-assets/js/Chart.roundedBarCharts.js') }}"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	@stack('scripts')
</body>

</html>