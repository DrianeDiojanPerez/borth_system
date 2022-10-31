<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                .
            
       

    
        {{-- page to  show data --}}
        @isset($GL)
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
           
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                                         
                       
                        <th scope="col" class="py-3 px-6">
                            AGENT	
                        </th>

                    
                        <th scope="col" class="py-3 px-6">
                            SHIP	
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Voyage	
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Departure
                        </th>
                       
                    </tr>
                </thead>
                {{-- $data = [
                'agent'  => $agent,
                'shipname'   => $sip_name,
                'Voyage' => $voyage,
                'Departure' => $date2,
                'Container' => $Container,
                'Type' => $package_type,
                'lbs' => $pound_ton,
                'cf' => $cubic_tone,
                'shorttonslbs' => (($pound_ton/2000)),
                'shorttonscf' => (($cubic_tone/40)),
                'revton' => $revton,
                'roundup' => $finaltone,
                'day' => $days,
                'freedays' => $freedays,
                '2' => $two,
                '3' => $three,
                '5' => $fve,
                '7' => $seven,
                'loadingcharge' => $price_VM,
                'total' => $finalprice            
            ]; --}}
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $agent }}</th> 
                        <td class="py-4 px-6">{{ $shipname }}</td>
                        <td class="py-4 px-6"> {{ $Voyage }} </td>
                        <td class="py-4 px-6"> {{ $Departure }}</td>
                        
                        </tr>
                    
                    
                </tbody>
            </table>
            
        </div>
        <br>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">

            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                                         
                       
                        <th scope="col" class="py-3 px-6">
                            Container	
                        </th>

                    
                        <th scope="col" class="py-3 px-6">
                            Type
                        </th>
                    
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $Container }}</th> 
                        <td class="py-4 px-6">{{ $Type }}</td>
                        
                        
                        </tr>
                    
                    
                </tbody>
            </table>
            
        </div>
        <br>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">

            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                                         
                       
                        <th scope="col" class="py-3 px-6">
                            lbs
                        </th>

                    
                        <th scope="col" class="py-3 px-6">
                            cf
                        </th>
                        <th scope="col" class="py-3 px-6">
                            shorttonslbs
                        </th>
                        <th scope="col" class="py-3 px-6">
                            shorttonscf
                        </th><th scope="col" class="py-3 px-6">
                            revton
                        </th>
                        <th scope="col" class="py-3 px-6">
                            roundup
                        </th>
                    
                    
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $lbs }}</th> 
                        <td class="py-4 px-6">{{ $cf }}</td>
                        <td class="py-4 px-6">{{ $shorttonslbs }}</td>
                        <td class="py-4 px-6">{{ $shorttonscf }}</td>
                        <td class="py-4 px-6">{{ $revton }}</td>
                        <td class="py-4 px-6">{{ $roundup }}</td>
                        
                        
                        </tr>
                    
                    
                </tbody>
            </table>
            
        </div>
        <br>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">

            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                                         
                       
                        <th scope="col" class="py-3 px-6">
                            day
                        </th>
                        <th scope="col" class="py-3 px-6">
                            freeday
                        </th>

                    
                        <th scope="col" class="py-3 px-6">
                            #Days
                        </th>
                        <th scope="col" class="py-3 px-6">
                            1st Week

                        </th>
                        <th scope="col" class="py-3 px-6">
                            2nd Week and more
                        </th>
                        <th scope="col" class="py-3 px-6">
                            loadingcharge
                        </th>
                        <th scope="col" class="py-3 px-6">
                            total
                        </th>
                    
                    
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $day }}</th> 
                        <td class="py-4 px-6">{{ $freedays }}</td>
                        <td class="py-4 px-6">${{ $two }}</td>
                        <td class="py-4 px-6">${{ $three }}</td>
                        <td class="py-4 px-6">${{ $five }}</td>
                       
                        <td class="py-4 px-6">${{ $loadingcharge }}</td>
                        <td class="py-4 px-6">${{ $total }}</td>
                        
                        
                        </tr>
                    
                    
                </tbody>
            </table>

        </div>
        <br>

