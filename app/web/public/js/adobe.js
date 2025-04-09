$(document).ready(function ()
{
  var csrfToken = $('meta[name="csrf-token"]').attr("content");

  //$.cookie.defaults.path = '/';

  function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }

});