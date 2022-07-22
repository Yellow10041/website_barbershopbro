@extends('layouts.app')

@section('title', 'Hello')

@section('section')

    <div class="container container-about">
        <div class="container__about__logo">
            <img src="/img/about_logo.png" alt="">
        </div>
        <div class="container__about__info">
            <div class="container__about__title">About our company</div>
            <div class="container__about__text">
                <div class="container__about__text__item">Our men’s hairdressing salon is the first who dared to breakall stereotypes, we are a symbiosis of Barbers, sculptors and classics striving for excellence. We hold weekly meetings and master classes in Kiev and Ukraine, share the secrets and subtleties of proper shaving at home with a straight razor, royal shaving rituals. Practical advice on how to care for your beard and mustache and how to style your hair correctly, selection of the correct haircut for the shape of the face. We want to help real men to be even more independent and self-confident. Bro Barbershop is a men’s club in which you will not only become better, but will also be armed with the experience of our ancestors. Bro — has the main feature, it is the first Barbershop in Kiev and Ukraine, opened by masters.</div>
                <div class="container__about__text__item">Kiev is the heart of the country and the place where the history of the barbershop hairdressing empire originates. It was in one of the cellars that a special culture of independent barber began to emerge, which is expanding its boundaries every day. An excellent confirmation of this is the first school of barbers in Ukraine, where more and more new people can pay tribute to the ancient art of men’s haircuts.</div>
            </div>
        </div>
    </div>

    @include('inc.footers.footer_miniblack')

@stop
