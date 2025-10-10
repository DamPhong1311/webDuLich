<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DestinationFactory extends Factory
{
    public function modelName()
    {
        return \App\Models\Destination::class;
    }

    public function definition()
    {
        $title = $this->faker->unique()->city.' '.$this->faker->word;
        return [
            'title' => $title,
            'slug' => Str::slug($title.'-'.rand(1,9999)),
            'excerpt' => $this->faker->sentence(12),
            'content' => $this->faker->paragraphs(4, true),
            'location' => $this->faker->city,
            'province' => $this->faker->state,
            'published_at' => now()->subDays(rand(0,300)),
        ];
    }
}
