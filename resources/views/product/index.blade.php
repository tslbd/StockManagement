<x-app-layout>

    <div class="bg-white">

        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <div class=" flex items-center justify-center">
                <form action="{{ route('products.index') }}" class="" method="GET">
                    <input class="rounded-full px-3 py-1  " name="search" type="search" placeholder="product search...." id="search" />
                    <button type="submit" class="px-3 py-1 bg-blue-400 rounded-full cursor-pointer">Search</button>
                </form>
            </div>
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 mt-5">Product List</h2>
            @if (count($products) > 0)
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    @foreach($products as $product)

                    <div class="group relative">
                        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                            <img src="{{ asset('/storage/'.$product->photo) }}" alt="Front of men&#039;s Basic Tee in black." class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                        </div>
                        <div class="mt-4 flex flex-col justify-between gap-x-2">
                            <div>
                                <h3 class="text-sm text-gray-700 ">
                                    <a href="#">
                                        {{ $product->title }}
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500"> {{ $product->description }} </p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">{{ $product->price }}</p>
                            <div>
                                <form method="post" action="{{ route('stocks.store') }}" >
                                    @csrf
                                    <input type="number" class="hidden" name="id" value="{{ $product->id }}">
                                        @if(array_key_exists($product->id,$stocks))
                                            <button type="submit" class="px-3 pt-1 bg-gray-300 w-full text-white cursor-not-allowed " disabled >Add To Stock</button>
                                        @else
                                            <button type="submit" class="px-3 pt-1 bg-blue-400 w-full text-white  ">Add To Stock</button>
                                        @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
               <p class="text-center bg-gray-300 text-black p-3 rounded w-1/4 m-auto font-bold "> No product found </p>
            @endif

        </div>
    </div>
</x-app-layout>
