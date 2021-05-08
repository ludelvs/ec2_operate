<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        \DB::table('users')->insert([
            0 =>
                [
                    'name' => 'user01',
                    'password' => 'd7e8b8671e89a983fac7e203e844366c',
                    'email' => 'hoge@example.com',
                    'remember_token' => 'MoFGXnv8WbwjzU6cYFKrVCmiXAp7Q1pCNEDDgi7MTMAcwgG47IrwZtSf0jnG',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
        ]);
    }
}