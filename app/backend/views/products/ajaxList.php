<?foreach($rows as $row):?>
  <div class="image-item">
    <img data-id="<?=$row->id?>" src="<?=Yii::getAlias('@upl/').$row->thumb?>">
    <div class="del-image-item">[<a  data-id="<?=$row->id?>" href="#">Remove</a>]</div>
  </div>
<?endforeach;?>