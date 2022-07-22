@extends('layouts.app')

@section('title', 'Login')

@section('section')

    <div class="container container-auth">

        <form action="{{ route('login_submit') }}" method="POST">
            @csrf

            <div class="auth__form">

                <div class="auth__form__title">Login</div>

                <div class="auth__form__help">
                    <div class="auth__form__help__item">
                        I dont have account yet.
                        <a href="{{ route('register') }}">Click here to register</a>
                    </div>
                </div>

                <div class="auth__form__inputs">
                    @if ($errors->any())
                        <div class="auth__errors">
                            @foreach ($errors->all() as $error)
                                <span class="auth__error">{{ $error }}</span>
                            @endforeach
                        </div>
                    @endif
                    <input class="auth__form__inputs__item" type="email" name="email" placeholder="Email">
                    <input class="auth__form__inputs__item" type="password" name="password" placeholder="Password">
                </div>

            </div>

            <button class="auth__button" type="submit">Login</button>

        </form>

    </div>



@stop
