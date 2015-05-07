<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'name'     => 'Sai Sai',
			'username' => 'sai',
			'email'    => 'youremail@gmail.com',
			'password' => Hash::make('test'),
		));
	}

}