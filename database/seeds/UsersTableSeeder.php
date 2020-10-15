<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Admin Test";
        $user->login = "admin";
        $user->password = bcrypt("admin");
        $user->privilegio = 1;
        $user->privilegio_admin = 1;
        $user->save();
    }
}
