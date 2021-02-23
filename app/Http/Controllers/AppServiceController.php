<?php

namespace App\Http\Controllers;

use App\Models\AppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class AppServiceController extends Controller
{

    const CID = 'services';
    const DISPLAY_SEARCH_RESULTS = 100;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return redirect('applications/'.$request->app_code.'/edit#services');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return View::make(self::CID.'.form')->with(['app_code' => $request->app_code]);
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
            return redirect(self::CID.'/create?app_code='.$request->get('app_code'))
                ->withErrors($validator)
                ->withInput();
        }

        $item = new AppService([
            'name' => $request->get('name'),
            'type' => $request->get('type'),
            'sub_type' => $request->get('sub_type'),
            'description' => $request->get('description'),
            'app_code' => $request->get('app_code')
        ]);
        $item->save();
        return redirect('applications/'.$request->get('app_code').'/edit#services')->with('success', __('Saved!'));
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
        $item = AppService::find($id);
        return View::make(self::CID.'.form')->with(['item' => $item ]);
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
        $item = AppService::find($id);
        $item->name = $request->get('name');
        $item->type = $request->get('type');
        $item->sub_type = $request->get('sub_type');
        $item->description = $request->get('description');
        $item->save();

        return redirect('applications/'.$item->app_code.'/edit#services')->with('success', __('Saved!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = AppService::find($id);
        $app_code = $item->app_code;
        AppService::destroy($id);
        return redirect('applications/'.$app_code.'/edit#services')->with('success', __('Deleted!'));
    }
}
