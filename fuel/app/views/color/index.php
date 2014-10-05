<h2>Listing <span class='muted'>Colors</span></h2>
<br>
<?php if ($colors): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Code</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($colors as $item): ?>		<tr>

			<td><?php echo $item->name; ?></td>
			<td><?php echo $item->code; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('color/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('color/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('color/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Colors.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('color/create', 'Add new Color', array('class' => 'btn btn-success')); ?>

</p>
