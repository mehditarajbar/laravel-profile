<?php

namespace Database\Factories;

use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ChannelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name=$this->faker->sentence(4);
        return [
            'name'=>$name,
            'slug'=>Str::slug($name)
        ];
    }
}
