<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('商品情報') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('imageStore'))
                    <div class="bg-indigo-400 text-center text-white mx-auto w-1/4 py-2" >
                        {{ session('imageStore') }}
                       </div>
                       @elseif (session('imageUpdate'))
                       <div class="bg-green-400 text-center text-white mx-auto w-1/4 py-2" >
                        {{ session('imageUpdate') }}
                       </div>
                       @elseif (session('alert'))
                       <div class="bg-red-400 text-center text-white mx-auto w-1/4 py-2" >
                        {{ session('alert') }}
                       </div>
                        @elseif (session('message'))
                       <div class="bg-indigo-400 text-center text-white mx-auto w-1/4 py-2" >
                        {{ session('message') }}
                       </div>
                    @endif

                    <div class="flex justify-end mb-4">
                                
                        <button onclick="location.href='{{ route('owner.products.create') }}'" type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">新規登録</button>                        
                    </div>
                    
                <div class="flex flex-wrap">
                    @foreach ($ownerInfo as $owner)
                    @foreach ($owner->shop->product as $product)
                    <div class="w-1/4 p-2 md:p-4">
                            <a href="{{ route('owner.products.edit', ['product' => $product->id]) }}">
                                <div class="border rounded-md:p-4">
                                        @if (empty($product->imageFirst->filename ?? ''))
                                            <img src="{{ asset('images/no-image.png') }}">
                                        @else
                                            <img src="{{ asset('storage/products/'. $product->imageFirst->filename) }}">
                                    @endif
                                </div>
                                <div class="text-gray-700">
                                    {{ $product->name }}
                                </div>
                            </a>
                        </div>
                        @endforeach
                    @endforeach
                </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    