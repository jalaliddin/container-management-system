@extends('layouts.app')

@section('content')
    <style>
        #map {
            height: 500px;
            border: 1px solid #000;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header"><span>ID: <b>{{$order->id}}</b></span> {{ __('Mijoz ma\'lumotlarini') }}
                        <span><b>{{$order->author}}</b> kiritdi.</span>
                    </div>
                    <div class="container py-4">
                        <div class="row">
                            <div class="col">
                                <a href="{{route('order.index')}}">
                                    <button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Orqaga</button>
                                </a>
                            </div>
                            <div class="col">
                                <form action="{{route('location.order', ['id' => $order->id])}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm float-right"><i
                                            class="fa fa-car"></i> Lokatsiya jo'natish
                                    </button>
                                </form>
                                <form action="{{route('generate.agreement', ['id' => $order->id])}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm float-right mr-2"><i
                                            class="fas fa-file-word"></i> Shartnoma
                                    </button>
                                </form>
                            </div>
                        </div>
                        <br>
                        @if(Session::has('message'))
                            <div class="alert alert-success">{{Session::get('message')}}</div>
                        @endif
                        @if(Session::has('notsent'))
                            <div class="alert alert-danger">{{Session::get('notsent')}}</div>
                        @endif
                        @if(count($errors)>0)
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="alert alert-danger">{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="container">
                            <div class="row">
                                <div class="col border">
                                    <br>
                                    <h3 class="text-center">Ism: <b>{{$order->name}}</b></h3>
                                    <h4 class="text-center">Holati: @if($order->status==1)<font
                                            color="blue">{{'Faol'}}</font>@elseif($order->status==2)<font
                                            color="red">{{'Bekor qilingan'}}</font>@elseif($order->status==3)<font
                                            color="green">{{'Tayyor'}}</font>@endif</h4>
                                    <br>
                                </div>
                            </div>
                            <br>
                            <di class="row">
                                <div class="col border">
                                    <div class="container">
                                        <br>
                                        <h4 class="text-center">Konteyner ma'lumotlari:</h4>
                                        <ol>
                                            <li>
                                                Telefon raqami: <b>{{$order->phone}}</b>
                                            </li>
                                            <li>
                                                Shahar: <b>{{$order->town}}</b>
                                            </li>
                                            <li>
                                                Konteyner qiymati: <b>@money($order->container_price)</b>
                                            </li>
                                            <li>
                                                Konteyner turi: <b>{{$order->container_type}}</b>
                                            </li>
                                            <li>
                                                Eslatmalar: <b>{{$order->description}}</b>
                                            </li>
                                            <li>
                                                Общивка наружнях стен: <b>{{$order->table_1}}</b>
                                            </li>
                                            <li>
                                                Фортук наружная верхняя: <b>{{$order->table_2}}</b>
                                            </li>
                                            <li>
                                                Цвет: <b>{{$order->table_3}}</b>
                                            </li>
                                            <li>
                                                Общивка внутренных стен: <b>{{$order->table_4}}</b>
                                            </li>
                                            <li>
                                                Покрытия пола: <b>{{$order->table_5}}</b>
                                            </li>
                                            <li>
                                                Дверной проём: <b>{{$order->table_6}}</b>
                                            </li>
                                            <li>
                                                Каркас: <b>{{$order->table_7}}</b>
                                            </li>
                                            <li>
                                                Ma'lumot kiritilgan vaqti: <b>{{$order->created_at}}</b>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                                <div class="col border">
                                    <div class="container">
                                        <br>
                                        <h4 class="text-center">To'lov ma'lumotlari:</h4>
                                        <ol>
                                            <li>
                                                Konteynerning umumiy bahosi: <b>@money($order->container_price)</b>
                                            </li>
                                            <li>To'langan summa: <b>@money($order->payments->sum('paid_price'))</b>
                                            </li>
                                            <li>
                                                Qolgan summa: <b>@money($order->container_price-$order->payments->sum('paid_price'))</b>
                                            </li>
                                        </ol>
                                        @foreach($order->payments as $payment)
                                            <div class="card border-success mb-3 mx-auto" style="max-width: 18rem;">
                                                <div class="card-header bg-transparent border-success">Kirim
                                                    kartochkasi
                                                </div>
                                                <div class="card-body text-success">
                                                    <h5 class="card-title">@money($payment->paid_price)</h5>
                                                    <p class="card-text">{{$payment->payment_type}} orqali
                                                        o'tkazilgan.</p>
                                                </div>
                                                <div class="card-footer bg-transparent border-success">Sana:
                                                    {{$payment->payment_date}}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </di>
                            <br>
                            <div class="row">
                                <div class="col border">
                                    <div class="container">
                                        <br>
                                        <b>Konteynerning joylashuvini.</b>
                                        <div class="form-group">
                                            <div id="map"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
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
                draggable: false
            });
            google.maps.event.addListener(marker, 'dragend', function (a) {
                console.log(a);
                // var div = document.createElement('div');
                // div.innerHTML = a.latLng.lat().toFixed(4) + ', ' + a.latLng.lng().toFixed(4);
                // document.getElementsByTagName('body')[0].appendChild(div);
                // document.getElementById("lat").value = a.latLng.lat().toFixed(4);
                // document.getElementById("long").value = a.latLng.lng().toFixed(4)
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
