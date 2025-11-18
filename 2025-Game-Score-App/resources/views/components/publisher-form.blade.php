@props(['action', 'method', 'publisher', 'games'])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method === 'PUT' || $method === 'PATCH')
        @method($method)
    @endif
    <div class="mb-4">
    <label for="name" class="block text-sm text-gray-700">Name</label>
    <input
        type="text"
        name="name"
        id="name"
        value="{{ old('name', $publisher->name ?? ' ') }}"
        required
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        @error('name')
        <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
    <label for="bio" class="block text-sm text-gray-700">Bio</label>
    <input
        type="text"
        name="bio"
        id="bio"
        value="{{ old('bio', $publisher->bio ?? ' ') }}"
        required
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        @error('bio')
        <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
    <label for="logo" class="block text-sm font-medium text-gray-700">Publisher Logo</label>
    <input
        type="file"
        name="logo"
        id="logo"
        {{ isset($publisher) ? '' : 'required' }}
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('logo')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label class="block mb-2">Games</label>
        <div class="grid grid-cols-3 gap-4">
            @foreach($games as $game)
        <div class="flex items-center">
        <input type="checkbox" name="games[]" id="game_{{ $game->id }}" value="{{ $game->id }}"
            @if(isset($publisherGames) && in_array($game->id, $publisherGames)) checked @endif>
        <label for="game_{{ $game->id }}" class="ml-2">{{ $game->title }}</label>
        </div>
            @endforeach
        </div>
    </div>
    <div class="mb-4">
        <x-primary-button class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
            {{ isset($publisher) ? 'Update Game' : 'Add Publisher' }}
        </x-primary-button>
    </div>

</form>