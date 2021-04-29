@extends('layouts.master-without-nav')

@section('title') Login @stop

@section('content')
<!-- Begin page -->
<div class="wrapper-page">
    <div class="card">
        <div class="card-body">

            <h3 class="text-center m-0">
                Greenicc Furniture
                <!-- <a href="index" class="logo logo-admin"><img src="{{URL::asset('assets/images/logo.png')}}" height="30" alt="logo"></a> -->
            </h3>

            <div class="p-3">
                <h4 class="text-muted font-18 m-b-5 text-center">Welcome Back !</h4>
                <p class="text-muted text-center">Sign in to continue to Cpanel.</p>

                <form class="form-horizontal m-t-30" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <!-- <label for="username">Username</label> -->
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Enter username" value="{{ old('username') }}">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <!-- <label for="userpassword">Password</label> -->
                        <input type="password" class="form-control @error('email') is-invalid @enderror" name="password" id="userpassword" placeholder="Enter password" autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }} </strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row m-t-20">
                        <div class="col-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="remember" id="customControlInline" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>

                    <div class="form-group m-t-10 mb-0 row">
                        <div class="col-12 m-t-20">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="m-t-40 text-center">
        <p>© {{date('Y')}} {{ config('app.name') }}. Crafted with <i class="mdi mdi-heart text-danger"></i> by KeennessSolutions</p>
    </div>
</div>
@endsection
