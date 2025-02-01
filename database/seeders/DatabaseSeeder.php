<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::factory(10)->create();
        User::factory()->createMany([
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password'=>'1234',
                'image_url'=>'defaultimg.png',
                'image_id'=>'defaultimageid'
            ],
            [
                'name' => 'Example User',
                'email' => 'example@example.com',
                'password'=>'12345',
                'image_url'=>'defaultimg1.png',
                'image_id'=>'defaultimageid1'
            ],
            [
                'name' => 'Simple User',
                'email' => 'simple@example.com',
                'password'=>'123456',
                'image_url'=>'defaultimg2.png',
                'image_id'=>'defaultimageid2'
            ]

        ]);
        
        $this->call([
            NewsSeeder::class
        ]);
    }
}
