<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload CSV') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              
                
                <form action="{{ route('Supervisor.Packing.store') }}" method="post">
                    @csrf
                    <input type="file" name="csv" id="csv">
                    <x-jet-button class="ml-4">
                        {{ __('Submit') }}
                    </x-jet-button>
                </form>
                <br>
                @isset($error)
                <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Info</span>
                    <div>
                      <span class="font-medium">Danger alert!</span> {{ $error}}
                    </div>
                  </div>
                
                @endisset
                @isset($success)
                <div class="flex p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Info</span>
                    <div>
                      <span class="font-medium">Success alert!</span>  {{ $success}}
                    </div>
                  </div>
                @endisset
            </div>
        </div>
    </div>
    @section('scripts')
    <script>
         FilePond.registerPlugin(FilePondPluginFileValidateSize);
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[id="csv"]');
    
        // Create a FilePond instance
        const pond = FilePond.create(inputElement, {
            minFileSize: '61B',
            maxFileSize: '3MB',

});
        FilePond.setOptions({
            server: {
                url: '/upload',
                revert: '/revert',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
        },
        labelFileProcessingError: (error) => {
    console.log(error);
    return 'Invalid Type File, To Small File to Chunck. Increase Number Record';
}
        });
    </script>
    @endsection
</x-app-layout>