$(document).ready(function(){
  // var sections = new Array("dashboard", "event");
  // $("#"+sections.join(", #")).hide();
  var url = window.location.href;
  var regexs = new Array(
    new Array("localhost/Lion/trunk/admin/?$", "#dashboard", function(){}),
    new Array("localhost/Lion/trunk/admin/content/?$", "#event", function(){
      $.ajax("/Lion/trunk/admin/server.php", {
        method: "GET",
        data: 'url=/admin/content/',
        dataType: "html",
        success: function(data){
          $("#event").append(data);
        }
      });
    }),
    new Array("localhost/Lion/trunk/admin/content/[0-9]+/?$", "#event", function(){
      $.ajax("/Lion/trunk/admin/server.php", {
        method: "PUT",
        data: 'url=/admin/content/',
        dataType: "html",
        success: function(data){
          $("#event").append(data);
        }
      });
    })
  );
  $.each(regexs, function(index, regex){
    regex[0] = regex[0].replace("/", "\/");
    regex[0] = new RegExp(regex[0]);
    if(url.match(regex[0])){
      $(regex[1]).show();
      regex[2]();
      return false;
    }
  });
});
