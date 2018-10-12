<div class="card">
  <div class="card-header">
    <b>Login</b>
  </div>
  <div class="card-body">
    <form method="post">
      {csrf}<input type="hidden" name="{name}" value="{hash}">{/csrf}
      <div class="form-group">
        <input type="email" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" class="form-control">
        <small><i><?php echo form_error('email'); ?></i></small>
      </div>
      <div class="input-group">
        <input type="password" name="password" placeholder="Password" class="form-control">
        <div class="input-group-append">
          <span class="input-group-text" id="basic-addon2"><a href="<?php echo base_url('auth/forgot') ?>">Forgot?</a></span>
        </div>
      </div>
      <small><i><?php echo form_error('password'); ?></i></small>
      <div class="form-group float-right mt-3">
        <small><i>Don't have an account? <a href="<?php echo base_url('auth/register') ?>">Register!</a></i></small>&nbsp;
        <input type="submit" name="login" value="Sign In" class="btn btn-outline-light">
      </div>
    </form>
  </div>
</div>
