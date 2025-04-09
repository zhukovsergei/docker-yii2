<?php
use JBZoo\Utils\Str;
use yii\helpers\Url;

backend\assets\Imperavi::register($this);
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
            /*formattingAdd:[
                {
                    tag:'p',
                    title:'RedBlock',
                    class:'red',
                    clear:true
                }],*/
            minHeight: <?=$height;?>,
            uploadImageFields: {
                'mode': 1
            },
            uploadFileFields: {
                'mode': 0
            },
            buttons: ['html', 'formatting', 'bold', 'italic', 'deleted', 'underline', 'unorderedlist', 'orderedlist', 'outdent', 'indent',
                'image', 'file', 'link', 'alignment', 'horizontalrule'],
            plugins: ['table', 'video', 'fontsize', 'fontfamily', 'fontcolor', 'fullscreen', 'erase'],

            imageUpload:'<?=Url::to(['WysiwygUpload'])?>',
            fileUpload:'<?=Url::to(['WysiwygUpload'])?>',

            imageUploadCallback: function(image, json) {
                image.addClass('image-in-post');
            },
            fileUploadCallback: function(link, json) {
                link.addClass('file-in-post');
            },
            insertedLinkCallback: function(link) {
                link.addClass('link-in-post');
            }
        });
    });
</script>
