<form method="post" class="form-horizontal" id="content_updt">
  <div class="form-group">
    <label for="title" class="control-label col-sm-2">Title</label>
    <div class="col-sm-10">
    <input type="text" name="title" id="title" class="form-control" value="%s"/>
    </div>
  </div>
  <div class="form-group">
    <label for="type" class="control-label col-sm-2">Type</label>
    <div class="col-sm-10">
    <input type="text" name="type" id="type" class="form-control" value="%s"/>
    </div>
  </div>
  <div class="form-group">
    <label for="date" class="control-label col-sm-2">Creation date</label>
    <div class="col-sm-10">
    <input type="text" name="date" id="date" class="form-control" value="%s"/>
    </div>
  </div>
  <div class="form-group">
    <label for="content" class="control-label col-sm-2">Content</label>
    <div class="col-sm-10">
    <textarea id="content" name="content" class="form-control">%s</textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Update</button>
    </div>
  </div>
</form>
