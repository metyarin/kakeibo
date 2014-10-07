<?php
use Orm\Model;

class Model_Buy extends \Orm\Model_Soft
{
	protected static $_properties = array(
		'id',
		'user_id',
		'date',
		'content',
		'price',
		'created_at',
		'updated_at',
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

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');
		//$val->add_field('date', 'Date', 'required|valid_string[numeric]');
		$val->add_field('content', 'Content', 'required|max_length[255]');
		$val->add_field('price', 'Price', 'required|valid_string[numeric,dashes]');

		return $val;
	}
  public function getColorCode(){
    $color = Model_Color::query()->where("name","LIKE","%".$this->content."%")->get_one();
    if($color){
      return  "color:".$color->code;
    }
    return "";
  }

  public static function mb_strtotime($sDate=null, $blnNow=true) {
 // 日本語版の対応
 if(preg_match('/^([0-9]{4})[年]{1}([0-9]{1,2})[月]{1}([0-9]{1,2})[日]{1}[\s　]([0-9]{1,2})[時]{1}([0-9]{1,2})[分]{1}([0-9]{1,2})[秒]{1}[\s　]*$/u', $sDate, $match)){  // YYYY年MM月DD日HH時MI分SS秒
  $sTimestamp = mktime($match[4], $match[5], $match[6], $match[2], $match[3], $match[1]);
 }elseif(preg_match('/^([0-9]{4})[年]([0-9]{1,2})[月]([0-9]{1,2})[日][\s　]([0-9]{1,2})[時]([0-9]{1,2})[分][\s　]*$/u', $sDate, $match)){ // YYYY年MM月DD日HH時MI分
  $sTimestamp = mktime($match[4], $match[5], 0, $match[2], $match[3], $match[1]);
 }elseif(preg_match('/^([0-9]{4})[年]([0-9]{1,2})[月]([0-9]{1,2})[日][\s　]*$/u', $sDate, $match)){ // YYYY年MM月DD日
  $sTimestamp = mktime(0, 0, 0, $match[2], $match[3], $match[1]);

 // 通常
 }else {
  $sTimestamp = strtotime($sDate, $blnNow);
 }// end if
 return $sTimestamp;
}// end function

}
