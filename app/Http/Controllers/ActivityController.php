<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Component;
use Activity;
use Lang;

class ActivityController extends Controller
{
    /**
     * Create a new controller instance with authentication.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('role:admin');
        $this->middleware('permission:read activities');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $show = ($request->show) ? $request->show : 100;
        $selected_module = $request->module_id;

        /*
         * Retrieving activity
         * Activity::where('log_name' , 'other-log')->get(); //returns all activity from the 'other-log'
         * There’s also an inLog scope you can use:
         * Activity::inLog('other-log')->get();
         * //you can pass multiple log names to the scope
         * Activity::inLog('default', 'other-log')->get();
         * //passing an array is just as good
         * Activity::inLog(['default', 'other-log'])->get();
         */

        try {
            if ($selected_module) {
                $module = Component::findOrFail($selected_module);
                $activities = Activity::where('subject_type', $module->model)->paginate($show)->onEachSide(1);
            } else {
                $activities = Activity::paginate($show)->onEachSide(1);
            }

            $modules = Component::all();
            $total = $activities->count();

            /**
             * Check if request is AJAX or not.
             */
            if ($request->ajax()) {
                $data = [
                    'status' => 200,
                    'success' => true,
                    'result' => Activity::all()->toArray()
                ];
                
                return response()->json($data);
            }

            return view(
                'activities',
                [
                    'activities' => $activities,
                    'modules' => $modules,
                    'selected_module' => $selected_module,
                    'show' => $show,
                    'total' => $total,
                    'keyword' => $keyword,
                ]
            );
        } catch (\Exception $e) {
            //dd($e);

            $message = $e->getMessage();

            return view(
                'activities',
                [
                    'msg' => $message,
                    'status' => false,
                ]
            );
        }
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $msg = Lang::get('common.DeleteSuccess');
        try {
            $activity = Activity::findOrFail($id);
            $this->authorize('delete', $activity);
            $activity->delete();

            return back()->with('msg', $msg)->with('status', true)->with('selected_module', $request->selected_module);
        } catch (\Exception $e) {
            $msg = $e->getMessage();

            return back()->withError($msg)->with('status', false)->withInput();
        }
    }
}
