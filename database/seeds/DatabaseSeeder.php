<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        DB::table('users')->delete();

        $users = array(
                ['first_name' => 'Thabungba','last_name'=>'Meetei', 'email' => 'thabungm@gmail.com', 'password' => Hash::make('test')],
                ['first_name' => 'Naba','last_name'=>'Tamuli', 'email' => 'test@serveaseme', 'password' => Hash::make('test')]
        );
            
        // Loop through each user above and create the record for them in the database
        foreach ($users as $user)
        {
            User::create($user);
        }

        Model::reguard();
    }
}