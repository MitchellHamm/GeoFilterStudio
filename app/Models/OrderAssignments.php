<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAssignments extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_assignments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'order_id',
    ];

    /**
     * The attributes that are visible.
     *
     * @var array
     */
    protected $visible = [
        'user_id',
        'order_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
}