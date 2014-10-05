<?php
class Controller_Color extends Controller_Template
{

	public function action_index()
	{
		$data['colors'] = Model_Color::find('all');
		$this->template->title = "Colors";
		$this->template->content = View::forge('color/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('color');

		if ( ! $data['color'] = Model_Color::find($id))
		{
			Session::set_flash('error', 'Could not find color #'.$id);
			Response::redirect('color');
		}

		$this->template->title = "Color";
		$this->template->content = View::forge('color/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Color::validate('create');

			if ($val->run())
			{
				$color = Model_Color::forge(array(
					'name' => Input::post('name'),
					'code' => Input::post('code'),
				));

				if ($color and $color->save())
				{
					Session::set_flash('success', 'Added color #'.$color->id.'.');

					Response::redirect('color');
				}

				else
				{
					Session::set_flash('error', 'Could not save color.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Colors";
		$this->template->content = View::forge('color/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('color');

		if ( ! $color = Model_Color::find($id))
		{
			Session::set_flash('error', 'Could not find color #'.$id);
			Response::redirect('color');
		}

		$val = Model_Color::validate('edit');

		if ($val->run())
		{
			$color->name = Input::post('name');
			$color->code = Input::post('code');

			if ($color->save())
			{
				Session::set_flash('success', 'Updated color #' . $id);

				Response::redirect('color');
			}

			else
			{
				Session::set_flash('error', 'Could not update color #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$color->name = $val->validated('name');
				$color->code = $val->validated('code');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('color', $color, false);
		}

		$this->template->title = "Colors";
		$this->template->content = View::forge('color/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('color');

		if ($color = Model_Color::find($id))
		{
			$color->delete();

			Session::set_flash('success', 'Deleted color #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete color #'.$id);
		}

		Response::redirect('color');

	}

}
