@extends('layouts.app')

@section('title', 'View')

@section('section')

    <div class="container container-depview">

        <div class="container__title container__title-depview">{{ $data[0]->name }}</div>

        <div class="container__dep__img"><img src="/img/dep_img.png" alt=""></div>

    </div>

    <div class="container container-depviews">

        <div class="container__schedule">
            <div class="container__schedule__item">
                <div class="container__schedule__title">{{ $data[0]->first_work_day }} — {{ $data[0]->last_work_day }} {{ $data[0]->first_hour_work }}.{{ $data[0]->first_minutes_work }}-{{ $data[0]->last_hour_work }}.{{ $data[0]->last_minutes_work }}</div>
                <div class="container__schedule__phonenum">{{ $data[0]->phone_num }}</div>
                <div class="container__schedule__address">{{ $data[0]->address }}</div>
            </div>
            <div class="container__schedule__photo">
                <img src="/img/dep_icon.png">
            </div>
        </div>

        <div class="container__services">
            <div class="container__services__borer">
                <div class="container__services__inner">
                    @foreach($services as $service)
                        <div class="container__services__item" data-time="{{ $service->time }}">
                            <div class="container__services__title">
                                <div class="container__services__name">{{ $service->name }}</div>
                                <div class="container__services__icon__box">
                                    @include('inc.services_icons.service_icon_' . $service->icon)
                                </div>
                            </div>
                            <div class="container__services__info">
                                <div class="container__services__price">{{ $service->price }}$</div>
                                <div class="container__services__time">

                                    Approximate execution time —

                                    @if(floor($service->time / 60) != 0)
                                        {{ floor($service->time / 60) }} hour

                                        @if($service->time % 60 != 0)
                                            {{ $service->time % 60}} min

                                        @endif
                                    @else
                                        {{ $service->time % 60}} min
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        <div class="container__timetable">
            <div class="container__timetable__inner">
                <label class="container__timetable__date" for="date">
                    <span class="container__timetable__date__num"></span><i class="far fa-calendar-alt"></i>
                    <input class="container__timetable__date__input" type="date" name="" id="date" min="{{date('Y-m-d')}}">
                </label>
                <div class="container__timetable__time">
                    @for ($i = $data[0]->first_hour_work; $i <= $data[0]->last_hour_work; $i++)
                        @if ($i == $data[0]->first_hour_work + 1)
                            <div class="container__timetable__time__item container__timetable__time__item-active"><span>{{$i}}</span>:00</div>
                        @else
                            <div class="container__timetable__time__item"><span>{{$i}}</span>:00</div>
                        @endif
                    @endfor
                </div>

                <div class="container__timetable__time-mob">
                    <div class="container__timetable__time-mob">
                        <div class="container__timetable__time__container">
                            @for ($i = $data[0]->first_hour_work; $i <= $data[0]->last_hour_work && $i < $data[0]->first_hour_work + 4; $i++)
                                @if ($i == $data[0]->first_hour_work + 1)
                                    <div class="container__timetable__time__item container__timetable__time__item-active"><span>{{$i}}</span>:00</div>
                                @else
                                    <div class="container__timetable__time__item"><span>{{$i}}</span>:00</div>
                                @endif
                            @endfor
                        </div>

                        @if ($data[0]->last_hour_work - $data[0]->first_hour_work > 4)
                            @if ($data[0]->last_hour_work - $data[0]->first_hour_work >= 11)
                                <div class="container__timetable__time__container">
                                    @for ($i = $data[0]->first_hour_work + 4; $i <= $data[0]->last_hour_work && $i < $data[0]->first_hour_work + 8; $i++)
                                        <div class="container__timetable__time__item"><span>{{$i}}</span>:00</div>
                                    @endfor
                                </div>
                                <br>
                            @else
                                <div class="container__timetable__time__container container__timetable__time__container-center">
                                    @for ($i = $data[0]->first_hour_work + 4; $i <= $data[0]->last_hour_work && $i < $data[0]->first_hour_work + 8; $i++)
                                        <div class="container__timetable__time__item"><span>{{$i}}</span>:00</div>
                                    @endfor
                                </div>
                                <br>
                            @endif
                        @endif

                        @if ($data[0]->last_hour_work - $data[0]->first_hour_work > 8)
                            <div class="container__timetable__time__container">
                                @for ($i = $data[0]->first_hour_work + 8; $i <= $data[0]->last_hour_work && $i < $data[0]->first_hour_work + 12; $i++)
                                    <div class="container__timetable__time__item"><span>{{$i}}</span>:00</div>
                                @endfor
                            </div>
                        @endif
                    </div>
                </div>

                <div class="container__timetable__timeminuts">
                    <div class="container__timetable__timeminuts__item"><span>{{$data[0]->first_hour_work + 1}}</span>:<span>00</span> <i class="fas fa-hourglass-half"></i></div>
                    <div class="container__timetable__timeminuts__item"><span>{{$data[0]->first_hour_work + 1}}</span>:<span>15</span> <i class="fas fa-hourglass-half"></i></div>
                    <div class="container__timetable__timeminuts__item"><span>{{$data[0]->first_hour_work + 1}}</span>:<span>30</span> <i class="fas fa-hourglass-half"></i></div>
                    <div class="container__timetable__timeminuts__item"><span>{{$data[0]->first_hour_work + 1}}</span>:<span>45</span> <i class="fas fa-hourglass-half"></i></div>
                </div>
            </div>
        </div>

        <div class="container__card__mob">

            @foreach ($employees as $employee)
                <div class="container__card__item">
                    <div class="container__card__item__id">{{ $employee->id }}</div>
                    <div class="container__card__mob__indicate"></div>
                    <div class="container__card__item__name">{{ User::where('id', $employee->user_id)->get()->first()->name }}</div>
                    <div class="container__card__item__rate">Average ratings {{ EmployeeController::employee_rating_avg($employee->id) }}/10.</div>
                    <div class="container__card__item__order">
                        <div class="container__map__employercard__img">
                            @if(EmployeeController::user_employee($employee->id)->photo)
                                <img src="/img/user/{{ EmployeeController::user_employee($employee->id)->photo }}" alt="">
                            @else
                                <svg width="110" height="110" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M55 0C62.2935 0 69.2882 2.89731 74.4454 8.05456C79.6027 13.2118 82.5 20.2065 82.5 27.5C82.5 34.7935 79.6027 41.7882 74.4454 46.9454C69.2882 52.1027 62.2935 55 55 55C47.7065 55 40.7118 52.1027 35.5546 46.9454C30.3973 41.7882 27.5 34.7935 27.5 27.5C27.5 20.2065 30.3973 13.2118 35.5546 8.05456C40.7118 2.89731 47.7065 0 55 0ZM55 68.75C85.3875 68.75 110 81.0563 110 96.25V110H0V96.25C0 81.0563 24.6125 68.75 55 68.75Z" fill="#494949"/>
                                </svg>
                            @endif
                        </div>
                        <div class="container__map__employercard__bottom">
                            @if (Auth::user())
                                <div class="container__mob__employercard__button">Order now</div>
                                <div class="container__mob__employercard__engaged">Engaged</div>
                            @else
                                <div class="container__map__employercard__massage">
                                    You must have account to order.
                                    <a href="{{ route('register') }}">Click here to register.</a></div>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="container__map">
            <div class="container__map__inner">

                @include('inc.maps.map_' . $data[0]->map)


                @for($i = 0; $i < count($employees); $i++)
                    <svg class="container__map__point__item" width="76" height="89" viewBox="0 0 76 89" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M62.189 33.1132C59.493 33.0481 56.839 32.4286 54.3909 31.2932C51.9428 30.1578 49.7525 28.5305 47.9555 26.5118C48.9201 30.6319 48.3598 34.9636 46.3791 38.6997C44.3983 42.4358 41.1322 45.3216 37.1893 46.8193C33.2463 48.317 28.8955 48.3245 24.9475 46.8403C20.9995 45.3562 17.7235 42.4817 15.73 38.7524C13.7365 35.0232 13.1615 30.6934 14.112 26.57C15.0625 22.4466 17.4738 18.8108 20.8965 16.3399C24.3192 13.8691 28.52 12.7318 32.7161 13.1399C36.9121 13.548 40.8173 15.4737 43.7039 18.5583C42.5374 14.3097 42.8257 9.79101 44.5226 5.72659C39.7945 3.43412 34.5644 2.38368 29.3218 2.67363C24.0792 2.96357 18.9956 4.58442 14.547 7.38441C10.0984 10.1844 6.43025 14.072 3.88605 18.6831C1.34184 23.2942 0.00476316 28.4781 0 33.7495C0 46.1305 6.91869 56.4965 11.9889 64.0524L12.9131 65.431C17.9576 72.7711 23.3692 79.8499 29.1272 86.6404L31.1341 88.9999L33.141 86.6404C38.8982 79.8494 44.3098 72.7705 49.3551 65.431L50.2793 64.0259C55.3231 56.47 62.2418 46.1305 62.2418 33.7495C62.2154 33.5374 62.189 33.3253 62.189 33.1132V33.1132Z" fill="#7C7C7C"/>
                        <path d="M31.1077 40.2182C36.5476 40.2182 40.9576 35.7908 40.9576 30.3293C40.9576 24.8678 36.5476 20.4404 31.1077 20.4404C25.6678 20.4404 21.2578 24.8678 21.2578 30.3293C21.2578 35.7908 25.6678 40.2182 31.1077 40.2182Z" fill="#7C7C7C"/>
                        <path class="container__map__point__item-color" d="M62.7964 26.5117C70.0885 26.5117 76 20.5769 76 13.2559C76 5.93485 70.0885 0 62.7964 0C55.5042 0 49.5928 5.93485 49.5928 13.2559C49.5928 20.5769 55.5042 26.5117 62.7964 26.5117Z" fill="#A2A2A2"/>
                    </svg>
                @endfor

                <div class="container__map__employercard">

                    @foreach ($employees as $employee)
                        <div class="container__map__employercard__item">
                            <div class="container__map__employercard__inner">
                                <div class="container__map__employercard__id">{{ $employee->id }}</div>
                                <div class="container__map__employercard__title">
                                    <div class="container__map__employercard__img">
                                        @if(EmployeeController::user_employee($employee->id)->photo)
                                            <img src="/img/user/{{ EmployeeController::user_employee($employee->id)->photo }}" alt="">
                                        @else
                                            <svg width="110" height="110" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M55 0C62.2935 0 69.2882 2.89731 74.4454 8.05456C79.6027 13.2118 82.5 20.2065 82.5 27.5C82.5 34.7935 79.6027 41.7882 74.4454 46.9454C69.2882 52.1027 62.2935 55 55 55C47.7065 55 40.7118 52.1027 35.5546 46.9454C30.3973 41.7882 27.5 34.7935 27.5 27.5C27.5 20.2065 30.3973 13.2118 35.5546 8.05456C40.7118 2.89731 47.7065 0 55 0ZM55 68.75C85.3875 68.75 110 81.0563 110 96.25V110H0V96.25C0 81.0563 24.6125 68.75 55 68.75Z" fill="#494949"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="container__map__employercard__info">
                                        <div class="container__map__employercard__name">{{ User::where('id', $employee->user_id)->get()->first()->name }}</div>
                                        <div class="container__map__employercard__year">Barber in {{ Departments::where('id', $employee->department_id)->get()->first()->name }}</div>
                                        <div class="container__map__employercard__rating">Average ratings {{ EmployeeController::employee_rating_avg($employee->id) }}/10.</div>
                                    </div>
                                </div>
                                <div class="container__map__employercard__bottom">
                                    @if (Auth::user())
                                        <div class="container__map__employercard__button">Order now</div>
                                        <div class="container__map__employercard__engaged">Engaged</div>
                                    @else
                                        <div class="container__map__employercard__massage">
                                            You must have account to order.
                                            <a href="{{ route('register') }}">Click here to register.</a></div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>

        <form class="container__form" action="{{ route('order-add', [$city, $data[0]->id]) }}" method="post">
            @csrf
            <input class="container__form__departments" type="number" name="depID" value="{{ $data[0]->id }}">
            <input class="container__form__departments" type="number" name="cityID" value="{{ $data[0]->city_id }}">
            <input class="container__form__service" name="service" type="number">
            <input class="container__form__date" name="date" type="date">
            <input class="container__form__time-start" name="timeStart" type="number">
            <input class="container__form__time-end" name="timeEnd" type="number">
            <input class="container__form__employer" name="empID" type="number">
        </form>

    </div>

    @include('inc.footers.footer_mini')

