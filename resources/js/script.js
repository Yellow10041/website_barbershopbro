import {forEach} from "lodash/fp/_util";

$(function() {

    console.log(1);

    let i = false;
    $('.container__filer__box').click(function() {
        if (i) {
            $('.container__filer__box__plate').css({"z-index" : "10"})
            $(".container__filer__box__item").css({"opacity" : "0"});
            setTimeout(function () {
                $('.container__filer__box').css({'height' : '35px'})
                $(".container__filer__box__item").eq(0).css({"display" : "block", "opacity" : "1"});
                $(".container__filer__box__item").eq(1).removeClass('container__filer__box__item-active');
                $(".container__filer__box__icon").removeClass('container__filer__box__icon-active');
            }, 100);

            i = false;
        } else {
            $('.container__filer__box__plate').css({"z-index" : "-1"})
            $(this).css({'height' : '100px'})
            $(".container__filer__box__item").css({"display" : "block"})
            $(".container__filer__box__item").eq(1).addClass('container__filer__box__item-active');
            $(".container__filer__box__icon").addClass('container__filer__box__icon-active');
            setTimeout(function () {
                $(".container__filer__box__item").css({"opacity" : "1"});
            }, 100);

            i = true;
        }


    });

    $('.container__rating__item-auth').click(function() {

        $('.container__rating__item-auth').removeClass('container__rating__item-active')
        $(this).addClass('container__rating__item-active')

    });

    $('.container__filer__box__item').click(function() {

        console.log(1);

    });

    $('.container__rating__item-auth').click(function() {
        $('.container__rating__num').val($(this).text());
    });

    $('.container__services__item').click(function() {

        $('.container__services__item').removeClass('container__services__item-active');
        $(this).addClass('container__services__item-active');

        $('.container__timetable__timeminuts__item').removeClass('container__timetable__timeminuts__item-active');
        $('.container__map__employercard__button').removeClass('container__map__employercard__button-active');
        $('.container__map__employercard__engaged').removeClass('container__map__employercard__engaged-active');

    });

    let placeItems = $(".container__map__place__item").length;
    console.log(placeItems);

    let placeParPosX = $('.container__map__inner').offset().left;
    let placeParPosY = $('.container__map__inner').offset().top;

    for (let i = 0; i < placeItems; i++) {

        let placeItemX = $('.container__map__place__item:eq(' + i +')').offset().left - placeParPosX;
        let placeItemY = $('.container__map__place__item:eq(' + i +')').offset().top - placeParPosY;

        $('.container__map__point__item:eq(' + i +')').css({'top' : placeItemY - 60, 'left' : placeItemX + 10});
        $('.container__map__employercard__item:eq(' + i +')').css({'top' : placeItemY - 330, 'left' : placeItemX + 50});

        console.log(placeItemX, placeItemY);
    }

    $('.container__map__place').click(function() {
        $('.container__map__employercard__item').removeClass('container__map__employercard__item-active');
        $('.container__map__point__item-color').removeClass('container__map__point__item-coloractive');
    });

    $('.container__map__point__item').click(function() {
        $('.container__map__point__item-color').removeClass('container__map__point__item-coloractive');
        $('.container__map__employercard__item').removeClass('container__map__employercard__item-active');
        let pointItemIndex = $(this).index() - 1;
        console.log(pointItemIndex);
        $('.container__map__employercard__item:eq(' + pointItemIndex + ')').addClass('container__map__employercard__item-active');
        $(this).children('.container__map__point__item-color').addClass('container__map__point__item-coloractive');
    });




    function timeminutsPos() {
        let posX = $('.container__timetable__time__item-active').offset().left;
        let itemWidth = $('.container__timetable__time__item-active').width();
        let itemMinWidth = $('.container__timetable__timeminuts').width();
        let posParX = $('.container__timetable__inner').offset().left;
        console.log(itemMinWidth)
        $('.container__timetable__timeminuts').css({'left' : posX - posParX - (itemMinWidth / 2) + (itemWidth / 2)});
    }

    timeminutsPos();

    $('.container__timetable__time__item').click(function() {
        $('.container__timetable__time__item').removeClass('container__timetable__time__item-active')
        $(this).addClass('container__timetable__time__item-active')
        console.log($(this).children('span').text())
        let posX = $(this).offset().left;
        let itemWidth = $(this).width();
        let itemMinWidth = $('.container__timetable__timeminuts').width();
        let posParX = $('.container__timetable__inner').offset().left;
        console.log(itemMinWidth)
        $('.container__timetable__timeminuts').css({'left' : posX - posParX - (itemMinWidth / 2) + (itemWidth / 2)});
        let hourNumStart = Number($('.container__timetable__timeminuts__item').children('span:first').text());
        $('.container__timetable__timeminuts__item:first').data('time', 10)
        let hourNumEnd = Number($(this).children('span').text());
        let difference = hourNumEnd - hourNumStart;
        let antiDifference = hourNumStart - hourNumEnd;
        console.log(hourNumStart, hourNumEnd, difference);
        if (difference > 0) {
            for (let i = 1; i <= difference; i++) {
                $('.container__timetable__timeminuts__item').children('span:first-child').text(hourNumStart + i);
            }
        }
        else {
            for (let i = 1; i <= antiDifference; i++) {
                $('.container__timetable__timeminuts__item').children('span:first-child').text(hourNumStart - i);
            }
        }

        $('.container__timetable__timeminuts__item').removeClass('container__timetable__timeminuts__item-active');
    });

    $('.container__timetable__timeminuts__item').click(function() {
        $('.container__timetable__timeminuts__item').removeClass('container__timetable__timeminuts__item-active');
        $(this).addClass('container__timetable__timeminuts__item-active');
        $('.container__timetable__timeminuts__item').each(function () {
            console.log(Number($('.container__services__item-active').data('time')))
            let timeStart = Number($(this).children('span:first').text()) * 60 + Number($(this).children('span:last').text());
            let timeEnd = Number($(this).children('span:first').text()) * 60 + Number($(this).children('span:last').text()) + Number($('.container__services__item-active').data('time'))
            $(this).data('time-start', timeStart);
            $(this).data('time-end', timeEnd);
            console.log($(this).data('time-start'), $(this).data('time-end'));
        })
    });


    let yearNow = new Date().getFullYear();
    let monthNow = new Date().getMonth() + 1;
    if (monthNow < 10) monthNow = '0' + monthNow;
    let dateNow = new Date().getDate();
    if (dateNow < 10) dateNow = '0' + dateNow;
    let datesNow = yearNow + "-" + monthNow + "-" + dateNow;
    console.log(datesNow);

    $('.container__timetable__date__input')[0].value = datesNow;
    $('.container__form__date')[0].value = datesNow;

    function date() {
        let dateNowInput = $('.container__timetable__date__input')[0].value;
        console.log($('.container__timetable__date__input')[0].value);
        console.log($('.container__form__date')[0].value);
        $('.container__form__date')[0].value = dateNowInput;
        if (dateNowInput) $('.container__timetable__date__num').text(dateNowInput);

        setTimeout(date, 1000);
    }

    date();

    $('.container__services__item').click(function() {
        $('.container__form__service')[0].value = $(this).index();
    });

    console.log($('.container__form__service')[0]);


    $('.container__timetable__timeminuts__item').click(function() {
        let timeStart = Number($(this).children('span').eq(0).text()) * 60 + Number($(this).children('span').eq(1).text());
        let timeService = $('.container__services__item-active').data('time');
        let timeEnd = timeStart + timeService;

        $('.container__form__time-start')[0].value = timeStart;
        $('.container__form__time-end')[0].value = timeEnd;
    });

    $('.container__map__employercard__button').click(function() {
        let employer = $(this).parent().parent().children('.container__map__employercard__id').text();
        let employerMob = $(this).parents('.container__card__item').children('.container__card__item__id').text();
        if(employer) {
            $('.container__form__employer')[0].value = employer;
        }
        else {
            $('.container__form__employer')[0].value = employerMob;
        }
        console.log(employer, employerMob);


        $('.container__form').submit();
    });

    $('.container__mob__employercard__button').click(function() {
        let employer = $(this).parent().parent().children('.container__map__employercard__id').text();
        let employerMob = $(this).parents('.container__card__item').children('.container__card__item__id').text();
        if(employer) {
            $('.container__form__employer')[0].value = employer;
        }
        else {
            $('.container__form__employer')[0].value = employerMob;
        }
        console.log(employer, employerMob);


        $('.container__form').submit();
    });
})
