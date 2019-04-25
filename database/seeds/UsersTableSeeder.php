
<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder{
    public function run(){
        DB::table('users')->delete();

        $user = array(
          array(
              'name'=>'Manh',
              'password'=>Hash::make('123123'),
              'email'=>'aem@gmail.com',
          )
        );
        DB::table('users')->insert($user);
    }
}