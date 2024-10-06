@props(['messages'])

@if ($messages)
    @foreach ((array) $messages as $message)
        <div id="alert-3" class="flex items-center my-2 text-red-800 rounded-lg " role="alert">
            <svg class="w-5 h-5 text-red-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd"/>
            </svg>
            <div class="ml-3 text-sm font-medium">{{ $message }}</div>
        </div>
    @endforeach
@endif
