<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'institution_name' => 'Testing',
                'jenis_ipta'       => 'IPTA',
                'name' => 'Hazimah',
                'ic_no' => '961213136488',
                'email' => 'hazimahpethie@gmail.com',
                'password' => Hash::make('hazimah123'),
                'position' => "Pegawai IT",
                'phone_no' => '082111111',
                'publish_status' => true,
                'email_verified_at' => now(),
            ],
        ]);
    }
}
