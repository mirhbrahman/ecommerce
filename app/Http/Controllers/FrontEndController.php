<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class FrontEndController extends Controller
{
    public function index()
    {
        return view('index')->with('products', Product::paginate(3));
    }

    public function singleProduct($id)
    {
        return view('single')->with('product', Product::find($id));
    }
}
