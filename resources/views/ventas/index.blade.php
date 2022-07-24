<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('A vender') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 sm:px-25 bg-white border-b border-gray-200">

                    <div class="mt-8 text-2xl">
                        Vamos a registrar ventas.
                    </div>
                    <br>

                    <div class="col-12">
                        <div class="container-fluid">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Mmm!</strong> Revisa los datos ingresados.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif           
                        <form action="{{ route('ventas.crea') }}" method="post">
                            @csrf
                            
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Cliente:</strong>
                                        <input type="numeric" name="cliente" value="{{ old('cliente') }}" class="form-control" placeholder="Cliente">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Nombre Producto:</strong>
                                        <select class="form-control"  name="producto_id" value="{{old('producto_id')}}" >
                                            @foreach ($productos as $producto)
                                                <option value="{{$producto->id}}" {{ $producto->id === old('producto_id') ? 'selected' : ''}}> {{$producto->nombre}} ($ {{number_format($producto->precio)}}) ({{$producto->categoria->categoria}})</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Cantidad:</strong>
                                        <input type="number" name="cantidad" value="{{ old('cantidad') }}" class="form-control" placeholder="Cantidad">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button onclick="submit()" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <table class="table table-lg ">
                            <thead>
                                <tr>
                                    <th scope="col">Id Venta</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Valor Unitario</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Valor Total</th>
                                    <th scope="col">Fecha Creación</th>
                                </tr>                                    
                            </thead>
                            <tbody>
                            @forelse ($ventas as $venta)
                                <tr class="table-light">
                                    
                                    <td>{{$venta->id}}</td>
                                    <td>{{$venta->cliente}}</td>
                                    <td>{{$venta->producto->nombre}}</td>
                                    <td>${{number_format($venta->producto->precio)}}</td>
                                    <td>{{number_format($venta->cantidad)}}</td>
                                    <td>${{number_format($venta->precio_total)}}</td>
                                    <td>{{date_format($producto->created_at,"d/m/Y")}}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3"><h1>No existen Ventas.</h1></td></tr>
                            @endforelse
                                                                
                            </tbody>
                        </table>

                        </div>                                
                    </div>


                    <br>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>