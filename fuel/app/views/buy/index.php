<h2>節約バトル！！！<span class='muted'>Buys</span></h2>
<br>
<?php if ($buys): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>User id</th>
			<th>Date</th>
			<th>Content</th>
			<th>Price</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($buys as $item): ?>		<tr>

			<td><?php echo $item->user_id; ?></td>
			<td><?php echo date("m月d日",$item->date); ?></td>
			<td><?php echo $item->content; ?></td>
			<td><?php echo $item->price; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('buy/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('buy/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('buy/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Buys.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('buy/create', 'Add new Buy', array('class' => 'btn btn-success')); ?>
	<?php echo Html::anchor('buy/fromgoogle', '一括登録', array('class' => 'btn btn-success')); ?>
</p>
