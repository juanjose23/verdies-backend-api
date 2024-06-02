<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $usuarios = [
            [
                'name' => 'Maria  Vela',
                'email' => 'maria.gomez88i@std.uni.edu.ni',
                'password' => Hash::make('12345678'),
                'provider' => null,
                'provider_id' => null,
                'email_verified_at' => Carbon::now(),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Luis  Bravo',
                'email' => 'luis.maritinez94i@std.uni.edu.ni',
                'password' => Hash::make('12345678'),
                'provider' => null,
                'provider_id' => null,
                'email_verified_at' => Carbon::now(),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Arturo Mejia',
                'email' => 'armejia02@gmail.com',
                'password' => Hash::make('12345678'),
                'provider' => null,
                'provider_id' => null,
                'email_verified_at' => Carbon::now(),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Abel Cruz',
                'email' => 'abelc7601@gmail.com',
                'password' => Hash::make('12345678'),
                'provider' => null,
                'provider_id' => null,
                'email_verified_at' => Carbon::now(),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Juan Huete',
                'email' => 'juanhuete13@gmail.com',
                'password' => Hash::make('12345678'),
                'provider' => null,
                'provider_id' => null,
                'email_verified_at' => Carbon::now(),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        foreach ($usuarios as $usuario) {
            User::create($usuario);
          
        }
    }
}