<a href="{{ route('Cashier.payment.index') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
<a href="downloadPDF/{{ $house }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Print</a>
<br><br>
        
        
        
        
                                
        @endisset
        @isset($VH)
        
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
           
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                                         
                       
                        <th scope="col" class="py-3 px-6">
                            AGENT	
                        </th>

                    
                        <th scope="col" class="py-3 px-6">
                            SHIP	
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Voyage	
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Departure
                        </th>
                       
                    </tr>
                </thead>
                {{-- $data = [
                'agent'  => $agent,
                'shipname'   => $sip_name,
                'Voyage' => $voyage,
                'Departure' => $date2,
                'Container' => $Container,
                'Type' => $package_type,
                'lbs' => $pound_ton,
                'cf' => $cubic_tone,
                'shorttonslbs' => (($pound_ton/2000)),
                'shorttonscf' => (($cubic_tone/40)),
                'revton' => $revton,
                'roundup' => $finaltone,
                'day' => $days,
                'freedays' => $freedays,
                '2' => $two,
                '3' => $three,
                '5' => $fve,
                '7' => $seven,
                'loadingcharge' => $price_VM,
                'total' => $finalprice            
            ]; --}}
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $agent }}</th> 
                        <td class="py-4 px-6">{{ $shipname }}</td>
                        <td class="py-4 px-6"> {{ $Voyage }} </td>
                        <td class="py-4 px-6"> {{ $Departure }}</td>
                        
                        </tr>
                    
                    
                </tbody>
            </table>
            
        </div>
        <br>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">

            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                                         
                       
                        <th scope="col" class="py-3 px-6">
                            Container	
                        </th>

                    
                        <th scope="col" class="py-3 px-6">
                            Type
                        </th>
                    
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $Container }}</th> 
                        <td class="py-4 px-6">{{ $Type }}</td>
                        
                        
                        </tr>
                    
                    
                </tbody>
            </table>
            
        </div>
        <br>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">

            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                                         
                       
                        <th scope="col" class="py-3 px-6">
                            lbs
                        </th>

                    
                        <th scope="col" class="py-3 px-6">
                            cf
                        </th>
                        <th scope="col" class="py-3 px-6">
                            shorttonslbs
                        </th>
                        <th scope="col" class="py-3 px-6">
                            shorttonscf
                        </th><th scope="col" class="py-3 px-6">
                            revton
                        </th>
                        <th scope="col" class="py-3 px-6">
                            roundup
                        </th>
                    
                    
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $lbs }}</th> 
                        <td class="py-4 px-6">{{ $cf }}</td>
                        <td class="py-4 px-6">{{ $shorttonslbs }}</td>
                        <td class="py-4 px-6">{{ $shorttonscf }}</td>
                        <td class="py-4 px-6">{{ $revton }}</td>
                        <td class="py-4 px-6">{{ $roundup }}</td>
                        
                        
                        </tr>
                    
                    
                </tbody>
            </table>
            
        </div>
        <br>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">

            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                                         
                       
                        <th scope="col" class="py-3 px-6">
                            day
                        </th>
                        <th scope="col" class="py-3 px-6">
                            freeday
                        </th>

                    
                        <th scope="col" class="py-3 px-6">
                            #Days
                        </th>
                        <th scope="col" class="py-3 px-6">
                            1st Week

                        </th>
                        <th scope="col" class="py-3 px-6">
                            2nd Week
                        </th><th scope="col" class="py-3 px-6">
                        week 4 and more
                        </th>
                        <th scope="col" class="py-3 px-6">
                            loadingcharge
                        </th>
                        <th scope="col" class="py-3 px-6">
                            total
                        </th>
                    
                    
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $day }}</th> 
                        <td class="py-4 px-6">{{ $freedays }}</td>
                        <td class="py-4 px-6">${{ $two }}</td>
                        <td class="py-4 px-6">${{ $three }}</td>
                        <td class="py-4 px-6">${{ $five }}</td>
                        <td class="py-4 px-6">${{ $seven }}</td>
                        <td class="py-4 px-6">${{ $loadingcharge }}</td>
                        <td class="py-4 px-6">${{ $total }}</td>
                        
                        
                        </tr>
                    
                    
                </tbody>
            </table>

        </div>
        <br>

<a href="{{ route('Cashier.payment.index') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
<a href="downloadPDF/{{ $house }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Print</a>
<br><br>
        
        
        
        
                                
        @endisset
    </div>
    </div>
</div>
</x-app-layout>