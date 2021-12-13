@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3><i class="fa fa-shopping-cart"></i> Checkout</h3>
                        @if(!empty($order))
                        <p align="right">Order Date: {{ $order->orderdate }}</p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1;?>
                                @foreach($order_details as $od)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{ $od->products->product_name }}</td>
                                        <td>{{ $od->total_product }}</td>
                                        <td align="left">Rp. {{ number_format($od->products->price) }}</td>
                                        <td align="left">Rp. {{ number_format($od->total_price_product) }}</td>
                                        <td>
                                            <form action="{{url('checkout')}}/{{$od->id}}" method="post">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa 
                                                fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" align="right"><strong>Total Price :</strong></td>
                                    <td><strong>Rp. {{ number_format($order->total_price) }}</strong></td>
                                    <td>
                                        <a href="{{ url('konfirm-checkout') }}" class="btn btn-success">
                                            <i class="fa fa-shopping-cart"></i> Checkout
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>            
        </div>
    </div>
@endsection