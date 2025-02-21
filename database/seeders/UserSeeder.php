<?php

namespace Database\Seeders;

use App\Models\Backend\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $josn = File::get(path:'database/json/user.json');
        $user = collect(json_decode($josn));

        $user->each(function ($user) {
            User::create([
                'name'=> $user->name,
                'email'=> $user->email,
                'password'=> Hash::make($user->password),
                'image_url'=> $user->image_url,
                'image_id'=> $user->image_id,
                'contacts'=> $user->contacts,
                'role'=> $user->role,
                'status'=> $user->status,
            ]);
        });
    }
}