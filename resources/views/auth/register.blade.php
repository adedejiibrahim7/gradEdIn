@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="panel" style="padding:50px;">
{{--                <div class="panel-header">{{ __('Register') }}</div>--}}

                <div class="panel-body">
                    <div class="display-4 text-center mb-5">Signup</div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">

                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                            <div class="">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

                            <div class="">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="">
                            <p class="">Here to:</p>
                            <div class="input-group row pl-4 pb-3">
                                <div class="form-check col">
                                    <input type="radio" class="form-check-input" id="seeker" value="seeker" name="purpose">
                                    <label class="form-check-label" for="seeker">Seek Opportunities</label>
                                </div>
                                <div class="form-check col">
                                    <input type="radio" class="form-check-input" id="employer" value="employer" name="purpose">
                                    <label class="form-check-label" for="employer">Recruit Talents</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Signup
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
