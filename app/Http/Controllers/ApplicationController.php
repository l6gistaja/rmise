<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\AppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ApplicationController extends Controller
{

    const DISPLAY_SEARCH_RESULTS = 100;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = [];
        $q = '';
        if(isset($request->q)) {
            $q = $request->q;
            $items = Application::search($q)->take(self::DISPLAY_SEARCH_RESULTS)->get();
            if(count($items) < 1) {
                $appIds = [];
                foreach(AppService::search($q)->take(self::DISPLAY_SEARCH_RESULTS)->get() as $as) {
                    $appIds[] = $as->app_code;
                }
                array_unique($appIds);
                $items = Application::find($appIds);
            }
        }
        return View::make('applications.index')->with(['items' => $items, 'q' => $q]);
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
