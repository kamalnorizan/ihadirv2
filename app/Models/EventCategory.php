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

    /**
     * Get all of the events for the EventCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany(Event::class, 'event_category_id', 'id');
    }
}
