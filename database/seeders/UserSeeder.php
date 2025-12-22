<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin (Si Paling Berkuasa)
        User::create([
            'name'     => 'Salsa (Admin)',
            'email'    => 'admin@spm.id',
            'password' => Hash::make('admin'),
            'role'     => 'admin',
        ]);

        // Staff
        User::create([
            'name'     => 'Rajip (Staff)',
            'email'    => 'staff@spm.id',
            'password' => Hash::make('staff'),
            'role'     => 'staff',
        ]);

        // Warga
        User::create([
            'name'     => 'Warga',
            'email'    => 'warga@spm.id',
            'password' => Hash::make('warga'),
            'role'     => 'warga',
        ]);
    }
}
