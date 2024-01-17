<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\NotifierList;
use Illuminate\Http\Request;

class NotifierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifiers = NotifierList::get();
        return view("admin.settings.notifiers", compact("notifiers"));
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
        NotifierList::create($request->all());

        return redirect()->back()->with("success","Notifier Added Successfully");
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
        $notifier = NotifierList::findOrFail($id);
        $notifiers = NotifierList::get();
        return view('admin.settings.notifiers', compact('notifier','notifiers'));
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
        $notifier = NotifierList::findOrFail($id);
        $notifier->update($request->all());
        return redirect()->route('admin.notifier')->with('success','Notifer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notifier = NotifierList::findOrFail($id);
        $notifier->delete();
        return redirect()->back()->with('success','Notifier deleted successfully');
    }
}
