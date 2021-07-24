<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Address::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'street' => $this->faker->streetAddress,
      'city' => $this->faker->city,
      'is_sectional' => $this->faker->boolean(),
      'section_name' => $this->faker->word,
      'unit' => $this->faker->randomLetter . $this->faker->randomNumber,
      'type' => $this->faker->randomElement([
        'apartment',
        'complex',
        'estate'
      ]),
      'province' => $this->faker->randomElement([
        'limpopo',
        'mpumalanga',
        'western cape',
        'eastern cape',
        'northern cape',
        'kwazulu natal',
        'gauteng',
        'free state',
        'north west'
      ]),
      'postal_code' => $this->faker->postcode,
    ];
  }
}
