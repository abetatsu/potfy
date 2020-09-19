<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
	<div class="container">
		<a class="navbar-brand" href="{{ route('portfolio.top') }}">
			<img src="{{ asset('assets/image/potfy.png') }}" alt="" width="130">
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
			@auth
				<a href="{{ route('user.portfolios.create')}}" class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full">新規投稿</a>
			@endauth
				<!-- Authentication Links -->
				@unless (Auth::guard('user')->check())
					<li class="nav-item">
						<a class="nav-link" href="{{ route('user.login') }}">{{ __('Login') }}</a>
					</li>
					@if (Route::has('user.register'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('user.register') }}">{{ __('Register') }}</a>
						</li>
					@endif
				@else
					<li class="nav-item dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						{{  Auth::user()->name ? Auth::user()->name : 'Guest' }} <span class="caret"></span>
						</a>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="{{ route('user.users.show', Auth::id()) }}">
								マイページ <span class="caret"></span>
							</a>
							<a class="dropdown-item" href="{{ route('user.logout') }}"
								onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>
							
							<form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</li>
				@endunless
			</ul>
		</div>
	</div>
</nav>