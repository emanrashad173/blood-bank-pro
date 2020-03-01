<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonationRequest;


class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
      $records = DonationRequest::where(function($query) use($request){
          if ($request->input('city_id')) {
            $query->where('city_id',$request->city_id);
          }
          if ($request->input('blood_type_id')) {
            $query->where('blood_type_id',$request->blood_type_id);
          }
          if ($request->input('search_by_hospital_name')) {
            $query->where(function($query) use($request){
              $query->where('hospital_name','like','%'.$request->search_by_name.'%');
            });
          }
        })->paginate(20);

      return view('donations.index', compact('records'));

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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $record = DonationRequest::with('city','bloodType','client')->find($id);
      return view('donations.show', compact('record'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $record = DonationRequest::findOrFail($id);
      $record->delete();
      flash('Deleted')->error();
      return back();
    }

}
