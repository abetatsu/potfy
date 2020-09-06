<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-5">
	<div class="container">
		<a class="navbar-brand" href="{{ url('/') }}">
			<img src="{{ asset('assets/image/potfy.png') }}" alt="" width="150">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav mr-auto">

			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto">
				<!-- Authentication Links -->
				@unless (Auth::guard('company')->check())
					<li class="nav-item">
						<a class="nav-link" href="{{ route('company.login') }}">{{ __('Login') }}</a>
					</li>
					@if (Route::has('company.register'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('company.register') }}">{{ __('Register') }}</a>
						</li>
					@endif
				@else
					<li class="nav-item dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="{{ route('company.logout') }}"
								onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>

							<a class="dropdown-item" href="{{ route('company.companies.show', Auth::id()) }}">
								マイページ <span class="caret"></span>
							</a>

							<form id="logout-form" action="{{ route('company.logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</li>
				@endunless
			</ul>
		</div>
	</div>
</nav>