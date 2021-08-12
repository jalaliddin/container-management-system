@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header"><span>ID: <b>{{$order->id}}</b></span> {{ __('Mijoz ma\'lumotlarini') }} <span><b>{{$order->author}}</b> kiritdi.</span>
                    </div>
                    <div class="container py-4">
                        <a href="{{route('order.index')}}">
                            <button type="button" class="btn btn-secondary btn-sm">Orqaga</button>
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
                                                <div class="card-header bg-transparent border-success">Kirim kartochkasi</div>
                                                <div class="card-body text-success">
                                                    <h5 class="card-title">@money($payment->paid_price)</h5>
                                                    <p class="card-text">{{$payment->payment_type}} orqali o'tkazilgan.</p>
                                                </div>
                                                <div class="card-footer bg-transparent border-success">Sana:
                                                    {{$payment->payment_date}}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </di>
                            <hr>
                        </div>
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
