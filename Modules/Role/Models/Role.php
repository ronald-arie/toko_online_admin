<?php

namespace Modules\Role\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Role extends Model {
    protected $table = 'user_role';

    protected $fillable = [
        'name',
        'permissions',
        'status',
    ];

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public static function boot()
    {
       parent::boot();
       static::creating(function($model)
       {
        $model->created_by = Auth::user()->id;
        $model->updated_by = Auth::user()->id;
       });
       static::updating(function($model)
       {
        $model->updated_by = Auth::user()->id;
       });
   }
}
