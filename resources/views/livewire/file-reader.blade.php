<div>
    @if($error)
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            {{ $error }}
        </div>
    @endif

    @error('path')
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
        {{ $message }}
    </div>
    @enderror

    <div style="padding: 10px">
        <div>
            <label for="path" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">File
                path</label>
            <div class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input
                        wire:model="path"
                        type="text"
                        id="path"
                        class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="path/to/file"
                        required
                >
                <button
                        wire:click="getLines"
                        type="button"
                        class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                    View
                </button>
            </div>
        </div>
    </div>
    <div style="padding: 10px">
        <ul>
            @foreach($lines as $line)
                <li>{{ ($loop->iteration + $startLine) .': '. $line }}</li>
            @endforeach
        </ul>
    </div>
    <div style="padding: 10px">
        <button
                @if($hasPrevious)
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded"
                @else
                    class="bg-blue-500 text-white font-bold py-2 px-4 rounded opacity-50 cursor-not-allowed"
                disabled
                @endif
                wire:click="goToBeginning"
        >
            Beginning
        </button>
        <button
                @if($hasPrevious)
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded"
                @else
                    class="bg-blue-500 text-white font-bold py-2 px-4 rounded opacity-50 cursor-not-allowed"
                disabled
                @endif
                wire:click="previous"
        >
            Previous
        </button>
        <button
                @if($hasNext)
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded"
                @else
                    class="bg-blue-500 text-white font-bold py-2 px-4 rounded opacity-50 cursor-not-allowed"
                disabled
                @endif
                wire:click="next"
        >
            Next
        </button>
        <button
                @if($hasNext)
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded"
                @else
                    class="bg-blue-500 text-white font-bold py-2 px-4 rounded opacity-50 cursor-not-allowed"
                disabled
                @endif
                wire:click="goToEnd"
        >
            End
        </button>
    </div>
</div>