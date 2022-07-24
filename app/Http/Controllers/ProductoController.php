<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::orderBy('created_at','DESC')->paginate(10);
        return view('inventario.index',['productos'=> $productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('inventario.edit', compact('categorias'));
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
            'nombre' => 'required',
            'referencia' => 'required',
            'categoria_id' => 'required',
            'peso' => 'required',
            'precio' => 'required',
            'stock' => 'required',
        ]);
    
        $producto = Producto::create($request->all());
     
        return redirect()->route('producto.crear')
                        ->with('success',"El producto {$producto->nombre} a sido creado.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorias = Categoria::all();
        $producto = Producto::where('id',$id)->with('categoria')->first();
        return view('inventario.edit',compact('producto','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'referencia' => 'required',
            'categoria_id' => 'required',
            'peso' => 'required',
            'precio' => 'required',
            'stock' => 'required',
        ]);
    
        $producto = Producto::where('id',$id)->first();
        $producto->update($request->all());
     
        return redirect()->route('inventario');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::where('id',$id)->first();
        $producto->delete();

        return redirect()->route('inventario');
    }
}
