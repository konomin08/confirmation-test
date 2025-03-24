<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'tel' => $this->faker->phoneNumber,
            'category_id' => $this->faker->numberBetween(1, 5),
            'content' => $this->faker->realText(200),
            'gender' => $this->faker->randomElement(['男性', '女性', '未設定']),
            'category' => '未分類',
        ];
    }
}
