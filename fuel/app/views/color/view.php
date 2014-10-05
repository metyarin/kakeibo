<h2>Viewing <span class='muted'>#<?php echo $color->id; ?></span></h2>

<p>
	<strong>Name:</strong>
	<?php echo $color->name; ?></p>
<p>
	<strong>Code:</strong>
	<?php echo $color->code; ?></p>

<?php echo Html::anchor('color/edit/'.$color->id, 'Edit'); ?> |
<?php echo Html::anchor('color', 'Back'); ?>