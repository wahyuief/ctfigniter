<div class="navbar border mb-2 bg-light">
  <b>Challenges</b>
  <div class="float-right">
    <a href="#" data-toggle="modal" data-target="#add-new-challenge">Add new</a>
  </div>
</div>
<div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <th><b>Name</b></th>
      <th><b>Category</b></th>
      <th><b>Score</b></th>
      <th width="50"><b>Show</b></th>
      <th width="50"><b>Edit</b></th>
    </tr>
    <?php foreach ($data as $row) { ?>
    <tr>
      <td><?php echo $row['title'].' '.($new <= $row['publish'] ? '<span class="badge badge-danger">New</span>' : '') ?></td>
      <td><?php echo $row['category'] ?></td>
      <td><?php echo $row['score'] ?>pt</td>
      <td align="center"><?php echo($row['visible'] > 0 ? '<a href="'.base_url('admin/show/chal/0/').$row['id'].'"><i class="fa fa-check"></i></a>' : '<a href="'.base_url('admin/show/chal/1/').$row['id'].'"><i class="fa fa-times"></i></a>') ?></td>
      <td align="center"><a href="#" data-toggle="modal" data-target="#edit-challenge-<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></a></td>
    </tr>
    <div class="modal fade" id="edit-challenge-<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit challenge</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo base_url('admin/edit_challenge/').$row['id'] ?>" method="post">
            {csrf}<input type="hidden" name="{name}" value="{hash}">{/csrf}
            <div class="modal-body">
              <div class="form-group">
                <input type="text" name="title" placeholder="Title" value="<?php echo $row['title'] ?>" class="form-control">
              </div>
              <div class="form-group">
                <textarea name="description" placeholder="Description" class="form-control" style="resize:none;"><?php echo $row['description'] ?></textarea>
              </div>
              <div class="form-group">
                <input type="text" name="link" placeholder="Link" value="<?php echo $row['link'] ?>" class="form-control">
              </div>
              <div class="form-group">
                <input type="text" name="flag" placeholder="Flag" value="<?php echo $row['flag'] ?>" class="form-control">
              </div>
              <div class="form-group">
                <input type="number" name="score" placeholder="Score" value="<?php echo $row['score'] ?>" class="form-control">
              </div>
              <div class="form-group">
                <select class="form-control" name="category">
                  <option disabled>Choose</option>
                  <?php foreach ($categories as $cat) {
                    if ($row['cat_id'] === $cat['id']) {
                      echo '<option value="'.$row['cat_id'].'" selected>'.$cat['title'].'</option>';
                    } else {
                      echo '<option value="'.$cat['id'].'">'.$cat['title'].'</option>';
                    }
                  } ?>
                </select>
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

<div class="modal fade" id="add-new-challenge" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add new challenge</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('admin/add_challenge') ?>" method="post">
        {csrf}<input type="hidden" name="{name}" value="{hash}">{/csrf}
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="title" placeholder="Title" class="form-control">
          </div>
          <div class="form-group">
            <textarea name="description" placeholder="Description" class="form-control" style="resize:none;"></textarea>
          </div>
          <div class="form-group">
            <input type="text" name="link" placeholder="Link" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="flag" placeholder="Flag" class="form-control">
          </div>
          <div class="form-group">
            <input type="number" name="score" placeholder="Score" class="form-control">
          </div>
          <div class="form-group">
            <select class="form-control" name="category">
              <option selected disabled>Choose</option>
              {categories}
                <option value="{id}">{title}</option>
              {/categories}
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" name="submit" value="Save" class="btn btn-outline-light">
        </div>
      </form>
    </div>
  </div>
</div>
