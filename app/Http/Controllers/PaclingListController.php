<?php

namespace App\Http\Controllers;

use App\Models\csvFiles;
use App\Models\holyday;
use App\Models\pacling_list;
use App\Models\shipschedule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;
use App\Models\TemporaryFile;
use DateTime;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PaclingListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('Supervisor.index.upload');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $fileT = TemporaryFile::where('folder', $request->csv)->first();
        TemporaryFile::where('folder', $request->csv)->delete();


        // $file = $request->file('uploaded_file');

        //$file_temp=$file;
        if ($fileT) {


            Storage::move('livewire-tmp/tmp/' . $fileT->folder . '/' . $fileT->filename, 'public/csv-file/' . $fileT->filename);
            Storage::deleteDirectory('livewire-tmp/tmp/' . $fileT->folder);

            $filepath = Storage::path('public/csv-file/' . $fileT->filename);

            //Where uploaded file will be stored on the server 
            $location = 'storage/csv-file'; //Created an "uploads" folder for that
            // Upload file
            //$file->move($location, $filename);
            // In case the uploaded file path is to be stored in the database 
            //$filepath = public_path($location . "/" . $filename);
            // Reading file
            $file = fopen($filepath, "r");

            //Read the contents of the uploaded file 


            while (($data = fgetcsv($file, null, ",")) !== FALSE) {
                $arraydatacsv[] = $data;
            }
            fclose($file);

            // dd($arraydatacsv);

            $i = 0;

            if (
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][0])) === "﻿billoflading") || (strtolower(str_replace(' ', '', $arraydatacsv[0][0])) === "billoflading")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][1])) === "﻿container") || (strtolower(str_replace(' ', '', $arraydatacsv[0][1])) === "container")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][2])) === "﻿agent") || (strtolower(str_replace(' ', '', $arraydatacsv[0][2])) === "agent")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][3])) === "﻿consignee") || (strtolower(str_replace(' ', '', $arraydatacsv[0][3])) === "consignee")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][4])) === "﻿description") || (strtolower(str_replace(' ', '', $arraydatacsv[0][4])) === "description")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][5])) === "﻿quantity") || (strtolower(str_replace(' ', '', $arraydatacsv[0][5])) === "quantity")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][6])) === "﻿packagetype") || (strtolower(str_replace(' ', '', $arraydatacsv[0][6])) === "packagetype")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][7])) === "﻿referencenumber") || (strtolower(str_replace(' ', '', $arraydatacsv[0][7])) === "referencenumber")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][8])) === "﻿weightunit") || (strtolower(str_replace(' ', '', $arraydatacsv[0][8])) === "weightunit")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][9])) === "﻿weight") || (strtolower(str_replace(' ', '', $arraydatacsv[0][9])) === "weight")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][10])) === "﻿dimentionsunit") || (strtolower(str_replace(' ', '', $arraydatacsv[0][10])) === "dimentionsunit")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][11])) === "﻿height") || (strtolower(str_replace(' ', '', $arraydatacsv[0][11])) === "height")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][12])) === "﻿width") || (strtolower(str_replace(' ', '', $arraydatacsv[0][12])) === "width")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][13])) === "﻿length") || (strtolower(str_replace(' ', '', $arraydatacsv[0][13])) === "length")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][14])) === "﻿dockreceiptnumber") || (strtolower(str_replace(' ', '', $arraydatacsv[0][14])) === "dockreceiptnumber")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][15])) === "﻿shippingmarks") || (strtolower(str_replace(' ', '', $arraydatacsv[0][15])) === "shippingmarks")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][16])) === "﻿hoousebol") || (strtolower(str_replace(' ', '', $arraydatacsv[0][16])) === "hoousebol") ||
                    (strtolower(str_replace(' ', '', $arraydatacsv[0][16])) === "housebol") || (strtolower(str_replace(' ', '', $arraydatacsv[0][16])) === "housebol"))

            ) {
                //////////////////////////////////////packing list///////////////////////////////////////////////////

                

                
                for ($c = 1; $c < count($arraydatacsv); $c++) {
                    $empty=false;
                    if(
                        empty($arraydatacsv[$c][0])||
                        empty($arraydatacsv[$c][1])||
                        empty($arraydatacsv[$c][2])||
                        empty($arraydatacsv[$c][3])||
                        empty($arraydatacsv[$c][4])||
                        empty($arraydatacsv[$c][5])||
                        empty($arraydatacsv[$c][6])||
                        empty($arraydatacsv[$c][7])||
                        empty($arraydatacsv[$c][8])||
                        empty($arraydatacsv[$c][9])||
                        empty($arraydatacsv[$c][10])||
                        empty($arraydatacsv[$c][11])||
                        empty($arraydatacsv[$c][12])||
                        empty($arraydatacsv[$c][13])||
                        empty($arraydatacsv[$c][14])||
                        empty($arraydatacsv[$c][15])||
                        empty($arraydatacsv[$c][16])
                    
                    ){$empty=true;}

                    $filenametoex=$fileT->filename;
                    $pieces = explode(" ", $filenametoex);
                    $res = preg_replace("/[^0-9]/", "", $pieces[1] );
                    $res=intval($res);

                    pacling_list::create([
                        'bill_of_lading' => $arraydatacsv[$c][0],
                        'voyage_number'=> $res,
                        'container' => $arraydatacsv[$c][1],
                        'agent' => $arraydatacsv[$c][2],
                        'consignee' => $arraydatacsv[$c][3],
                        'description' => $arraydatacsv[$c][4],
                        'quantity' => intval($arraydatacsv[$c][5]),
                        'package_type' => $arraydatacsv[$c][6],
                        'reference_number' => $arraydatacsv[$c][7],
                        'weight_unit' => $arraydatacsv[$c][8],
                        'weight' => intval($arraydatacsv[$c][9]),
                        'dimentions_unit' => $arraydatacsv[$c][10],
                        'height' => intval($arraydatacsv[$c][11]),
                        'width' => intval($arraydatacsv[$c][12]),
                        'length' => intval($arraydatacsv[$c][13]),
                        'dock_receipt_number' =>  intval(($arraydatacsv[$c][14])),
                        'shipping_marks' => $arraydatacsv[$c][15],
                        'hoouse_BOL' => $arraydatacsv[$c][16],
                        'empty' => $empty
                    ]);
                
                        
                    }
                   
                
                csvFiles::create([
                    'folder' => 'packing-csv',
                    'filename' => $fileT->filename
                ]);
                Storage::move('public/csv-file/' . $fileT->filename, 'public/csv-file/packing-csv/' . $fileT->filename);
                return view('Supervisor.index.upload', ['success' => 'Uploaded and Inserted successfully']);
                //////////////////////////////////////end packing list///////////////////////////////////////////////////
            } elseif (
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][0])) === "﻿vesselname") || (strtolower(str_replace(' ', '', $arraydatacsv[0][0])) === "vesselname")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][1])) === "﻿voyagenumber") || (strtolower(str_replace(' ', '', $arraydatacsv[0][1])) === "voyagenumber")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][2])) === "﻿ata") || (strtolower(str_replace(' ', '', $arraydatacsv[0][2])) === "ata")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][3])) === "﻿atd") || (strtolower(str_replace(' ', '', $arraydatacsv[0][3])) === "atd"))
            ) {
                //////////////////////////////////////ship shedule///////////////////////////////////////////////////
                $dataco=false;

                for ($c = 1; $c < count($arraydatacsv); $c++) {
                if(!(($this->validateDate(($arraydatacsv[$c][2]),'Y-m-d')&&($this->validateDate($arraydatacsv[$c][3]))))){
                        
                    $dataco=true;
                        break; 
                }
            }
            if($dataco){
                Storage::delete('public/csv-file/' . $fileT->filename);
                return view('Supervisor.index.upload', ['error' => "Invalid Data Type for Ship schedule YYYY-MM-DD"]);
            }

                for ($c = 1; $c < count($arraydatacsv); $c++) {
                    $empty=false;
                    if(
                        empty($arraydatacsv[$c][0])||
                        empty($arraydatacsv[$c][1])||
                        empty($arraydatacsv[$c][2])||
                        empty($arraydatacsv[$c][3])
                    
                    ){$empty=true;}

                    
                    
                    shipschedule::create([
                        'vessel_name' => $arraydatacsv[$c][0],
                        'voyage_number' => $arraydatacsv[$c][1],
                        'ata' => $arraydatacsv[$c][2],
                        'atd' => $arraydatacsv[$c][3],
                        'empty'=>$empty
                    ]);
                
                        
                    }





                csvFiles::create([
                    'folder' => 'ship-schedule-csv',
                    'filename' => $fileT->filename
                ]);
                Storage::move('public/csv-file/' . $fileT->filename, 'public/csv-file/ship-schedule-csv/' . $fileT->filename);
                return view('Supervisor.index.upload', ['success' => 'Uploaded and Inserted successfully']);
                //////////////////////////////////////end ship shedule///////////////////////////////////////////////////
            } elseif (
                    ((strtolower(str_replace(' ', '', $arraydatacsv[0][0])) === "﻿holidate") || (strtolower(str_replace(' ', '', $arraydatacsv[0][0])) === "holidate")) &&
                ((strtolower(str_replace(' ', '', $arraydatacsv[0][1])) === "﻿comments") || (strtolower(str_replace(' ', '', $arraydatacsv[0][1])) === "comments"))
            ) {
                //////////////////////////////////////holyday///////////////////////////////////////////////////
                $datacorect=false;
                for ($c = 1; $c < count($arraydatacsv); $c++) {
                    if(!($this->validateDate($arraydatacsv[$c][0]))){
                        $datacorect=true;
                        break; 
                         
                    }
                }
                if($datacorect){
                    Storage::delete('public/csv-file/' . $fileT->filename);
                    return view('Supervisor.index.upload', ['error' => "Invalid Data Type for Holyday table YYYY-MM-DD"]);
                }
                
                for ($c = 1; $c < count($arraydatacsv); $c++) {
                    $empty=false;
                    if(
                        empty($arraydatacsv[$c][0])||
                        empty($arraydatacsv[$c][1])
                    
                    ){$empty=true;}

                    


                    holyday::create([
                        'date' => $arraydatacsv[$c][0],
                        'comment' => $arraydatacsv[$c][1],
                        'empty' => $empty
                    ]);
                
                        
                    }
                    
                csvFiles::create([
                    'folder' => 'holyday-csv',
                    'filename' => $fileT->filename
                ]);
                Storage::move('public/csv-file/' . $fileT->filename, 'public/csv-file/holyday-csv/' . $fileT->filename);
                return view('Supervisor.index.upload', ['success' => 'Uploaded and Inserted successfully']);
                //////////////////////////////////////end holyday///////////////////////////////////////////////////
            }


            Storage::delete('public/csv-file/' . $fileT->filename);
            return view('Supervisor.index.upload', ['error' => "Invalid Column Name"]);
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pacling_list  $pacling_list
     * @return \Illuminate\Http\Response
     */
    public function show(pacling_list $pacling_list)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pacling_list  $pacling_list
     * @return \Illuminate\Http\Response
     */
    public function edit(pacling_list $pacling_list)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pacling_list  $pacling_list
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pacling_list $pacling_list)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pacling_list  $pacling_list
     * @return \Illuminate\Http\Response
     */
    public function destroy(pacling_list $pacling_list)
    {
        //
    }
    public function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
}
