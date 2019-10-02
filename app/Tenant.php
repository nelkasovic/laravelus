<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Activitylog\Traits\LogsActivity;
use Plank\Metable\Metable;

class Tenant extends Model
{
    use Sortable;
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

    protected $table = 'tenants';

    protected $with = ['meta'];

    protected $fillable = [
        'name',
        'extension',
        'street',
        'street_number',
        'zip',
        'city',
        'country',
        'phone',
        'mobile',
        'fax',
        'email',
        'website',
        'picture',
        'active',
    ];

    /**
     * The attributes that may be sorted by.
     *
     * @var array
     */
    public $sortable = [
        'name',
        'extension',
        'street',
        'street_number',
        'zip',
        'city',
        'country',
        'email',
        'active'
    ];

    /**
     * Available client settings.
     *
     * @var array
     */
     public $settings = [
        'helpers' => [
            'custom_theme' => 'xmodern',
            'initial_password' => '#Staff84'
        ],
        'theme_settings' => [
            'enable_cookies' => false,
            'sidebar_r' => false,
            'sidebar_o' => true,
            'sidebar_o_xs' => false,
            'sidebar_dark' => false,
            'sidebar_mini' => true,
            'side_overlay_hover' => false,
            'side_overlay_o' => false,
            'enable_page_overlay' => true,
            'side_scroll' => true,
            'page_header_fixed' => true,
            'page_footer_fixed' => false,
            'page_header_dark' => true,
            'page_header_glass' => false,
            'main_content_boxed' => false,
            'main_content_narrow' => false
        ],
        'notification_settings' => [
            'notify_data_incomplete' => true,
            'notify_person_to_user' => true,
            'notify_tender' => true,
            'notify_with_attachment' => true,
            'notify_attachment_skills' => true,
            'notify_attachment_participants' => true,
            'notify_event_applied' => true,
            'notify_event_declined' => true,
            'notify_event_assigned' => true,
            'notify_event_confirmed' => true,
            'notify_event_completed' => true,
        ],
        'app_settings' => [
            'footer_show_date' => true,
        ]
    ];

    public $themes = [
        'default',
        'xwork',
        'xmodern',
        'xeco',
        'xsmooth',
        'xinspire',
        'xdream',
        'xpro',
        'xplay'
    ];
    
    /**
     * Activity Log.
     */
    protected static $logFillable = true;
    protected static $ignoreChangedAttributes = ['fax', 'website'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    protected static $logName = 'Tenant';

    public function settings()
    {
        return $this->settings;
    }

    public function themes()
    {
        return $this->themes;
    }


    /**
     * Relations.
     */
    public function users()
    {
        return $this->hasMany('App\User')->where('active', 1);
    }

    public function persons()
    {
        return $this->hasMany('App\Person');
    }

    public function evus()
    {
        return $this->hasMany('App\Person')->whereHas('roles', function ($q) {
            $q->where('name', 'evu');
        })->where('active', 1);
    }

    public function customers()
    {
        return $this->hasMany('App\Person')->whereHas('roles', function ($q) {
            $q->where('name', 'customer');
        })->where('active', 1);
    }

    public function admins()
    {
        return $this->hasMany('App\Person')->whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->where('active', 1);
    }

    /**
     * Overwrite scope search.
     */
    public function scopeSearch($query, $value)
    {
        return $query->where('name', 'like', '%'.$value.'%')
            ->orWhere('extension', 'like', '%'.$value.'%')
            ->orWhere('email', 'like', '%'.$value.'%');
    }
}
