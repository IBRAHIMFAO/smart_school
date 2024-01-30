<?php
namespace Database\Factories;

use App\Models\Student;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();

        return [
            'name' => $faker->name(),
            'codeRFID' => $faker->regexify('[0-9A-F]{8}'),
        ];
    }
}
