<?php

namespace Fuel\Migrations;

class Add_name_to_users_2
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'name' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'name'

		));
	}
}
