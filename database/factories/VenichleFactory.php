<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venichle>
 */
class VenichleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $endOfYear = now()->endOfYear();
        $vehicleNames = [
            'Avanza', 'Xenia', 'Innova', 'Ertiga', 'Livina', 'Terios', 'Rush', 'Pajero', 'Fortuner', 'X-Trail',
            'CR-V', 'HR-V', 'BR-V', 'Xpander', 'Outlander', 'Kijang', 'Kijang Innova', 'Elf', 'Grand Livina',
            'Alphard', 'Vellfire', 'L300', 'Hiace', 'Calya', 'Sienta', 'Agya', 'Ayla', 'Brio', 'Mobilio',
            'Sigra', 'Ranger', 'Hilux', 'D-Max', 'Travero', 'Colorado', 'Navara', 'BT-50', 'Triton', 'Strada'
        ];

        return [
            'nama' => $this->faker->randomElement($vehicleNames),
            'type' => $this->faker->randomElement(['Angkutan Orang', 'Angkutan Barang']),
            'nomor' => $this->faker->numerify('##########'),
            'bbm' => $this->faker->numberBetween(1000, 5000),
            'service' => $this->faker->dateTimeBetween('now', $endOfYear)->format('Y-m-d'),
        ];
    }
}
