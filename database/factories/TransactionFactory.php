<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    public function definition(): array
    {
        $subtotal           = fake()->numberBetween(15000, 500000);
        $discountPercentage = fake()->randomElement([0, 0, 0, 5, 10]); // weighted toward no discount
        $discountAmount     = round($subtotal * $discountPercentage / 100);
        $taxAmount          = round(($subtotal - $discountAmount) * 0.11); // 11 % VAT (Indonesia)
        $totalAmount        = $subtotal - $discountAmount + $taxAmount;

        $status      = fake()->randomElement(['completed', 'completed', 'completed', 'pending', 'cancelled']);
        $paymentDate = $status === 'completed' ? fake()->dateTimeBetween('-6 months', 'now') : null;

        return [
            'transaction_code'    => 'TXN' . now()->format('Ymd') . strtoupper(fake()->unique()->bothify('####??')),
            'user_id'             => User::inRandomOrder()->value('id'),
            'member_id'           => fake()->boolean(40)
                                     ? Member::inRandomOrder()->value('id')
                                     : null,
            'subtotal'            => $subtotal,
            'discount_amount'     => $discountAmount,
            'discount_percentage' => $discountPercentage,
            'tax_amount'          => $taxAmount,
            'total_amount'        => $totalAmount,
            'payment_method'      => fake()->randomElement(['cash', 'cash', 'card', 'e-wallet', 'qris']),
            'payment_status'      => $status,
            'payment_date'        => $paymentDate,
            'notes'               => fake()->boolean(20) ? fake()->sentence() : null,
        ];
    }

    /** State: completed transactions only */
    public function completed(): static
    {
        return $this->state(fn () => [
            'payment_status' => 'completed',
            'payment_date'   => fake()->dateTimeBetween('-3 months', 'now'),
        ]);
    }

    /** State: pending transactions only */
    public function pending(): static
    {
        return $this->state(fn () => [
            'payment_status' => 'pending',
            'payment_date'   => null,
        ]);
    }
}
