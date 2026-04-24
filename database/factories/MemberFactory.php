<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    public function definition(): array
    {
        // Get a user that doesn't have a member record yet, or create one
        $user = User::doesntHave('member')->inRandomOrder()->first()
                ?? User::factory()->create();

        $totalSpent = fake()->numberBetween(0, 8000000);

        return [
            'user_id'             => $user->id,
            'member_code'         => 'MBR' . strtoupper(fake()->unique()->bothify('###??')),
            'member_phone'        => fake()->numerify('08##########'),
            'member_email'        => $user->email,
            'discount_percentage' => fake()->randomElement([0, 2, 5, 10]),
            'points_balance'      => fake()->numberBetween(0, 500),
            'total_spent'         => $totalSpent,
            'is_active'           => fake()->boolean(85),
        ];
    }
}
