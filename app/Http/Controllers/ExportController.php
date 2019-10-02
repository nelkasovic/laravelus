<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

// Export from collection.
use App\Exports\ActivitiesExport;
use App\Exports\AssetsExport;
use App\Exports\ClientsExport;
use App\Exports\CoursesExport;
use App\Exports\EventsExport;
use App\Exports\ExclusionsExport;
use App\Exports\FilesExport;
use App\Exports\GroupsExport;
use App\Exports\MethodsExport;
use App\Exports\ObjectivesExport;
use App\Exports\PeriodsExport;
use App\Exports\PersonsExport;
use App\Exports\RoomsExport;
use App\Exports\ScriptsExport;
use App\Exports\SkillsExport;
use App\Exports\StudiesExport;
use App\Exports\UsersExport;

use App\Exports\StudentsFromView;
use Lang;
use Carbon;

class ExportController extends Controller
{
    /**
     * Create a new controller instance with authentication.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('role:user|person');
        $this->middleware('permission:read persons');
    }

    /**
     * Export persons.
     */
    public function persons()
    {
        return Excel::download(new PersonsExport, Carbon::now()->format('Y_m_d_') . Lang::get('common.Persons') . '.xlsx');
    }

    /**
     * Export persons with role student.
     */
    public function students()
    {
        return Excel::download(new StudentsFromView, Carbon::now()->format('Y_m_d_') . Lang::get('common.Students') . '.xlsx');
    }

    /**
     * Export users.
     */
    public function users()
    {
        return Excel::download(new UsersExport, Carbon::now()->format('Y_m_d_') . Lang::get('common.Users') . '.xlsx');
    }

    /**
     * Export clients.
     */
    public function clients()
    {
        return Excel::download(new ClientsExport, Carbon::now()->format('Y_m_d_') . Lang::get('common.Clients') . '.xlsx');
    }

    /**
     * Export skills.
     */
    public function skills()
    {
        return Excel::download(new SkillsExport, Carbon::now()->format('Y_m_d_') . Lang::get('common.Skills') . '.xlsx');
    }
    
    /**
     * Export scripts.
     */
    public function scripts()
    {
        return Excel::download(new ScriptsExport, Carbon::now()->format('Y_m_d_') . Lang::get('common.Scripts') . '.xlsx');
    }
    
    /**
     * Export events.
     */
    public function events()
    {
        return Excel::download(new EventsExport, Carbon::now()->format('Y_m_d_') . Lang::get('common.Events') . '.xlsx');
    }

    /**
     * Export objectives.
     */
    public function objectives()
    {
        return Excel::download(new ObjectivesExport, Carbon::now()->format('Y_m_d_') . Lang::get('common.Objectives') . '.xlsx');
    }

    /**
     * Export methods.
     */
    public function methods()
    {
        return Excel::download(new MethodsExport, Carbon::now()->format('Y_m_d_') . Lang::get('common.Methods') . '.xlsx');
    }
    
    /**
     * Export groups.
     */
    public function groups()
    {
        return Excel::download(new GroupsExport, Carbon::now()->format('Y_m_d_') . Lang::get('common.Groups') . '.xlsx');
    }
    
    /**
     * Export courses.
     */
    public function courses()
    {
        return Excel::download(new CoursesExport, Carbon::now()->format('Y_m_d_') . Lang::get('common.Courses') . '.xlsx');
    }
    
    /**
     * Export studies.
     */
    public function studies()
    {
        return Excel::download(new StudiesExport, Carbon::now()->format('Y_m_d_') . Lang::get('common.Studies') . '.xlsx');
    }
    
    /**
     * Export rooms.
     */
    public function rooms()
    {
        return Excel::download(new RoomsExport, Carbon::now()->format('Y_m_d_') . Lang::get('common.Rooms') . '.xlsx');
    }

    /**
     * Export assets.
     */
    public function assets()
    {
        return Excel::download(new AssetsExport, Carbon::now()->format('Y_m_d_') . Lang::get('common.Assets') . '.xlsx');
    }

    /**
     * Export exclusions.
     */
    public function exclusions()
    {
        return Excel::download(new ExclusionsExport, Carbon::now()->format('Y_m_d_') . Lang::get('common.Exclusions') . '.xlsx');
    }

    /**
     * Export periods.
     */
    public function periods()
    {
        return Excel::download(new PeriodsExport, Carbon::now()->format('Y_m_d_') . Lang::get('common.Periods') . '.xlsx');
    }

    /**
     * Export activities.
     */
    public function activities()
    {
        return Excel::download(new ActivitiesExport, Carbon::now()->format('Y_m_d_') . Lang::get('common.Activities') . '.xlsx');
    }

    /**
     * Export files.
     */
    public function files()
    {
        return Excel::download(new FilesExport, Carbon::now()->format('Y_m_d_') . Lang::get('common.Files') . '.xlsx');
    }
    /**
     * Export grades.
     */
    public function grades()
    {
        return Excel::download(new GradesExport, Carbon::now()->format('Y_m_d_') . Lang::get('common.Grades') . '.xlsx');
    }
}
