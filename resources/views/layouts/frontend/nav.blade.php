        <div class="fixed-top bg-white shadow-sm">
			<div class="container px-0">
				<nav class="navbar navbar-expand-xl navbar-light hk-navbar hk-navbar-alt shadow-none">
					<a class="navbar-toggle-btn nav-link-hover navbar-toggler" href="javascript:void(0);" data-toggle="collapse" data-target="#navbarCollapseAlt" aria-controls="navbarCollapseAlt" aria-expanded="false" aria-label="Toggle navigation"><span class="feather-icon"><i data-feather="menu"></i></span></a>
					<a class="navbar-brand" href="/">
						<h4>SIG AKIA</h4>
					</a>
					
					<div class="collapse navbar-collapse ml-auto" id="navbarCollapseAlt">
						<ul class="navbar-nav ml-auto">
							<li class="nav-item mr-10">
								<a class="nav-link {{ Request::segment(1) == 'fasilitas-kesehatan' ? 'active' : ''}}" href="{{ route('faskes') }}">Fasilitas Kesehatan</a>
							</li>
                            <li class="nav-item mr-10">
								<a class="nav-link {{ Request::segment(1) == 'persebaran' ? 'active' : ''}}" href="{{ route('persebaran') }}">Peta Persebaran</a>
							</li>
							<li class="nav-item mr-10">
								<a class="nav-link" href="#">Version<span class="badge badge-soft-success badge-sm badge-pill ml-10">v 1.0</span></a>
							</li>
							@auth
							<li class="nav-item mr-10">
								<a class="nav-link" href="#"><strong>{{ Auth::user()->name }}</strong></a>
							</li>
							@endif
						</ul>
					</div>
					<ul class="navbar-nav hk-navbar-content">
						@if (Route::has('login'))
							<div class="top-right links">
								@auth
									@if (Auth::user()->role_id == 1)
										<li class="nav-item">
											<a class="btn btn-outline-primary btn-rounded" href="{{ route('admin.index') }}">Dashboard</a>
										</li>
									@elseif (Auth::user()->role_id == 2)
										<li class="nav-item">
											<a class="btn btn-outline-primary btn-rounded" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												@csrf
											</form>
										</li>
									@endif
								@else
									<li class="nav-item">
										<a class="btn btn-outline-primary btn-rounded" href="{{ route('login') }}">Login</a>
									</li>
								@endauth
							</div>
						@endif
					</ul>
				</nav>
			</div>	
		</div>	