<!-- Header -->
<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            <li><i class="ti-mobile"></i> +84 123 456 789</li>
                            <li><i class="ti-email"></i> teamIT5@support.com</li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-7 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                            <li><i class="ti-bag"></i> <a href="{{ route('cart.show') }}">Cart</a></li>
                            @if (Auth::check())
                                <li class="my-account">
                                    <i class="ti-user"></i>
                                    <a class="title-my-account" href="{{ route('user.edit') }}">My account</a>
                                    <i class="ti-angle-down"></i>
                                    <ul class="dropdown-custom">
                                        <li class="nav-item">
                                            <a href="{{ route('user.discounts.index') }}">My Discount</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('user.products.index') }}">My product</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('user.orders.index') }}">Order History</a>
                                        </li>
                                        <li class="nav-item custom-item">
                                            <a href="{{ route('user.orders-management.index') }}">Order management</a>
                                        </li>
                                        <li class="nav-item custom-item">
                                            <a href="{{ route('user.statistic') }}">Statistic</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><i class="ti-power-off"></i><a href="{{ route('logout') }}">Logout</a></li>
                            @else
                                <li><i class="ti-power-off"></i><a href="{{ route('login') }}">Login</a></li>
                                <li>
                                    <i class="ti-lock"></i>
                                    <a href="{{ route('register.create') }}">Register</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="{{ route('home.index') }}"><img src="{{ asset('assets/user/images/logo.png') }}"
                                alt="logo"></a>
                    </div>
                    <!--/ End Logo -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <form method="GET" action="{{ route('home.index') }}">
                                <input name="search" placeholder="Search Products Here....." type="search">
                                <button class="btnn"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="all-category">
                            <h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
                            <ul class="main-category">
                                <x-category />
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="active"><a href="{{ route('home.index') }}">Home</a>
                                            </li>
                                            <li><a href="{{ route('products.index') }}">Product
                                                    <span class="new">New</span></a></li>
                                            <li><a href="#">Brand<i class="ti-angle-down"></i></a>
                                                <ul class="dropdown">
                                                    <x-brand />
                                                </ul>
                                            </li>
                                            <li><a href="contact.html">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
<!--/ End Header -->
