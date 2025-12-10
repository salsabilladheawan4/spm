<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warga;
use Faker\Factory as Faker;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gunakan locale Indonesia agar nama & no hp sesuai
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 50; $i++) {

            // Tentukan gender random untuk mencocokkan nama
            $gender = $faker->randomElement(['male', 'female']);
            $jenis_kelamin = ($gender == 'male') ? 'Laki-laki' : 'Perempuan';

            Warga::create([
                // Generate 16 digit angka random unik untuk KTP
                'no_ktp'        => $faker->unique()->numerify('################'),
                'nama'          => $faker->name($gender),
                'jenis_kelamin' => $jenis_kelamin,
                'agama'         => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu']),
                'pekerjaan'     => $faker->jobTitle,
                'telp'          => $faker->numerify('08##########'),
                'email'         => $faker->unique()->safeEmail,
            ]);
        }
    }
}
