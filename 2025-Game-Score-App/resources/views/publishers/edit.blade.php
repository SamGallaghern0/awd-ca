<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-x1 text-gray-800 leading-tight">
            {{_('Publisher Game') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4 ">Edit Publisher:</h3>
                    <x-publisher-form
                        :action="route('publishers.update', $publisher)"
                        :method="'PUT'"
                        :publisher="$publisher"
                        :games="$games"
                    />
                    <a href="{{ route('publishers.index', $publisher) }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 margin-top-10">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>