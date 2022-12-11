
<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
            <span class="icofont-close js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

<nav class="site-nav">
    <div class="container">
        <div class="menu-bg-wrap">
            <div class="site-navigation">
                <a href="{{ url('/') }}" class="logo m-0 float-start">
                    <img rel="icon" type="image/png" src="{{ asset('/public/admin/assets/img/favicon.png') }}">
                    iBook
                </a>
                @if(!@empty($slug))
                    <span class="logo d-none d-lg-inline-block text-start site-menu"> &nbsp;/ {{ $slug }} </span> 
                @endempty
                <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
                    <li class="active"><a href="{{ url('/') }}">Home</a></li>
                    <li class="active"><a href="{{ url('/my-library/'.Auth::user()->id) }}">My Library</a></li>
                    <li class="has-children">
                        <a href="{{ URL::to('/category') }}">Category</a>
                        <ul class="dropdown">
                            @foreach ($cate as $cat_item)
                                <li><a href="{{ url('/category/'.$cat_item->category_slug) }}">{{ $cat_item->category_name }}</a></li>    
                            @endforeach
                        </ul>
                    </li>

                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="has-children">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{ asset('/public/images') }}/{{ $user->image }}" class="rounded-circle" style="width: 30px;" alt="Avatar" />
                                {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown" aria-labelledby="navbarDropdown">
                                <li>
                                    <a  href="{{ url('/profile/'. Auth::user()->id) }}">
                                        Profile
                                     </a>
                                </li>
                                <li>
                                    <a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    @endguest
                </ul>

                <a href="#" class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none" data-toggle="collapse" data-target="#main-navbar">
                    <span></span>
                </a>

            </div>
        </div>
    </div>
</nav>