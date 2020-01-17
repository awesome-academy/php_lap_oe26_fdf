@extends('client.layout.master')
@section('title', trans('message.signin'))
@section('content')
<div class="container ">
    <hr>
    <div class="row" >
        <div class="col-md-5">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <fieldset>
                    <h4 class="text-uppercase pull-center">
                        {{ trans('message.signin') }}
                    </h4>
                    </br>
                    <div class="form-group">
                        <label>{{ trans('message.email') }}</label> <span id="color"> *</span>
                        <input type="email" name="email" class="form-control input-lg"
                            value="{{ old('email') }}" placeholder="{{ trans('message.email') }}" required autofocus >
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{ trans('message.password') }}</label> <span id="color"> *</span>
                        <input type="password" name="password" class="form-control input-lg" placeholder="{{ trans('message.password') }}" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input"
                                {{ old('remember') ? 'checked' : '' }}>
                                {{ trans('message.remember') }}
                        </label>
                    </div>
                    </br>
                    <div>
                        <input type="submit" class="btn btn-lg btn-primary" value="{{ trans('message.signin') }}">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
</br>
@endsection
