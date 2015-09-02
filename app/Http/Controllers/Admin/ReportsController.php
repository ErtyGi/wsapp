<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReportFormRequest;


class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $user = Auth::user();
        $reports = $user->reports()->latest()->get();

        return view('cms.reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return view('cms.reports.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ReportFormRequest $request)
    {
        $report = new   \App\Model\Report();
        $report->user_id = $request->get('user_id');
        $report->website_id = $request->get('website_id');
        $report->save();

        return redirect('/analisi/reports')->with('custom_success', 'Your report has been created! ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


    public function test(){
         $path = public_path('vendor\bin');
        $browsershot = new \Spatie\Browsershot\Browsershot();
        $browsershot-> setURL('http://www.google.com')
                    -> save('');



        echo '<img src="arstechnica-browsershot.jpg" />';



    }
}
