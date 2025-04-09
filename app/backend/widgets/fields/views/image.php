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

<div class="form-group">
    <label class="col-lg-<?=$lg[0]?> control-label"></label>
    <div class="col-lg-<?=$lg[1]?> link-container">
        <?if(file_exists($imagePath)):?>
            <a target="_blank" href="<?=$fileUrl?>"><img alt="<?=$val?>" src="<?=$thumbUrl?>"></a>
        <?endif;?>
    </div>

    <div class="col-lg-3">
        <a class="edit-image-btn edit-image-btn-<?=$widgetId?> btn btn-danger btn-labeled icon-lg fa fa-edit"
           data-wid="<?=$widgetId?>"
           data-fileurl="<?=$fileUrl?>"
           data-filename="<?=$val?>"
           data-fieldname="<?=$nf?>"
           data-toggle="modal" data-target="#tui-modal-window-<?=$widgetId?>"
           <?if(!file_exists($imagePath)):?>style="display: none"<?endif;?>>
            Edit an image
        </a>

        <?if(file_exists($imagePath)):?>
            <a data-url="<?=\yii\helpers\Url::to(['deleteFileThroughCleaner'])?>" data-message="Remove the <?=$val?> image?" data-class="<?=$classModelName?>" data-idforremove="<?=$modelId?>" data-fieldforremove="<?=$nf?>" class="deleteImage btn btn-default btn-labeled icon-lg fa fa-trash" >
                Remove
            </a>
        <?endif;?>

    </div>
    <br>

</div>

<style>
    .modal-dialog {
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        top: 0;
    }

   .modal-body {
       height: 100vh;
   }

   .tui-container {
       height: 100%;
   }

    .modal-content {
        height: 100%;
        border-radius: 0;
    }
</style>

<!-- Modal -->
<div class="modal" id="tui-modal-window-<?=$widgetId?>" role="dialog" tabindex="-1" aria-labelledby="tui-modal-window-<?=$widgetId?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!--Modal header-->
            <!--<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title">Modal Heading</h4>
            </div>-->

            <!--Modal body-->
            <div class="modal-body">

                <div class="tui-container tui-container-<?=$widgetId?>">
                    <div class="tui-image-editor-container" id="tui-image-editor-container-<?=$widgetId?>">
                    </div>
                    <br>
                </div>

            </div>

        </div>
    </div>
</div>

<script>

    // Image editor
    $(document).ready(function () {

        var imageEditor = initTuiEditor('<?=$widgetId?>', '<?=$fileUrl?>', '<?=$val?>');

        window.onresize = function() {
            imageEditor.ui.resizeEditor();
        };

        normalizeTuiButtons();

        function normalizeTuiButtons() {

            /**
             * Add "Close" button
             */
            $('#tui-modal-window-<?=$widgetId?> .tui-image-editor-header-buttons')
                .prepend('<button class="btn btn-default" data-dismiss="modal">Close</button>');

            /**
             * Replace "Download" button on "Save changes" button
             */
            $('#tui-modal-window-<?=$widgetId?> .tui-image-editor-header-buttons .tui-image-editor-download-btn')
                .replaceWith('<button class="save-tui-editor-<?=$widgetId?> btn btn-primary btn-labeled" data-dismiss="modal">Save changes</button>');

            /**
             * Remove the second hided "Download" button
             */
            $('#tui-modal-window-<?=$widgetId?> .tui-image-editor-controls-buttons .tui-image-editor-download-btn')
                .remove();

            /**
             * Remove "Load" button
             */
            $('#tui-modal-window-<?=$widgetId?> .tui-image-editor-header-buttons .tui-image-editor-load-btn').parent().remove();
        }

        /**
         * Open editor
         */
        $('.edit-image-btn-<?=$widgetId?>').on('click', function (e) {
            e.preventDefault();

            var file = document.querySelector('input[name=<?=$nf?>]').files[0];

            if(file) {
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {

                    imageEditor.loadImageFromURL(reader.result, file.name).then(result=>{
                        imageEditor.ui.activeMenuEvent();
                        imageEditor.ui.resizeEditor({
                            imageSize: {oldWidth: result.oldWidth, oldHeight: result.oldHeight, newWidth: result.newWidth, newHeight: result.newHeight},
                        });
                    }).catch(err=>{
                        console.error("Something went wrong:", err);
                    });

                    // imageEditor.loadImageFromURL(reader.result, file.name);
                };
            } else {

                imageEditor.loadImageFromURL('<?=$fileUrl?>', '<?=$val?>').then(result=>{
                    imageEditor.ui.activeMenuEvent();
                    imageEditor.ui.resizeEditor({
                        imageSize: {oldWidth: result.oldWidth, oldHeight: result.oldHeight, newWidth: result.newWidth, newHeight: result.newHeight},
                    });
                }).catch(err=>{
                    console.error("Something went wrong:", err);
                });
            }

        });

        /**
         * Save result
         */

        const fileInput = document.querySelector('input[name=<?=$nf?>]');

        // if we have existsing filname. Just rename it
        let existFilename = <?php if($val):?> '<?=Uuid::uuid4()->toString(). '.'. pathinfo($val)['extension']?>' <?php else:?>''<?php endif;?>;

        $('body').on('click', '.save-tui-editor-<?=$widgetId?>', function (e) {
            e.preventDefault();
            let editedBase64 = imageEditor.toDataURL();

            if(!existFilename) {
                existFilename = imageEditor.getImageName();
            }

            let file = dataURLtoFile(editedBase64, existFilename);

            let list = new DataTransfer();

            list.items.add(file);
            fileInput.files = list.files;
        });

        /**
         * When load new image, show the button editor
         */
        $('input[name=<?=$nf?>]').on('change', function(){
            const file = document.querySelector('input[name=<?=$nf?>]').files[0];
            const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];

            if(file && validImageTypes.includes(file['type'])) {
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {

                    imageEditor.ui.activeMenuEvent();
                    imageEditor.loadImageFromURL(reader.result, file.name).then(result=>{
                        imageEditor.ui.activeMenuEvent();
                        imageEditor.ui.resizeEditor({
                            imageSize: {oldWidth: result.oldWidth, oldHeight: result.oldHeight, newWidth: result.newWidth, newHeight: result.newHeight},
                        });
                    }).catch(err=>{
                        console.error("Something went wrong:", err);
                    });

                };

                $('.edit-image-btn-<?=$widgetId?>').show();
            } else {
                $('.edit-image-btn-<?=$widgetId?>').hide();
            }

        });

    });


</script>

