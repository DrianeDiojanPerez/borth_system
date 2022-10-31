<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\holyday;
use App\Models\pacling_list;
use App\Models\shipschedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;

class homeController extends Controller
{
    public function print(Request $request){

        
    }
    public function searchselect(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            if($request->search==""){
                return Response($output);
            }
            $token=csrf_token();
            $products = pacling_list::where('hoouse_BOL', 'LIKE', '%' . $request->search . "%")->get();
            if ($products) {
                foreach ($products as $key => $product) {
                    $output .= '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">' .
                        '<th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">' . $product->bill_of_lading . '</th>' .
                        '<td class="py-4 px-6">' . $product->container . '</td>' .
                        '<td class="py-4 px-6">' . $product->agent . '</td>' .
                        '<td class="py-4 px-6">' . $product->consignee . '</td>' .
                        '<td class="py-4 px-6">' . $product->package_type . '</td>' .
                        '<td class="py-4 px-6">' . $product->dock_receipt_number . '</td>' .
                        '<td class="py-4 px-6">' . $product->hoouse_BOL . '</td>' .
                        '<td class="py-4 px-6">
                        
                        <form method="POST" action="home">
                        <input type="hidden" name="_token" value="'.$token.'">
                    
                        
                        <input type="hidden" id="hoouse_BOL" name="hoouse_BOL" value="'.$product->hoouse_BOL.'" />
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        View</button>
                        </form>
                        </td>' .
                        '</tr>';
                }
                return Response($output);
            }
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Gate::denies('IS-Cashier')) {
            abort(403);
        }
        return view('Cashier.index.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     * 
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if($request->hoouse_BOL){
           $packing_list=pacling_list::where('hoouse_BOL','=',$request->hoouse_BOL)->get();
          
           foreach ($packing_list as $key => $product) {
            $voyage=$product->voyage_number;
            $agent=$product->agent;
            $Container=$product->container;
            break;
           }

           $voyage_number=shipschedule::where('voyage_number','=',$voyage)->get();
           foreach ($voyage_number as $key => $p) {
            $date2=$p->atd;
            $sip_name=$p->vessel_name;
            break;
           }
           $freedays=9;
           $now=date("Y-m-d");
           $holydate=holyday::where('date', '>=', $date2)
           ->where('date', '<=', $now)->get();
           
           $feeholy=count($holydate);
           $freedays=$freedays+$feeholy;
           
           $now2 = time();
            $your_date = strtotime($date2);
            $datediff = $now2 - $your_date;
            $days=intval($datediff / (60 * 60 * 24));
            $min=intval($datediff / (60 * 60 * 24))-$freedays;

           
           $price_VM=0;
           $finaltone=0;
           $pound_ton=0;
           $finalc=0;
           $finalw=0;
           $cubic_tone=0;
                foreach ($packing_list as $key => $packing) {
                $package_type=$packing->package_type;
                $weight=$packing->weight;
                $height=$packing->height;
                $finalw=$finalw+$weight;
                
                $width=$packing->width;
                $length=$packing->length;
                $ton_w=$weight/2000;
                $ton_c=($height*$width*$length)/40;
                $finalc=$finalc+$height*$width*$length;
                if($package_type!="VH"){
                    if($ton_w==$ton_c){
                        if($ton_c<1)
                        {
                            $price_VM=$price_VM+(1*3.50);
                        }
                        else{
                            $price_VM=$price_VM+($ton_c*3.50);

                        }
                        
                        
                    }
                    elseif($ton_w>$ton_c){
                        if($ton_w<1)
                        {
                        $price_VM=$price_VM+(1*3.50);
                        }
                        else{
                            $price_VM=$price_VM+($ton_w*3.50);
                        }
                        
                        
                    }elseif($ton_w<$ton_c){
                        if($ton_c<1)
                        {
                            $price_VM=$price_VM+(1*3.50);
                        }else{$price_VM=$price_VM+($ton_c*3.50);}
                        
                    }
                    
                }
                $pound_ton=$pound_ton+$ton_w;
                $cubic_tone=$cubic_tone+$ton_c;
               }
            if($pound_ton==$cubic_tone){
                $finaltone=$pound_ton;
                
            }
            elseif($pound_ton>$cubic_tone){
                $finaltone=$pound_ton;
                
            }elseif($pound_ton<$cubic_tone){
                
                $finaltone=$cubic_tone;
            }
            if($finaltone<1)
            {$finaltone=1;}
            
            $finaltone=round($finaltone);
            
            $finalprice=0;
            $two=0;
            $three=0;
            $fve=0;
            $seven=0;
            if($min<=0){
                $finalprice=$price_VM;
                
            }
            elseif($min>=1){
                if($min>7){
                $finalprice=$finaltone*2.00*7;
                $two=$finalprice;
                    
                }else{
                    $finalprice=$finaltone*2.00*$min;
                    $two=$finalprice;
                }
                if($min>7){
                    $finalprice=$finalprice+($finaltone*3);
                    $three=$finaltone*3;
                }
                if($min>14){
                    $finalprice=$finalprice+($finaltone*5);
                    $fve=$finaltone*5;
                }
                if($min>21){
                    $finalprice=$finalprice+($finaltone*7);
                    $seven=$finaltone*7;
                }
                $finalprice=$finalprice+$price_VM;

            }
            $revton=0;
            if(($pound_ton)==($cubic_tone))
            {
                $revton=($cubic_tone);
            }elseif(($pound_ton)>($cubic_tone))
            {
                $revton=($pound_ton);
            }elseif(($pound_ton)<($cubic_tone))
            {
                $revton=$cubic_tone;
            }
            if($package_type=="VH"){
            $data = [
                'agent'  => $agent,
                'shipname'   => $sip_name,
                'Voyage' => $voyage,
                'Departure' => $date2,
                'Container' => $Container,
                'Type' => $package_type,
                'lbs' => $finalw,
                'cf' => $finalc,
                'shorttonslbs' => (($pound_ton)),
                'shorttonscf' => (($cubic_tone)),
                'revton' => $revton,
                'roundup' => $finaltone,
                'day' => $days,
                'freedays' => $freedays,
                'two' => $two,
                'three' => $three,
                'five' => $fve,
                'seven' => $seven,
                'loadingcharge' => $price_VM,
                'total' => $finalprice,
                'house' => $request->hoouse_BOL,
                'VH'=>true        
            ];

            return view('Cashier.index.paymentpage', $data);
        }else{
            

            $finalprice=0;
            $two=0;
            $three=0;
            $fve=0;
            $seven=0;
            if($min<=0){
                $finalprice=$price_VM;
                
            }
            elseif($min>=1){
                if($min>7){
                $finalprice=$finaltone*3.00*7;
                $two=$finalprice;
                    
                }else{
                    $finalprice=$finaltone*3.00*$min;
                    $two=$finalprice;
                }
                if($min>7){
                    $finalprice=$finalprice+($finaltone*5);
                    $three=$finaltone*5;
                }
                if($min>14){
                    $finalprice=$finalprice+($finaltone*7);
                    $fve=$finaltone*7;
                }
                
                $finalprice=$finalprice+$price_VM;

            }


            $data = [
                'agent'  => $agent,
                'shipname'   => $sip_name,
                'Voyage' => $voyage,
                'Departure' => $date2,
                'Container' => $Container,
                'Type' => $package_type,
                'lbs' => $finalw,
                'cf' => $finalc,
                'shorttonslbs' => (($pound_ton)),
                'shorttonscf' => (($cubic_tone)),
                'revton' => $revton,
                'roundup' => $finaltone,
                'day' => $days,
                'freedays' => $freedays,
                'two' => $two,
                'three' => $three,
                'five' => $fve,
                'loadingcharge' => $price_VM,
                'total' => $finalprice,
                'house' => $request->hoouse_BOL,
                'GL'=>true        
            ];





            return view('Cashier.index.paymentpage', $data);
        }

           
            

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return $id;
    }
    public function search()
    {
        //
        $Voyage_Number = $_POST['Voyage_Number'];

        $Bill_of_Lading_Number = $_POST['Bill_of_Lading_Number'];

        $response = Http::withToken(env('TOKEN'))->get("https://app.octopi.co/api/v1/voyages/$Voyage_Number/bill_of_ladings/$Bill_of_Lading_Number.json");
        $data = $response->json();

        return view('Cashier.index.index', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
