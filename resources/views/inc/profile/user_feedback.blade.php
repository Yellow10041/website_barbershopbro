<div class="profile__info__content">
    <div class="profile__feedback__content__title">
        <div class="profile__feedback__content__title-right">Your feedbacks</div>
    </div>

    <div class="profile__feedback__content__items">
        @if (isset($feedbacks[0]))

            @foreach ($feedbacks as $feedback)

                <div class="profile__feedback__content__item">

                    <form class="profile__feedback__content__item__form" action="{{ route('feedback-delete') }}" method="POST">
                        @csrf

                        <div class="profile__feedback__content__item__form__text">
                            <input class="profile__feedback__content__item__id" type="text" name="id" value="{{$feedback->id}}">

                            <div class="profile__feedback__content__item__form__text__field">
                                {{$feedback->text }}
                            </div>
                            <div class="profile__feedback__content__item__form__text__delete__container">
                                <button class="profile__feedback__content__item__form__text__delete" type="submit"><i class="fas fa-trash"></i></button>
                                <div class="profile__feedback__content__item__form__text__rate">
                                    {{ $feedback->score }} <i class="fas fa-star"></i>
                                </div>
                            </div>

                        </div>

                        <div class="profile__feedback__content__item__form__rate">
                            @for ($i = 1; $i <= 10; $i++)

                                @if ($feedback->score == $i)
                                    <div class="profile__feedback__content__item__form__rate__item profile__feedback__content__item__form__rate__item-active">{{$i}}</div>
                                @else
                                    <div class="profile__feedback__content__item__form__rate__item">{{$i}}</div>
                                @endif
                            @endfor
                        </div>
                    </form>
                </div>

            @endforeach

        @else

            <div class="profile__feedback__content__item">
                <div class="profile__feedback__content__item__massage">Leave feedback</div>
            </div>

        @endif


    </div>
</div>
