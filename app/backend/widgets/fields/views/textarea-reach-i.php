<?php
use JBZoo\Utils\Str;
use yii\helpers\Url;

backend\assets\Redactor::register($this);
?>
<div class="form-group">
    <label class="col-lg-<?=$lg[0]?> control-label" for="<?=Str::slug($nf);?>"><?=$lf?></label>
    <div class="col-lg-<?=$lg[1]?>">
        <textarea id="<?=Str::slug($nf);?>" name="<?=$nf?>" rows="6" class="form-control"><?if($val):?><?=$val?><?endif;?></textarea>
        <?if($hint):?>
            <small class="help-block"><?=$hint?></small>
        <?endif;?>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#<?=Str::slug($nf);?>').redactor({
            lang:'de',
            pastePlainText: true,
            multipleUpload: true,
            imageResizable: true,
            imagePosition: true,

            minHeight: '<?=$height;?>px',

            plugins: [
                'alignment',
                'imagemanager',
                'filemanager',
                'fontsize',
                'inlinestyle',
                'video',
                'widget',
                'table',
                'specialchars',
                'fontfamily',
                'fontcolor',
                'fullscreen',
                'counter'
            ],

            imageUpload:'<?=Url::to(['WysiwygUploadImproved'])?>',
            imageData: {
                params: JSON.stringify({
                    mode: 'image',
                    context: '<?=addslashes(get_class($this->context->model))?>',
                    id: '<?=$this->context->model->id?>',
                }),
                _csrf: '<?=\Yii::$app->request->getCsrfToken()?>',

            },
            fileUpload:'<?=Url::to(['WysiwygUploadImproved'])?>',
            fileData: {
                params: JSON.stringify({
                    mode: 'file',
                    context: '<?=addslashes(get_class($this->context->model))?>',
                    id: '<?=$this->context->model->id?>',
                }),
                _csrf: '<?=\Yii::$app->request->getCsrfToken()?>',

            },
        });
    });
</script>
