<div class="row">
  <div class="col-sm-4 mb-4">
    <?php echo '<img src="'.base_url('assets/img/').('{picture}' ? 'anonymous.jpg' : '{picture}').'" class="img-thumbnail" width="100%" height="100%"/>' ?>
    <div class="text-center mt-2">
      <div class="font-weight-bold">{fullname}</div>
      <?php echo($this->session->has_userdata('ctfigniter') && empty($this->uri->segment(2)) ? '{email}' : '') ?>
      <div>Score: <?php echo $score ?>pt</div>
      <div><small>{last_login}</small></div>
    </div>
    <hr>
    <?php if ($this->session->has_userdata('ctfigniter') && empty($this->uri->segment(2))) {
      echo '<a href="#" class="btn form-control mb-2" data-toggle="modal" data-target="#edit-profile">Edit Profile</a>';
    } ?>
    <a href="<?php echo base_url('profile/logout') ?>" class="btn form-control">Logout</a>
  </div>
  <div class="col-sm-8">
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <tr>
          <th>Challenge</th>
          <th>Solved Time</th>
        </tr>
        {solvers}
      </table>
    </div>
  </div>
</div>
<div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('profile/edit') ?>" method="post">
        {csrf}<input type="hidden" name="{name}" value="{hash}">{/csrf}
        <div class="modal-body">
          <div class="form-group">
            <label><b>Full Name</b></label>
            <input type="text" name="fullname" placeholder="Full Name" value="{fullname}" class="form-control">
          </div>
          <div class="form-group">
            <label><b>Email</b></label>
            <input type="email" name="email" placeholder="Email" value="{email}" class="form-control">
          </div>
          <div class="form-group">
            <label><b>Password</b></label>
            <input type="password" name="password" placeholder="Leave blank if you don't want to change it" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" name="submit" value="Save" class="btn btn-outline-light">
        </div>
      </form>
    </div>
  </div>
</div>
