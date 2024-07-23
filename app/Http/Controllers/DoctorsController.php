<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\doctors;
class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $color = [
            '#06c23e',
            '#70c206',
            '#f9db00',
            '#f98100',
            '#f94500',
            '#ff0f0f',
            '#ff0f49',
            '#ff0f9f',
            '#b70fff',
            '#4d0fff',
            '#0f14ff',
            '#0fa4ff',
            '#0fff8c',
            '#0f6aff',
            '#696969',
        ];
        
        $docs = doctors::all();
        $i=0;
        $c=null;
        $colors=[];
        foreach ($docs as $b) {
            
            array_push($colors,$b->color);
            
        }
        for($i=0;$i<15;$i++){
            if(in_array($color[$i],$colors)){
            
                
            }
            else{
                $c=$color[$i];
                break;
            } 
        }

        doctors::create([
            'DocLName'=> request('DocLName'),
            'DocFName'=> request('DocFName'),
            'contact'=> request('contact'),
            'speciality'=> request('speciality'),
            'color'=>$c,
            
        ]);
        return redirect('dashboard/medecin');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $doctors = doctors::all();
        return ['docs' => $doctors];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = doctors::find($id);
            if($doctor)
            {
                return response()->json([
                    'DocFName'=>$doctor->DocFName,
                    'DocLName'=>$doctor->DocLName,
                    'contact'=>$doctor->contact,
                    'speciality'=>$doctor->speciality,
                    'id'=>$doctor->id,
                    
                ]);
            }
            else{
                return response()->json([
                    'status'=>404,
                    'doctor'=>'not found',
                ]);
            }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('editid');

        $doc = doctors::find($id);
        $doc->DocFName = $request->input('editFName');
        $doc->DocLName = $request->input('editLName');
        $doc->speciality = $request->input('speciality');
        $doc->contact = $request->input('editContact');
        $doc->update();

        return redirect('dashboard/medecin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = doctors::find($id);
        $doctor->delete();
        return response()->json([
            'status'=>200,
            'message'=>'medecin est suprrimer',
        ]);
    }
}
