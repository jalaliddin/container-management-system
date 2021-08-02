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
                        <span>Izlash:</span>
                        <p><input type="text" id="myInput" onkeyup="myFunction()"
                                  placeholder="Ism orqali izlash">
                            <a href="{{route('payment.create')}}">
                                <button type="button" class="btn btn-primary float-right">Yangi to'lov</button>
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
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#exampleModal{{$payment->id}}">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$payment->id}}" tabindex="-1" role="dialog"
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
                                                Haqiqatdan ham ushbu <b>{{$payment->order->name ?? 'Buyurtma o\'chirilgan'}}</b> buyurtmasini
                                                o'chirishni
                                                tasdiqlaysizmi?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Yopish
                                                </button>
                                                <form action="{{ route('payment.destroy',$payment->id) }}"
                                                      method="POST">
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
                td = tr[i].getElementsByTagName("td")[0];
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
    </script>
@endsection
