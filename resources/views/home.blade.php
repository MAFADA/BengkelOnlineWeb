@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($products as $p)
        <div class="col-md-4">
            <div class="card" >
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$p->product_name}}</h5>
                    <p class="card-text">
                        <strong>Harga   :</strong> Rp. {{number_format($p->price)}} <br>                        
                    </p>
                    <a href="/order/{{$p->id}}" class="btn btn-primary"><i class="fa fa-eye"></i> Detail</a>
                </div>
            </div>
        </div>        
        @endforeach
    </div>
</div>
@endsection
