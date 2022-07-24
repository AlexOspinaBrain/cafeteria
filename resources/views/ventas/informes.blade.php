<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Informes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 sm:px-25 bg-white border-b border-gray-200">

                    <div class="col-12">
                        <div class="container-fluid">
                            
                                       
                        <h2 scope="col">Producto más vendido : <b>{{ $data['masVendido']->nombre}}</b> Cantidad : {{$data['masVendido']->cantidad }}</h2>
                        <br>
                        <h2 scope="col">Producto con más stock : <b>{{ $data['masStock']->nombre}}</b> Cantidad : {{$data['masStock']->cantidad }}</h2>
                        

                        </div>                                
                    </div>

                    <br>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>