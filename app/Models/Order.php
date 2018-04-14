<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'event_type',
        'event_theme',
        'filter_text',
        'filter_colors',
        'filter_imagery',
        'status',
    ];

    /**
     * The attributes that are visible.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'user_id',
        'event_type',
        'event_theme',
        'filter_text',
        'filter_colors',
        'filter_imagery',
        'created_at',
        'updated_at',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
}