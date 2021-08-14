<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Stan Trip Container</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/425f3e38f0.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *, :after, :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg, video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --bg-opacity: 1;
            background-color: #fff;
            background-color: rgba(255, 255, 255, var(--bg-opacity))
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .border-gray-200 {
            --border-opacity: 1;
            border-color: #edf2f7;
            border-color: rgba(237, 242, 247, var(--border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --text-opacity: 1;
            color: #edf2f7;
            color: rgba(237, 242, 247, var(--text-opacity))
        }

        .text-gray-300 {
            --text-opacity: 1;
            color: #e2e8f0;
            color: rgba(226, 232, 240, var(--text-opacity))
        }

        .text-gray-400 {
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--text-opacity))
        }

        .text-gray-500 {
            --text-opacity: 1;
            color: #a0aec0;
            color: rgba(160, 174, 192, var(--text-opacity))
        }

        .text-gray-600 {
            --text-opacity: 1;
            color: #718096;
            color: rgba(113, 128, 150, var(--text-opacity))
        }

        .text-gray-700 {
            --text-opacity: 1;
            color: #4a5568;
            color: rgba(74, 85, 104, var(--text-opacity))
        }

        .text-gray-900 {
            --text-opacity: 1;
            color: #1a202c;
            color: rgba(26, 32, 44, var(--text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns:repeat(1, minmax(0, 1fr))
        }

        @media (min-width: 640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width: 768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns:repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width: 1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme: dark) {
            .dark\:bg-gray-800 {
                --bg-opacity: 1;
                background-color: #2d3748;
                background-color: rgba(45, 55, 72, var(--bg-opacity))
            }

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:border-gray-700 {
                --border-opacity: 1;
                border-color: #4a5568;
                border-color: rgba(74, 85, 104, var(--border-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }

            .dark\:text-gray-400 {
                --text-opacity: 1;
                color: #cbd5e0;
                color: rgba(203, 213, 224, var(--text-opacity))
            }
        }
    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        #map {
            height: 300px;
            border: 1px solid #000;
        }
    </style>

</head>
<body class="antialiased">
<div
    class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center">
            <img class="items-center" src="{{asset('img/logo.jpg')}}" width="200" height="200" alt="">
        </div>
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <h1 class="dark:text-white" class="display-1">StanTrip Containers</h1>
        </div>
        <div class="flex justify-center">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-warning text-center" data-toggle="modal" data-target="#onlineOrderModal">
                Buyurtma berish
            </button>
            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="onlineOrderModal" tabindex="-1" role="dialog" aria-labelledby="onlineOrderModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="onlineOrderModalLabel">Yengil tipdagi konstruksiyalarga onlayn buyurtma berish</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{--Form field--}}
                            <form action="{{route('online.order')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Ism va Familiya">
                                </div>
                                <div class="form-group">
                                    <span>+998</span><input type="number" class="form-control" id="phone" minlength="9"
                                                            name="phone" placeholder="Telefon raqami" required>
                                </div>
                                <input hidden readonly type="number" id="number" value="0.00" name="container_price">
                                <b>Konteynerning kelajakdagi joylashuvini tanlang.</b>
                                <div class="form-group">
                                    <div id="map"></div>
                                </div>
                                <input hidden readonly type="text" id="lat" value="" name="lat">
                                <input hidden readonly type="text" id="long" value="" name="long">
                                <b>Shahar/Tumanni tanlang:</b>
                                <div class="form-group">
                                    <select class="custom-select" name="town">
                                        <option value="Xiva t">Xiva t</option>
                                        <option value="Xiva sh">Xiva sh</option>
                                        <option value="Bog'ot">Bog'ot</option>
                                        <option value="Gurlan">Gurlan</option>
                                        <option value="Qo'shko'pir">Qo'shko'pir</option>
                                        <option value="Shovot">Shovot</option>
                                        <option value="Urganch t">Urganch t</option>
                                        <option value="Urganch sh">Urganch sh</option>
                                        <option value="Xazorasp">Xazorasp</option>
                                        <option value="Xonqa">Xonqa</option>
                                        <option value="Yangiariq">Yangiariq</option>
                                        <option value="Yangibozor">Yangibozor</option>
                                        <option value="none">none</option>
                                    </select>
                                </div>
                                <input hidden readonly type="number" value="1" name="status">
                                <b> Тип контейнера:</b>
                                <div class="form-group">
                                    <select class="custom-select" name="container_type">
                                        <option value="4X3">4X3</option>
                                        <option value="5X3">5X3</option>
                                        <option value="6X3">6X3</option>
                                        <option value="7X3">7X3</option>
                                        <option value="8X3">8X3</option>
                                        <option value="9X3">9X3</option>
                                        <option value="10X3">10X3</option>
                                        <option value="11X3">11X3</option>
                                        <option value="12X3">12X3</option>
                                    </select>
                                </div>
                                <b>Общивка наружнях стен:</b>
                                <div class="form-group">
                                    <select class="custom-select" name="type_1">
                                        <option value="Профнастиль">Профнастиль</option>
                                        <option value="Сэндвич панель">Сэндвич панель</option>
                                    </select>
                                </div>
                                <b>Фортук наружная верхняя:</b>
                                <div class="form-group">
                                    <select class="custom-select" name="type_2">
                                        <option value="Алюпан">Алюпан</option>
                                        <option value="Тунакабонд">Тунакабонд</option>
                                    </select>
                                </div>
                                <b>Цвет:</b>
                                <div class="form-group">
                                    <select class="custom-select" name="type_3">
                                        <option value="Яркий">Яркий</option>
                                        <option value="Тёмный">Тёмный</option>
                                    </select>
                                </div>
                                <b>Общивка внутренных стен:</b>
                                <div class="form-group">
                                    <select class="custom-select" name="type_4">
                                        <option value="МДФ">МДФ</option>
                                        <option value="Пластик">Пластик</option>
                                    </select>
                                </div>
                                <b>Покрытия пола:</b>
                                <div class="form-group">
                                    <select class="custom-select" name="type_5">
                                        <option value="Ламинат+Доска">Ламинат+Доска</option>
                                        <option value="Доска обрезная">Доска обрезная</option>
                                    </select>
                                </div>
                                <b>Дверной проём:</b>
                                <div class="form-group">
                                    <select class="custom-select" name="type_6">
                                        <option value="Каленая стекло">Каленая стекло</option>
                                        <option value="Витраж">Витраж</option>
                                    </select>
                                </div>
                                <b>Каркас:</b>
                                <div class="form-group">
                                    <select class="custom-select" name="type_7">
                                        <option value="Металлический профиль">Металлический профиль</option>
                                        <option value="Контейнер">Контейнер</option>
                                    </select>
                                </div>
                                <b>Заметка:</b>
                                <div class="form-group">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="description"
                                          rows="3"></textarea>
                                </div>
                                <br>
{{--                                <button type="submit" class="btn btn-success float-right">Saqlash</button>--}}
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Yopish</button>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Jo'natish</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key=AIzaSyDjebhPUM5ER3yiFDvN4uHoX8PlnYSrmuQ&sensor=false"></script>
<script>
    @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.success("{{ session('message') }}");
    @endif
    window.onload = function () {
        var latlng = new google.maps.LatLng(41.3895, 60.3415);
        var map = new google.maps.Map(document.getElementById('map'), {
            center: latlng,
            zoom: 11,
            mapTypeId: 'hybrid'
        });
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            title: 'Set lat/lon values for this property',
            draggable: true
        });
        google.maps.event.addListener(marker, 'dragend', function (a) {
            console.log(a);
            document.getElementById("lat").value = a.latLng.lat().toFixed(4);
            document.getElementById("long").value = a.latLng.lng().toFixed(4)
        });
    };
    document.getElementById("price-input").onblur = function () {

        //number-format the user input
        this.value = parseFloat(this.value.replace(/,/g, ""))
            .toFixed(2)
            .toString()
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        //set the numeric value to a number input
        document.getElementById("number").value = this.value.replace(/,/g, "")

    }
</script>
</html>
