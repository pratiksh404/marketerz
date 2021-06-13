<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'phone' => rand(1, 10),
            'gender' => rand(1, 3),
            'address' => $this->faker->city(),
            'active' => 1
        ];
    }
}
