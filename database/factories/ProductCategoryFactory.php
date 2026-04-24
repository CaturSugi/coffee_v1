<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    /** Coffee-shop specific categories */
    private static array $categories = [
        'Espresso Drinks',
        'Cold Brew',
        'Frappe & Blended',
        'Tea & Herbal',
        'Food & Snacks',
        'Pastries',
        'Merchandise',
        'Non-Coffee',
    ];

    private static int $index = 0;

    public function definition(): array
    {
        $name = self::$categories[self::$index % count(self::$categories)] . ' ' . (self::$index > 7 ? fake()->word() : '');
        self::$index++;
        $name = trim($name);

        return [
            'name'        => $name,
            'slug'        => Str::slug($name) . '-' . fake()->unique()->numberBetween(1, 9999),
            'description' => fake()->sentence(),
            'icon'        => fake()->randomElement(['coffee', 'tea', 'food', 'drink', 'star', 'gift']),
            'is_active'   => true,
        ];
    }
}
