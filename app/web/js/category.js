$(document).ready(function(){


  // Delete TREE NODE CATEGORIES INDEX
  // =================================================================
  $('#fullTreeCats').on('click', '.delTreeNode', function(e){
    e.preventDefault();
    var result = confirm('Remove?');
    var that = $(this);
    if(result)
    {
      var id = that.data('id');
      $.ajax({
        type: 'POST',
        url : '/categories/del-tree-node',
        data: {
          'id':  id
        },
        dataType: 'json',
        success: function(res){
          if(res.success)
          {
            $.niftyNoty({
              type: 'success',
              title: 'System message',
              icon: 'fa fa-info fa-lg',
              message: 'Category have removed',
              container: 'floating',
              timer: 5500
            });
            that.parent('li').slideUp(150);
          }
        }
      });
    }
  });
  // ===================================================

});
