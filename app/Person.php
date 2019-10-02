<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Activitylog\Traits\LogsActivity;
use Plank\Metable\Metable;
use Qlick\LaravelRating\Traits\Rate\CanRate;
use Qlick\LaravelRating\Traits\Vote\CanVote;
use Qlick\LaravelRating\Traits\Like\CanLike;

class Person extends Model 
{
    use Sortable;
    use LogsActivity;
    use Metable;
    use HasRoles;
    
    /**
     * Override default $perPage = 15.
     */
    protected $perPage = 10;

    protected $guard_name = 'web';

    protected $table = 'persons';

    protected $with = ['meta'];

    protected $fillable = [
        'user_id',
        'tenant_id',
        'salutation',
        'first_name',
        'last_name',
        'company_name',
        'title',
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
        'changed',
        'notes',
    ];

    /**
     * The attributes that may be sorted by.
     *
     * @var array
     */
    public $sortable = [
        'last_name', 
        'first_name', 
        'company_name', 
        'title', 
        'email', 
        'phone', 
        'updated_at'
    ];

    
    /**
     * Activity Log.
     */
    protected static $logFillable = true;
    protected static $ignoreChangedAttributes = ['user_id', 'website'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    //protected static $logName = 'Person';

    /**
     * Relations.
     */

    public function tenant()
    {
        return $this->belongsTo('App\Tenant');
    }


    /**
     * Overwrite scope search.
     */
    public function scopeSearch($query, $value)
    {
        return $query->where('first_name', 'like', '%'.$value.'%')
            ->orWhere('last_name', 'like', '%'.$value.'%')
            ->orWhere('title', 'like', '%'.$value.'%')
            ->orWhere('notes', 'like', '%'.$value.'%')
            ->orWhere('email', 'like', '%'.$value.'%');
    }
}
