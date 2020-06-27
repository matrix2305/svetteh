<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class InitSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role' => 'administrator',
            'color' => '#fff'
        ]);

        DB::table('users')->insert(
            [
                'role_id' => 1,
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'created_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
                [
                    'permission' => 'users.create',
                    'name' => 'Dodavanje korisnika'
                ],
                [
                    'permission' => 'users.edit',
                    'name' => 'Izmena korisnika'
                ],
                [
                    'permission' => 'users.delete',
                    'name' => 'Brisanje korisnika'
                ],
                [
                    'permission' => 'posts.create',
                    'name' => 'Dodavanje objava'
                ],
                [
                    'permission' => 'posts.edit',
                    'name' => 'Izmena objava'
                ],
                [
                    'permission' => 'posts.delete',
                    'name' => 'Brisanje objava'
                ],
                [
                    'permission' => 'roles.create',
                    'name' => 'Dodavanje učešća'
                ],
                [
                    'permission' => 'roles.edit',
                    'name' => 'Izmena ućešća'
                ],
                [
                    'permission' => 'roles.delete',
                    'name' => 'Brisanje brisanje'
                ],
                [
                    'permission' => 'category.create',
                    'name' => 'Dodavanje kategorije'
                ],
                [
                    'permission' => 'category.edit',
                    'name' => 'Izmena kategorije'
                ],
                [
                    'permission' => 'category.delete',
                    'name' => 'Brisanje kategorije'
                ],
            ]
        );
    }
}
