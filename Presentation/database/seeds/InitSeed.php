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

        DB::table('permissions_role')->insert(
            [
                [
                    'role_id' => 1,
                    'permissions_id' => 1,
                ],
                [
                    'role_id' => 1,
                    'permissions_id' => 2,
                ],
                [
                    'role_id' => 1,
                    'permissions_id' => 3,
                ],
                [
                    'role_id' => 1,
                    'permissions_id' => 4,
                ],
                [
                    'role_id' => 1,
                    'permissions_id' => 5,
                ],
                [
                    'role_id' => 1,
                    'permissions_id' => 6,
                ],
                [
                    'role_id' => 1,
                    'permissions_id' => 7,
                ],
                [
                    'role_id' => 1,
                    'permissions_id' => 8,
                ],
                [
                    'role_id' => 1,
                    'permissions_id' => 9,
                ],
                [
                    'role_id' => 1,
                    'permissions_id' => 10,
                ],
                [
                    'role_id' => 1,
                    'permissions_id' => 11,
                ],
                [
                    'role_id' => 1,
                    'permissions_id' => 12,
                ],
            ]
        );

        DB::table('content')->insert(
            [
                'name' => 'test',
                'text' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum',
                'email' => 'admin@gmail.com',
            ]
        );
    }
}
