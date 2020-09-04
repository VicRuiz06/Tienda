<?php

use Illuminate\Http\Request;
//importación del modelo que ayuda a gestionar los registros de la bd
use App\Product;

//Autentica al usuario
Route::middleware('auth')->group(function(){

Route::get('products', function(){
	$products = Product::orderBy('created_at', 'desc')->get();
	return view('products.index', compact('products'));
})->name('products.index');

Route::get('products/create', function(){
	return view('products.create');
})->name('products.create');

Route::post('products', function(Request $request){
	//NUeva instancia a partir del modelo
	 $newProduct = new Product;
	 //asignando valores de los campos del formulario
	 $newProduct->description = $request->input('description');
	 $newProduct->price = $request->input('price');
	 $newProduct->save();

	 return redirect()->route('products.index')->with('info', 'Producto creado exitosamente');
})->name('products.store');

Route::delete('products/{id}', function($id){
	$product = Product::findOrFail($id);
	$product->delete();
	return redirect()->route('products.index')->with('info', 'Producto eliminado exitosamente');
})->name('products.destroy');

Route::get('products/{id}/edit', function($id){
	$product = Product::findOrFail($id);
	return view('products.edit', compact('product'));
})->name('products.edit');

Route::put('/products/{id}', function(Request $request, $id){
	$product = Product::findOrFail($id);
	$product->description = $request->input('description');
	$product->price = $request->input('price');
	$product->save();
	return redirect()->route('products.index')->with('info', 'Producto actualizado exitosamente');
})->name('products.update');

});

Auth::routes();




