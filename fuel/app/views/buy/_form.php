<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
				<?php echo Form::hidden('user_id', Input::post('user_id', isset($buy) ? $buy->user_id : $user_id), array('class' => 'col-md-4 form-control', 'placeholder'=>'User id')); ?>
		<div class="form-group">
			<?php echo Form::label('内容', 'content', array('class'=>'control-label')); ?>

				<?php echo Form::input('content', Input::post('content', isset($buy) ? $buy->content : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'項目名を入力してください')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('価格', 'price', array('class'=>'control-label')); ?>

				<?php echo Form::input('price', Input::post('price', isset($buy) ? $buy->price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'ここは価格')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', '登録', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>
