
// Tables-DataTables.js
// ====================================================================
// This file should not be included in your project.
// This is just a sample how to initialize plugins or components.
//
// - ThemeOn.net -

$(window).on('load', function() {

  // DATA TABLES
  // =================================================================
  // Require Data Tables
  // -----------------------------------------------------------------
  // http://www.datatables.net/
  // =================================================================

  $.fn.DataTable.ext.pager.numbers_length = 5;


  // Row selection (single row)
  // -----------------------------------------------------------------
  var rowSelection = $('.table-cercare').DataTable({
    "responsive": true,
    "aaSorting": [],
    "language": {
      "processing": "Подождите...",
      "search": "Поиск:",
      "lengthMenu": "Показать _MENU_ записей",
      "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
      "infoEmpty": "Записи с 0 до 0 из 0 записей",
      "infoFiltered": "(отфильтровано из _MAX_ записей)",
      "infoPostFix": "",
      "loadingRecords": "Загрузка записей...",
      "zeroRecords": "Записи отсутствуют.",
      "emptyTable": "В таблице отсутствуют данные",
      "paginate": {
        "first": "Первая",
        "previous": '<i class="fa fa-angle-left"></i>',
        "next": '<i class="fa fa-angle-right"></i>',
        "last": "Последняя"
      },
      "aria": {
        "sortAscending": ": активировать для сортировки столбца по возрастанию",
        "sortDescending": ": активировать для сортировки столбца по убыванию"
      }
    }

    //"ordering": false
  });

  $('.table-cercare').on( 'click', 'tr', function () {
    if ( $(this).hasClass('selected') ) {
      $(this).removeClass('selected');
    }
    else
    {
      rowSelection.$('tr.selected').removeClass('selected');
      $(this).addClass('selected');
    }
  } );

});
