<?php

namespace Database\Factories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Permission>
 */
class PermissionFactory extends Factory
{
    protected $model = Permission::class;
    public function definition(): array
    {
        $name = $this->faker->unique()->word;
        return [
            'name' => $name,
            'slug' => Str::slug($name, '-'),
        ];
    }
}
