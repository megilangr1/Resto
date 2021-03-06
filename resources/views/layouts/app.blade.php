<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		
		<!-- Other -->
		<link rel="stylesheet" href="{{ asset('') }}other/select2/css/select2.min.css">

		<style>
			.flat {
				border-radius: 0px !important;
			}

			.table {
				width: 100% !important;
			}

			.select2-container--default .select2-selection--single {
				border-radius: 0px;
				height: calc(1.6em + 0.75rem + 2px);
			}

			.select2-container--default .select2-selection--single .select2-selection__rendered {
				line-height: 35px;
			}
			.select2-container .select2-selection--single .select2-selection__rendered {
				padding-left: 0.75rem;
			}
			.select2-container--default .select2-selection--single .select2-selection__arrow {
				height: 35px;
			}
			.select2-dropdown {
				border-radius: 0px;
			}
		</style>

		@yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Resto App') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
											@guest
											
											@else

											<li class="nav-item dropdown">
												<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
													User & Level Akses
												</a>
												<div class="dropdown-menu">
													<a href="{{ route('role.index') }}" class="dropdown-item">Management Role</a>
													<a href="{{ route('user.index') }}" class="dropdown-item">Management User</a>
												</div>
											</li>

											<li class="nav-item dropdown">
												<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
													Master Data
												</a>
												<div class="dropdown-menu">
													<a href="{{ route('units.index') }}" class="dropdown-item">Data Satuan</a>
													<a href="{{ route('category.index') }}" class="dropdown-item">Data Kategori</a>
													<a href="{{ route('suppliers.index') }}" class="dropdown-item">Data Supplier</a>
													<div class="dropdown-divider"></div>
													<a href="{{ route('ingredients.index') }}" class="dropdown-item">Bahan Pokok</a>
												</div>
											</li>
											{{-- <li class="nav-item">
												<a href="{{ route('role.index') }}" class="nav-link">
													Management Role
												</a>
											</li> --}}
											@endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
					<div class="container">
						{{-- <div class="row justify-content-center"> --}}
						<div class="row">
							@yield('content')
						</div>
					</div>
        </main>
		</div>


		<script src="{{ mix('js/app.js') }}"></script>
		<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

		@stack('scripts')
		
		<!-- Other -->
		<script src="{{ asset('') }}other/select2/js/select2.full.min.js"></script>

		@yield('script')
</body>
</html>
