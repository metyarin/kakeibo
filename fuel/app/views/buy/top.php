<h2>節約バトル！！！</h2>
<h3 style="color:red;">悪意あるクローラー（googleとか言うゴミ）によってデータが消失しましたが、現人神（@dora_the_emon）によって助けられ復旧しました。一部消えてる部分は申し訳ありません</h3>
<p>  一番になったひとが、みんなから2万円貰える。エキシビションの人も１人1,000円位にしましょうか？嫌な人は日付の下にイヤって書いてください<br />
食費を除く生活に必須な出費（家賃、光熱費、保険等）は含まれない。クレジットカード支払いも記載,生活に必須ではない出費（Webサービスの月額費、有料チャンネル等）,ギャンブルで増やすのは可,　風俗を利用した場合は店舗と感想も付け加えましょう <br />
有価証券等は同月内に売買を行った場合にのみ記載しましょう<br />
  会社から支給される経費はノーカウント。ただし会社から通勤補助がある車通勤勢は（会社からの交通費支給額）−（実際にかかったガソリン代）で計算するようにしましょう <br />
  エキシビション参加の人はmetyarin@gmail.com宛に1000円のamazonギフトカードを送ってください。お願いします。期限は土日まで。現状12枚<br />
  https://www.amazon.co.jp/gp/product/B004N3APDM/gcrnsts?ie=UTF8&redirect=true&ref_=s9_ri_bw_g228_i2<br />
  </p>
<?php if ($users): ?>
<table>
<?php $rank=1; ?>
<?php foreach ($rank_users as $item): ?>
  <tr><td><?php echo $rank++; ?>位：</td><td><?php echo $item->name ?></td><td style="text-align:right"><?php echo $item->getTotalPrice();?>円</td>
<?php endforeach; ?>
</table>
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
      <th style="text-align:right; background-color:#ddd;"><?php echo Html::anchor('buy/index/'.$item->id, '編集', array('class' => 'btn btn-xs btn-success')); ?><?php echo Html::anchor('buy/create/'.$item->id, '追加', array('class' => 'btn btn-xs btn-success')); ?></th>
			<th colspan="2" style="text-align:right; background-color:#ddd;"><span style="color:red;"><?php echo $item->getTotalPrice(); ?>円</span></th>
		</tr>
    <?php foreach ($item->getMonthBuys() as $buy): ?>		<tr>
      <tr>
        <td style="width:40px;border:1px solid #ddd;text-align:center;"><small><?php echo date("d日",$buy->date); ?></small></td>
        <td style="border:1px solid #ddd;overflow: hidden;"><small style="<?php echo $buy->getColorCode()?>"><?php echo $buy->content; ?></small></td>
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
