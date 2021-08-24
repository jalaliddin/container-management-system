@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('To\'lovlar') }}</div>
                    <div class="container py-4">
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
                        <a href="{{route('payment.create')}}">
                            <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Yangi to'lov</button>
                        </a>
                        <br>
                        <br>
                        <table class="table table-striped table-hover" id="orderTable">
                            <thead>
                            <tr>
                                <th>To'lovchining ismi</th>
                                <th>To'lov turi</th>
                                <th>To'lov shakli</th>
                                <th>To'lov miqdori</th>
                                <th>To'lov sanasi</th>
                                <th>Amaliyot</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{$payment->order->name ?? 'Buyurtma o\'chirilgan'}}</td>
                                    <td>{{$payment->payment_type}}</td>
                                    <td>{{$payment->pay_type}}</td>
                                    <td>@money($payment->paid_price)</td>
                                    <td>{{$payment->payment_date}}</td>
                                    <td>
                                        <a href="{{route('payment.edit', $payment->id)}}">
                                            <button type="button" class="btn btn-success btn-sm"><i
                                                    class="fas fa-edit"></i>
                                            </button>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm" onclick="deleteConfirm('deleleteOrder')"><i class="fas fa-trash-alt"></i></a>
                                        <form id="deleleteOrder" action="{{ route('payment.destroy',$payment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