@stop


@section('custom-js')
    <script>
        $(document).ready(function() {

            $('.container__card__item').click(function() {
                if($(this).hasClass('container__card__item-active')) {
                    $('.container__card__item').removeClass('container__card__item-active');
                }
                else {
                    $('.container__card__item').removeClass('container__card__item-active');
                    $(this).addClass('container__card__item-active');
                }

            })


            $('.container__timetable__timeminuts__item').click(function() {
                let timeStart = $(this).data('time-start');
                let timeEnd = $(this).data('time-end');
                let date = $('.container__form__date')[0].value
                let depID = {{$data[0] -> id}};
                let cityID = {{$data[0] -> city_id}};
                console.log("hello")
                $.ajax({
                    type: "GET",
                    url: "{{ route('department-view', [$city, $data[0] -> id]) }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        timeStart: timeStart,
                        timeEnd: timeEnd,
                        date: date,
                        depID: depID,
                        cityID: cityID
                    },

                    success: (data) => {
                        let dataArr = data.split('');
                        console.log(data);

                        $('.container__map__employercard__button').removeClass('container__map__employercard__button-active');
                        $('.container__map__employercard__engaged').removeClass('container__map__employercard__engaged-active');

                        $('.container__mob__employercard__button').removeClass('container__mob__employercard__button-active');
                        $('.container__mob__employercard__engaged').removeClass('container__mob__employercard__engaged-active');

                        $('.container__card__mob__indicate').removeClass('container__card__mob__indicate-active');
                        $('.container__map__point__item-color').removeClass('container__map__point__item-colorfree');
                        $('.container__map__point__item-color').removeClass('container__map__point__item-colornofree');

                        $(dataArr).each((index, element) => {
                            console.log(index, element);

                            if (element == 0) {
                                $('.container__map__employercard__button').eq(index).addClass('container__map__employercard__button-active')
                                $('.container__mob__employercard__button').eq(index).addClass('container__mob__employercard__button-active')


                                $('.container__card__mob__indicate').eq(index).addClass('container__card__mob__indicate-active')
                                $('.container__map__point__item-color').eq(index).addClass('container__map__point__item-colorfree');
                            }
                            else {

                                $('.container__map__employercard__engaged').eq(index).addClass('container__map__employercard__engaged-active')
                                $('.container__mob__employercard__engaged').eq(index).addClass('container__mob__employercard__engaged-active')

                                $('.container__map__point__item-color').eq(index).addClass('container__map__point__item-colornofree');
                            }
                        });
                    }
                });
            });
        });
    </script>
@stop
