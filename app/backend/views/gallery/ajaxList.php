<?foreach($rows as $row):?>
  <img width="250" data-id="<?=$row->id?>" src="<?=Yii::getAlias('@upl/').$row->name?>" alt="<?=$row->name?>">
<?endforeach;?>