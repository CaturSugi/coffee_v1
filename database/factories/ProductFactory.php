<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /** Coffee-drink adjectives + base names for infinite unique combos */
    private static array $adjectives = [
        'Classic', 'Iced', 'Hot', 'Premium', 'Special', 'Signature',
        'Original', 'House', 'Seasonal', 'Limited', 'Double', 'Triple',
    ];

    private static array $bases = [
        'Espresso', 'Americano', 'Cappuccino', 'Latte', 'Flat White',
        'Macchiato', 'Mocha', 'Cold Brew', 'Frappe', 'Matcha Latte',
        'Chamomile Tea', 'Earl Grey', 'Croissant', 'Muffin', 'Cheesecake',
        'Sandwich', 'Salad', 'Waffle', 'Pancake', 'Toast',
    ];

    public function definition(): array
    {
        // Combine adjective + base + suffix number for near-unlimited uniqueness
        $name          = fake()->randomElement(self::$adjectives)
                         . ' ' . fake()->randomElement(self::$bases)
                         . ' #' . fake()->unique()->numberBetween(1, 9999);

        $purchasePrice = fake()->numberBetween(5000, 25000);
        $sellPrice     = $purchasePrice * fake()->randomFloat(2, 1.4, 2.2);
        $stock         = fake()->numberBetween(0, 100);

        return [
            'category_id'    => ProductCategory::inRandomOrder()->value('id')
                                 ?? ProductCategory::factory()->create()->id,
            'name'           => $name,
            'description'    => fake()->sentence(10),
            'sku'            => strtoupper(fake()->unique()->bothify('SKU-####-??')),
            'purchase_price' => $purchasePrice,
            'sell_price'     => round($sellPrice, -2),
            'stock'          => $stock,
            'min_stock'      => fake()->numberBetween(3, 15),
            'image'          => null,
            'is_active'      => fake()->boolean(90),
            'created_by'     => User::inRandomOrder()->value('id'),
        ];
    }

    /** State: mark as out of stock */
    public function outOfStock(): static
    {
        return $this->state(fn () => ['stock' => 0]);
    }

    /** State: always active */
    public function active(): static
    {
        return $this->state(fn () => ['is_active' => true]);
    }
}
