@if(Gate::check('profile_moderator'))
    <div class="profile__info__content">

        <div class="profile__info__content__title">
            <div class="profile__info__content__title-left">Your info:</div>
            <div class="profile__info__content__title-right profile__info__content__title__button">Apply</div>
        </div>

        <div class="profile__info__content__details">

            <div class="profile__info__content__details__fields_name">
                <div class="profile__info__content__details__fields_name__item">Name</div>
                <div class="profile__info__content__details__fields_name__item">Email</div>
                <div class="profile__info__content__details__fields_name__item">Password</div>
            </div>

            <form class="profile__info__content__details__fields_value" action="{{ route('user-update') }}">
                @csrf

                <div class="profile__info__content__details__fields_value__item">
                    <input class="profile__info__content__details__fields_value__item__input" type="text"name="name" value="{{Auth::user()->name}}">
                    <i class="far fa-edit"></i>
                </div>
                <div class="profile__info__content__details__fields_value__item">
                    <input class="profile__info__content__details__fields_value__item__input" type="email" name="email" value="{{Auth::user()->email}}">
                    <i class="far fa-edit"></i>
                </div>
                <div class="profile__info__content__details__fields_value__item">
                    <input class="profile__info__content__details__fields_value__item__input" type="password" name="password" placeholder="********">
                    <i class="far fa-edit"></i>
                </div>
            </form>

        </div>
    </div>
@elseif(Gate::check('profile_barber'))
    <div class="profile__info__content">

        <div class="profile__info__content__title">
            <div class="profile__info__content__title-left">Your info:</div>
            <div class="profile__info__content__title-right profile__info__content__title__button">Apply</div>
        </div>

        <div class="profile__info__content__details">

            <div class="profile__info__content__details__fields_name">
                <div class="profile__info__content__details__fields_name__item">Rate</div>
                <div class="profile__info__content__details__fields_name__item">Name</div>
                <div class="profile__info__content__details__fields_name__item">Email</div>
                <div class="profile__info__content__details__fields_name__item">Password</div>
            </div>

            <form class="profile__info__content__details__fields_value" action="{{ route('user-update') }}">
                @csrf

                <div class="profile__info__content__details__fields_value__item">
                    <div class="profile__info__content__details__fields_value__item__input">{{EmployeeController::employee_user_rate(Auth::user()->id)}}<i class="fas fa-star"></i></div>
                </div>

                <div class="profile__info__content__details__fields_value__item">
                    <input class="profile__info__content__details__fields_value__item__input" type="text"name="name" value="{{Auth::user()->name}}">
                    <i class="far fa-edit"></i>
                </div>
                <div class="profile__info__content__details__fields_value__item">
                    <input class="profile__info__content__details__fields_value__item__input" type="email" name="email" value="{{Auth::user()->email}}">
                    <i class="far fa-edit"></i>
                </div>
                <div class="profile__info__content__details__fields_value__item">
                    <input class="profile__info__content__details__fields_value__item__input" type="password" name="password" placeholder="********">
                    <i class="far fa-edit"></i>
                </div>
            </form>

        </div>
    </div>
@else
    <div class="profile__info__content">

        <div class="profile__info__content__title">
            <div class="profile__info__content__title-left">Your info:</div>
            <div class="profile__info__content__title-right profile__info__content__title__button">Apply</div>
        </div>

        <div class="profile__info__content__details">

            <div class="profile__info__content__details__fields_name">
                <div class="profile__info__content__details__fields_name__item">Name</div>
                <div class="profile__info__content__details__fields_name__item">Age</div>
                <div class="profile__info__content__details__fields_name__item">Phone</div>
                <div class="profile__info__content__details__fields_name__item">Email</div>
                <div class="profile__info__content__details__fields_name__item">Password</div>
            </div>

            <form class="profile__info__content__details__fields_value" action="{{ route('user-update') }}">
                @csrf

                <div class="profile__info__content__details__fields_value__item">
                    <input class="profile__info__content__details__fields_value__item__input" type="text"name="name" value="{{Auth::user()->name}}">
                    <i class="far fa-edit"></i>
                </div>
                <div class="profile__info__content__details__fields_value__item">
                    @if (isset(Auth::user()->age))
                        <input class="profile__info__content__details__fields_value__item__input" type="text" name="age" value="{{Auth::user()->age}}">
                    @else
                        <input class="profile__info__content__details__fields_value__item__input" type="text" name="age" placeholder="Please enter your age">
                    @endif
                    <i class="far fa-edit"></i>
                </div>
                <div class="profile__info__content__details__fields_value__item">
                    @if (isset(Auth::user()->phone))
                        <input class="profile__info__content__details__fields_value__item__input" type="text" name="phone" value="{{Auth::user()->phone}}">
                    @else
                        <input class="profile__info__content__details__fields_value__item__input" type="text" name="phone" placeholder="Please enter your phone number">
                    @endif
                    <i class="far fa-edit"></i>
                </div>
                <div class="profile__info__content__details__fields_value__item">
                    <input class="profile__info__content__details__fields_value__item__input" type="email" name="email" value="{{Auth::user()->email}}">
                    <i class="far fa-edit"></i>
                </div>
                <div class="profile__info__content__details__fields_value__item">
                    <input class="profile__info__content__details__fields_value__item__input" type="password" name="password" placeholder="********">
                    <i class="far fa-edit"></i>
                </div>
            </form>

        </div>
    </div>
@endif
