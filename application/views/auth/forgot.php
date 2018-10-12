<div class="card">
  <div class="card-header">
    <b>Forgot</b>
  </div>
  <div class="card-body">
    <form method="post">
      {csrf}<input type="hidden" name="{name}" value="{hash}">{/csrf}
      <div class="form-group">
        <input type="email" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" class="form-control">
        <small><i><?php echo form_error('email'); ?></i></small>
      </div>
      <div class="form-group float-right mt-3">
        <input type="submit" name="login" value="Send" class="btn btn-outline-light">
      </div>
    </form>
  </div>
</div>
