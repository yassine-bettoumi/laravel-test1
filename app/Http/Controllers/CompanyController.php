<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Traits\PdfTrait;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use PdfTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CanadaCompaniesWithUsers = Company::with('users','countries')->where('countries.name','=','canada')->get(); // this are all the companies with thier users in canada
        $CanadaCompaniesUsers = $CanadaCompaniesWithUsers->users; // this are all the users who are associated with companies in the country of canada with dates 
        //this how to get date of association of the user 
    // @foreach ($CanadaCompaniesUsers as $user)
    // <li>{{$user->name}} -- {{$user->pivot->created_at}}</li>
    //     @endforeach


    }

    public function store(PdfRequest $request)
    {
        $error = array(); // list of errors to display

        $file = $this-> savePdf($request->pdfFile,'file/proposals'); //you'll find this function in app/traits/pdftrait...
        if($file != '422'){
            if($file != '403'){
                $filesFromDb = Files::get();
                foreach($filesFromDb as $fileFromDb){
                    if($fileFromDb->name != $file && $fileFromDb->size != filesize($file)){
                        Files::create(['name'=> $file,'size'=> filesize($file)]); // when the file doesn't exist on our db 

                    }elseif($fileFromDb->name = $file && $fileFromDb->size != filesize($file)){
                        Files::where('name',$file)->update(['name'=> $file,'size'=> filesize($file)]); // update the file
                    }
                }
            }else{
                array_push($status,'403');
            }

         }else{
            array_push($status,'422');
         }
    }
}
