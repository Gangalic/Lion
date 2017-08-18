<form id="add_content" method="post" class="form-horizontal" class="add" action="/Lion/trunk/admin/server.php">
  <div class="form-group">
    <label for="title" class="control-label col-sm-2">Title</label>
    <div class="col-sm-10">
    <input type="text" name="title" id="title" class="form-control"/>
    </div>
  </div>
  <div class="form-group">
    <label for="type" class="control-label col-sm-2">Type</label>
    <div class="col-sm-10">
    <input type="text" name="type" id="type" class="form-control"/>
    </div>
  </div>
  <div class="form-group">
    <label for="content" class="control-label col-sm-2">Content</label>
    <div class="col-sm-10">
      <textarea id="content" name="content" class="form-control"></textarea>
      <div class="btn-toolbar">
        <div class="btn-group">
          <a class="btn" href="#"><i class="glyphicon glyphicon-picture"></i></a>
          <a class="btn" href="#"><i class="glyphicon glyphicon-text-size"></i></a>
          <a class="btn" href="#"><i class="glyphicon glyphicon-bold"></i></a>
          <a class="btn" href="#"><i class="glyphicon glyphicon-italic"></i></a>
          <a class="btn" href="#"><i class="glyphicon glyphicon-console"></i></a>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Post</button>
    </div>
  </div>
</form>
