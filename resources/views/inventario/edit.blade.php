<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 sm:px-25 bg-white border-b border-gray-200">

                    <div class="mt-8 text-2xl">
                        Producto.
                    </div>
                    <br>

                    <div class="col-12">
                        <div class="container-fluid">
                            {{$success ?? ''}}
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
                        @if (isset($producto->id))
                            <form action="{{ route('producto.actualizar', $producto->id ) }}" method="post">
                            @method('PUT')
                        @else
                            <form action="{{ route('producto.crea') }}" method="post">
                        @endif
                            @csrf
                            
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Nombre Producto:</strong>
                                        <input type="text" name="nombre" value="{{ $producto->nombre ?? old('nombre') }}" class="form-control" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Referencia:</strong>
                                        <input type="text" name="referencia" value="{{ $producto->referencia ?? old('referencia') }}" class="form-control" placeholder="Referencia">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Categoria:</strong>
                                        <select class="form-control"  name="categoria_id" value="{{$producto->categoria_id ?? old('categoria_id')}}" >
                                            @foreach ($categorias as $categoria)
                                                <option value="{{$categoria->id}}" {{  isset($producto->categoria_id) && $producto->categoria_id === $categoria->id ? 'selected' : ''}}> {{$categoria->categoria }}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Peso:</strong>
                                        <input type="number" name="peso" value="{{ $producto->peso ?? old('peso') }}" class="form-control" placeholder="Peso">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Precio:</strong>
                                        <input type="number" name="precio" value="{{ $producto->precio ?? old('precio') }}" class="form-control" placeholder="Precio">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Stock:</strong>
                                        <input type="number" name="stock" value="{{ $producto->stock ?? old('stock') }}" class="form-control" placeholder="Cantidad">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                  <button onclick="submit()" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </form>
                        

                        </div>                                
                    </div>

                    <br>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>