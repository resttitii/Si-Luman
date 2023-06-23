<?php
//fix
//menghasilkan data dummy atau data uji secara otomatis

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array // mendefinisikan state (keadaan) default dari model User
    {
        return [
            'name' => fake()->name(), //akan menghasilkan sebuah nama acak
            'email' => fake()->unique()->safeEmail(), //menghasilkan alamat email acak yang aman
            'email_verified_at' => now(), //menandakan bahwa email pengguna sudah diverifikasi dengan waktu saat ini
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //contoh password terenkripsi yang ditetapkan sebagai password default untuk semua data dummy pengguna
            'remember_token' => Str::random(10), //menghasilkan token acak dengan panjang 10 karakter menggunakan Str::random(10)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static //menandakan bahwa alamat email model User tidak terverifikasi
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
