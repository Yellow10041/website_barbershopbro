@extends('layouts.app')

@section('title', 'Departments')

@section('section')
<div class="container-feedback">

    <div class="container container-feed">
        <div class="container__title container__title-feed">You can leave feedback about our barber.<3</div>
        <form class="feedback__form" action="{{ route('feedback_add') }}" method="post">
            @csrf



            @if (Auth::user())
                <textarea class="container__textarea" name="text" ></textarea>
            @else
                <textarea class="container__textarea" name="text" disabled placeholder="To leave a review, login to the site"></textarea>
            @endif


            <div class="container__rating">
                <div class="container__rating__inner">
                    @for ($i = 1; $i <= 10; $i++)
                        @if (Auth::user())
                            <div class="container__rating__item container__rating__item-auth">{{$i}}</div>
                        @else
                            <div class="container__rating__item">{{$i}}</div>
                        @endif
                    @endfor
                </div>
            </div>
            <input class="container__rating__num" name="score" type="number">

            <div class="container__submit">
                @if (Auth::user())
                    <button class="container__submit__btn container__submit__btn-auth" type="submit">Confirm</button>
                @else
                    <button class="container__submit__btn" type="submit">Confirm</button>
                @endif

            </div>
        </form>


        @if ($errors->any())

            <div class="alert">
                <div class="errors">
                    @foreach ($errors->all() as $error)
                        <div class="error">{{ $error }}</div>
                    @endforeach
                </div>

                <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17 0C7.61175 0 0 7.61175 0 17C0 26.3882 7.61175 34 17 34C26.3882 34 34 26.3882 34 17C34 7.61175 26.3882 0 17 0ZM17 27.8517C15.6712 27.8517 14.7617 26.8274 14.7617 25.5C14.7617 24.1343 15.7094 23.1483 17 23.1483C18.3642 23.1483 19.2383 24.1343 19.2383 25.5C19.2383 26.8288 18.3642 27.8517 17 27.8517ZM17.8812 18.8714C17.5426 20.026 16.4758 20.0458 16.1202 18.8714C15.7108 17.5171 14.2559 12.376 14.2559 9.03692C14.2559 4.63108 19.7682 4.60983 19.7682 9.03692C19.7668 12.3958 18.2339 17.6701 17.8812 18.8714Z" fill="#C4C4C4"/>
                </svg>
            </div>
        @endif


    </div>



    <div class="container container-feedcomments">
        <div class="container__comments">
            @foreach($data as $elem)
                <div class="container__comments__item">
                    <div class="container__comments__info">
                        <div class="container__comments__img">
                            @if (User::where('id', $elem->user_ID)->get()->first()->photo)
                                <img src="/img/user/{{ User::where('id', $elem->user_ID)->get()->first()->photo }}" alt="" class="container__comments__img__inner">
                            @else
                                <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M45 0C50.9674 0 56.6903 2.37053 60.9099 6.5901C65.1295 10.8097 67.5 16.5326 67.5 22.5C67.5 28.4674 65.1295 34.1903 60.9099 38.4099C56.6903 42.6295 50.9674 45 45 45C39.0326 45 33.3097 42.6295 29.0901 38.4099C24.8705 34.1903 22.5 28.4674 22.5 22.5C22.5 16.5326 24.8705 10.8097 29.0901 6.5901C33.3097 2.37053 39.0326 0 45 0V0ZM45 56.25C69.8625 56.25 90 66.3187 90 78.75V90H0V78.75C0 66.3187 20.1375 56.25 45 56.25Z" fill="#E2E2E2"/>
                                </svg>
                            @endif
                        </div>
                        <div class="container__comments__info__inner">
                            <div class="container__comments__name">{{ User::where('id', $elem->user_ID)->get()->first()->name }}</div>
                            <div class="container__comments__orders">
                                @if (UserController::user_orders($elem->user_ID))
                                    {{ UserController::user_orders($elem->user_ID) }} orders
                                @else
                                    no orders
                                @endif
                            </div>
                        </div>

                        <div class="container__comments__info__rating">{{ $elem->score }} <i class="fas fa-star"></i></div>

                    </div>
                    <div class="container__comments__text">
                        <div class="container__comments__texts">{{ $elem->text }}</div>
                        <div class="container__comments__rating">
                            <div class="container__comments__rating__item">{{ $elem->score }} <i class="fas fa-star"></i></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@include('inc.footers.footer_miniblack')

@stop
