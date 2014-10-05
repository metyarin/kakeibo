<?php
class Controller_Buy extends Controller_Template
{

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

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Buy::validate('create');

			if ($val->run())
			{
				$buy = Model_Buy::forge(array(
					'user_id' => Input::post('user_id'),
					'date' => Input::post('date'),
					'content' => Input::post('content'),
					'price' => Input::post('price'),
				));

				if ($buy and $buy->save())
				{
					Session::set_flash('success', 'Added buy #'.$buy->id.'.');

					Response::redirect('buy');
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
			$buy->user_id = Input::post('user_id');
			$buy->date = Input::post('date');
			$buy->content = Input::post('content');
			$buy->price = Input::post('price');

			if ($buy->save())
			{
				Session::set_flash('success', 'Updated buy #' . $id);

				Response::redirect('buy');
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

}
