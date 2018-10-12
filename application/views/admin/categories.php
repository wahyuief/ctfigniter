<div class="navbar border mb-2 bg-light">
  <b>Categories</b>
  <div class="float-right">
    <a href="#" data-toggle="modal" data-target="#add-new-category">Add new</a>
  </div>
</div>
<div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <th><b>Name</b></th>
      <th width="50"><b>Edit</b></th>
    </tr>
    <?php foreach ($data as $row) { ?>
    <tr>
      <td><?php echo $row['title'] ?></td>
      <td align="center"><a href="#" data-toggle="modal" data-target="#edit-category-<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></a></td>
    </tr>
    <div class="modal fade" id="edit-category-<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo base_url('admin/edit_category/').$row['id'] ?>" method="post">
            {csrf}<input type="hidden" name="{name}" value="{hash}">{/csrf}
            <div class="modal-body">
              <div class="form-group">
                <input type="text" name="title" placeholder="Category" value="<?php echo $row['title'] ?>" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" name="submit" value="Save" class="btn btn-outline-light">
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php } ?>
  </table>
</div>

<div class="modal fade" id="add-new-category" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add new category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('admin/add_category') ?>" method="post">
        {csrf}<input type="hidden" name="{name}" value="{hash}">{/csrf}
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="title" placeholder="Category" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" name="submit" value="Save" class="btn btn-outline-light">
        </div>
      </form>
    </div>
  </div>
</div>
