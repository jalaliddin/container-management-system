@extends('layouts.app')

@section('content')
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
                                <span>+998</span><input type="number" class="form-control" id="phone" minlength="9"
                                                        name="phone" placeholder="Telefon raqami"
                                                        value="{{$order->phone}}">
                            </div>
                            <b>Konteyner summasi:</b>
                            <div class="form-group">
                                <input type="text" class="form-control" id="price-input" name="container_price_format"
                                       placeholder="Konteyner summasi" value="{{$order->container_price}}">
                            </div>
                            <input hidden readonly type="number" id="number" name="container_price"
                                   value="{{$order->container_price}}">
                            <div class="form-group">
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
    <script>
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
