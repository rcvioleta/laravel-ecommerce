<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index')->with('products', Product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required | numeric',
            'image' => 'required | image | mimes:jpeg,png,jpg,gif,svg | max:2048',
            'description' => 'required'
        ]); 

        $image = $request->image;
        $image_name = time() . $image->getClientOriginalName();
        $image->move('uploads/products', $image_name);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => 'uploads/products/' . $image_name,
            'description' => $request->description
        ]);

        $request->session()->flash('success', 'New product was added successfully!');
        return redirect()->back();
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
        return view('products.edit')->with('product', Product::find($id));
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
        $request->validate([
            'name' => 'required',
            'price' => 'required | numeric',
            'description' => 'required'
        ]); 

        $product = Product::find($id);

        if ($request->hasFile('image')) 
        {
            $request->validate(['image' => 'required | image | mimes:jpeg,png,jpg,gif,svg | max:2048']);
            $image = $request->image;
            $image_name = time() . $image->getClientOriginalName();
            $image->move('uploads/products', $image_name);
            $product->image = 'uploads/products/' . $image_name;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        Session::flash('success', 'Product was updated successfully!');
        return redirect()->back();
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
        $product->delete();

        Session::flash('success', 'Product was deleted successfully!');
        return redirect()->back();
    }
}
