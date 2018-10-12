<?php if ($registration > 0) { ?>
  <div class="card">
    <div class="card-header">
      <b>Register</b>
    </div>
    <div class="card-body">
      <form method="post">
        {csrf}<input type="hidden" name="{name}" value="{hash}">{/csrf}
        <div class="form-group">
          <input type="text" name="fullname" placeholder="Full Name" value="<?php echo set_value('fullname'); ?>" class="form-control">
          <small><i><?php echo form_error('fullname'); ?></i></small>
        </div>
        <div class="form-group">
          <input type="email" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" class="form-control">
          <small><i><?php echo form_error('email'); ?></i></small>
        </div>
        <div class="form-group">
          <input type="password" name="password" placeholder="Password" class="form-control">
          <small><i><?php echo form_error('password'); ?></i></small>
        </div>
        <div class="form-group">
          <input type="password" name="passconf" placeholder="Retype Password" class="form-control">
          <small><i><?php echo form_error('passconf'); ?></i></small>
        </div>
        <div class="form-group float-right">
          <small><i>Already have an account? <a href="<?php echo base_url('auth/login') ?>">Login!</a></i></small>&nbsp;
          <input type="submit" name="register" value="Sign Up" class="btn btn-outline-light">
        </div>
      </form>
    </div>
  </div>
<?php } else { ?>
  <div class="card">
    <div class="card-header">
      <b>Register</b>
    </div>
    <div class="card-body">
      Sorry, registration is currently unavailable.
    </div>
  </div>
<?php } ?>
