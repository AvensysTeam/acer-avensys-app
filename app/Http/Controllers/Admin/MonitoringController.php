<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Monitoring;
use Illuminate\Http\Request;

class MonitoringController extends Controller
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
        //dd($request->all());
        $monitoring = Monitoring::first();
        if(!$monitoring){
            $monitoring = new Monitoring();
        }
        if($request->monitor_new_user){
            $monitoring->monitor_new_user = true;
        }else{
            $monitoring->monitor_new_user = false;
        }

        if($request->monitor_logged_in_user){
            $monitoring->monitor_logged_in_user = true;
        }else{
            $monitoring->monitor_logged_in_user = false;
        }

        $monitoring->new_user_monitoring_level = $request->new_user_monitoring_level;
        $monitoring->logged_in_monitoring_level = $request->logged_in_monitoring_level;
        $monitoring->save();

        return redirect()->back()->with('success','Monitoring configuration updated');
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
