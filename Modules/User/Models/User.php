<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class User extends Model {
    protected $table = 'users';

    protected $fillable = [
        'name',
        'username',
        'password',
        'role_id',
        'email',
        'is_active',
    ];

    public function role()
    {
        return $this->belongsTo('Modules\Role\Models\Role', 'role_id');
    }

    public static function boot()
    {
       parent::boot();
       static::creating(function($model)
       {
        $model->created_by = Auth::id();
        $model->updated_by = Auth::id();
       });
       static::updating(function($model)
       {
        $model->updated_by = Auth::id();
       });
   }
}
