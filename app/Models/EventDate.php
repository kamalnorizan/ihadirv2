<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDate extends Model
{
    /** @use HasFactory<\Database\Factories\EventDateFactory> */
    use HasFactory;

    public $timestamps = true;

    protected $table = 'event_dates';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $guarded = ['id'];


}
