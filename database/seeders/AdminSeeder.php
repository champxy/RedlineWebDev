<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artisan::call('permission:create-role admins');
        Artisan::call('permission:create-role users');
        Storage::deleteDirectory('public/media');
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@estate.test',
            'password' => Hash::make('password'),
            'type' => 100,
        ]);
    }
}
