<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Group;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $group = new Group;
        $group->name = "warriors";
        $group->save();

        $user = new User;
        $user->name = "Super";
        $user->lastname = "User";
        $user->email = "camilo.perez.ort@gmail.com";
        $user->password = bcrypt("W@rri0rs15");
        $user->role = "SUPER";
        $user->group_id = 1;
        $user->save();
    }
}
