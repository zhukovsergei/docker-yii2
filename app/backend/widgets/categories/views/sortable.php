<div id="page-content">
  <div class="row">

    <?if( ! empty($itemsSortableWidget) ):?>
      <div class="col-lg-12">
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title">Categories</h3>
          </div>

          <div class="panel-body">
            <?=yii\jui\Sortable::widget([
              'items' => $itemsSortableWidget,
              'clientOptions' => [
                'placeholder' => 'ui-state-highlight',
                'cursor' => 'move',
              ],
              'itemOptions' => ['class' => 'ui-state-default'],
              'clientEvents' => [
                'update' => new \yii\web\JsExpression( "function( event, ui ) {
                            var active_id = $(ui.item).data('id');
                            var prev_id = $(ui.item).prev().data('id');
                            var next_id = $(ui.item).next().data('id');
                      
                            $.ajax({
                              type: 'POST',
                              url : '/categories/drag-and-drop',
                              //async: true,
                              data: {
                                'fd[active_id]':  active_id,
                                'fd[prev_id]':  prev_id,
                                'fd[next_id]':  next_id
                              },
                              dataType: 'json',
                              success: function(res){
                                if(res.success)
                                {
                                  $.niftyNoty({
                                    type: 'success',
                                    title: 'System message',
                                    icon: 'fa fa-info fa-lg',
                                    message: 'Category moved',
                                    container: 'floating',
                                    timer: 5500
                                  });
                                  $.ajax({
                                    type: 'POST',
                                    url : '/categories/get-html-tree',
                                    dataType: 'html',
                                    success: function(res){
                                      $('#fullTreeCats').html(res);
                                    }
                                  });
                                }
                      
                              }
                            });
                          }
                      " ),
              ],
            ]);?>

          </div>

        </div>

      </div>
    <?endif;?>
  </div>


</div>