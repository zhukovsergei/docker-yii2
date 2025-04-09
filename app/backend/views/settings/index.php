<?php
/* @var $this yii\web\View */
$this->title = 'Settings';
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
        <!--<div class="panel-control">
            <a href="/<?/*=$this->id*/?>/add" class="btn btn-primary btn-labeled fa fa-plus">Add a new entry</a>
          </div>-->
        <h3 class="panel-title">All rows</h3>
      </div>

      <div class="panel-body">
        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
          <tr>
            <th> Name</th>
            <th> Valuew</th>
            <th class="col-lg-3 text-right min-width">Actions &nbsp;</th>
          </tr>
          </thead>
          <tbody>

          <?foreach($rows as $row):?>
            <tr>
              <td><?=$row->name?></td>
              <td><?if($row->type == 'boolean'):?>
                  <div class="checkbox">
                    <label class="form-checkbox form-normal form-warning">
                      <input disabled name="fd[boolean]" <?if($row->value):?> checked <?endif;?> type="checkbox" class="form-control"> </label>
                  </div>
                <?else:?>
                  <?=$row->value?>
                <?endif;?></td>

              <td class="text-right col-lg-1">
                <button data-target="#modal_<?=$row->id?>" data-toggle="modal" class="btn btn-default add-tooltip" data-original-title='Edit "<?=$row->key?>"'>
                  <i class="fa fa-pencil"></i> &nbsp; Edit</button>
              </td>
            </tr>
          <?endforeach;?>

          </tbody>
        </table>
      </div>
    </div>

    <div class="panel">
      <div class="panel-heading">
        <div class="panel-control">

        </div>

        <h3 class="panel-title">Upload file</h3>
      </div>

      <form class="form-horizontal" action="<?=Url::to(['load-static-file'])?>" method="POST" enctype="multipart/form-data">
        <div class="panel-body">

          <div class="form-group">

            <label class="col-lg-1 control-label"></label>
            <div class="col-lg-4">
              <!--<span class="pull-left btn btn-default btn-file">
											Browse... <input name="file" type="file">-->
              <input name="file" type="file" class="form-control">
            </div>
          </div>

          <?if($file):?>
            <div class="form-group">
              <label class="col-lg-1 control-label">Download</label>
              <div class="col-lg-4">
                <a class="btn btn-default btn-active-success" href="<?=Yii::getAlias('@upl/'.$file->name)?>"><?=$file->name?></a>
              </div>
            </div>
          <?endif;?>


        </div>
        <div class="panel-footer">
          <div class="row">
            <div class="col-lg-3 col-lg-offset-1">
              <div id="progress-bar" style="display: none" class="progress progress-md">
                <div style="width: 70%;" class="progress-bar progress-bar-primary progress-bar-striped active"></div>
                <!--            <a href="/--><?///*=$this->id*/?><!--/add" class="btn btn-primary btn-labeled fa fa-plus">Add a new entry</a>-->
              </div>

              <button id="do-upload" class="btn btn-primary btn-labeled fa fa-upload" type="submit">Upload</button>
            </div>

          </div>
        </div>
      </form>
    </div>
    <script>
      $(function(){
        $('#do-upload').on('click', function(){
          $('#do-upload').hide();
          $('#progress-bar').show();
        });
      })
    </script>
  </div>

</div>

<?foreach($rows as $row):?>
  <!--Default Bootstrap Modal-->
  <!--===================================================-->
  <div class="modal fade" id="modal_<?=$row->id?>" role="dialog" tabindex="-1" aria-labelledby="modal_<?=$row->id?>" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" action="<?=Url::to(['edit'])?>" class="form-horizontal">
          <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading">
              <h3 class="panel-title">The setting "<?=$row->section?>.<?=$row->key?>"</h3>
            </div>
            <!--Panel body-->
            <div class="panel-body">
              <div class="form-group">
                <label class="col-lg-4 control-label">Value</label>
                <div class="col-lg-6">
                  <?if($row->type == 'boolean'):?>
                    <div class="checkbox">
                      <label class="form-checkbox form-normal form-primary">
                        <input name="fd[boolean]" <?if($row->value):?> checked <?endif;?> value="1" type="checkbox" class="form-control"> On</label>
                    </div>
                  <?else:?>
                    <input name="fd[value]" value="<?=\yii\helpers\Html::encode($row->value)?>" type="text" class="form-control">
                  <?endif;?>
                </div>
                <div class="clear"></div>
              </div>
            </div>
          </div>

          <!--Modal footer-->
          <div class="modal-footer">
            <input name="fd[type]" value="<?=$row->type?>" type="hidden">
            <input name="fd[sectionKey]" value="<?=$row->section?>.<?=$row->key?>" type="hidden">
            <button class="btn btn-primary" type="submit">Save</button>
            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <!--===================================================-->
  <!--End Default Bootstrap Modal-->
<?endforeach;?>