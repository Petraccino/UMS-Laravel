<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;
    

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => explode(' ', fake()->name())[0],
            'lastname' => fake()->lastName(),
            'email' => fake()->unique()->email(),
            'fiscalcode' => strtoupper(\Faker\Factory::create()->unique()->regexify('[A-Z0-9]{16}')),
            'province' => fake()->randomElement([
                'Agrigento', 'Ancona', 'Aosta', 'Bari', 'Bologna', 'Bolzano', 'Brescia',
                'Cagliari', 'Campobasso', 'Catanzaro', 'Catania', 'Firenze', 'Genova',
                'L Aquila', 'La Spezia', 'Milano', 'Napoli', 'Padova', 'Palermo', 'Perugia',
                'Potenza', 'Reggio Calabria', 'Roma', 'Trento', 'Trieste', 'Torino', 'Venezia'
            ]),
            'phone' => fake()->phoneNumber(16),
            'age' => fake()-> numberBetween(15,99),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
