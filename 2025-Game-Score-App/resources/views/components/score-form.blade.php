@props(['action', 'method', 'game', 'score'])

<form action="{{$action}}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method === 'PUT' || $method === 'PATCH')
        @method($method)
    @endif
    <div class="mb-4">
        <label for="rating" class="block font-medium text-sm text-gray-700">Rating</label>
        <input
            type="text"
            name="rating"
            id="rating"
            value="{{ old('rating', $score->rating ?? '') }}"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            required
        />
        @error('rating')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="comment" class="block font-medium text-sm text-gray-700">Comment</label>
        <input
            type="text"
            name="comment"
            id="comment"
            value="{{old('comment', $score->comment ??'')}}"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            required
        />
        @error('comment')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>
    <x-primary-button>
        {{isset($score) ? 'Update Score' : 'save Score'}}
    </x-primary-button>
</form>