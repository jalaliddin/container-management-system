@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('To\'lov ma\'lumotlarini o\'zgartirish') }}</div>
                    <div class="container py-4">
                        <a href="{{route('payment.index')}}">
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
                        <form action="{{route('payment.update',$payment->id)}}" method="post" class="">
                            @method('patch')
                            @csrf
                            <div class="form-group">
                                <select class="custom-select" name="payment_type">
                                    @if($payment->payment_type)
                                        <option value="{{$payment->payment_type}}"
                                                selected>{{$payment->payment_type}}</option>
                                    @endif
                                    <option value="Bank orqali">Bank orqali</option>
                                    <option value="Kredit">Kredit</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="custom-select" name="pay_type">
                                    @if($payment->pay_type)
                                        <option value="{{$payment->pay_type}}" selected>{{$payment->pay_type}}</option>
                                    @endif
                                    <option value="To'lov">To'lov</option>
                                    <option value="To'lovni qaytarish">To'lovni qaytarish</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <b>To'lov summasi:</b>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="price-input"
                                           name="container_price_format" placeholder="To'lov summasi"
                                           value="{{$payment->paid_price}}">
                                </div>
                            </div>
                            <input hidden readonly type="number" id="number" name="paid_price"
                                   value="{{$payment->paid_price}}">
                            <div class="form-group">
                                <b>To'lov sanasi:</b>
                                <input name="payment_date" type="date" id="start" name="date"
                                       value="{{$payment->payment_date}}">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-warning float-right">Saqlash</button>
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
