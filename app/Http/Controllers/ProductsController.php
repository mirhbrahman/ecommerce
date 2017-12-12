<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index')
        ->with('products', Product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $this->validate($request,[
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpg,jpeg,png|max:1000',
            'des' => 'required'
        ]);

        if ($image = $request->file('image')) {
            $new_name = time().'.'.$image->getClientOriginalExtension();
            $image->move('uploads/products',$new_name);
            $input['image'] = $new_name;
        }

        if (Product::create($input)) {
            Session::flash('success','Product create successfull.');
        }

        return redirect()->route('product.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('product.edit')
        ->with('product', Product::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $this->validate($request,[
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpg,jpeg,png|max:1000',
            'des' => 'required'
        ]);

        $product = Product::find($id);

        if ($image = $request->file('image')) {
            $name = $product->getOriginal('image');
            $image->move('uploads/products',$name);
            $input['image'] = $name;
        }

        if ($product->update($input)) {
            Session::flash('success','Product update successfull.');
        }

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product->delete()) {
            Session::flash('success','Product delete successfull.');
        }

        return redirect()->route('product.index');
    }
}
