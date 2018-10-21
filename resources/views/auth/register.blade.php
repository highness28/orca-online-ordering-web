@extends('layouts.app')

@section('content')
<div class="container" style="padding: 50px 0;">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="section-title">
                    <h3 class="title">Registration</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-4">
                                    <input class="input" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert" style="color: red;">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-xs-4">
                                    <input class="input" type="password" name="password" placeholder="Password" value="{{ old('password') }}">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert" style="color: red;">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-xs-4">
                                    <input class="input" type="password" name="password_confirmation" placeholder="Password confirmation" value="{{ old('password_confirmation') }}">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" role="alert" style="color: red;">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-4">
                                    <input class="input" type="text" name="first_name" placeholder="First name" value="{{ old('first_name') }}">
                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert" style="color: red;">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-xs-4">
                                    <input class="input" type="text" name="last_name" placeholder="Last name" value="{{ old('last_name') }}">
                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert" style="color: red;">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-xs-4">
                                    <input class="input" type="number" name="phone_number" placeholder="Phone number" value="{{ old('phone_number') }}">
                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback" role="alert" style="color: red;">
                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-4 col-xs-offset-4">
                                    <button class="primary-btn order-submit" style="width: 100%;">Register</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection