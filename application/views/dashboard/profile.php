<div class="row">
  <div class="col-sm-4 mb-4">
    <?php echo '<img src="'.base_url('assets/img/').('{picture}' ? 'anonymous.jpg' : '{picture}').'" class="img-thumbnail" width="100%" height="100%"/>' ?>
    <div class="text-center mt-2">
      <div class="font-weight-bold">{fullname}</div>
      <?php echo($this->session->has_userdata('ctfigniter') && empty($this->uri->segment(2)) ? "{email}" : '') ?>
      <div>Score: <?php echo $score ?>pt</div>
      <div><small>{last_login}</small></div>
    </div>
    <hr>
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
