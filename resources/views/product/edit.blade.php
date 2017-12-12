@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Product</div>

                <div class="panel-body">
                    @include('includes.errors')
                    {{Form::model($product,['route'=>['product.update',$product->id],'method'=>'put','files'=>true])}}
                    <label for="">Name</label>
                    {{Form::text('name',null,['class'=>'form-control'])}}
                    <label for="">Price</label>
                    {{Form::number('price',null,['class'=>'form-control'])}}
                    <label for="">Image</label>
                    {{Form::file('image',null,['class'=>'form-control'])}}
                    <label for="">Description</label>
                    {{Form::textarea('des',null,['class'=>'form-control'])}}
                    <br>
                    {{Form::submit('Update Product',['class'=>'form-control btn btn-primary'])}}
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
