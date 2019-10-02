<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Plank\Metable\Metable;
use Qlick\LaravelRating\Traits\Rate\CanRate;
use Qlick\LaravelRating\Traits\Vote\CanVote;
use Qlick\LaravelRating\Traits\Like\CanLike;

class User extends Authenticatable
{
    use Notifiable;
    use Sortable;
    use HasRoles;
    use LogsActivity;
    use Metable;

    /**
     * Override default $perPage = 15.
     */
    protected $perPage = 10;

    /**
     * Guard name.
     */
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'email',
        'password',
        'last_login',
    ];

    /**
     * The attributes that may be sorted by.
     *
     * @var array
     */
    public $sortable = ['email', 'name', 'description', 'updated_at'];

    /**
     * Activity Log.
     */
    protected static $logFillable = true;
    protected static $ignoreChangedAttributes = ['password'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    //protected static $logName = 'User';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Available person settings.
     *
     * @var array
     */
    public $settings = [
        'notification_settings' => [
            'receive_tender' => true,
            'receive_event_declined' => true,
            'receive_event_assigned' => true,
            'receive_event_confirmed' => true,
        ],
        'dashboard_widget_settings' => [
            'quick_stats' => true,
            'events_per_month_stats' => true,
            'last_posts' => false,
            'user_activities' => false,
            'other_activities' => false,
            'events_overview' => true,
        ]
    ];
    public function settings()
    {
        return $this->settings;
    }


    /**
     * Relations.
     */
    public function person()
    {
        return $this->belongsTo('App\Person');
    }


    public function tenant()
    {
        return $this->belongsTo('App\Tenant');
    }

    /**
     * Overwrite scope search.
     */
    public function scopeSearch($query, $value)
    {
        return $query->where('email', 'like', '%'.$value.'%')
            ->orWhere('description', 'like', '%'.$value.'%');
    }
}
