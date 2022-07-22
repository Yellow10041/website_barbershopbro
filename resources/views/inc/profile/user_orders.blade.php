@if(Gate::check('profile_barber')) {{-- Barber --}}
    <div class="profile__orders__rate">
        Orders done: {{EmployeeController::employee_orders_count(Auth::user()->id)}}
    </div>
@endif



<div class="profile__info__content profile__info__content-orders">

    <div class="profile__orders__content__title">
        <div class="profile__orders__content__title__left">Your orders</div>
        @if(Gate::check('profile_moderator')) {{-- Moderator --}}
            <div class="profile__orders__content__title__right">
                Info about order:
            </div>
        @elseif(Gate::check('profile_barber')) {{-- Barber --}}
            <div class="profile__orders__content__title__right profile__orders__content__title__right--barber">
                Orders done: {{EmployeeController::employee_orders_count(Auth::user()->id)}}
            </div>
        @else
            <div class="profile__orders__content__title__right">
                Info about orders:
            </div>
        @endif

    </div>

    <div class="profile__orders__content__items">

        @if (isset($orders[0]))

            @foreach ($orders as $order)

                @if(Gate::check('profile_moderator'))
                    <div class="profile__orders__content__item">

                        <div class="profile__orders__content__barber">
                            <div class="profile__orders__content__barber__photo">

                                @if (User::where('id', $order->user_id)->get()->first()->photo)
                                    <img src="/img/user/{{ User::where('id', $order->user_id)->get()->first()->photo }}" alt="" class="profile__orders__content__barber__photo__img">
                                @else
                                    <svg width="110" height="110" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M55 0C62.2935 0 69.2882 2.89731 74.4454 8.05456C79.6027 13.2118 82.5 20.2065 82.5 27.5C82.5 34.7935 79.6027 41.7882 74.4454 46.9454C69.2882 52.1027 62.2935 55 55 55C47.7065 55 40.7118 52.1027 35.5546 46.9454C30.3973 41.7882 27.5 34.7935 27.5 27.5C27.5 20.2065 30.3973 13.2118 35.5546 8.05456C40.7118 2.89731 47.7065 0 55 0V0ZM55 68.75C85.3875 68.75 110 81.0562 110 96.25V110H0V96.25C0 81.0562 24.6125 68.75 55 68.75Z" fill="#494949"/>
                                    </svg>
                                @endif

                                @if ($order->rating)
                                    <div class="profile__orders__content__barber__photo__rate-barber">
                                        {{$order->rating}}
                                        <i class="fas fa-star"></i>
                                    </div>
                                @else
                                    <div class="profile__orders__content__barber__photo__rate-barber profile__orders__content__barber__photo__rate-barber-no">
                                        rate
                                        <i class="fas fa-star"></i>
                                    </div>
                                @endif

                            </div>
                            <div class="profile__orders__content__barber__name">{{ User::where('id', $order->user_id)->get()->first()->name }}</div>
                            <div class="profile__orders__content__barber__rate">
                                @if (UserController::user_orders($order->user_id))
                                    {{ UserController::user_orders($order->user_id) }} orders
                                @else
                                    no orders
                                @endif
                            </div>
                        </div>



                        <div class="profile__orders__content__info">

                            <div class="profile__orders__content__info__barber profile__orders__content__info__barber-moderator">

                                <div class="profile__orders__content__info__barber__subtitle">
                                    <div class="profile__orders__content__barber__name">{{ EmployeeController::user_employee($order->employee_id)->name }}</div>
                                    <div class="profile__orders__content__barber__rate">barber rate
                                        {{ EmployeeController::employee_rating_avg($order->employee_id) }}
                                    </div>
                                </div>
                                <div class="profile__orders__content__info__barber__title">
                                    @if (EmployeeController::user_employee($order->employee_id)->photo)
                                        <img src="/img/user/{{ EmployeeController::user_employee($order->employee_id)->photo }}" alt="" class="profile__orders__content__barber__photo__img">
                                    @else
                                        <svg width="110" height="110" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M55 0C62.2935 0 69.2882 2.89731 74.4454 8.05456C79.6027 13.2118 82.5 20.2065 82.5 27.5C82.5 34.7935 79.6027 41.7882 74.4454 46.9454C69.2882 52.1027 62.2935 55 55 55C47.7065 55 40.7118 52.1027 35.5546 46.9454C30.3973 41.7882 27.5 34.7935 27.5 27.5C27.5 20.2065 30.3973 13.2118 35.5546 8.05456C40.7118 2.89731 47.7065 0 55 0V0ZM55 68.75C85.3875 68.75 110 81.0562 110 96.25V110H0V96.25C0 81.0562 24.6125 68.75 55 68.75Z" fill="#494949"/>
                                        </svg>
                                    @endif
                                    <div class="profile__orders__content__info__status profile__orders__content__info__status-moderator">
                                        <div class="profile__orders__content__info__status__item ">Status:</div>
                                        <div class="profile__orders__content__info__status__item"><a href="{{ route('order-change-status', ['id' => $order->id]) }}">{{ Status::where('id', $order->status)->get()->first()->name }}</a></div>
                                    </div>
                                </div>
                            </div>

                            <div class="profile__orders__content__info__items">
                                <div class="profile__orders__content__info__item profile__orders__content__info__item-moderator">
                                    <div class="profile__orders__content__info__date">
                                        <div class="profile__orders__content__info__date__inner">
                                            Date: {{ $order->date }}
                                            <div class="profile__orders__content__info__date__hour">
                                                Hour:
                                                {{ floor($order->start_minutes  / 60)}}
                                                :
                                                @if(floor($order->start_minutes  % 60) == 0)
                                                    00
                                                @else
                                                    {{floor($order->start_minutes  % 60)}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile__orders__content__info__item profile__orders__content__info__item-moderator">
                                    <div class="profile__orders__content__info__service profile__orders__content__info__service-moderator">
                                        <div class="profile__orders__content__info__service__inner">{{ Service::where('id', $order->service)->get()->first()->price }} $</div>
                                        <div class="profile__orders__content__info__service__inner">{{ Service::where('id', $order->service)->get()->first()->name }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @elseif(Gate::check('profile_barber'))

                    <div class="profile__orders__content__item">

                        <div class="profile__orders__content__barber">
                            <div class="profile__orders__content__barber__photo">
                                @if (User::where('id', $order->user_id)->get()->first()->photo)
                                    <img src="/img/user/{{ User::where('id', $order->user_id)->get()->first()->photo }}" alt="" class="profile__orders__content__barber__photo__img">
                                @else
                                    <svg width="110" height="110" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M55 0C62.2935 0 69.2882 2.89731 74.4454 8.05456C79.6027 13.2118 82.5 20.2065 82.5 27.5C82.5 34.7935 79.6027 41.7882 74.4454 46.9454C69.2882 52.1027 62.2935 55 55 55C47.7065 55 40.7118 52.1027 35.5546 46.9454C30.3973 41.7882 27.5 34.7935 27.5 27.5C27.5 20.2065 30.3973 13.2118 35.5546 8.05456C40.7118 2.89731 47.7065 0 55 0V0ZM55 68.75C85.3875 68.75 110 81.0562 110 96.25V110H0V96.25C0 81.0562 24.6125 68.75 55 68.75Z" fill="#494949"/>
                                    </svg>
                                @endif

                                    @if ($order->rating)
                                        <div class="profile__orders__content__barber__photo__rate-barber">
                                            {{$order->rating}}
                                            <i class="fas fa-star"></i>
                                        </div>
                                    @else
                                        <div class="profile__orders__content__barber__photo__rate-barber profile__orders__content__barber__photo__rate-barber-no">
                                            rate
                                            <i class="fas fa-star"></i>
                                        </div>
                                    @endif


                            </div>
                            <div class="profile__orders__content__barber__name">{{ User::where('id', $order->user_id)->get()->first()->name }}</div>
                            <div class="profile__orders__content__barber__rate">
                                @if (UserController::user_orders($order->user_id))
                                    {{ UserController::user_orders($order->user_id) }} orders
                                @else
                                    no orders
                                @endif
                            </div>
                            @if ($order->rating)
                                <div class="profile__orders__content__barber__photo__rate__container">
                                    <div class="profile__orders__content__barber__photo__rate-barber profile__orders__content__barber__photo__rate-barber-mob">
                                        {{$order->rating}}
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>

                            @else
                                <div class="profile__orders__content__barber__photo__rate-barber profile__orders__content__barber__photo__rate-barber-mob profile__orders__content__barber__photo__rate-barber-no">
                                    rate
                                    <i class="fas fa-star"></i>
                                </div>
                            @endif
                        </div>

                        <div class="profile__orders__content__info">
                            <div class="profile__orders__content__info__item">
                                <div class="profile__orders__content__info__status">Status: {{ Status::where('id', $order->status)->get()->first()->name }}</div>
                                <div class="profile__orders__content__info__date">
                                    <div class="profile__orders__content__info__date__inner">
                                        Date: {{ $order->date }}
                                        <div class="profile__orders__content__info__date__hour">
                                            Hour:
                                            {{ floor($order->start_minutes  / 60)}}
                                            :
                                            @if(floor($order->start_minutes  % 60) == 0)
                                                00
                                            @else
                                                {{floor($order->start_minutes  % 60)}}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile__orders__content__info__item">
                                <div class="profile__orders__content__info__service">
                                    {{ Service::where('id', $order->service)->get()->first()->name }}
                                    <div class="profile__orders__content__info__service__icon">
                                        @include('inc.services_icons.service_icon_' . Service::where('id', $order->service)->get()->first()->icon)
                                    </div>
                                </div>
                                <div class="profile__orders__content__info__price">{{ Service::where('id', $order->service)->get()->first()->price }}$</div>
                            </div>
                        </div>

                    </div>
               @else {{-- User --}}
                    <div class="profile__orders__content__item">


                        <form class="profile__orders__form" action="{{ route('order-change-rating', ['id' => $order->id]) }}" method="POST">
                            @csrf

                            @if ($order->rating)
                                <input class="profile__orders__form__input" type="number" name="rating" value="{{$order->rating}}">
                            @else
                                <input class="profile__orders__form__input" type="number" name="rating">
                            @endif
                        </form>

                        <div class="profile__orders__content__barber">
                            <div class="profile__orders__content__barber__photo">
                                @if (EmployeeController::user_employee($order->employee_id)->photo)
                                    <img src="/img/user/{{ EmployeeController::user_employee($order->employee_id)->photo }}" alt="" class="profile__orders__content__barber__photo__img">
                                @else
                                    <svg width="110" height="110" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M55 0C62.2935 0 69.2882 2.89731 74.4454 8.05456C79.6027 13.2118 82.5 20.2065 82.5 27.5C82.5 34.7935 79.6027 41.7882 74.4454 46.9454C69.2882 52.1027 62.2935 55 55 55C47.7065 55 40.7118 52.1027 35.5546 46.9454C30.3973 41.7882 27.5 34.7935 27.5 27.5C27.5 20.2065 30.3973 13.2118 35.5546 8.05456C40.7118 2.89731 47.7065 0 55 0V0ZM55 68.75C85.3875 68.75 110 81.0562 110 96.25V110H0V96.25C0 81.0562 24.6125 68.75 55 68.75Z" fill="#494949"/>
                                    </svg>
                                @endif

                                <div class="profile__orders__content__barber__photo__rate">
                                    @if ($order->rating)
                                        {{$order->rating}}
                                        <i class="fas fa-star"></i>
                                    @else
                                        rate
                                        <i class="fas fa-star"></i>
                                    @endif

                                </div>
                            </div>
                            <div class="profile__orders__content__barber__name">{{ EmployeeController::user_employee($order->employee_id)->name }}</div>
                            <div class="profile__orders__content__barber__rate">barber rate
                                {{ EmployeeController::employee_rating_avg($order->employee_id) }}
                            </div>
                        </div>

                        <div class="profile__orders__content__info">
                            <div class="profile__orders__content__info__item">
                                <div class="profile__orders__content__info__status">Status: {{ Status::where('id', $order->status)->get()->first()->name }}</div>
                                <div class="profile__orders__content__info__date">
                                    <div class="profile__orders__content__info__date__inner">
                                        Date: {{ $order->date }}
                                        <div class="profile__orders__content__info__date__hour">
                                            Hour:
                                            {{ floor($order->start_minutes  / 60)}}
                                            :
                                            @if(floor($order->start_minutes  % 60) == 0)
                                                00
                                            @else
                                                {{floor($order->start_minutes  % 60)}}
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="profile__orders__content__info__item">
                                <div class="profile__orders__content__info__service">
                                    {{ Service::where('id', $order->service)->get()->first()->name }}
                                    <div class="profile__orders__content__info__service__icon">
                                        @include('inc.services_icons.service_icon_' . Service::where('id', $order->service)->get()->first()->icon)
                                    </div>
                                </div>
                                <div class="profile__orders__content__info__price">{{ Service::where('id', $order->service)->get()->first()->price }}$</div>
                            </div>
                        </div>

                        <div class="profile__orders__content__rate">

                            <div class="profile__orders__content__rate__items">
                                <div class="profile__orders__content__rate__items__inner">
                                    @if ($order->rating)
                                        @for($i = 1; $i <= 10; $i++)
                                            @if($order->rating == $i)
                                                <div class="profile__orders__content__rate__item profile__orders__content__rate__item-active">{{$i}}</div>
                                            @else
                                                <div class="profile__orders__content__rate__item">{{$i}}</div>
                                            @endif
                                        @endfor
                                    @else
                                        @for($i = 1; $i <= 10; $i++)
                                            <div class="profile__orders__content__rate__item">{{$i}}</div>
                                        @endfor
                                    @endif
                                </div>

                            </div>

                        </div>
                    </div>
                @endif

            @endforeach

        @else

            <div class="profile__feedback__content__item">
                <div class="profile__feedback__content__item__massage">Leave orders</div>
            </div>

        @endif

    </div>
</div>
</div>



<div class="profile__info__content profile__info__content-orders profile__info__content-orders-mob">

    <div class="profile__orders__content__title">

        <div class="profile__orders__content__title__left profile__orders__content__title__left-mob">Your orders</div>

    </div>

    <div class="profile__orders__content__items">

        @if (isset($orders[0]))

            @foreach ($orders as $order)

                @if(Gate::check('profile_moderator'))
                    <div class="profile__orders__content__item">

                        <div class="profile__orders__content__item__container profile__orders__content__item__container-main profile__orders__content__item__container-main-moderator">

                            <div class="profile__orders__content__barber__name__info">
                                <div class="profile__orders__content__barber__name">{{ User::where('id', $order->user_id)->get()->first()->name }}</div>
                                <div class="profile__orders__content__barber__rate">
                                    @if (UserController::user_orders($order->user_id))
                                        {{ UserController::user_orders($order->user_id) }} orders
                                    @else
                                        no orders
                                    @endif
                                </div>
                            </div>

                            <div class="profile__orders__content__barber__name__info">
                                <div class="profile__orders__content__barber__name">{{ EmployeeController::user_employee($order->employee_id)->name }}</div>
                                <div class="profile__orders__content__barber__rate">barber rate
                                    {{ EmployeeController::employee_rating_avg($order->employee_id) }}
                                </div>
                            </div>

                        </div>

                        <div class="profile__orders__content__item__container profile__orders__content__item__container-info">

                            <div class="profile__orders__content__info__item">
                                <div class="profile__orders__content__info__status">Status:<br> {{ Status::where('id', $order->status)->get()->first()->name }}</div>
                                <div class="profile__orders__content__info__date">
                                    <div class="profile__orders__content__info__date__inner">
                                        Date: {{ $order->date }}
                                        <div class="profile__orders__content__info__date__hour">
                                            Hour:
                                            {{ floor($order->start_minutes  / 60)}}
                                            :
                                            @if(floor($order->start_minutes  % 60) == 0)
                                                00
                                            @else
                                                {{floor($order->start_minutes  % 60)}}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile__orders__content__info__item">
                                <div class="profile__orders__content__info__service">
                                    {{ Service::where('id', $order->service)->get()->first()->name }}
                                    <div class="profile__orders__content__info__service__icon">
                                        @include('inc.services_icons.service_icon_' . Service::where('id', $order->service)->get()->first()->icon)
                                    </div>
                                </div>
                                <div class="profile__orders__content__info__price">{{ Service::where('id', $order->service)->get()->first()->price }}$</div>
                            </div>

                        </div>

                        <div class="profile__orders__content__item__container__menu">
                            <div class="profile__orders__content__item__container__menu__item profile__orders__content__item__container__menu__item-info">info about order</div>
                            <div class="profile__orders__content__item__container__menu__item profile__orders__content__item__container__menu__item-close">
                                @if ($order->rating)
                                    {{$order->rating}}
                                    <i class="fas fa-star"></i>
                                @else
                                    rate
                                    <i class="fas fa-star"></i>
                                @endif
                            </div>
                        </div>

                    </div>
                @elseif(Gate::check('profile_barber'))

                    <div class="profile__orders__content__item">

                        <div class="profile__orders__content__item__container profile__orders__content__item__container-main">
                            <div class="profile__orders__content__barber__photo">
                                @if (User::where('id', $order->user_id)->get()->first()->photo)
                                    <img src="/img/user/{{ User::where('id', $order->user_id)->get()->first()->photo }}" alt="" class="profile__orders__content__barber__photo__img">
                                @else
                                    <svg width="110" height="110" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M55 0C62.2935 0 69.2882 2.89731 74.4454 8.05456C79.6027 13.2118 82.5 20.2065 82.5 27.5C82.5 34.7935 79.6027 41.7882 74.4454 46.9454C69.2882 52.1027 62.2935 55 55 55C47.7065 55 40.7118 52.1027 35.5546 46.9454C30.3973 41.7882 27.5 34.7935 27.5 27.5C27.5 20.2065 30.3973 13.2118 35.5546 8.05456C40.7118 2.89731 47.7065 0 55 0V0ZM55 68.75C85.3875 68.75 110 81.0562 110 96.25V110H0V96.25C0 81.0562 24.6125 68.75 55 68.75Z" fill="#494949"/>
                                    </svg>
                                @endif

                                @if ($order->rating)
                                    <div class="profile__orders__content__barber__photo__rate-barber">
                                        {{$order->rating}}
                                        <i class="fas fa-star"></i>
                                    </div>
                                @else
                                    <div class="profile__orders__content__barber__photo__rate-barber profile__orders__content__barber__photo__rate-barber-no">
                                        rate
                                        <i class="fas fa-star"></i>
                                    </div>
                                @endif


                            </div>
                            <div class="profile__orders__content__barber__name__info">
                                <div class="profile__orders__content__barber__name">{{ User::where('id', $order->user_id)->get()->first()->name }}</div>
                                <div class="profile__orders__content__barber__rate">
                                    @if (UserController::user_orders($order->user_id))
                                        {{ UserController::user_orders($order->user_id) }} orders
                                    @else
                                        no orders
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="profile__orders__content__item__container profile__orders__content__item__container-info">

                            <div class="profile__orders__content__info__item">
                                <div class="profile__orders__content__info__status">Status:<br> {{ Status::where('id', $order->status)->get()->first()->name }}</div>
                                <div class="profile__orders__content__info__date">
                                    <div class="profile__orders__content__info__date__inner">
                                        Date: {{ $order->date }}
                                        <div class="profile__orders__content__info__date__hour">
                                            Hour:
                                            {{ floor($order->start_minutes  / 60)}}
                                            :
                                            @if(floor($order->start_minutes  % 60) == 0)
                                                00
                                            @else
                                                {{floor($order->start_minutes  % 60)}}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile__orders__content__info__item">
                                <div class="profile__orders__content__info__service">
                                    {{ Service::where('id', $order->service)->get()->first()->name }}
                                    <div class="profile__orders__content__info__service__icon">
                                        @include('inc.services_icons.service_icon_' . Service::where('id', $order->service)->get()->first()->icon)
                                    </div>
                                </div>
                                <div class="profile__orders__content__info__price">{{ Service::where('id', $order->service)->get()->first()->price }}$</div>
                            </div>

                        </div>

                        <div class="profile__orders__content__item__container__menu">
                            <div class="profile__orders__content__item__container__menu__item profile__orders__content__item__container__menu__item-info">info about order</div>
                            <div class="profile__orders__content__item__container__menu__item profile__orders__content__item__container__menu__item-close">
                                @if ($order->rating)
                                    {{$order->rating}}
                                    <i class="fas fa-star"></i>
                                @else
                                    rate
                                    <i class="fas fa-star"></i>
                                @endif
                            </div>
                        </div>

                    </div>
                @else {{-- User --}}

                <div class="profile__orders__content__item">

                    <form class="profile__orders__form" action="{{ route('order-change-rating', ['id' => $order->id]) }}" method="POST">
                        @csrf

                        @if ($order->rating)
                            <input class="profile__orders__form__input" type="number" name="rating" value="{{$order->rating}}">
                        @else
                            <input class="profile__orders__form__input" type="number" name="rating">
                        @endif
                    </form>

                    <div class="profile__orders__content__item__container profile__orders__content__item__container-main">
                        <div class="profile__orders__content__barber__photo">
                            @if (EmployeeController::user_employee($order->employee_id)->photo)
                                <img src="/img/user/{{ EmployeeController::user_employee($order->employee_id)->photo }}" alt="" class="profile__orders__content__barber__photo__img">
                            @else
                                <svg width="110" height="110" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M55 0C62.2935 0 69.2882 2.89731 74.4454 8.05456C79.6027 13.2118 82.5 20.2065 82.5 27.5C82.5 34.7935 79.6027 41.7882 74.4454 46.9454C69.2882 52.1027 62.2935 55 55 55C47.7065 55 40.7118 52.1027 35.5546 46.9454C30.3973 41.7882 27.5 34.7935 27.5 27.5C27.5 20.2065 30.3973 13.2118 35.5546 8.05456C40.7118 2.89731 47.7065 0 55 0V0ZM55 68.75C85.3875 68.75 110 81.0562 110 96.25V110H0V96.25C0 81.0562 24.6125 68.75 55 68.75Z" fill="#494949"/>
                                </svg>
                            @endif

                            @if ($order->rating)
                                <div class="profile__orders__content__barber__photo__rate-barber">
                                    {{$order->rating}}
                                    <i class="fas fa-star"></i>
                                </div>
                            @else
                                <div class="profile__orders__content__barber__photo__rate-barber profile__orders__content__barber__photo__rate-barber-no">
                                    rate
                                    <i class="fas fa-star"></i>
                                </div>
                            @endif


                        </div>
                        <div class="profile__orders__content__barber__name__info">
                            <div class="profile__orders__content__barber__name">{{ EmployeeController::user_employee($order->employee_id)->name }}</div>
                            <div class="profile__orders__content__barber__rate">barber rate
                                {{ EmployeeController::employee_rating_avg($order->employee_id) }}
                            </div>
                        </div>

                    </div>

                    <div class="profile__orders__content__item__container profile__orders__content__item__container-info">

                        <div class="profile__orders__content__info__item">
                            <div class="profile__orders__content__info__status">Status:<br> {{ Status::where('id', $order->status)->get()->first()->name }}</div>
                            <div class="profile__orders__content__info__date">
                                <div class="profile__orders__content__info__date__inner">
                                    Date: {{ $order->date }}
                                    <div class="profile__orders__content__info__date__hour">
                                        Hour:
                                        {{ floor($order->start_minutes  / 60)}}
                                        :
                                        @if(floor($order->start_minutes  % 60) == 0)
                                            00
                                        @else
                                            {{floor($order->start_minutes  % 60)}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile__orders__content__info__item">
                            <div class="profile__orders__content__info__service">
                                {{ Service::where('id', $order->service)->get()->first()->name }}
                                <div class="profile__orders__content__info__service__icon">
                                    @include('inc.services_icons.service_icon_' . Service::where('id', $order->service)->get()->first()->icon)
                                </div>
                            </div>
                            <div class="profile__orders__content__info__price">{{ Service::where('id', $order->service)->get()->first()->price }}$</div>
                        </div>

                    </div>

                    <div class="profile__orders__content__item__container profile__orders__content__item__container-rate">

                        <div class="profile__orders__content__rate__items">
                            <div class="profile__orders__content__rate__items__inner">
                                @if ($order->rating)
                                    @for($i = 1; $i <= 10; $i++)
                                        @if($order->rating == $i)
                                            <div class="profile__orders__content__rate__item profile__orders__content__rate__item-active">{{$i}}</div>
                                        @else
                                            <div class="profile__orders__content__rate__item">{{$i}}</div>
                                        @endif
                                    @endfor
                                @else
                                    @for($i = 1; $i <= 10; $i++)
                                        <div class="profile__orders__content__rate__item">{{$i}}</div>
                                    @endfor
                                @endif
                            </div>

                        </div>

                    </div>

                    <div class="profile__orders__content__item__container__menu">
                        <div class="profile__orders__content__item__container__menu__item profile__orders__content__item__container__menu__item-info">info about order</div>
                        <div class="profile__orders__content__item__container__menu__item profile__orders__content__item__container__menu__item-rate">
                            @if ($order->rating)
                                {{$order->rating}}
                                <i class="fas fa-star"></i>
                            @else
                                rate
                                <i class="fas fa-star"></i>
                            @endif
                        </div>
                    </div>

                </div>

                @endif

            @endforeach

        @else

            <div class="profile__feedback__content__item">
                <div class="profile__feedback__content__item__massage">Leave orders</div>
            </div>

        @endif

    </div>
</div>
</div>
