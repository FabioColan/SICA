<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\RoleUser;

class RoleUserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

        RoleUser::create(array(
            'role_id' => '3',
            'user_id' => '1'
        ));
        RoleUser::create(array(
            'role_id' => '1',
            'user_id' => '2'
        ));
	}

}
