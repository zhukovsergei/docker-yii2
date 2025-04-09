<?php
/* @var $this yii\web\View */
$this->title = 'Items';
use backend\widgets\fields\Checkbox;
use backend\widgets\fields\File;
use backend\widgets\fields\Select;
use backend\widgets\fields\Text;
use backend\widgets\fields\Textarea;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
?>

<div id="content-container">

    <?php echo backend\widgets\Alert::widget()?>

  <div id="page-title">
    <h1 class="page-header text-overflow"><?=$this->title?></h1>
  </div>

  <?=Breadcrumbs::widget([
    'homeLink' => [
      'label' => 'Main',
      'url' => Yii::$app->homeUrl,
    ],
    'links' => [
      ['label' => $this->title, 'url' => ['index']],
      'Editing the entry'
    ],
  ]);
  ?>

  <!--Page content-->
  <!--===================================================-->
  <div id="page-content">
    <div class="row">
      <form action="<?=Url::current()?>" method="post" enctype="multipart/form-data">
        <div class="col-lg-12">
          <div class="tab-base">

            <!--Nav Tabs-->
            <ul class="nav nav-tabs">
              <li class="active">
                <a data-toggle="tab" href="#demo-lft-tab-1" aria-expanded="true">General</a>
              </li>
              <li class="">
                <a data-toggle="tab" href="#demo-lft-tab-2" aria-expanded="false">Upload content</a>
              </li>
            </ul>

            <!--Tabs Content-->
            <div class="tab-content">
              <div id="demo-lft-tab-1" class="tab-pane fade active in">
                <div class="panel-body form-horizontal form-padding"> <!-- tab start here -->

                  <?= Text::widget([
                    'model' => $row,
                    'lf' => 'Name',
                    'nf' => 'fd[name]',
                  ])?>

                  <?= Select::widget([
                    'model' => $row,
                    'lf' => 'Category',
                    'nf' => 'fd[category_id]',
                    'source' => $categories,
                    'depth' => true,
                  ])?>

                  <?= Text::widget([
                    'model' => $row,
                    'lf' => 'Price',
                    'nf' => 'fd[price]',
                    'lg' => [2,2],
                  ])?>

                  <?= Text::widget([
                    'model' => $row,
                    'lf' => 'Quantity',
                    'nf' => 'fd[qt]',
                    'lg' => [2,1],
                  ])?>

                  <?= Textarea::widget([
                    'model' => $row,
                    'lf' => 'Short description',
                    'nf' => 'fd[short_text]',
                  ])?>

                  <?= Textarea::widget([
                    'model' => $row,
                    'lf' => 'Full description',
                    'nf' => 'fd[long_text]',
                  ])?>

                  <?= Checkbox::widget([
                    'model' => $row,
                    'lf' => 'Published on website',
                    'nf' => 'fd[approve]',
                  ])?>

                  <?= Checkbox::widget([
                    'model' => $row,
                    'lf' => 'New',
                    'nf' => 'fd[is_new]',
                  ])?>

                  <?= Checkbox::widget([
                    'model' => $row,
                    'lf' => 'Recommend',
                    'nf' => 'fd[is_rec]',
                  ])?>

                </div>
              </div>
              <div id="demo-lft-tab-2" class="tab-pane fade">
                <div class="panel-body form-horizontal form-padding"> <!-- tab start here -->

                  <?= File::widget([
                    'model' => $row,
                    'lf' => 'Image',
                    'nf' => 'image',
                  ])?>

                  <div class="form-group" id="image-box">
                    <?foreach($row->images as $image):?>
                      <div class="image-item">
                        <img data-id="<?=$image->id?>" src="<?=Yii::getAlias('@upl/').$image->thumb?>">
                        <div class="del-image-item">[<a  data-id="<?=$image->id?>" href="#">Remove</a>]</div>
                      </div>
                    <?endforeach;?>
                  </div>

                  <div class="form-group">
                      <script>
                          Dropzone.autoDiscover = false;

                          $(document).ready(function(){
                              function updateImageBox()
                              {
                                  $.ajax({
                                      type: 'POST',
                                      url : '<?=Url::to(['get-img-list', 'id' => $row->id])?>',
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

                                      this.on('sending', function(file, xhr, formData) {
                                          formData.append("product_id", <?=$row->id?>);
                                      });
                                  }
                              });

                              $('body').on('click', '#image-box a', function(e){
                                  e.preventDefault();
                                  $(this).parents('.image-item').fadeOut(350);
                                  var id = $(this).data('id');
                                  $.ajax({
                                      type: 'POST',
                                      url : '<?=Url::to(['del-img'])?>',
                                      data: {id: id},
                                      dataType: 'json',
                                      success: function(res){
                                          $.niftyNoty({
                                              type: 'warning',
                                              title: 'System message',
                                              icon: 'fa fa-info fa-lg',
                                              message: 'Removed',
                                              container: 'floating',
                                              timer: 5500
                                          });
                                      }
                                  });
                              });
                          })
                      </script>

                    <div id="dropZone" class="dropzone"></div>
                  </div>

                </div>
              </div>
            </div>
            <div class="panel-footer">
              <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                  <button class="btn btn-primary btn-labeled fa fa-check" type="submit"><?if(\Yii::$app->controller->action->id === 'add'):?>Create<?else:?>Save<?endif;?></button>
                  <a href="<?=Url::to(['index'])?>" class="btn btn-warning btn-labeled fa fa-repeat" >Cancel</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

  </div>


  <!--===================================================-->
  <!--End page content-->
</div>
