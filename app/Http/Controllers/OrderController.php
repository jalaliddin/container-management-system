<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Models\OrderCoordinates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('order.order', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
//        dd($request);
        $order = Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'container_price' => $request->container_price,
            'town' => $request->town,
            'status' => $request->status,
            'container_type' => $request->container_type,
            'table_1' => $request->type_1,
            'table_2' => $request->type_2,
            'table_3' => $request->type_3,
            'table_4' => $request->type_4,
            'table_5' => $request->type_5,
            'table_6' => $request->type_6,
            'table_7' => $request->type_7,
            'description' => $request->description,
            'author' => Auth::user()->name
        ]);

        $coordinates = new OrderCoordinates();
        $coordinates->address_latitude = $request->lat;
        $coordinates->address_longitude = $request->long;
        $order->payments()->save($coordinates);

        return redirect()->route('order.index')
            ->with('message', 'Ma\'lumotlar muvaffaqiyatli saqlandi!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
//        dd($order->coordinate);
        return view('order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return view('order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrderRequest $request, $id)
    {
        $order = Order::find($id);
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->container_price = $request->container_price;
        $order->town = $request->town;
        $order->status = $request->status;
        $order->container_type = $request->container_type;
        $order->table_1 = $request->type_1;
        $order->table_2 = $request->type_2;
        $order->table_3 = $request->type_3;
        $order->table_4 = $request->type_4;
        $order->table_5 = $request->type_5;
        $order->table_6 = $request->type_6;
        $order->table_7 = $request->type_7;
        $order->description = $request->description;
        $order->author = 1;
        $order->save();
        return redirect('/order')->with('message', 'Contact updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->coordinate()->delete();
        $order->delete();
        return redirect()->route('order.index')
            ->with('message', 'O\'chirildi');
    }

    public function search(Request $request)
    {

        $orders = Order::orderBy('created_at', 'desc');

        if(!empty(request('q'))){
            $query= $request->q;
            $orders = Order::where('name', 'LIKE', '%' . $query . '%');
        }

        if(!empty(request('phone'))){
            $query= $request->phone;
            $orders = Order::where('phone', 'LIKE', '%' . $query . '%');
        }

        if (!empty(request('status'))){
            $orders = Order::where('status',$request->status);
        }

        if (!empty(request('town'))){
            $orders = Order::where('town',$request->town);
        }

        $orders = $orders->paginate(10);

        return view('order.order',compact('orders'));

    }

    public function export()
    {
        return Excel::download(new OrdersExport, 'buyurtmalar.xlsx');
    }

}
