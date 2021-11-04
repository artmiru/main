@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-floating mb-3">
                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror" name="name"
                                       value="Тест Имя" required autocomplete="name" autofocus
                                       placeholder="Имя">
                            <!-- {{ old('name') }} -->
                                <label for="name">Имя:</label>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input id="family" type="text"
                                       class="form-control @error('family') is-invalid @enderror" name="family"
                                       value="Тест фамилия" required autocomplete="family" autofocus
                                       placeholder="Фамилия">
                                <label for="family">Фамилия:</label>
                                @error('family')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input id="phone" type="text"
                                       class="form-control @error('phone') is-invalid @enderror" name="phone"
                                       value="+79219245228" required autocomplete="phone" autofocus
                                       placeholder="Телефон">
                                <label for="phone">Телефон:</label>

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-floating mb-3">
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="artmiru@gmail.com" required autocomplete="email" placeholder="Емайл">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">

                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="new-password" placeholder="Пароль">
                                <label for="password">{{ __('Password') }}</label>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required autocomplete="new-password"
                                       placeholder="Повторить пароль">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            </div>
                            <div class="mb-2 row text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
