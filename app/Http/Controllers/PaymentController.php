<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:edit payments|delete payments|create payments|read payments', ['only' => ['index','show']]);
        $this->middleware('permission:create payments', ['only' => ['create','store']]);
        $this->middleware('permission:edit payments', ['only' => ['edit','update']]);
        $this->middleware('permission:delete payments', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::orderBy('created_at', 'desc')->paginate(10);
        return view('payment.payment', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orders = Order::all()->sortByDesc('created_at');
        return view('payment.add', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentRequest $request)
    {
        $order = Order::find($request->order_id);
        $payment = new Payment();
        $payment->payment_type = $request->payment_type;
        $payment->pay_type = $request->pay_type;
        $payment->paid_price = $request->paid_price;
        $payment->payment_date = $request->payment_date;
        $order = $order->payments()->save($payment);

        return redirect()->route('payment.index')
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::find($id);
        return view('payment.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePaymentRequest $request, $id)
    {
        $payment = Payment::find($id);
        $payment->payment_type = $request->payment_type;
        $payment->pay_type = $request->pay_type;
        $payment->paid_price = $request->paid_price;
        $payment->payment_date = $request->payment_date;
        $payment->save();

        return redirect('/payment')->with('message', 'Ma\'lumotlar muvaffaqiyatli yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payment.index')
            ->with('message', 'O\'chirildi');
    }
}
