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

	<title>Login &mdash; SPK Metode Analytics Hierarchy Process</title>

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
		.alert-danger {
			color: #842029;
    		background-color: #f8d7da;
			border-color: #f5c2c7;
		}
	</style>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-2">
							<img src="{{ asset('img/logo.png') }}" alt="Logo BAZNAS">
							<p class="lead mt-3">SPK Penentuan Penerima Beasiswa<br/>Menggunakan Metode Analytics Hierarchy Process</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									@if(session('success'))
										<div class="alert alert-success mb-3" id="alert">{{ session('success') }}</div>
									@endif

									@if(session('error'))
										<div class="alert alert-danger mb-3" id="alert">{{ session('error') }}</div>
									@endif

									<form method="post" action="{{ route('login') }}">
                                        @csrf
										<div class="mb-3">
											<label class="form-label"><i class="align-middle" data-feather="user"></i> Username</label>
											<input class="form-control form-control-lg @error('username') is-invalid @enderror" value="{{ old('username') }}" type="text" name="username" placeholder="Masukkan Username" autocomplete="off" />
                                            @error('username')
                                                <span class="text text-danger">{{ $message }}</span>
                                            @enderror
										</div>
										<div class="mb-3">
											<label class="form-label"><i class="align-middle" data-feather="lock"></i> Password</label>
											<input class="form-control form-control-lg @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" />
                                            @error('password')
                                                <span class="text text-danger">{{ $message }}</span>
                                            @enderror
										</div>

										<div class="d-grid gap-2 mt-3">
											<button type="submit" class="btn btn-primary">
                                                <i class="align-middle" data-feather="unlock"></i>
                                                Login
                                            </button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="{{ asset('js/app.js') }}"></script>
	<script>
		setTimeout(function(){
			var alert = document.getElementById('alert');
			if(alert != null) {
				alert.classList.add('d-none');
			}
		}, 2000);
	</script>

</body>

</html>