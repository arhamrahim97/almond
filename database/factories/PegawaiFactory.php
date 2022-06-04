<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_lengkap' => $this->faker->name,
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->dateTimeBetween('-30 years', '-18 years'),
            'nomor_hp' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'alamat' => $this->faker->address,
            'nip' => $this->faker->numerify('################'),
            'jabatan_struktural_id' => $this->faker->randomElement(['b8f8f8f8-f8f8-f8f8-f8f8-f8f8f8f8f8f8', 'c8f8f8f8-f8f8-f8f8-f8f8-f8f8f8f8f8f8', 'k8f8f8f8-f8f8-f8f8-f8f8-f8f8f8f8f8f8']),
            'unit_kerja' => $this->faker->company,
            'foto_profil' => $this->faker->randomElement([$this->faker->imageUrl(), null]),
            'created_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-3 days', 'now'),
        ];
    }
}
