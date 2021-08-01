<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::all()->where('status',1);
        $completedOrdersAll = Order::all()->where('status',3);
        $orderQuantity = Order::all()->count();
        $activeOrders = Order::all()->where('status', '1')->count();
        $passiveOrders = Order::all()->where('status', '2')->count();
        $completedOrders = Order::all()->where('status', '3')->count();
        $topTowns = Order::all()
            ->groupBy('town');
        $sumContainerPrice = Order::all()->sum('container_price');
        $sumPayments = Payment::all()->sum('paid_price');
        $creditSum = $sumContainerPrice - $sumPayments;
        foreach ($topTowns as $town => $data){
            $modifiedTowns[] = [
                'town' => $town,
                'count' => count($data)
            ];
        }
        if (isset($modifiedTowns)){
            $collectedTowns = collect($modifiedTowns);
            $sortedTowns = $collectedTowns->sortByDesc('count');
        }else{
            $sortedTowns[] = [
                'town' => 'text',
                'count' => 'count'
            ];
        }
        return view('home', compact(
            'orderQuantity', 'activeOrders',
            'passiveOrders', 'completedOrders', 'sortedTowns',
            'sumContainerPrice','sumPayments', 'creditSum',
            'orders','completedOrdersAll'
        ));
    }
}
