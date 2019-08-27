<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(50)->make();
        User::query()->insert($users->makeVisible(['password', 'remember_token'])->toArray());

        $user = User::query()->find(1);
        $user->name = '王立鹏';
        $user->email = '4110398@qq.com';
        $user->save();
    }
}
