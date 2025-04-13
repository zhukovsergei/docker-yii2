<?php

use Ramsey\Uuid\Uuid;

$widgetId = Uuid::uuid4()->toString();

?>

<?if($showLoadButton):?>
    <div class="form-group">
        <label class="col-lg-<?=$lg[0]?> control-label"><?=$lf?></label>
        <div class="col-lg-<?=$lg[1]?>">
            <input name="<?=$nf?>" type="file" class="form-control" data-wid="<?=$widgetId?>">
            <?if($hint):?>
                <small class="help-block"><?=$hint?></small>
            <?endif;?>
        </div>
    </div>
<?endif;?>

<?if( file_exists($filePath) ):?>
    <div class="form-group">
        <label class="col-lg-<?=$lg[0]?> control-label"></label>
        <div class="col-lg-<?=$lg[1]?> link-container">
            <a target="_blank" href="<?=$fileUrl?>"><?=$val?></a>
        </div>
        <div class="col-lg-3 ">
            <a href="<?=$fileUrl?>" download class="btn btn-info btn-xs btn-labeled icon-lg fa fa-cloud-download" style="margin-right: 5px;">
                Download
            </a>

            <a data-url="<?=\yii\helpers\Url::to(['deleteFileThroughCleaner'])?>"
               data-message="Remove the <?=$val?> file?"
               data-class="<?=$classModelName?>" data-idforremove="<?=$modelId?>"
               data-fieldforremove="<?=$nf?>"
               class="deleteFile btn btn-default btn-xs btn-labeled icon-lg fa fa-trash">
                Remove
            </a>
        </div>

        <br>

    </div>
<?endif;?>
