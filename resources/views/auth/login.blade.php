@extends('user.layouts.app')
@section('content')
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <div class="contact-head">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="form-main">
                            <div class="title">
                                <h3 class="title-login">Login</h3>
                            </div>
                            @if (Session::has('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (count($errors) > 0)
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="alert alert-danger"> {{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <form class="form" method="post" action="{{ route('login.post') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Email<span>*</span></label>
                                            <input id="email" name="email" type="email" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Password<span>*</span></label>
                                            <input id="password" name="password" type="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-group-socialite">
                                    <a href="{{ route('facebook.login') }}" class="ti-facebook btn-socialite btn-face"></a>
                                    <a href="{{ route('google.login') }}" class="ti-google btn-socialite btn-google"></a>
                                </div>
                                <input type="submit" class="btn-login" value="Login">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
