<x-app-layout>
    <div class="w-1/2  m-auto mt-10 ">
        <div class="flex justify-between">
            <div><p>Product</p></div>
            <div class="mr-16">
                <a href="{{ route('products.create') }}" class="bg-blue-400 text-white rounded shadow px-6 py-0.5">Create Product</a>
            </div>
        </div>
        <table class="mt-3">
            <tr class="border border-solid">
                <th class=" bg-white text-left p-2">Title</th>
                <th class=" bg-white text-left p-2">Description</th>
                <th class=" bg-white text-left p-2">Price</th>
                <th class=" bg-white text-left p-2">image</th>
                <th class=" bg-white text-left p-2">Action</th>

            </tr>
            @foreach($products as $product)
                <tr class="even:bg-off-table border border-solid">
                    <td class=" text-left p-2">{{ $product->title }}</td>
                    <td class=" text-left p-2">{{ $product->description }}</td>
                    <td class=" text-left p-2">{{ $product->price }}</td>
                    <td class=" text-left p-2">
                        <img src="{{ asset('/storage/'.$product->photo) }}"  class="w-12 h-12" alt="Hello"/>
                    </td>
                    <td class="flex text-center justify-between">
                        <a href="{{ route('products.edit', $product) }}" class="bg-green-400 px-3 py-1 ml-1 rounded-l mt-3">Edit</a>
                        <div class="mt-3">
                            <form method="POST" action="{{ route('products.destroy', $product) }}">
                                @csrf
                                @method('delete')
                                <a href="{{ route('products.destroy', $product) }}" class="bg-red-500 px-3 py-1 ml-1 mr-1 rounded-l ">Delete</a>
                            </form>
                        </div>

                    </td>
                </tr>
            @endforeach

        </table>
    </div>
</x-app-layout>
