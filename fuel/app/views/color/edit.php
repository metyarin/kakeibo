<h2>Editing <span class='muted'>Color</span></h2>
<br>

<?php echo render('color/_form'); ?>
<p>
	<?php echo Html::anchor('color/view/'.$color->id, 'View'); ?> |
	<?php echo Html::anchor('color', 'Back'); ?></p>
