<h2>節約バトル！！！</h2>
<?php if ($users): ?>
<div style="width:<?php echo count($users)*240; ?>px;">
<?php foreach ($users as $item): ?>
<div style="width:230px;float:left;padding:0 5px;">
<table style="width:220px;border:1px solid #ddd;">
<tbody>
<tr style="border:1px solid #ddd;">
		<tr>
			<th colspan="3" style="text-align:center; background-color:#ddd;padding-top:5px;"><?php echo $item->name; ?></th>
		</tr>
		<tr>
      <th style="text-align:right; background-color:#ddd;"><?php echo Html::anchor('buy/create/'.$item->id, '追加', array('class' => 'btn btn-xs btn-success')); ?></th>
			<th colspan="2" style="text-align:right; background-color:#ddd;"><span style="color:red;"><?php echo $item->getTotalPrice(); ?>円</span></th>
		</tr>
    <?php foreach ($item->getMonthBuys() as $buy): ?>		<tr>
      <tr>
        <td style="width:40px;border:1px solid #ddd;text-align:center;"><small><?php echo date("d日",$buy->date); ?></small></td>
        <td style="border:1px solid #ddd;overflow: hidden;"><small><?php echo $buy->content; ?></small></td>
        <td style="width:40px;border:1px solid #ddd;text-align:right;"><small><?php echo $buy->price; ?></small></td>
      </tr>
    <?php endforeach; ?>
</tbody>
</table>
</div>
<?php endforeach; ?>
</div>

<?php else: ?>
<p>No Buys.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('buy/create', 'Add new Buy', array('class' => 'btn btn-success')); ?>
	<?php echo Html::anchor('buy/fromgoogle', '一括登録', array('class' => 'btn btn-success')); ?>
</p>
