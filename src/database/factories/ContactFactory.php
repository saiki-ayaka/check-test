<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    public function definition(): array
    {
        $images = ['item1.png', 'item2.png', 'item3.png', 'item4.png', 'item5.png'];
    /**
     * Define the model's default state.
     *
     * @return array
     */
    
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->numberBetween(1, 3),
            'email' => $this->faker->unique()->safeEmail,
            'tel' => $this->faker->phoneNumber, // DB設計に合わせてtel1,2,3に分ける場合は調整が必要
            'address' => $this->faker->address,
            'building' => $this->faker->secondaryAddress,
            'detail' => $this->faker->realText(100),
            'image_path'  => $this->faker->boolean(50) ? 'products/' . $this->faker->randomElement($images) : null,
        ];
    }
}
