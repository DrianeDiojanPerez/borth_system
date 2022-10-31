<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
            

                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <div class="pb-4 bg-white ">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative mt-1">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input type="text" id="search" class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " name="search"placeholder="Search for items">
                        </div>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                		 		

                            
                                <th scope="col" class="py-3 px-6">
                                    Bill of Lading
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Container
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Agent
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Consignee
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Package Type
                                </th>
            
                                <th scope="col" class="py-3 px-6">
                                    Dock Receipt Number
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Hoouse BOL
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    print
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            
                        </tbody>
                    </table>
                </div>
                

       

    
        {{-- page to  show data --}}
        
    
    </div>
</div>
</div>
    <script type="text/javascript">

        $('#search').on('keyup',function(){
        $value=$(this).val();
        $.ajax({
            type : 'get',
            url : '{{URL::to('Cashier/search')}}',
            data:{'search':$value},
            success:function(data){
            $('tbody').html(data); }
        });
        })
    </script>
    <script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>
</x-app-layout>





