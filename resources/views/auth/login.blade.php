@extends('layouts.simple')
 
@section('content')


    <!-- Page Content -->
    <div class="row no-gutters justify-content-center bg-body-dark">
        <div class="hero-static col-sm-12 col-md-10 col-lg-8 col-xl-6 d-flex align-items-center p-2 px-sm-0">
            <!-- Sign In Block -->
            <div class="block block-rounded block-transparent block-fx-pop w-100 mb-0 overflow-hidden bg-image" style="background-image: url('/media/photos/photo20@2x.jpg');">
                <div class="row no-gutters">
                    <div class="col-md-6 order-md-1 bg-white">
                        <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                            <!-- Header -->
                            <div class="mb-2 text-center">
                                <a class="font-w700 font-size-h1" href="/">
                                    <span class="text-dark"></span><span class="text-primary"> {{ config('app.name') }}</span>
                                </a>
                                <p class="text-uppercase font-w700 font-size-sm text-muted">{{ __('common.Login') }}</p>
                            </div>
                            <!-- END Header -->

                            <!-- Sign In Form -->
                            <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.js) -->
                            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-signin" action="{{url('auth/login')}}" method="post" aria-label="{{ __('common.Login') }}">

                                @csrf

                                <div class="form-group">
                                    <input id="email" type="email" class="form-control form-control-alt{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="{{ __('common.Email') }}">

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control form-control-alt{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ __('common.Password') }}">

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                    <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">{{ __('common.RememberMe') }}</label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-primary mt-3 mb-3">
                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i>{{ __('common.Login') }}
                                    </button>

                                    <a class="" href="{{ route('password.request') }}">
                                        {{ __('common.ForgotPassword') }}?
                                    </a>
                                </div>
                            </form>
                            <!-- END Sign In Form -->
                        </div>
                    </div>
                    <div class="col-md-6 order-md-0 bg-primary-dark-op d-flex align-items-center">
                        <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                            <div class="media">
                                <a class="img-link mr-3" href="javascript:void(0)">
                                    <img class="img-avatar img-avatar-thumb" src="/media/avatars/avatar11.jpg" alt="">
                                </a>
                                <div class="media-body">
                                    <p class="text-white font-w600 mb-1">
                                        {{ __('common.ShortAppDescription') }}
                                    </p>
                                    <a class="text-white-75 font-w600" href="javascript:void(0)">{{ __('common.Author') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Sign In Block -->
        </div>
    </div>
    <!-- END Page Content -->
@endsection
