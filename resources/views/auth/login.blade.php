@extends('layouts.app')

@section('content')
<div style="padding-top: 10%;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="pb-5">
                    <h4 class="text-center text-success mb-3 fw-bold">Login</h4>
                    <h2 class="text-light text-center fw-bold">Welcome Back</h2>
                </div>
                <div class="card py-5 bg-dark border-0">
                    <div class="card-body px-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('email') {{ $message }} is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <label for="floatingPassword">Password</label>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="row d-flex justify-content-center">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-outline-light w-100 py-3">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link d-flex justify-content-center text-light" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection