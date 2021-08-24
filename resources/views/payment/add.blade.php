@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('To\'lovni kiritish') }}</div>
                    <div class="container py-4">
                        <a href="{{route('payment.index')}}">
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
                        <form id="savePayment" action="{{route('payment.store')}}" method="post" class="">
                            @csrf
                            <div class="form-group">
                                <select class="custom-select" name="order_id">
                                    @foreach($orders as $order)
                                        <option value="{{$order->id}}">{{$order->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="custom-select" name="payment_type">
                                    <option value="Bank ">Bank orqali</option>
                                    <option value="Kredit">Kredit</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="custom-select" name="pay_type">
                                    <option value="To'lov">To'lov</option>
                                    <option value="To'lovni qaytarish">To'lovni qaytarish</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <b>To'lov summasi:</b>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="price-input"
                                           name="container_price_format" placeholder="To'lov summasi">
                                </div>
                            </div>
                            <input hidden readonly type="number" id="number" name="paid_price">
                            <div class="form-group">
                                <b>To'lov sanasi:</b>
                                <input name="payment_date" type="date" id="start" name="date"
                                       value="">
                            </div>
                            <br>
                        </form>
                        <a href="#" class="btn btn-success float-right" onclick="saveConfirm('savePayment')">Saqlash</a>
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
