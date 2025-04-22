<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    public $timestamps = true;

    protected $table = 'event_categories';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $guarded = ['id'];

}
