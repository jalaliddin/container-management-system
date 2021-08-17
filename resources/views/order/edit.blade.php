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
                    <div class="card-header">{{ __('Buyurtmani  o\'zgartirish') }}</div>
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
                        <form action="{{route('order.update', $order->id)}}" method="POST" class="">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Ism va Familiya" value="{{$order->name}}">
                            </div>
                            <div class="form-group">
                                <span>+998</span><input type="tel" class="form-control" id="phone" minlength="9"
                                                        name="phone" placeholder="Telefon raqami"
                                                        value="{{$order->phone}}">
                            </div>
                            <b>Shahar/Tumanni tanlang:</b>
                            <div class="form-group">
                                <select sel class="custom-select" name="town">
                                    @if($order->town)
                                        <option value="{{$order->town}}" selected>{{$order->town}}</option>
                                    @endif
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
                            <b>Passport ma'lumotlarini o'zgartirish:</b>
                            <div class="form-group">
                                <input type="text" class="form-control" id="passport_number" name="passport_number"
                                       placeholder="Seriya va raqami" value="{{$order->passport_number}}">
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control" id="date_of_issue" name="date_of_issue"
                                       placeholder="Berilgan sanasi" value="{{$order->date_of_issue}}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="passport_authority" name="passport_authority"
                                       placeholder="Kim tomonidan berilgan" value="{{$order->passport_authority}}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="passport_address" name="passport_address"
                                       placeholder="Yashash manzili" value="{{$order->passport_address}}">
                            </div>
                            <hr>
                            <b>Holati:</b>
                            <div class="form-group">
                                <select class="custom-select" name="status">
                                    @if($order->status)
                                        <option value="{{$order->status}}" selected>@if($order->status==1)<font
                                                color="blue">{{'Faol'}}</font>@elseif($order->status==2)<font
                                                color="red">{{'Bekor qilingan'}}</font>@elseif($order->status==3)<font
                                                color="green">{{'Tayyor'}}</font>@endif</option>
                                    @endif
                                    <option value="1">Faol</option>
                                    <option value="2">Bekor qilingan</option>
                                    <option value="3">Tayyor</option>
                                </select>
                            </div>
                            <b>Konteyner summasi:</b>
                            <div class="form-group">
                                <input type="text" class="form-control" id="price-input" name="container_price_format"
                                       placeholder="Konteyner summasi" value="{{$order->container_price}}">
                            </div>
                            <input hidden readonly type="number" id="number" name="container_price"
                                   value="{{$order->container_price}}">
                            <b>Konteynerning kelajakdagi joylashuvini o'zgartirish.</b>
                            <div class="form-group">
                                <div id="map"></div>
                            </div>
                            <input hidden readonly type="text" id="lat" value="{{$order->coordinate->address_latitude}}" name="lat">
                            <input hidden readonly type="text" id="long" value="{{$order->coordinate->address_longitude}}" name="long">
                            <b> Тип контейнера:</b>
                            <div class="form-group">
                                <select class="custom-select" name="container_type">
                                    @if($order->container_type)
                                        <option value="{{$order->container_type}}"
                                                selected>{{$order->container_type}}</option>
                                    @endif
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
                                    @if($order->type_1)
                                        <option value="{{$order->type_1}}" selected>{{$order->type_1}}</option>
                                    @endif
                                    <option value="Профнастиль">Профнастиль</option>
                                    <option value="Сэндвич панель">Сэндвич панель</option>
                                </select>
                            </div>
                            <b>Фортук наружная верхняя:</b>
                            <div class="form-group">
                                <select class="custom-select" name="type_2">
                                    @if($order->type_2)
                                        <option value="{{$order->type_2}}" selected>{{$order->type_2}}</option>
                                    @endif
                                    <option value="Алюпан">Алюпан</option>
                                    <option value="Тунакабонд">Тунакабонд</option>
                                </select>
                            </div>
                            <b>Цвет:</b>
                            <div class="form-group">
                                <select class="custom-select" name="type_3">
                                    @if($order->type_3)
                                        <option value="{{$order->type_3}}" selected>{{$order->type_3}}</option>
                                    @endif
                                    <option value="Яркий">Яркий</option>
                                    <option value="Тёмный">Тёмный</option>
                                </select>
                            </div>
                            <b>Общивка внутренных стен:</b>
                            <div class="form-group">
                                <select class="custom-select" name="type_4">
                                    @if($order->type_4)
                                        <option value="{{$order->type_4}}" selected>{{$order->type_4}}</option>
                                    @endif
                                    <option value="МДФ">МДФ</option>
                                    <option value="Пластик">Пластик</option>
                                </select>
                            </div>
                            <b>Покрытия пола:</b>
                            <div class="form-group">
                                <select class="custom-select" name="type_5">
                                    @if($order->type_5)
                                        <option value="{{$order->type_5}}" selected>{{$order->type_5}}</option>
                                    @endif
                                    <option value="Ламинат+Доска">Ламинат+Доска</option>
                                    <option value="Доска обрезная">Доска обрезная</option>
                                </select>
                            </div>
                            <b>Дверной проём:</b>
                            <div class="form-group">
                                <select class="custom-select" name="type_6">
                                    @if($order->type_6)
                                        <option value="{{$order->type_6}}" selected>{{$order->type_6}}</option>
                                    @endif
                                    <option value="Каленая стекло">Каленая стекло</option>
                                    <option value="Витраж">Витраж</option>
                                </select>
                            </div>
                            <b>Каркас:</b>
                            <div class="form-group">
                                <select class="custom-select" name="type_7">
                                    @if($order->type_7)
                                        <option value="{{$order->type_7}}" selected>{{$order->type_7}}</option>
                                    @endif
                                    <option value="Металлический профиль">Металлический профиль</option>
                                    <option value="Контейнер">Контейнер</option>
                                </select>
                            </div>
                            <b>Заметка:</b>
                            <div class="form-group">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="description"
                                          rows="3">{{$order->description}}</textarea>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-warning float-right">Yangilash</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript"
            src="https://maps.google.com/maps/api/js?key=AIzaSyDjebhPUM5ER3yiFDvN4uHoX8PlnYSrmuQ&sensor=false"></script>
    <script>
        window.onload = function () {
            var latlng = new google.maps.LatLng({!! json_encode($order->coordinate->address_latitude??'') !!}, {!! json_encode($order->coordinate->address_longitude??'') !!});
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
