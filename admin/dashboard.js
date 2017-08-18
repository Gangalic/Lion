$(document).ready(function(){
  var url = window.location.href;
  // SERVER REQUESTS FOR RENDERING
  var get_calls = new Array(
    new Array("localhost/Lion/trunk/admin/?$", "#dashboard", function(){}),
    new Array("localhost/Lion/trunk/admin/content/event/?$", "#event", function(){
      $.ajax("/Lion/trunk/admin/server.php", {
        method: "GET",
        data: 'url='+url,
        dataType: "html",
        success: function(data){
          var event = $("#event").append(data);
          event.delegate(".content_delete", "click", function() {
              if(confirm("Click OK if you are sure you want to delete this content")){
                url = $( this ).parent().find("a").attr("href");
                $.ajax("/Lion/trunk/admin/server.php", {
                  method: "DELETE",
                  data: 'url='+url,
                  success: function(data){
                    $("#event").append("<p>Deleted successfully !</p>");
                  }
                });
              }
          });
        }
      });
    }),
    new Array("localhost/Lion/trunk/admin/content/event/[0-9]+/?$", "#event", function(){
      $.ajax("/Lion/trunk/admin/server.php", {
        method: "GET",
        data: 'url='+url,
        dataType: "html",
        success: function(data){
          $("#event").append(data);
        }
      });
    }),
    new Array("localhost/Lion/trunk/admin/content/event/add/?$", "#event", function(){
      $("#event div div.placeholder").load("/Lion/trunk/gelma/php/src/content/content_add_form.html.php", function(){
        // TODO
        $("#add_content btn-toolbar btn").click(function(){
          var selected_text = window.getSelection().toString();
        });
        $("#add_content").submit(function(event) {
          event.preventDefault();
          var form_data = $(this).serialize();
          url = "/admin/content/event/"; //hack
          $.ajax("/Lion/trunk/admin/server.php", {
            method: "POST",
            data: 'url='+url+"&"+form_data,
            success: function(data){
              $("#event").append("<p>Posted successfully !</p>");
            }
          });
        });
      });
      $("#event div div a.create").hide();
    }),
    new Array("localhost/Lion/trunk/admin/content/event/update/[0-9]+/?$", "#event", function(){
      $.ajax("/Lion/trunk/admin/server.php", {
        method: "GET",
        data: 'url='+url,
        dataType: "html",
        success: function(data){
          var update_form = $("#event").append(data);
          // TODO
          update_form.find("#content_updt btn-toolbar btn").click(function(){
            var selected_text = window.getSelection().toString();
          });
          update_form.find("#content_updt").submit(function(event){
            event.preventDefault();
            var form_data = $(this).serialize();
            url = window.location.href;
            $.ajax("/Lion/trunk/admin/server.php", {
              method: "PUT",
              data: 'url='+url+"&"+form_data,
              success: function(data){
                $("#event").append("<p>Updated successfully !</p>");
              }
            });
          });
        }
      });
    })
  );
  $.each(get_calls, function(index, request){
    request[0] = request[0].replace("/", "\/");
    request[0] = new RegExp(request[0]);
    if(url.match(request[0])){
      $(request[1]).show();
      request[2]();
      return false;
    }
  });
});
