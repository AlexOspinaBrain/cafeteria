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
                        Vamos a administrar el inventario.
                    </div>
                    <br>

                    <div class="col-12">
                        <div class="container-fluid">
                            
                            <div class="row">
                                <div class="col">
                                    <div class="mt-10 text-2xl">
                                        <h1>Listado de Productos</h1>
                                    </div>
                                    <a class="btn btn-primary btn-sm float-center" href="{{ route('producto.crear') }}">Crear nuevo producto</a>
                                </div>
                                <br>
                                <div class="col">
                                    <nav class="navbar navbar-light float-right">
                                        <div class="container-fluid">
                                        <form class="d-flex">
                                            <input name="schcedula" class="form-control me-2" type="search" placeholder="Buscar por nombre" aria-label="Search">
                                            <button class="btn btn-outline-success" type="submit">Buscar</button>
                                        </form>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                            <br>
                            <table class="table table-lg ">
                                <thead>
                                    <tr>
                                        
                                        <th scope="col">Id Producto</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Referencia</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Peso</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Fecha Creación</th>
                                        <th scope="col">Opciones</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                @forelse ($productos as $producto)
                                    <tr class="table-light">
                                        
                                        <td>{{$producto->id}}</td>
                                        <td>{{$producto->nombre}}</td>
                                        <td>{{$producto->referencia}}</td>
                                        <td>{{$producto->categoria->categoria}}</td>
                                        <td>{{number_format($producto->peso,2,'.')}}kg.</td>
                                        <td>${{number_format($producto->precio,2,'.')}}</td>
                                        <td>{{number_format($producto->stock)}}</td>
                                        <td>{{date_format($producto->created_at,"d/m/Y")}}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                    <a class="btn btn-info btn-sm float-center" href="{{ route('producto.editar',$producto->id) }}"><i class="far fa-edit" title="Actualizar"></i></a>
                                                    </div>
                                                    <div class="col">
                                                    <form action="{{ route('producto.borrar',$producto->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="submit()" class="btn btn-danger btn-sm float-center"><i class="far fa-trash-alt" title="Borrar"></i></button>
                                                    </form>
                                                    </div>
                                                </div>
                                            </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3"><h1>No existen Productos.</h1></td></tr>
                                @endforelse
                                                                   
                                </tbody>
                            </table>
                        @if ($productos->count())
                            <div class="mt-3">
                                {{$productos->links()}}
                            </div>
                        @endif

                        

                        </div>                                
                    </div>

                    <br>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>