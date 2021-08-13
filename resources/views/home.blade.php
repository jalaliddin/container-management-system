@extends('layouts.app')

@section('content')
    <style>
        #map {
            height: 400px;
            width: 100%;
            background-color: grey;
        }
    </style>
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
                                        <h3 class="card-title">@homeMoney($creditSum)</h3>
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
                                    <div id="map"></div>
                            </div>
                        </div>
                        <br>
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
                                            @foreach($ordersName as $orderName)
                                                <li><b>{{$orderName['name'] }}</b> - {{$orderName['phone']}}</li>
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
                                                <li><b>{{$completedOrderAll['name'] }}</b>
                                                    - {{$completedOrderAll['phone']}}</li>
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
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjebhPUM5ER3yiFDvN4uHoX8PlnYSrmuQ&callback=initMap">
    </script>
    <script>
        function initMap() {
            var center = {lat: 41.3565, lng: 60.8567};
            var locations = [
                @foreach($coordinates as $coordinate)
                ['Ism: name <br>\
    Tel.: phone <br>\
   <a href="{{route('order.show',1)}}">Batafsil ko\'rish</a>', {{$coordinate->address_latitude}}, {{$coordinate->address_longitude}}],
                    @endforeach
            ];
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 9,
                center: center
            });
            var infowindow = new google.maps.InfoWindow({});
            var marker, count;
            for (count = 0; count < locations.length; count++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[count][1], locations[count][2]),
                    map: map,
                    title: locations[count][0]
                });
                google.maps.event.addListener(marker, 'click', (function (marker, count) {
                    return function () {
                        infowindow.setContent(locations[count][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, count));
            }
        }
    </script>
@endsection
