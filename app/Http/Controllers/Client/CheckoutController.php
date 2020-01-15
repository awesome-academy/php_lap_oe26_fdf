<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use Auth;
use Session;

class CheckoutController extends Controller
{
    private $orderRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        OrderDetailRepositoryInterface $orderdetailRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderdetailRepository = $orderdetailRepository;
    }

    public function checkoutCart(Request $request)
    {
        $cart = Session::get('cart');
        $sumtotal = config('config.zero') ;
        if (count((array)session('cart')) > config('config.zero')){
            foreach (session('cart') as $id => $details) {
                $sumtotal += $details['price'] * $details['quantity'];
            }
        } else {
            return redirect()->route('cart');
        }
        $data =[
            'user_id' => Auth::user()->id,
            'date_order' => date('Y-m-d'),
            'total' => $sumtotal,
            'status' => config('config.zero'),
            'note' => $request['notes'],
        ];
        $order = $this->orderRepository->create($data);
        foreach ($cart as $key => $value) {
            $data =[
            'order_id' => $order->id,
            'product_id' => $key,
            'quantity' => $value['quantity'],
            'price' => $value['price'],
        ];

        $this->orderdetailRepository->create($data);
        }
        Session::forget('cart');

        return redirect()->route('index');
    }
}
