<x-app-layout>
    <div class=" w-2/6  shadow-2xl m-auto bg-white p-10 mt-3 rounded-3xl">
        <h1 class="text-center mb-3 text-3xl ">Product Create</h1>
        <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $product->title)"  />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description" name="description"  class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $product->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="price" :value="__('Price')" />
                <x-text-input id="price" class="block mt-1 w-full " type="number" name="price" :value="old('price', $product->price)"  />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="photo" class="image-preview" :value="__('Photo')" />

                <input type="file" id="photo" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="photo" value="{{ old('photo') }}">
                <x-input-error :messages="$errors->get('photo')" class="mt-2" />
            </div>

            <div class="flex  justify-between mt-4">
                <div>
                    <button class="px-12 py-1 bg-green-400 rounded-xl font-semibold" type="submit">update</button>
                </div>
                <div>
                    <button class="px-12 py-1 bg-red-500 rounded-xl font-semibold">Cancle</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
