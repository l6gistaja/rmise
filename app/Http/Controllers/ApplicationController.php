<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\AppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ApplicationController extends Controller
{

    const CID = 'applications';
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
        return View::make(self::CID.'.index')->with(['items' => $items, 'q' => $q]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make(self::CID.'.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect(self::CID.'/create')
                ->withErrors($validator)
                ->withInput();
        }

        $item = new Application([
            'name' => $request->get('name'),
            'app_group' => $request->get('app_group'),
            'app_type' => $request->get('app_type'),
            'description' => $request->get('description'),
            'app_cost' => 0 + $request->get('app_cost')
        ]);
        $item->save();
        return redirect(self::CID.'/'.$item->app_code.'/edit#services')->with('success', __('Saved!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->edit($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Application::find($id);
        return View::make(self::CID.'.form')->with(['item' => $item, 'services' => $item->appServices() ]);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect(self::CID.'/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $item = Application::find($id);
        $item->name = $request->get('name');
        $item->app_group = $request->get('app_group');
        $item->app_type = $request->get('app_type');
        $item->description = $request->get('description');
        $item->app_cost = 0 + $request->get('app_cost');
        $item->save();

        return redirect('/'.self::CID)->with('success', __('Saved!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Application::destroy($id);
        return redirect('/'.self::CID)->with('success', __('Deleted!'));
    }
}
