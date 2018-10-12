<div class="navbar border mb-2 bg-light">
  <b>Users</b>
  <div class="float-right">
    <a href="#" data-toggle="modal" data-target="#add-new-user">Add new</a>
  </div>
</div>
<div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <th><b>Name</b></th>
      <th><b>Email</b></th>
      <th width="80"><b>Level</b></th>
      <th width="50"><b>Show</b></th>
      <th width="50"><b>Edit</b></th>
    </tr>
    <?php foreach ($data as $row) { ?>
    <tr>
      <td><?php echo $row['fullname'] ?></td>
      <td><?php echo $row['email'] ?></td>
      <td align="center"><?php echo($row['level'] > 0 ? 'Admin' : 'Member') ?></td>
      <td align="center"><?php echo($row['visible'] > 0 ? '<a href="'.base_url('admin/show/user/0/').$row['id'].'"><i class="fa fa-check"></i></a>' : '<a href="'.base_url('admin/show/user/1/').$row['id'].'"><i class="fa fa-times"></i></a>') ?></td>
      <td align="center"><a href="#" data-toggle="modal" data-target="#add-new-user-<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></a></td>
    </tr>
    <div class="modal fade" id="add-new-user-<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit user</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo base_url('admin/edit_user/').$row['id'] ?>" method="post">
            {csrf}<input type="hidden" name="{name}" value="{hash}">{/csrf}
            <div class="modal-body">
              <div class="form-group">
                <label><b>Full Name</b></label>
                <input type="text" name="fullname" placeholder="Full Name" value="<?php echo $row['fullname'] ?>" class="form-control">
              </div>
              <div class="form-group">
                <label><b>Email</b></label>
                <input type="email" name="email" placeholder="Email" value="<?php echo $row['email'] ?>" class="form-control">
              </div>
              <div class="form-group">
                <label><b>Password</b></label>
                <input type="password" name="password" placeholder="Leave blank if you don't want to change it" class="form-control">
              </div>
              <div class="form-group">
                <label><b>Level</b></label>
                <select class="form-control" name="level">
                  <?php echo($row['level'] > 0 ? '<option value="1" selected>Admin</option><option value="0">Member</option>' : '<option value="1">Admin</option><option value="0" selected>Member</option>') ?>
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

<div class="modal fade" id="add-new-user" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add new user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('admin/add_user') ?>" method="post">
        {csrf}<input type="hidden" name="{name}" value="{hash}">{/csrf}
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="fullname" placeholder="Full Name" class="form-control">
          </div>
          <div class="form-group">
            <input type="email" name="email" placeholder="Email" class="form-control">
          </div>
          <div class="form-group">
            <input type="password" name="password" placeholder="Password" class="form-control">
          </div>
          <div class="form-group">
            <input type="password" name="passconf" placeholder="Retype Password" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" name="submit" value="Save" class="btn btn-outline-light">
        </div>
      </form>
    </div>
  </div>
</div>
