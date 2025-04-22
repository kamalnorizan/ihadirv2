<?php

namespace Database\Factories;


use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\EventCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid'=> Uuid::uuid4(),
            'title'=> fake()->sentence(rand(3, 5)),
            'location'=> fake()->company(),
            'pax'=> rand(10, 20),
            'owner_id'=> rand(1, User::count()),
            'event_category_id'=> rand(1, EventCategory::count()),
            'email'=> fake()->email(),
            'description'=> fake()->paragraph(rand(1, 3)),
        ];
    }
}
