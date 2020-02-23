<?php

namespace App\Http\Controllers\Order;

use App\Model\Cart;
use App\Model\OrderDetail;
use App\Http\Controllers\Controller;
use App\Model\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use View;
use DB;
use Carbon\Carbon;
use App\Model\Order;
use App\Http\Controllers\Cart\CartController;

class OrderController extends Controller {
    private $carts;

    public function getPaymentPending ($user_id) {
        $payments = Payment::where('user_id', $user_id)->get();
        $paymentPending = 0;

        foreach ($payments as $payment) {
            if ($payment->payment_status === Payment::PAYMENT_PENDING) {
                $paymentPending++;
            }
        }

        View::share('paymentPending', $paymentPending);
    }

    public function __construct($className = 'OtherController') {
        if ($className == 'OtherController') {
            $this->carts = new CartController();
        }
    }

    public function index(Request $request) {
        if (Auth::id() !== null) {
            $this->getPaymentPending(Auth::id());
            $this->carts->getCart(Auth::id());
        }

        $NUM_PAGE = 6;
        $page = $request->input('page');
        $page = ($page != null) ? $page : 1;

        $paymentDetails = DB::table('order_details')->join('payments', 'payments.order_id', '=', 'order_details.order_id')
                                                    ->join('products', 'products.product_id', '=', 'order_details.product_id')
                                                    ->where('payments.user_id', Auth::id())
                                                    ->get();

        $payments = Payment::where('user_id', Auth::id())
                           ->orderBy('payments.payment_id', 'desc')
                           ->paginate($NUM_PAGE);


        return view('customer.order')->with('payments', $payments)
                                          ->with('paymentDetails', $paymentDetails)
                                          ->with('page', $page)
                                          ->with('NUM_PAGE' ,$NUM_PAGE);
    }

    public function checkout() {
        $currentTime = Carbon::now();
        if (Auth::id() !== null) {
            $this->getPaymentPending(Auth::id());
            $this->carts->getCart(Auth::id());
        }

        $totalPrice = 0;
        $products = DB::table('carts')->join('products', 'carts.product_id', '=', 'products.product_id')
                                      ->where('carts.user_id', Auth::id())
                                      ->orderBy('carts.quantity', 'asc')
                                      ->get();

        foreach ($products as $product) {
            $totalPrice += $product->total;
        }

        $userDetail = DB::table('user_details')->join('users', 'users.id', '=', 'user_details.user_id')
                                               ->where('user_id', Auth::id())
                                               ->first();

        if ($totalPrice > 0) {
            $order = Order::create([
                'order_date' => $currentTime,
                'order_total' => $totalPrice,
                'user_id' => Auth::id()
            ]);

            foreach ($products as $product) {
                OrderDetail::create([
                    'order_id' => $order['order_id'],
                    'product_id' => $product->product_id,
                    'order_detail_quantity' => $product->quantity,
                    'order_detail_total' => $product->total
                ]);

                Cart::destroy($product->cart_id);
            }

            $hasAddress = $this->validateAddress($userDetail);

            $payment = Payment::create([
                'payment_date' => $currentTime,
                'user_id' => Auth::id(),
                'order_id' => $order['order_id'],
                'payment_total' => $order['order_total'],
                'payment_status' => Payment::PAYMENT_PENDING
            ]);

            return view('customer.checkout')->with('products', $products)
                                                 ->with('userDetail', $userDetail)
                                                 ->with('totalPrice', $totalPrice)
                                                 ->with('hasAddress', $hasAddress)
                                                 ->with('paymentId', $payment->payment_id);
        } else {
            return redirect('order');
        }
    }

    public function checkoutByPaymentId($paymentId) {
        if (Auth::id() !== null) {
            $this->getPaymentPending(Auth::id());
            $this->carts->getCart(Auth::id());
        }

        $payment = Payment::findOrFail($paymentId);
        if ($payment->payment_status == Payment::PAYMENT_PENDING) {
            $totalPrice = 0;
            $products = DB::table('order_details')->join('products', 'order_details.product_id', '=', 'products.product_id')
                                                  ->where('order_details.order_id', $payment->order_id)
                                                  ->orderBy('order_details.order_detail_quantity', 'asc')
                                                  ->get();

            $userDetail = DB::table('user_details')->join('users', 'users.id', '=', 'user_details.user_id')
                                                   ->where('user_id', Auth::id())
                                                   ->first();

            foreach ($products as $product) {
                $totalPrice += $product->order_detail_total;
            }

            $hasAddress = $this->validateAddress($userDetail);

            return view('customer.checkout')->with('products', $products)
                                                 ->with('userDetail', $userDetail)
                                                 ->with('totalPrice', $totalPrice)
                                                 ->with('hasAddress', $hasAddress)
                                                 ->with('paymentId', $paymentId);
        } else {
            abort(503, 'Payment status is paid');
        }
    }

    private function validateAddress($user) {
        $hasAddress = true;

        if (empty($user->user_address)) {
            $hasAddress = false;
        }

        if (empty($user->user_district)) {
            $hasAddress = false;
        }

        if (empty($user->user_province)) {
            $hasAddress = false;
        }

        if (empty($user->user_country)) {
            $hasAddress = false;
        }

        if (empty($user->user_postcode)) {
            $hasAddress = false;
        }

        return $hasAddress;
    }
}
