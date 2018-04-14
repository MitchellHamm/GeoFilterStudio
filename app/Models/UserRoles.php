<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'role_id',
    ];

    /**
     * The attributes that are visible.
     *
     * @var array
     */
    protected $visible = [
        'user_id',
        'role_id',
        'role_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function UserRoles() {
        return $this->belongsTo('App\Models\UserRoles');
    }

    public function getRoleNameAttribute() {
        return Roles::where('id', $this->role_id)->value('role');
    }
}