$(document).ready(function(){
  // <!-- INITIALIZE IOS SWITCHERY -->
  // =================================================================
  $('.nicePrettyCheckbox').each(function(ind, val){
    new Switchery(val);
  });
  // =================================================================
  // <!-- end initialize ios switchery -->

  /**
   * Copy table rows
   */
  $('#doCopyTblRows').on('click', function(){
    $(this).addClass('disabled');

    var catID = $('#catIDforCopy').val();
    var IDS = [];

    $("table input:checkbox:checked").each(function(ind, val)
    {
      IDS.push($(this).val());
    });

    $.ajax({
      type: 'POST',
      url : '/admin/products/copyingTableRows',
      data: {
        'catID':  catID,
        'IDS':  IDS
      },
      dataType: 'json',
      success: function(res){
        location.reload();
      }
    });
  });

  /**
   * Delete single file button from form
   */
  $('body').on('click', '.deleteFile', function (e) {
    e.preventDefault();

    var removeMessage = $(this).data('message');

    var result = confirm(removeMessage);

    if(!result) {
      return false;
    }

    var classModelName = $(this).data('class');
    var id = $(this).data('idforremove');
    var field = $(this).data('fieldforremove');
    var url = $(this).data('url');

    $.ajax({
      type: 'POST',
      url : url,
      data: {
        'classModelName':  classModelName,
        'id':  id,
        'field':  field
      },
      dataType: 'json'
    });

    $(this).closest('.form-group').hide();

    $.niftyNoty({
      type: 'success',
      title: 'System message',
      icon: 'fa fa-info fa-lg',
      message: 'The file was removed',
      container: 'floating',
      timer: 5500
    });
  });

  $('body').on('click', '.deleteImage', function (e) {
    e.preventDefault();

    var removeMessage = $(this).data('message');

    var result = confirm(removeMessage);

    if(!result) {
      return false;
    }

    var classModelName = $(this).data('class');
    var id = $(this).data('idforremove');
    var field = $(this).data('fieldforremove');
    var url = $(this).data('url');

    $.ajax({
      type: 'POST',
      url : url,
      data: {
        'classModelName':  classModelName,
        'id':  id,
        'field':  field
      },
      dataType: 'json'
    });

    $(this).closest('.form-group').find('.link-container').empty();
    $(this).closest('.form-group').find('.edit-image-btn').hide();
    $(this).hide();

    $.niftyNoty({
      type: 'success',
      title: 'System message',
      icon: 'fa fa-info fa-lg',
      message: 'The image was removed',
      container: 'floating',
      timer: 5500
    });
  });
});
/**
 * --------------------
 */

/**
 * TUI Editor
 */

function dataURLtoFile(dataurl, filename) {
  var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
      bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
  while(n--){
    u8arr[n] = bstr.charCodeAt(n);
  }
  return new File([u8arr], filename, {type:mime});
}

function initTuiEditor(widgetId, filePath, fileName) {

  var blackTheme = {
    'menu.normalIcon.path': '/js/plugins/tui.image-editor/dist/svg/icon-d.svg',
    'menu.activeIcon.path': '/js/plugins/tui.image-editor/dist/svg/icon-b.svg',
    'menu.disabledIcon.path': '/js/plugins/tui.image-editor/dist/svg/icon-a.svg',
    'menu.hoverIcon.path': '/js/plugins/tui.image-editor/dist/svg/icon-c.svg',
    'submenu.normalIcon.path': '/js/plugins/tui.image-editor/dist/svg/icon-d.svg',
    'submenu.activeIcon.path': '/js/plugins/tui.image-editor/dist/svg/icon-b.svg',
  };

  var tuiEditor = new tui.ImageEditor('#tui-image-editor-container-' + widgetId, {
    includeUI: {
      loadImage: {
        path: filePath,
        name: fileName
      },
      theme: blackTheme, // or whiteTheme
      initMenu: 'filter',
      menuBarPosition: 'bottom'
    },
    cssMaxWidth: 1920-(1920 * 0.3),
    cssMaxHeight: 1080-(1080 * 0.3),
    usageStatistics: false
  });

  tuiEditor.loadImageFromURL = (function() {
    var cached_function = tuiEditor.loadImageFromURL;
    function waitUntilImageEditorIsUnlocked(imageEditor) {
      return new Promise((resolve,reject)=>{
        const interval = setInterval(()=>{
          if (!imageEditor._invoker._isLocked) {
            clearInterval(interval);
            resolve();
          }
        }, 100);
      })
    }
    return function() {
      return waitUntilImageEditorIsUnlocked(tuiEditor).then(()=>cached_function.apply(this, arguments));
    };
  })();

  return tuiEditor;
}
/**
 * --------------------
 */
