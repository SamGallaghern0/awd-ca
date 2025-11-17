@props(['name', 'logo', 'bio'])

<div class="borderrounded-lg shadow-md p-6 bg-white hover:shadow-lg transition duration-300 max-w-xl mx-auto">
    <h1 class="font-bold text-black-600 mb-2" style="font-size: 3rem;">{{$name}}</h1>
    <div class="overflow-hidden rounded-lg mb-4 flex justify-center">
        <img src="{{ asset('logos/publishers/' . $logo) }}" alt="{{ $name }}" class="w-full max-w-xs h-auto object-cover">
    </div>
    <h3 class="text-gray-800 font-semibold mb-2" style="font-size : 2rem;">Bio</h3>
    <p class="text-gray-700 leading-relaxed">{{ $bio }}</p>
</div>