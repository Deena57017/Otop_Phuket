<?php

namespace App\Http\Controllers\User;

use App\Model\Cart;
use App\Model\OrderDetail;
use App\Model\UserDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;

class UserCustomerController extends Controller {
    public function updateUserDetail(Request $request) {
        $paymentId = $request->get('payment_id');

        $validate = Validator::make($request->all(),[
            'user_address' => 'required',
            'user_district' => 'required',
            'user_province' => 'required',
            'user_country' => 'required',
            'user_postcode' => 'required'
        ], [
            'user_address.required' => 'กรุณากรอกที่อยู่',
            'user_district.required' => 'กรุณากรอกตำบล',
            'user_province.required' => 'กรุณากรอกจังหวัด',
            'user_country.required' => 'กรุณากรอกประเทศ',
            'user_postcode.required' => 'กรุณากรอกรหัสไปรษณีย์',
        ]);

        if($validate->passes()) {
            $data = $request->all();
            $userDetail = UserDetail::where('user_id', Auth::id())->first();
            $userDetail->user_address =  $data['user_address'];
            $userDetail->user_district =  $data['user_district'];
            $userDetail->user_province =  $data['user_province'];
            $userDetail->user_country =  $data['user_country'];
            $userDetail->user_postcode =  $data['user_postcode'];
            $userDetail->update();
            return redirect('checkout/' . $paymentId);
        }
        else {
            return redirect('checkout/' . $paymentId)->withErrors($validate)->withInput();
        }
    }

    public function deleteProduct ($product_id) {
        $carts = Cart::where('product_id', $product_id)->get();
        $countCart = $carts->count();

        $order_details = OrderDetail::where('product_id',  $product_id)->get();
        $countOrderDetail = $order_details->count();

        if ($countCart === 0 && $countOrderDetail === 0) {
            Product::destroy($product_id);
            return redirect('product');
        }

        return redirect()->back()->with('fail', 'ไม่สามารถลบได้');
    }

}
