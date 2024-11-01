<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="SPK Metode AHP &amp; Analytics Hierarchy Process">
	<meta name="author" content="SPK AHP">
	<meta name="keywords" content="spk, ahp, analytics hierarchy process, beasiswa, baznas, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ asset('img/icons/icon-48x48.png') }}" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>SPK Metode Analytics Hierarchy Process</title>

	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
	<style>
		.alert {
			padding: .95rem .95rem;
			border-radius: 4px;
		}
		.alert-success {
			color: #117054;
    		background-color: #d2f1e8;
			border-color: #bbebdd;
		}
		.alert-primary {
			color: #fff;
    		background-color: #3b7ddd;
			border-color: #117054;
		}
		.badge {
			padding: 4px 6px;
			border-radius: 4px;
		}
		.badge-success {
			color: #117054;
    		background-color: #d2f1e8;
			border-color: #bbebdd;
		}
		.badge-primary {
			color: #fff;
    		background-color: #3b7ddd;
			border-color: #117054;
		}
	</style>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="{{ route('dashboard.index') }}">
					<img src="{{ asset('img/logo-invert.png') }}" alt="Logo BAZNAS" class="img-fluid">
                </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Menu
					</li>

					<li class="sidebar-item {{ Route::currentRouteName() == 'dashboard.index' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('dashboard.index') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
					</li>

					<li class="sidebar-item {{ Route::is('periode*') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('periode.index') }}">
                            <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Data Periode</span>
                        </a>
					</li>

					
					<li class="sidebar-item {{ Route::is('kriteria*') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('kriteria.index') }}">
							<i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Data Kriteria</span>
						</a>
					</li>

					<li class="sidebar-item {{ Route::is('subkriteria*') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('subkriteria.index') }}">
							<i class="align-middle" data-feather="check"></i> <span class="align-middle">Data Sub Kriteria</span>
						</a>
					</li>
					
					<li class="sidebar-item {{ Route::is('alternatif*') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('alternatif.index') }}">
							<i class="align-middle" data-feather="users"></i> <span class="align-middle">Data Alternatif</span>
						</a>
					</li>
							
					<li class="sidebar-header">
						Perhitungan AHP
					</li>

					

					<li class="sidebar-item {{ Route::is('perbandingan-kriteria*') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('perbandingan-kriteria.index') }}">
                            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Perbandingan Kriteria</span>
                        </a>
					</li>

					<li class="sidebar-item {{ Route::is('perbandingan-sub-kriteria*') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('perbandingan-sub-kriteria.index') }}">
                            <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Perbd. Sub Kriteria</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-cards.html">
                            <i class="align-middle" data-feather="pie-chart"></i> <span class="align-middle">Hasil Perhitungan</span>
                        </a>
					</li>

                    <li class="sidebar-header">
						Pengaturan
					</li>

                    <li class="sidebar-item {{ Route::currentRouteName() == 'password.index' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('password.index') }}">
                            <i class="align-middle" data-feather="lock"></i> <span class="align-middle">Password</span>
                        </a>
					</li>
                </ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <img src="{{ asset('img/avatars/avatar.png') }}" class="avatar img-fluid rounded me-1 border p-1" alt="User" /> <span class="text-dark">{{ auth()->user()->nama }}</span>
                            </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="align-middle me-1" data-feather="log-out"></i> 
                                    Log Out
                                </a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">
					@yield('content')
				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="{{ route('dashboard.index') }}">SPK Metode Analytics Hierarchy Process</a>
							</p>
						</div>
						<div class="col-6 text-end">
							Dibuat oleh <a href="http://www.pnp.ac.id" target="_blank" rel="Politeknik Negeri Padang">Politeknik Negeri Padang</a>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/datatables.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('#datatable').DataTable({
				"paging": false,
				"searching": true,	
				"columnDefs": [
            		{ "width": "5%", "targets": 0 }, // Kolom pertama	
				],
				language: {
					emptyTable: "Tidak ada data",
					zeroRecords: "Hasil pencarian tidak ditemukan"
				}
			});
		});

		setTimeout(function(){
			var alert = document.getElementById('alert');
			if(alert != null) {
				alert.classList.add('d-none');
			}
		}, 2000);
	</script>
</body>

</html>