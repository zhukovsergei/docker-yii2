(function($)
{
  $.Redactor.prototype.erase = function()
  {
    return {
      init: function()
      {
        var button = this.button.add('erase', 'Clear');
        this.button.setAwesome('erase', 'fa fa-eraser');
        this.button.addCallback(button, this.erase.cleaner);
      },
      cleaner: function()
      {
        var nodes = this.selection.getInlines();
        this.buffer.set();

        $.each(nodes, $.proxy(function(i,s)
        {
          var $s = $(s);
          $s.replaceWith($s.contents());
        }, this));

        this.code.sync();
      }
    };
  };
})(jQuery);