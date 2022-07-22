@extends('layouts.app')

@section('title', 'Profile')

@section('section')


    <div class="profile__content">{{ $content }}</div>
    <div class="profile__category">{{ $category }}</div>

    <div class="container container-profile">

        <div class="profile__info">

            <div class="profile__info__switcher">
                @if(Gate::check('profile_moderator'))
                    <a class="profile__info__switcher__item" data-switch="user-info" href="{{ route('profile', ['category' => 'user-info']) }}">Your info</a>
                    <a class="profile__info__switcher__item" data-switch="user-feedback" href="{{ route('profile', ['category' => 'user-feedback']) }}">Feedbacks</a>
                    <a class="profile__info__switcher__item" data-switch="user-orders" href="{{ route('profile', ['category' => 'user-orders']) }}">All orders</a>
                @elseif(Gate::check('profile_barber'))
                    <a class="profile__info__switcher__item" data-switch="user-info" href="{{ route('profile', ['category' => 'user-info']) }}">Your info</a>
                    <a class="profile__info__switcher__item" data-switch="user-orders" href="{{ route('profile', ['category' => 'user-orders']) }}">My orders</a>
                @else
                    <a class="profile__info__switcher__item" data-switch="user-info" href="{{ route('profile', ['category' => 'user-info']) }}">Your info</a>
                    <a class="profile__info__switcher__item" data-switch="user-feedback" href="{{ route('profile', ['category' => 'user-feedback']) }}">Feedback</a>
                    <a class="profile__info__switcher__item" data-switch="user-orders" href="{{ route('profile', ['category' => 'user-orders']) }}">Orders</a>
                @endif

            </div>

            @if ($errors->any())
                <div class="profile__errors-info">
                    @foreach ($errors->all() as $error)
                        <div class="profile__error-info">{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="profile__info__contents">

            </div>

        </div>


        @if(Gate::check('profile_moderator'))
            <div class="profile__user_info">
                <div class="profile__user_info__photo">
                    <div class="profile__user_info__photo__img">
                        @if (Auth::user()->photo)
                            <img src="/img/user/{{ Auth::user()->photo }}" alt="" class="profile__user_info__photo__img__inner">
                        @else

                            <div class="profile__user_info__photo__img__icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>upload photo</span>
                            </div>

                        @endif

                            <form class="profile__user_info__photo__img__form" action="{{ route('user-update-photo') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input name="image" type="file" class="profile__user_info__photo__img__input">
                            </form>
                    </div>
                </div>
                <div class="profile__user_info__name">{{Auth::user()->name}}</div>
                <div class="profile__user_info__year">
                    Moderator in
                    {{
                        Departments::where('id', ModeratorController::moderator_user(Auth::user()->id)->department_id)->get()->first()->name
                    }}
                </div>
            </div>
        @elseif(Gate::check('profile_barber'))
            <div class="profile__user_info">
                <div class="profile__user_info__photo">
                    <div class="profile__user_info__photo__img">
                        @if (Auth::user()->photo)
                            <img src="/img/user/{{ Auth::user()->photo }}" alt="" class="profile__user_info__photo__img__inner">
                        @else

                            <div class="profile__user_info__photo__img__icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>upload photo</span>
                            </div>

                        @endif

                            <form class="profile__user_info__photo__img__form" action="{{ route('user-update-photo') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input name="image" type="file" class="profile__user_info__photo__img__input">
                            </form>
                    </div>
                </div>
                <div class="profile__user_info__name">{{Auth::user()->name}}</div>
                <div class="profile__user_info__year">
                    Barber in
                    {{
                        Departments::where('id', EmployeeController::employee_user(Auth::user()->id)->department_id)->get()->first()->name
                    }}
                </div>
            </div>
        @else
            <div class="profile__user_info">
                <div class="profile__user_info__photo">
                    <div class="profile__user_info__photo__img">
                        @if (Auth::user()->photo)
                            <img src="/img/user/{{ Auth::user()->photo }}" alt="" class="profile__user_info__photo__img__inner">
                        @else

                            <div class="profile__user_info__photo__img__icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>upload photo</span>
                            </div>

                        @endif

                            <form class="profile__user_info__photo__img__form" action="{{ route('user-update-photo') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input name="image" type="file" class="profile__user_info__photo__img__input">
                            </form>
                    </div>
                </div>
                <div class="profile__user_info__name">{{Auth::user()->name}}</div>
                <div class="profile__user_info__year">
                    Total orders:
                    {{
                        count(Order::where('user_id', Auth::user()->id)->get())
                    }}
                </div>

            </div>
        @endif

    </div>


    <div class="container container-profile-mob">

        @if(Gate::check('profile_moderator'))
            <div class="profile__user_info">
                <div class="profile__user_info__photo">
                    <div class="profile__user_info__photo__img">
                        @if (Auth::user()->photo)
                            <img src="/img/user/{{ Auth::user()->photo }}" alt="" class="profile__user_info__photo__img__inner">
                        @else

                            <div class="profile__user_info__photo__img__icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>upload photo</span>
                            </div>

                        @endif

                        <form class="profile__user_info__photo__img__form" action="{{ route('user-update-photo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input name="image" type="file" class="profile__user_info__photo__img__input">
                        </form>
                    </div>
                </div>
                <div class="profile__user_info__name">{{Auth::user()->name}}</div>
                <div class="profile__user_info__year">
                    Moderator in
                    {{
                        Departments::where('id', ModeratorController::moderator_user(Auth::user()->id)->department_id)->get()->first()->name
                    }}
                </div>
            </div>
        @elseif(Gate::check('profile_barber'))
            <div class="profile__user_info">
                <div class="profile__user_info__photo">
                    <div class="profile__user_info__photo__img">
                        @if (Auth::user()->photo)
                            <img src="/img/user/{{ Auth::user()->photo }}" alt="" class="profile__user_info__photo__img__inner">
                        @else

                            <div class="profile__user_info__photo__img__icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>upload photo</span>
                            </div>

                        @endif

                        <form class="profile__user_info__photo__img__form" action="{{ route('user-update-photo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input name="image" type="file" class="profile__user_info__photo__img__input">
                        </form>
                    </div>
                </div>
                <div class="profile__user_info__name">{{Auth::user()->name}}</div>
                <div class="profile__user_info__year">
                    Barber in
                    {{
                        Departments::where('id', EmployeeController::employee_user(Auth::user()->id)->department_id)->get()->first()->name
                    }}
                </div>
            </div>
        @else
            <div class="profile__user_info">
                <div class="profile__user_info__photo">
                    <div class="profile__user_info__photo__img">
                        @if (Auth::user()->photo)
                            <img src="/img/user/{{ Auth::user()->photo }}" alt="" class="profile__user_info__photo__img__inner">
                        @else

                            <div class="profile__user_info__photo__img__icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>upload photo</span>
                            </div>

                        @endif

                        <form class="profile__user_info__photo__img__form" action="{{ route('user-update-photo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input name="image" type="file" class="profile__user_info__photo__img__input">
                        </form>
                    </div>
                </div>
                <div class="profile__user_info__name">{{Auth::user()->name}}</div>
                <div class="profile__user_info__year">
                    Total orders:
                    {{
                        count(Order::where('user_id', Auth::user()->id)->get())
                    }}
                </div>

            </div>
        @endif

        <div class="profile__info">

            <div class="profile__info__switcher">
                @if(Gate::check('profile_moderator'))
                    <a class="profile__info__switcher__item" data-switch="user-info" href="{{ route('profile', ['category' => 'user-info']) }}">Your info</a>
                    <a class="profile__info__switcher__item" data-switch="user-feedback" href="{{ route('profile', ['category' => 'user-feedback']) }}">Feedbacks</a>
                    <a class="profile__info__switcher__item" data-switch="user-orders" href="{{ route('profile', ['category' => 'user-orders']) }}">All orders</a>
                @elseif(Gate::check('profile_barber'))
                    <a class="profile__info__switcher__item" data-switch="user-info" href="{{ route('profile', ['category' => 'user-info']) }}">Your info</a>
                    <a class="profile__info__switcher__item" data-switch="user-orders" href="{{ route('profile', ['category' => 'user-orders']) }}">My orders</a>
                @else
                    <a class="profile__info__switcher__item" data-switch="user-info" href="{{ route('profile', ['category' => 'user-info']) }}">Your info</a>
                    <a class="profile__info__switcher__item" data-switch="user-feedback" href="{{ route('profile', ['category' => 'user-feedback']) }}">Feedback</a>
                    <a class="profile__info__switcher__item" data-switch="user-orders" href="{{ route('profile', ['category' => 'user-orders']) }}">Orders</a>
                @endif

            </div>

            @if ($errors->any())
                <div class="profile__errors-info">
                    @foreach ($errors->all() as $error)
                        <div class="profile__error-info">{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="profile__info__contents">

            </div>

        </div>




    </div>



@stop



@section('custom-js')
    <script>
        $(document).ready(function() {




            {{--$('.profile__info__switcher__item').on('click', function() {--}}
            {{--    console.log(1);--}}



            {{--    $('.profile__info__switcher__item').removeClass('profile__info__switcher__item-active');--}}
            {{--    $(this).addClass('profile__info__switcher__item-active');--}}

            {{--    let category = $(this).data('switch');--}}

            {{--    console.log(category);--}}

            {{--    let link = location.pathname;--}}
            {{--    let newLink = link + '?';--}}
            {{--    newLink += 'category=' +  category;--}}
            {{--    history.pushState({}, '', newLink)--}}

            {{--    $.ajax({--}}
            {{--        type: "GET",--}}
            {{--        url: "{{ route('profile') }}",--}}
            {{--        headers: {--}}
            {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--        },--}}
            {{--        data: {--}}
            {{--            category : category--}}
            {{--        },--}}

            {{--        success: (data) => {--}}
            {{--            console.log(data);--}}
            {{--            $('.profile__info__contents').html(data);--}}
            {{--        }--}}
            {{--    });--}}

            {{--});--}}












            $('.profile__info__contents').html($('.profile__content').text());

            $('.profile__orders__content__item__container__menu__item-info').click(function () {

                if($(this).hasClass('profile__orders__content__item__container__menu__item-active')) {
                    $(this).parents('.profile__orders__content__item').children('.profile__orders__content__item__container__menu').children('.profile__orders__content__item__container__menu__item').removeClass('profile__orders__content__item__container__menu__item-active');
                    $(this).parents('.profile__orders__content__item').children('.profile__orders__content__item__container-rate').removeClass('profile__orders__content__item__container-active');
                    $(this).parents('.profile__orders__content__item').children('.profile__orders__content__item__container-info').removeClass('profile__orders__content__item__container-active');
                    $(this).parents('.profile__orders__content__item').children('.profile__orders__content__item__container').removeClass('profile__orders__content__item__container-close');
                }
                else {
                    $(this).parents('.profile__orders__content__item').children('.profile__orders__content__item__container__menu').children('.profile__orders__content__item__container__menu__item').removeClass('profile__orders__content__item__container__menu__item-active');
                    $(this).addClass('profile__orders__content__item__container__menu__item-active')
                    $(this).parents('.profile__orders__content__item').children('.profile__orders__content__item__container-info').addClass('profile__orders__content__item__container-active');
                    $(this).parents('.profile__orders__content__item').children('.profile__orders__content__item__container-rate').removeClass('profile__orders__content__item__container-active');
                    $(this).parents('.profile__orders__content__item').children('.profile__orders__content__item__container').addClass('profile__orders__content__item__container-close');
                }

            })

            $('.profile__orders__content__item__container__menu__item-rate').click(function () {

                if($(this).hasClass('profile__orders__content__item__container__menu__item-active')) {
                    $(this).parents('.profile__orders__content__item').children('.profile__orders__content__item__container__menu').children('.profile__orders__content__item__container__menu__item').removeClass('profile__orders__content__item__container__menu__item-active');
                    $(this).parents('.profile__orders__content__item').children('.profile__orders__content__item__container-rate').removeClass('profile__orders__content__item__container-active');
                    $(this).parents('.profile__orders__content__item').children('.profile__orders__content__item__container-info').removeClass('profile__orders__content__item__container-active');
                    $(this).parents('.profile__orders__content__item').children('.profile__orders__content__item__container').removeClass('profile__orders__content__item__container-close');

                }
                else {
                    console.log(1);
                    $(this).parents('.profile__orders__content__item').children('.profile__orders__content__item__container__menu').children('.profile__orders__content__item__container__menu__item').removeClass('profile__orders__content__item__container__menu__item-active');
                    $(this).addClass('profile__orders__content__item__container__menu__item-active')
                    $(this).parents('.profile__orders__content__item').children('.profile__orders__content__item__container-rate').addClass('profile__orders__content__item__container-active');
                    $(this).parents('.profile__orders__content__item').children('.profile__orders__content__item__container-info').removeClass('profile__orders__content__item__container-active');
                    $(this).parents('.profile__orders__content__item').children('.profile__orders__content__item__container').addClass('profile__orders__content__item__container-close');
                }

            })

            $('.profile__info__switcher__item').removeClass('profile__info__switcher__item-active').each(function () {
                console.log($(this).data('switch'), $('.profile__category').text() );
                if ($(this).data('switch') == $('.profile__category').text()) {
                    $(this).addClass('profile__info__switcher__item-active');
                }
            });

            $('.profile__info__content__title__button').click(function () {
                $(this).closest('.profile__info__content').children('.profile__info__content__details').children('.profile__info__content__details__fields_value').submit();
            })

            function infoApply() {
                console.log(1)
            }

            $('.profile__orders__content__rate__item').click(function () {
                let index = $(this).parents('.profile__orders__content__item').index();
                $('.profile__orders__form__input').eq(index)[0].value = $(this).text();
                $('.profile__orders__form').eq(index).submit();
            })

            $('.profile__orders__content__barber__photo__rate').click(function () {
                console.log(1);
                let index = $(this).parents('.profile__orders__content__item').index();
                console.log(index)
                if ($(this).hasClass('profile__orders__content__barber__photo__rate-active')) {
                    $(this).removeClass('profile__orders__content__barber__photo__rate-active');
                    $('.profile__orders__content__rate').eq(index).removeClass('profile__orders__content__rate-open')
                    $('.profile__orders__content__info').eq(index).removeClass('profile__orders__content__info-close')
                }
                else {
                    $(this).addClass('profile__orders__content__barber__photo__rate-active');
                    $('.profile__orders__content__rate').eq(index).addClass('profile__orders__content__rate-open')
                    $('.profile__orders__content__info').eq(index).addClass('profile__orders__content__info-close')
                }

            });


            let time = 500;
            function fileInput(){
                let file1 = $('.profile__user_info__photo__img__input').eq(0)[0].files[0]
                let file2 = $('.profile__user_info__photo__img__input').eq(1)[0].files[0]
                if (file1) {
                    $(".profile__user_info__photo__img__form").eq(0).submit();
                }
                if (file2) {
                    $(".profile__user_info__photo__img__form").eq(1).submit();
                }
                setTimeout(fileInput, time);
            };

            fileInput();

        });
    </script>
@stop
