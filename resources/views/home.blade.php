@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Asosiy ko\'rsatgichlar') }}</div>
                    <div class="container py-4">
                        <div class="row">
                            <div class="col">
                                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Umumiy buyurtmalar summasi</div>
                                    <div class="card-body">
                                        <h3 class="card-title">@homeMoney($sumContainerPrice)</h3>
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Umumiy kirimlar summasi</div>
                                    <div class="card-body">
                                        <h3 class="card-title">@homeMoney($sumPayments)</h3>
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Umumiy qarzdorlarning summasi</div>
                                    <div class="card-body">
                                        <h3 class="card-title">@money($creditSum)</h3>
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Umumiy buyurtmalar soni</div>
                                    <div class="card-body">
                                        <h3 class="card-title">{{$orderQuantity}}</h3>
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card text-dark bg-warning mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Bekor qilingan buyurtmalar soni</div>
                                    <div class="card-body">
                                        <h3 class="card-title">{{$passiveOrders}}</h3>
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Tayyor buyurtmalar soni</div>
                                    <div class="card-body">
                                        <h3 class="card-title">{{$completedOrders}}</h3>
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card border-primary mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Faol shahar/tumanlar</div>
                                    <div class="card-body text-primary">
                                        <h5 class="card-title"></h5>
                                        <p class="card-text">
                                        <ol>
                                            @foreach($sortedTowns as $town)
                                                <li><b>{{$town['town'] }}</b> - {{$town['count']}} ta buyurtma</li>
                                            @endforeach
                                        </ol>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card border-primary mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Faol buyurtmachilar</div>
                                    <div class="card-body text-primary">
                                        <h5 class="card-title"></h5>
                                        <p class="card-text">
                                        <ol>
                                            @foreach($orders as $order)
                                                <li><b>{{$order['name'] }}</b> - {{$order['phone']}}</li>
                                            @endforeach
                                        </ol>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card border-primary mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Buyurtmasi tayyorlar</div>
                                    <div class="card-body text-primary">
                                        <h5 class="card-title"></h5>
                                        <p class="card-text">
                                        <ol>
                                            @foreach($completedOrdersAll as $completedOrderAll)
                                                <li><b>{{$completedOrderAll['name'] }}</b> - {{$completedOrderAll['phone']}}</li>
                                            @endforeach
                                        </ol>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
