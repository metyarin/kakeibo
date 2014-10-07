<?php
class Controller_Top extends Controller_Template
{
  public $template = "top";
	public function action_top()
	{
		$data['buys'] = Model_Buy::find('all');
		$data['users'] = Model_User::find('all');
    
    uasort($data['users'], array("Model_User",'cmp'));

    $rank_users = $data['users'];
    foreach($rank_users as $key=>$rank_user){
      if($rank_user->getTotalPrice()==0){
        unset($rank_users[$key]);
      }
    }
		$data['rank_users'] = array_slice(array_reverse($rank_users),0,5);
		$this->template->title = "Buys";
		$this->template->content = View::forge('buy/top', $data);

	}

}
