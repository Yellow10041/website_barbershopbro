@extends('layouts.app')

@section('title', 'Register')

@section('section')

    <div class="container container-auth">

        <form action="{{ route('register_submit') }}" method="POST">
            @csrf

            <div class="auth__form">

                <div class="auth__form__title">Register</div>

                <div class="auth__form__help">
                    <div class="auth__form__help__item">
                        I have account.
                        <a href="{{ route('login') }}">Click here to login</a>
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
                    <input class="auth__form__inputs__item" type="text" name="name" placeholder="Name">
                    <input class="auth__form__inputs__item" type="email" name="email" placeholder="Email">
                    <input class="auth__form__inputs__item" type="password" name="password" placeholder="Password">
                    <input class="auth__form__inputs__item" type="password" name="password_repeat" placeholder="Repeat password">
                </div>

            </div>

            <button class="auth__button" type="submit">Register</button>

        </form>

    </div>



@stop
