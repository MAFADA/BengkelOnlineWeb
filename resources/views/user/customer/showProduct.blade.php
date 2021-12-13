@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">                
                    <div class="card-header">
                        <h4>{{ $product->product_name }}</h4>
                    </div>                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">                                
                                <img src="..." class="rounded mx-auto
                                d-block" width="100%" alt="Card image cap">
                            </div>
                            <div class="col-md-6 mt-5">
                                <h2>{{ $product->product_name }}</h2>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Price</td>
                                            <td>:</td>
                                            <td>Rp.  {{number_format($product->price) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Stock</td>
                                            <td>:</td>
                                            <td>{{number_format($product->stock) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td>:</td>
                                            <td>{{$product->description}}</td>
                                        </tr>
                                        <tr>
                                            <td>Quantity</td>
                                            <td>:</td>
                                            <td>
                                                <form action="{{url('order')}}/{{$product->id}}" method="post">
                                                    @csrf
                                                    <input type="text" name="qty" class="form-control"
                                                    required="">
                                                    <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-shopping-cart"></i> 
                                                    Add to Cart</button>
                                                </form>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection