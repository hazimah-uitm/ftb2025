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
                'name' => 'Hazimah',
                'ic_no' => '961213136028',
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
