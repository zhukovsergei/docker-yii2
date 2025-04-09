<?php
/* @var $this yii\web\View */
$this->title = 'Gallery';
use yii\helpers\Url;
?>
<div id="content-container">

  <?php echo backend\widgets\Alert::widget()?>

  <div id="page-title">
    <h1 class="page-header text-overflow"><?=$this->title?></h1>
  </div>

  <div id="page-content">
    <div class="panel">
      <div class="panel-heading">
        <div class="panel-control">
          <!--          <a href="/--><?//=$this->id?><!--/add" class="btn btn-primary btn-labeled fa fa-plus">Add a new entry</a>-->
        </div>
        <h3 class="panel-title">All images</h3>
      </div>

      <div class="panel-body" id="image-box">
        <?foreach($images as $image):?>
          <img width="250" data-id="<?=$image->id?>" src="<?=Yii::getAlias('@upl/').$image->name?>" alt="">
        <?endforeach;?>
      </div>
    </div>

    <div class="panel">
      <div class="panel-body">
        <script>
          Dropzone.autoDiscover = false;

          $(document).ready(function(){
            function updateImageBox()
            {
              $.ajax({
                type: 'POST',
                url : '<?=Url::to(['get-img-list'])?>',
                dataType: 'html',
                success: function(res){
                  $('#image-box').html(res)
                }
              });
            }


            $('div#dropZone').dropzone({
              // dictDefaultMessage: "Для загрузки перетащите файлы сюда или кликните",
              // dictCancelUploadConfirmation: "Остановить загрузку этого файла?",
              // dictCancelUpload: "Отменить",
              // dictRemoveFile: "Удалить",
              url: "<?=Url::to(['upload'])?>",

              init: function() {
                this.on('success', function(file, json) {
                  if(json.success)
                  {
                    $.niftyNoty({
                      type: 'success',
                      title: 'System message',
                      icon: 'fa fa-info fa-lg',
                      message: 'The file '+ file.name + ' is uploaded',
                      container: 'floating',
                      timer: 5500
                    });
                  }
                });

                this.on('queuecomplete', function() {
                  updateImageBox();
                });

                /*this.on('sending', function(file, xhr, formData) {
                  formData.append("project_id", 15);
                });*/
              }
            });
          })
        </script>
        <div id="dropZone" class="dropzone"></div>
      </div>
    </div>
  </div>

</div>
