@extends('layouts.app')

@section('title', 'Hello')

@section('section')

    <div class="container">
        <div class="container__title">We are barber shop that offers<br>wide range of services.</div>
        <div class="container__img"></div>
        <div class="container__title container__title-middle">Our specialists can do<br>anything you want with your hair.</div>
        <div class="container__cards">

            @foreach($employees as $empoloyee)
                <div class="container__cards__item">
                    <img src="/img/user/{{ EmployeeController::user_employee($empoloyee->id)->photo }}" alt="" class="container__cards__item__img">
                    <div class="container__cards__item__img__gradient"></div>
                    <div class="container__cards__text">
                        <div class="container__cards__city">{{ City::where('id', $empoloyee->city_id)->get()->first()->city }}</div>
                        <div class="container__cards__info">
                            <div class="container__cards__name">{{EmployeeController::user_employee($empoloyee->id)->name}}</div>
                            <div class="container__cards__rate">{{ EmployeeController::employee_rating_avg($empoloyee->id) }}</div>
                            <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.33276 22L11.5014 17.2824L18.6661 22L11.5014 0L4.33276 22Z" fill="#F7F9FF" fill-opacity="0.8"/>
                                <path d="M7.99951 7L-0.000488281 9.8281L6.26821 12L7.99951 7Z" fill="#F7F9FF" fill-opacity="0.8"/>
                                <path d="M22.9995 9.8281L14.9995 7L16.7308 12L22.9995 9.8281Z" fill="#F7F9FF" fill-opacity="0.8"/>
                            </svg>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <footer class="footer">
        <div class="footer__inner">
            <div class="footer__title">We have many branches all over the country and abroad.</div>
            <div class="footer__box">
                <div class="footer__box__item">
                    <div class="footer__department">
{{--                        <div class="footer__department__item">--}}
{{--                            <div class="footer__department__item__name">ВАТРАЛЬ I</div>--}}
{{--                            <div class="footer__department__item__address">вул. ВАЛОВА, 5А м. Тернопіль</div>--}}
{{--                            <div class="footer__department__item__phone">+098 052 38 61</div>--}}
{{--                        </div>--}}
{{--                        <div class="footer__department__item">--}}
{{--                            <div class="footer__department__item__name">ВАТРАЛЬ II</div>--}}
{{--                            <div class="footer__department__item__address">вул. ВАЛОВА, 5А м. Тернопіль</div>--}}
{{--                            <div class="footer__department__item__phone">+098 052 38 61</div>--}}
{{--                        </div>--}}
{{--                        <div class="footer__department__item">--}}
{{--                            <div class="footer__department__item__name">ВАТРАЛЬ III</div>--}}
{{--                            <div class="footer__department__item__address">вул. ВАЛОВА, 5А м. Тернопіль</div>--}}
{{--                            <div class="footer__department__item__phone">+098 052 38 61</div>--}}
{{--                        </div>--}}
                        <a class="footer__department__btn" href="{{ route('departments', ['city' => 'Ternopil']) }}">Book online</a>
                    </div>
                </div>
                <div class="footer__box__item">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d20956.361547213026!2d25.9379577!3d48.96214539724847!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sua!4v1643976682450!5m2!1sru!2sua" width="700" height="500" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </footer>

    <footer class="footer-miniblack">
        <div class="footer__inner">
            <div class="footer__contact footer__contact-miniblack">
                <div class="footer__contact__item">Bro Barbershop (c) 2022</div>
                <a class="footer__contact__item" href="{{ route('about') }}">Contacts</a>
                <div class="footer__contact__item">broinfo@gmail.com</div>
            </div>
        </div>
    </footer>

@stop
