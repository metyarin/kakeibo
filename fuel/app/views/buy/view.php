<h2>Viewing <span class='muted'>#<?php echo $buy->id; ?></span></h2>

<p>
	<strong>User id:</strong>
	<?php echo $buy->user_id; ?></p>
<p>
	<strong>Date:</strong>
	<?php echo $buy->date; ?></p>
<p>
	<strong>Content:</strong>
	<?php echo $buy->content; ?></p>
<p>
	<strong>Price:</strong>
	<?php echo $buy->price; ?></p>

<?php echo Html::anchor('buy/edit/'.$buy->id, 'Edit'); ?> |
<?php echo Html::anchor('buy', 'Back'); ?>