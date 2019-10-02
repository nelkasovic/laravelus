<?php

namespace App\Http\Controllers;

use Spatie\Valuestore\Valuestore;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $client_settings;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        
        // Get all client and user settings
        $client_settings = Auth()->user()->client->settings;
        $user_settings = Auth()->user()->settings;
        // Get themes available.
        $themes = Auth()->user()->client->themes;

        return view('settings', compact('client_settings', 'user_settings', 'themes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexvs()
    {
        $this->client_settings = Valuestore::make(storage_path('app/settings.json'));
        $this->client_settings->put(
            [
                'one' => 'You have one.',
                'two' => 'You have got two.',
                'three' => 'They have three.',
                'four' => 'We have four.',
            ]
        );

        return view('settings', compact('client_settings'));
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
        $this->client_settings = Valuestore::make(storage_path('app/settings.json'));

        
        if ($request->client_settings) {
            foreach ($request->client_settings as $key => $value) {
                $this->client_settings->forget($key);
                $this->client_settings->put($key, $value);
            }
    
            //dd($request->client_settings, $this->client_settings->all());
        }

        return view('settings', compact('client_settings'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function sync(Request $request)
    {
        $client = Auth()->user()->client;
        
        // Fetch request with client and user settings.
        $client_data = $request->client_settings;
        $user_data = $request->user_settings;

        // Get all client and user settings.
        $client_settings = $client->settings;
        $user_settings = Auth()->user()->settings;
        $themes = Auth()->user()->client->themes;

        // Loop through all client theme settings.
        foreach ($client_settings['theme_settings'] as $key => $value) {
            $value = @$client_data[$key] ? true : false;
            $client->setMeta($key, $value);
        }

        // Loop through all client notification settings.
        foreach ($client_settings['notification_settings'] as $key => $value) {
            $value = @$client_data[$key] ? true : false;
            $client->setMeta($key, $value);
        }

        // Loop through all client application settings.
        foreach ($client_settings['app_settings'] as $key => $value) {
            $value = @$client_data[$key] ? true : false;
            $client->setMeta($key, $value);
        }

        // Loop through all client helper settings.
        foreach ($client_settings['helpers'] as $key => $value) {
            $client->setMeta($key, @$client_data[$key]);
        }

        // Loop through all user notification settings.
        foreach ($user_settings['notification_settings'] as $key => $value) {
            $value = @$user_data[$key] ? true : false;
            Auth()->user()->setMeta($key, $value);
        }

        // Loop through all user widget settings.
        foreach ($user_settings['dashboard_widget_settings'] as $key => $value) {
            $value = @$user_data[$key] ? true : false;
            Auth()->user()->setMeta($key, $value);
        }
        
        /**
         * Check if request is AJAX or not.
         */
        if ($request->ajax()) {
            $data = [
                    'status' => 200,
                    'success' => true,
                    'result' => $request->all()
                ];
                
            return response()->json($data);
        }
        
        return back();
    }

    /**
     * Reset settings to default.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function defaults()
    {
        $client = Auth()->user()->client;

        // Get all client and user settings
        $client_settings = $client->settings;
        $user_settings = Auth()->user()->settings;

        // Get all themes available.
        $themes = Auth()->user()->client->themes;

        // Loop through all client settings.
        foreach ($client_settings as $option) {
            // Since we have nested arrays in settings, we need to loop through once more.
            foreach ($option as $key => $value) {
                $client->setMeta($key, $value);
            }
        }

        // Loop through all user settings.
        foreach ($user_settings as $option) {
            // Since we have nested arrays in settings, we need to loop through once more.
            foreach ($option as $key => $value) {
                Auth()->user()->setMeta($key, $value);
            }
        }

        return back();
    }

    /**
     * Initialize setting/meta fields.
     *
     * @param array $fields
     * @param object $model
     *
     * @return \Illuminate\Http\Response
     */
    public function init($model, $client_settings)
    {
        if ($model && $client_settings) {
            $model->syncMeta($client_settings);
        }
    }
}
