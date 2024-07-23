<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use App\Models\facture;
use Illuminate\Http\Request;

class paymentFacture extends Controller
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

        $fac = facture::create([
            'desc'=> request('pdescription'),
            'medicamentP'=> request('medicamentP'),
            'consultationP'=> request('consulteP'),
            'totalP'=> request('totalP'),
            'appId'=> request('appId')
        ]);
        $id =request('appId');
        $app = appointment::find($id);
         $app->appPaiement = "oui";
         $app->appStatus = "payer";
         $app->update();
        return redirect('dashboard/home')->with('status','rendez-vous payer avec succès');

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
    public function show($id)
    {
        //
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
