<?php

namespace Fuel\Migrations;

class Create_buys
{
	public function up()
	{
		\DBUtil::create_table('buys', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true, 'null' => true),
			'date' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'content' => array('constraint' => 255, 'type' => 'varchar'),
			'price' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('buys');
	}
}