<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/logo.png" class="img-responsive">
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
                              <li class="nav-item active">
						        <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="#">About<span class="sr-only">(current)</span></a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="/student/home">EPtest<span class="sr-only">(current)</span></a>
						      </li>
						      <li class="nav-item dropdown">
							        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							          Help
							        </a>
							        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							          <a class="dropdown-item" href="#">FAQ</a>
							          <a class="dropdown-item" href="#">Support</a>
							        </div>
						      </li>
                              
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Signup</a>
                            </li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if(Auth::user()->unreadNotifications->count())
                                    <span class="badge badge-pill badge-danger">
                                        {{ Auth::user()->unreadNotifications->count() }}
                                     </span>
                                 @endif
                                        Notifications <span class="caret"></span>
                            </a>

                                <div class="dropdown-menu dropdown-menu-right notificationPanel" aria-labelledby="navbarDropdown">
                                    @foreach(Auth::user()->unreadNotifications as $notification) 
                                        <a class="dropdown-item">
                                            <div class="notificationDetail">
                                                <div class="notificationTitle">{{ $notification->data['resgistration']['title']}}{{Auth::user()->name}},</div>
                                                <div class="notificationBody">{!! $notification->data['resgistration']['body'] !!}</div>
                                            </div>
                                        </a>
                                    @endforeach 
                                    @if(Auth::user()->unreadNotifications->count())
                                        <div class="clearAllLink"><a class="btn btn-link" href="{{ route('markAsRead') }}">Clear All</a></div>
                                    @else
                                            <div class="noNotificationMsg">
                                                <span class="fa fa-bell fa-3x"></span>
                                                <p>No New Notifications</p>
                                            </div>
                                    @endif
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if( Auth::user()->role->first()->pivot->role_id !== 1)
                                         <a class="dropdown-item" href="{{ route('profile', ['id' =>  Auth::user()->id ])}}">Manage Profile</a>
                                    @endif
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>