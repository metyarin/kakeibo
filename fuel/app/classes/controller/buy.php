<?php
class Controller_Buy extends Controller_Template
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
	public function action_index()
	{
		$data['buys'] = Model_Buy::find('all');
		$this->template->title = "Buys";
		$this->template->content = View::forge('buy/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('buy');

		if ( ! $data['buy'] = Model_Buy::find($id))
		{
			Session::set_flash('error', 'Could not find buy #'.$id);
			Response::redirect('buy');
		}

		$this->template->title = "Buy";
		$this->template->content = View::forge('buy/view', $data);

	}

	public function action_create($user_id=null)
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Buy::validate('create');

			if ($val->run())
			{
				$buy = Model_Buy::forge(array(
					'user_id' => Input::post('user_id'),
					'date' => time(),
					'content' => Input::post('content'),
					'price' => Input::post('price'),
				));

				if ($buy and $buy->save())
				{
					Session::set_flash('success', 'Added buy #'.$buy->id.'.');

					Response::redirect('/');
				}

				else
				{
					Session::set_flash('error', 'Could not save buy.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

	  $this->template->set_global('user_id', $user_id, false);
		$this->template->title = "Buys";
		$this->template->content = View::forge('buy/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('buy');

		if ( ! $buy = Model_Buy::find($id))
		{
			Session::set_flash('error', 'Could not find buy #'.$id);
			Response::redirect('buy');
		}

		$val = Model_Buy::validate('edit');

		if ($val->run())
		{
			//$buy->user_id = Input::post('user_id');
			//$buy->date = Input::post('date');
			$buy->content = Input::post('content');
			$buy->price = Input::post('price');

			if ($buy->save())
			{
				Session::set_flash('success', 'Updated buy #' . $id);

				Response::redirect('/');
			}

			else
			{
				Session::set_flash('error', 'Could not update buy #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$buy->user_id = $val->validated('user_id');
				$buy->date = $val->validated('date');
				$buy->content = $val->validated('content');
				$buy->price = $val->validated('price');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('buy', $buy, false);
		}

		$this->template->title = "Buys";
		$this->template->content = View::forge('buy/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('buy');

		if ($buy = Model_Buy::find($id))
		{
			$buy->delete();

			Session::set_flash('success', 'Deleted buy #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete buy #'.$id);
		}

		Response::redirect('buy');

	}
	public function action_fromgoogle()
	{
		if (Input::method() == 'POST')
		{

			if ($user_id = Input::post("user_id"))
			{
        $user = Model_User::find($user_id);
        if($user){
          $content = Input::post("content");
          $each_line = preg_split("/\n/",$content);
          foreach($each_line as $buy_line){
            $each_content= preg_split("/[\s]+/",$buy_line);
            var_dump($each_content);
            if($each_content[0]){
              if(strpos($each_content[0],"2014")===FALSE){
                $each_content[0]= "2014年".$each_content[0];
              }
              $day = self::mb_strtotime($each_content[0]);
              //var_dump($each_content[0],$day);die;
            }
            $content = $each_content[1];
            $price= $each_content[2];
            var_dump($day,$content,$price);
            if($day&&$content){
              $Buy = new Model_Buy();
              $Buy->user_id= $user->id;
              $Buy->date = $day;
              $Buy->content= $content;
              $Buy->price= $price;
              $Buy->save();
            }
          }
          Response::redirect("buy/index");


        }
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$data['users'] = Arr::assoc_to_keyval(Model_User::find('all'),"id","name");
		$this->template->title = "Buys";
		$this->template->content = View::forge('buy/fromgoogle', $data);

	}
function mb_strtotime($sDate=null, $blnNow=true) {
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
