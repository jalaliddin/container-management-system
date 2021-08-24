@extends('layouts.app')

@section('content')
    <style>
        #map {
            height: 300px;
            border: 1px solid #000;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Buyurtma kiritish') }}</div>
                    <div class="container py-4">
                        <a href="{{route('order.index')}}">
                            <button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Orqaga</button>
                        </a>
                        <br>
                        <br>
                        @if(Session::has('message'))
                            <div class="alert alert-success">{{Session::get('message')}}</div>
                        @endif
                        @if(count($errors)>0)

                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="alert alert-danger">{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form id="saveOrder" action="{{route('order.store')}}" method="post" class="">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Ism va Familiya">
                            </div>
                            <div class="form-group">
                                <span>+998</span><input type="tel" class="form-control" id="phone" minlength="9"
                                                        name="phone" placeholder="Telefon raqami" required>
                            </div>
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
                            <b>Passport ma'lumotlarini kiriting:</b>
                            <div class="form-group">
                                <input type="text" class="form-control" id="passport_number" name="passport_number"
                                       placeholder="Seriya va raqami">
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control" id="date_of_issue" name="date_of_issue"
                                       placeholder="Berilgan sanasi">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="passport_authority" name="passport_authority"
                                       placeholder="Kim tomonidan berilgan">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="passport_address" name="passport_address"
                                       placeholder="Yashash manzili">
                            </div>
                            <hr>
                            <b>Holati:</b>
                            <div class="form-group">
                                <select class="custom-select" name="status">
                                    <option value="1">Faol</option>
                                    <option value="2">Bekor qilingan</option>
                                    <option value="3">Tayyor</option>
                                </select>
                            </div>
                            <b>Konteyner summasi:</b>
                            <div class="form-group">
                                <input type="text" class="form-control" id="price-input" name="container_price_format"
                                       placeholder="Konteyner summasi" value="0.00">
                            </div>
                            <input hidden readonly type="number" id="number" value="0.00" name="container_price">
                            <b>Konteynerning kelajakdagi joylashuvini tanlang.</b>
                            <div class="form-group">
                                <div id="map"></div>
                            </div>
                            <input hidden readonly type="text" id="lat" value="" name="lat">
                            <input hidden readonly type="text" id="long" value="" name="long">
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
                        </form>
                        <a href="#" class="btn btn-success float-right" onclick="saveConfirm('saveOrder')">Saqlash</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript"
            src="https://maps.google.com/maps/api/js?key=AIzaSyDjebhPUM5ER3yiFDvN4uHoX8PlnYSrmuQ&sensor=false"></script>
    <script>
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
@endsection
