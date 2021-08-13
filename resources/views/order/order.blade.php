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
                                        <input  name="q" type="text" placeholder="ism bo'yicha qidirish"/>
                                        <input  name="phone" type="number" placeholder="telefon raqam bo'yicha qidirish"/>
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
                                        <button class="btn-secondary btn" type="submit">Izlash</button>
                                    </form>
                                </div>
                                <div class="col-3">
                                    <div class="btn-toolbar pull-right">
                                        <a href="{{route('export.order')}}">
                                            <button type="button" class="btn btn-success mr-3">Excel</button>
                                        </a>
                                        <a href="{{route('order.create')}}">
                                            <button type="button" class="btn btn-primary mr-3">Yangi buyurtma</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
{{--                            <span>Izlash:</span>--}}
{{--                            <p>--}}
{{--                            <input type="text" id="myInput" onkeyup="myFunction()"--}}
{{--                                  placeholder="Telefon raqam orqali izlash">--}}
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
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#exampleModal{{$order->id}}">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$order->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">E'tibor bering!</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Haqiqatdan ham ushbu <b>{{$order->name}}</b> buyurtmasini o'chirishni
                                                tasdiqlaysizmi?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Yopish
                                                </button>
                                                <form action="{{ route('order.destroy',$order->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Tasdiqlayman</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("orderTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function filterTable() {
            // Variables
            let dropdown, table, rows, cells, country, filter;
            dropdown = document.getElementById("statusDropdown");
            table = document.getElementById("orderTable");
            rows = table.getElementsByTagName("tr");
            filter = dropdown.value;

            // Loops through rows and hides those with countries that don't match the filter
            for (let row of rows) { // `for...of` loops through the NodeList
                cells = row.getElementsByTagName("td");
                country = cells[7] || null; // gets the 2nd `td` or nothing
                // if the filter is set to 'All', or this is the header row, or 2nd `td` text matches filter
                if (filter === "All" || !country || (filter === country.textContent)) {
                    row.style.display = ""; // shows this row
                } else {
                    row.style.display = "none"; // hides this row
                }
            }
        }
    </script>
@endsection
