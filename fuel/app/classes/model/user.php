<?php
use Orm\Model;

class Model_User extends \Orm\Model_Soft
{
	protected static $_properties = array(
		'id',
		'username',
		'name',
		'password',
		'group',
		'email',
		'last_login',
		'login_hash',
		'profile_fields',
		'created_at',
		'updated_at',
		'deleted_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);
  protected static $_has_many = array(
    'buys' => array(
      'model_to' => 'Model_Buy',
      'key_from' => 'id',
      'key_to' => 'user_id',
      'cascade_save' => true,
      'cascade_delete' => false,
      // there are some more options for specific relation types
    ),

  );

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('username', 'Username', 'required|max_length[255]');
		$val->add_field('name', 'name', 'required|max_length[255]');
		//$val->add_field('group', 'Group', 'required|valid_string[numeric]');
		//$val->add_field('email', 'Email', 'required|valid_email|max_length[255]');
		//$val->add_field('last_login', 'Last Login', 'required|max_length[255]');
		//$val->add_field('login_hash', 'Login Hash', 'required|max_length[255]');
		//$val->add_field('profile_fields', 'Profile Fields', 'required|max_length[255]');

		return $val;
	}
  public function getTotalPrice(){
    $total = 0;
    foreach($this->buys as $buy){
      $total+=$buy->price;
    }
    return $total;
  }
  public static function cmp($a, $b) {
    $a_price = $a->getTotalPrice();
    $b_price = $b->getTotalPrice();
        if ($a_price == $b_price) {
                  return 0;
        }
         return ($a_price > $b_price) ? -1 : 1;
  }
  public function getMonthBuys(){
    return $query = Model_Buy::query()->where("user_id",$this->id)->order_by("date","desc")->get();
  }
}
