<?php

namespace App\Http\Controllers;

use App\Http\Requests\VentaPostRequest;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::with('categoria')->orderByRaw('id DESC')->get();
        $ventas = Venta::orderByRaw('id DESC')->get();
        return view('ventas.index',compact('productos','ventas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VentaPostRequest $request)
    {
    
        $producto = Producto::where('id', $request->producto_id)->first();

        $venta = new Venta();

        $venta->cliente = $request->cliente;
        $venta->producto_id = $request->producto_id;
        $venta->cantidad = $request->cantidad;
        $venta->precio_total = $producto->precio * $request->cantidad;
        $venta->save();

        $producto->stock = $producto->stock - $request->cantidad;
        $producto->save();

        return redirect()->route('ventas.index');
    }

    /**
     * Main Resume
     *
     * @return void
     */
    public function informe (){
        

        $venta = DB::table('ventas')
            ->join('productos', 'productos.id', '=', 'ventas.producto_id')
            ->selectRaw('sum(ventas.cantidad) as cantidad, productos.nombre')
            ->groupBy('productos.id')
            ->orderByDesc('cantidad')
            ->first();

        $stock = DB::table('productos')
            ->selectRaw('sum(stock) as cantidad, nombre')
            ->groupBy('productos.id')
            ->orderByDesc('cantidad')
            ->first();

        $data = ['masVendido' => $venta,
                 'masStock' => $stock,
        ];

        return view('ventas.informes',compact('data'));
    }
}
