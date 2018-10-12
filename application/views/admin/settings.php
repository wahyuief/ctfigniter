<div class="row accordion" id="Settings">
  <div class="col-sm-4">
    <div class="list-group">
      <a href="#" class="list-group-item list-group-item-action" data-toggle="collapse" data-target="#Website">Website</a>
      <a href="#" class="list-group-item list-group-item-action" data-toggle="collapse" data-target="#Email">Email</a>
      <a href="#" class="list-group-item list-group-item-action" data-toggle="collapse" data-target="#Configuration">Configuration</a>
    </div>
  </div>
  <div class="col-sm-8">
    <div class="card">
      <?php foreach ($data as $row) { ?>
      <div id="Website" class="collapse show" data-parent="#Settings">
        <div class="card-body">
          <form action="<?php echo base_url('admin/setting_website') ?>" method="post">
            {csrf}<input type="hidden" name="{name}" value="{hash}">{/csrf}
            <div class="form-group">
              <label><b>Title</b></label>
              <input type="text" name="title" value="<?php echo $row['title'] ?>" class="form-control">
            </div>
            <div class="form-group">
              <label><b>Description</b></label>
              <input type="text" name="description" value="<?php echo $row['description'] ?>" class="form-control">
            </div>
            <div class="form-group float-right">
              <input type="submit" name="submit" value="Update" class="btn btn-outline-light">
            </div>
          </form>
        </div>
      </div>
      <div id="Email" class="collapse" data-parent="#Settings">
        <div class="card-body">
          <form action="<?php echo base_url('admin/setting_email') ?>" method="post">
            {csrf}<input type="hidden" name="{name}" value="{hash}">{/csrf}
            <div class="form-group">
              <label><b>SMTP Host</b></label>
              <input type="text" name="host" value="<?php echo $row['smtp_host'] ?>" class="form-control">
            </div>
            <div class="form-group">
              <label><b>SMTP Port</b></label>
              <input type="number" name="port" value="<?php echo $row['smtp_port'] ?>" class="form-control">
            </div>
            <div class="form-group">
              <label><b>SMTP User</b></label>
              <input type="text" name="user" value="<?php echo $row['smtp_user'] ?>" class="form-control">
            </div>
            <div class="form-group">
              <label><b>SMTP Pass</b></label>
              <input type="text" name="pass" value="<?php echo $row['smtp_pass'] ?>" class="form-control">
            </div>
            <div class="form-group float-right">
              <input type="submit" name="submit" value="Update" class="btn btn-outline-light">
            </div>
          </form>
        </div>
      </div>
      <?php } ?>
      <div id="Configuration" class="collapse" data-parent="#Settings">
        <div class="card-body">
          <form action="<?php echo base_url('admin/setting_website') ?>" method="post" class="table-responsive">
            <table class="table table-striped">
              <tr>
                <th>Challenge</th>
                <td width="50" align="center"><?php echo($chall > 0 ? '<a href="'.base_url('admin/stop_chal/0').'"><i class="fa fa-check"></i></a>' : '<a href="'.base_url('admin/stop_chal/1').'"><i class="fa fa-times"></i></a>') ?></td>
              </tr>
              <tr>
                <th>Registration</th>
                <td width="50" align="center"><?php echo($row['registration'] > 0 ? '<a href="'.base_url('admin/stop_registration/0').'"><i class="fa fa-check"></i></a>' : '<a href="'.base_url('admin/stop_registration/1').'"><i class="fa fa-times"></i></a>') ?></td>
              </tr>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
