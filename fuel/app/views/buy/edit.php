<h2>Editing <span class='muted'>Buy</span></h2>
<br>

<?php echo render('buy/_form'); ?>
<p>
	<?php echo Html::anchor('buy/view/'.$buy->id, 'View'); ?> |
	<?php echo Html::anchor('buy', 'Back'); ?></p>
