<?php

namespace App\Http\Controllers\Cust;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Alert;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $product = Product::where('id',$id)->first();

        return view('user.customer.showProduct', compact('product'));
    }

    public function order(Request $request, $id){
        $product = Product::where('id',$id)->first();
        $tanggal = Carbon::now();

        //validasi apakah melebihi stock
        if($request->qty > $product->stock){
            return redirect('order/'.$id);
        }

        //cek validasi
        $cek_order =  Order::where('cust_id',Auth::user()->id)->where('status',0)->first();    

        //simpan ke DB order
        if(empty($cek_order)){
            $order = new Order;
            $order->cust_id = Auth::user()->id;
            $order->orderdate = $tanggal;
            $order->status = 0;
            $order->total_price = 0;
            $order->save();
        }

        //simpan ke dB orderdetail
        $new_order = Order::where('cust_id',Auth::user()->id)->where('status',0)->first();

        //cek order_detail
        $cek_order_detail = OrderDetail::where('product_id',$product->id)->where('order_id',$new_order->id)->first();

        if(empty($cek_order_detail)){

            $order_detail = new OrderDetail;
            $order_detail->product_id = $product->id;
            $order_detail->order_id = $new_order->id;
            $order_detail->total_product = $request->qty;
            $order_detail->total_price_product = $product->price*$request->qty;
            $order_detail->save();
        }else{
            $order_detail = OrderDetail::where('product_id',$product->id)->where('order_id',$new_order->id)->first();
            $order_detail->total_product = $order_detail->total_product+$request->qty;
            
            //harga sekarang
            $price_order_detail_baru = $product->price*$request->qty;
            $order_detail->total_price_product = $order_detail->total_price_product+$price_order_detail_baru;
            $order_detail->update();
        }
        //order total
        $order = Order::where('cust_id',Auth::user()->id)->where('status',0)->first();
        $order->total_price= $order->total_price+$product->price*$request->qty;
        $order->update();

        Alert::success('Order Enter the Cart Successfully', 'Success');
        return redirect('checkout');
    }

    public function checkout(){
        $order = Order::where('cust_id',Auth::user()->id)->where('status',0)->first();        
        if (!empty($order)) {            
            $order_details = OrderDetail::where('order_id',$order->id)->get();
            return view('user.customer.checkout', compact('order','order_details'));
        }
        
    }

    public function delete($id){
        $order_detail = OrderDetail::where('id',$id)->first();
        
        $order = Order::where('id',$order_detail->order_id)->first();
        $order->total_price = $order->total_price-$order_detail->total_price_product;
        $order->update();

        $order_detail->delete();
        Alert::error('Order Deleted Successfully', 'Delete');
        return redirect('checkout');
    }

    public function confirm(){
        $order = Order::where('cust_id',Auth::user()->id)->where('status',0)->first();
        $order_id = $order->id;
        //ubah stock        
        $order->status = 1;
        $order->update();

        $order_details = OrderDetail::where('order_id',$order_id)->get();
        foreach($order_details as $od)
        {
            $product = Product::where('id', $od->product_id)->first();
            $product->stock = $product->stock-$od->total_product;
            $product->update();
        }

        Alert::error('Order Successfully Checkout', 'Success');
        return redirect('home');
    }
}
