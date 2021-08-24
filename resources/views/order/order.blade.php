@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Buyurtmalar') }}</div>
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
                            <div class="row">
                                <div class="col-9">
                                    <form action="{{route('orders.search')}}" method="get">
                                        <input  name="q" type="text" placeholder="Ism bo'yicha qidirish"/>
                                        <input  name="phone" type="number" placeholder="Telefon raqam bo'yicha qidirish"/>
                                        <select id="statusDropdown" name="status">
                                            <option value="">Hammasi</option>
                                            <option value="1">Faol</option>
                                            <option value="2">Bekor qilingan</option>
                                            <option value="3">Tayyor</option>
                                        </select>
                                        <select name="town">
                                            <option value="">Hammasi</option>
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
                                        <button class="btn-secondary btn" type="submit"><i class="fas fa-search"></i> Izlash</button>
                                    </form>
                                </div>
                                <div class="col-3">
                                    <div class="btn-toolbar">
                                        <a href="{{route('export.order')}}">
                                            <button type="button" class="btn btn-success mr-3"><i class="fas fa-file-excel"></i> Excel</button>
                                        </a>
                                        <a href="{{route('order.create')}}">
                                            <button type="button" class="btn btn-primary mr-3"><i class="fas fa-plus"></i>Yangi buyurtma</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <br>
                        <table class="table table-striped table-hover" id="orderTable">
                            <thead>
                            <tr>
                                <th>Ism</th>
                                <th>Telefon</th>
                                <th>Shahar/Tuman</th>
                                <th>Konteyner Turi</th>
                                <th>Umumiy summa</th>
                                <th>To'lov summasi</th>
                                <th>Qarzdorlik</th>
                                <th>Holati</th>
                                <th>Amaliyot</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->name}}</td>
                                    <td>{{$order->phone}}</td>
                                    <td>{{$order->town}}</td>
                                    <td>{{$order->container_type}}</td>
                                    <td>@money($order->container_price)</td>
                                    <td>@money($order->payments->sum('paid_price'))</td>
                                    <td>@money($order->container_price-$order->payments->sum('paid_price'))</td>
                                    <td>@if($order->status==1)<font
                                            color="blue">{{'Faol'}}</font>@elseif($order->status==2)<font
                                            color="red">{{'Bekor qilingan'}}</font>@elseif($order->status==3)<font
                                            color="green">{{'Tayyor'}}</font>@endif</td>
                                    <td>
                                        <a href="{{route('order.show', $order->id)}}">
                                            <button type="button" class="btn btn-primary btn-sm"><i
                                                    class="far fa-eye"></i>
                                            </button>
                                        </a>
                                        <a href="{{route('order.edit', $order->id)}}">
                                            <button type="button" class="btn btn-success btn-sm"><i
                                                    class="fas fa-edit"></i>
                                            </button>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm" onclick="deleteConfirm('deleleteOrder')"><i class="fas fa-trash-alt"></i></a>
                                        <form id="deleleteOrder" action="{{ route('order.destroy',$order->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
