@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">All Product</div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Action</th>
                            </thead>

                            <tbody>
                                @if ($products)
                                    @foreach ($products as $product)
                                        <tr>
                                            <td><img width="50px" height="50px" src="{{$product->image}}" alt=""></td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>
                                                <a href="{{route('product.edit',$product->id)}}" class="btn btn-xs btn-info pull-left">Edit</a>
                                                {{Form::open(['route'=>['product.destroy',$product->id],'method'=>'delete'])}}
                                                {{Form::submit('Delete',['class'=>'btn btn-xs btn-danger pull-right'])}}
                                                {{Form::close()}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <h3>No product found</h3>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
