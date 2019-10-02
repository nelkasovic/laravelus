<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon;
use Activity;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application home.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenant = Auth::user()->tenant;
        $person = Auth()->user()->person;
        
        // Get client settings
        // $settings = Auth()->user()->tenant->getAllMeta();

        // Get all posts
        $posts = Auth()->user()->tenant->posts()->sortable(['updated_at' => 'desc'])->get()->take(5);

        $persons = $client->persons();
        //$events = $client->events()->whereHas('persons')->where('start_date', '>', Carbon::now()->format('Y-m-d H:i'))->take(5)->orderBy('start_date')->get();
        $events = $client->events()->orderBy('start_date')->get();

        $courses = $client->courses()->whereHas('persons')->take(6)->orderBy('updated_at', 'desc')->get();
        $scripts = $client->scripts()->take(5)->orderBy('updated_at', 'desc')->get();
        $activities = Activity::all()->take(5);
        $logins = Auth()->user()->tenant->users()->orderBy('last_login', 'desc')->take(5)->get();

        $upcoming_events = $events->filter(function ($event) {
            return $event->start_date > Carbon::now()->format('Y-m-d H:i');
        })->take(10);

        $current_events = $events->filter(function ($event) {
            return $event->end_date > Carbon::now()->format('Y-m-d H:i') && $event->start_date <= Carbon::now()->format('Y-m-d H:i');
        })->take(10)->sortBy('end_date');

        // Get only counts
        $count_upcoming = $client->events()->where('start_date', '>', Carbon::now()->format('Y-m-d H:i'))->count();
        $count_current = $client->events()->where('start_date', '<', Carbon::now()->format('Y-m-d H:i'))->where('end_date', '>', Carbon::now()->format('Y-m-d H:i'))->count();
        $count_open = (new EventController())->matching($person->id)->count();
        $events_open = (new EventController())->matching($person->id)->orderBy('start_date', 'asc')->get();
        
        // Count of events starting in the current month.
        $event_stats_chart_current = $this->eventStatsByStartDate(Carbon::now());
        $event_stats_chart_last = $this->eventStatsByStartDate(Carbon::now()->subYear());
        $event_stats_chart_next = $this->eventStatsByStartDate(Carbon::now()->addYear());

        $event_stats = Auth()->user()->tenant->events()->whereMonth('start_date', Carbon::now());

        // Count of participants which are assigned to groups and attached to an event in this month.
        $particpant_stats = Auth()->user()->tenant->students()->whereHas('groups', function($q) { 
            $q->whereHas('events', function($e) { 
                $e->whereMonth('start_date', Carbon::now()); 
            } ); 
        });

        // Count of different courses in this month.
        $course_stats = Auth()->user()->tenant->courses()->whereHas('events', function($q) { 
            $q->whereMonth('start_date', Carbon::now());
        });

        // Count of different studies in this month.
        $study_stats = Auth()->user()->tenant->studies()->whereHas('courses', function($q) { 
            $q->whereHas('events', function($e) { 
                $e->whereMonth('start_date', Carbon::now()); 
            } ); 
        });

        return view(
            'home',
            compact(
                'settings',
                'events_open',
                'count_open',
                'count_upcoming',
                'count_current',
                'persons',
                'activities',
                'upcoming_events',
                'current_events',
                'courses',
                'scripts',
                'logins',
                'posts',
                'event_stats',
                'event_stats_chart_current',
                'event_stats_chart_last',
                'event_stats_chart_next',
                'particpant_stats',
                'course_stats',
                'study_stats'
            )
        );
    }
        
    /* Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $persons = Auth::user()->tenant->persons();

        return view('dashboard')
            ->with('persons', $persons);
    }

    public function stats(Request $request)
    {
    }

    /* Get stats for dashboard. Event counts in the last 12 months.
     *
     * @return Illuminate\Support\Collection
     */
    public function eventStatsByStartDate($period)
    {
        // Get all event start dates.
        $dates = Auth()->user()->tenant->events()->whereYear('start_date', $period)->pluck('start_date');
        
        // Create empty collection to hold response.
        $response = collect();

        // Get only month numbers from start dates. Sort them from 0 - 12.
        $collection = $dates->map(function ($date) {
            return date('m', strtotime($date));
        })->sort();

        // Group by month number. All same months as one.
        $grouped = $collection->groupBy(function ($item, $key) {
            return $item;
        });

        // Count same months events.
        $numbered = $grouped->map(function ($item, $key) {
            return collect($item)->count();
        });
        
        // Get month names instead of numbers.
        $values = $numbered->mapWithKeys(function ($item, $key) {
            $month = Carbon::createFromFormat('m', $key)->format('F');
            return ["\"$month\"" => $item];
        });

        // Get only month names as labes.
        $labels = collect(array_keys($values->toArray()));

        // Put labels and values (count of events in a month) into the response.
        $response->put('labels', $labels->implode(', '));
        $response->put('values', $values->implode(', '));

        // Send response back.
        return $response;
    }

    public function calendar()
    {
        $tenant = Auth()->user()->tenant;
        $events = [];
        $data = $client->occurrences;
        if ($data->count()) {
            foreach ($data as $key => $occurrence) {
                $events[] = Calendar::event(
                    $occurrence->event->name, // Event name
                    false, // Full day event?
                    Carbon::parse($occurrence->date . ' ' . $occurrence->start_time),
                    Carbon::parse($occurrence->date . ' ' . $occurrence->end_time),
                    //new \DateTime($occurrence->end_date.' +1 day'),
                    $occurrence->id,
                    // Add color and link on event
                    [
                        'color' => $occurrence->event->color,
                        'url' => action('EventController@show', $occurrence->event->id),
                    ]
                );
            }
        }
        $locale = app()->getLocale() . 'Locale';

        $calendar = Calendar::addEvents($events)->setOptions([
            'locale' => $locale,
            'themeSystem' => 'bootstrap4',
            'firstDay' => 1,
            'editable' => !0,
            'droppable' => !0,
            'minTime' => '06:00:00',
            'maxTime' => '19:00:00',
            'defaultView' => 'list',
            'header' => array(
                'left' => 'title',
                'right' => 'prev,next today month,agendaWeek,agendaDay,listWeek',
            ),
        ]);

        return view('calendar', compact('calendar'));
    }

    public function calendarTest()
    {
        $events = [];

        $events[] = Calendar::event(
            'Event One', //event title
            false, //full day event?
            '2015-02-11T0800', //start time (you can also use Carbon instead of DateTime)
            '2015-02-12T0800', //end time (you can also use Carbon instead of DateTime)
            0 //optionally, you can specify an event ID
        );

        $events[] = Calendar::event(
            "Valentine's Day", //event title
            true, //full day event?
            new \DateTime('2015-02-14'), //start time (you can also use Carbon instead of DateTime)
            new \DateTime('2015-02-14'), //end time (you can also use Carbon instead of DateTime)
            'stringEventId' //optionally, you can specify an event ID
        );

        $eloquentEvent = EventModel::first(); //EventModel implements MaddHatter\LaravelFullcalendar\Event

        $calendar = Calendar::addEvents($events) //add an array with addEvents
            ->addEvent($eloquentEvent, [ //set custom color fo this event
                'color' => '#800',
            ])->setOptions([ //set fullcalendar options
                'firstDay' => 1,
            ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
                'viewRender' => 'function() {alert("Callbacks!");}',
            ]);

        return view('calendar', compact('calendar'));
    }
}
