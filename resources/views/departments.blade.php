@extends('layouts.app')

@section('title', 'Departments')

@section('section')

    <div class="container container-dep">

        <div class="container__filer">

            <form action="{{ route('departments', 'Kyiv') }}"></form>


            <div class="container__filer__box">
                <div class="container__filer__box__plate"></div>
                @foreach($cities as $town)
                    <a class="container__filer__box__item" href="{{ route('departments', $town) }}">{{$town}}</a>
                @endforeach
                <div class="container__filer__box__icon"></div>
            </div>
        </div>

        <div class="container__departments">
            @if(isset($data))
                @foreach($data as $elem)
                    <div class="container__departments__item">

                        <form class="container__departments__item__form" action="{{ route('department-view', [$city,  $elem-> id]) }}">
                            @csrf

                            <input type="number" name="cityID" value="{{$elem->city_id}}">

                        </form>

                        <div class="container__departments__item__text">
                            <div class="container__departments__item__title">{{ $elem -> name}}</div>
                            <div class="container__departments__item__subtitle">{{ $elem -> first_work_day}} - {{ $elem -> last_work_day}} {{ $elem->first_hour_work }}.{{ $elem->first_minutes_work }}-{{ $elem->last_hour_work }}.{{ $elem->last_minutes_work }}</div>
                        </div>
                        <div class="container__departments__item__info">
                            <div class="container__departments__item__phone">{{ $elem -> phone_num}}</div>
                            <div class="container__departments__item__address">{{ $elem -> address}}</div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>

    @include('inc.footers.footer_mini')

@stop

@section('custom-js')
    <script>
        $(document).ready(function() {
            $('.container__departments__item').click(function() {
                $(this).children('.container__departments__item__form').submit();
            });

            $('.container__filer__box__item-activelink').click(function() {
                $(this).children('.container__departments__item__form').submit();
            });
        });
    </script>
@stop
