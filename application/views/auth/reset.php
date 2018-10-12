<div class="card">
  <div class="card-header">
    <b>Reset</b>
  </div>
  <div class="card-body">
    <form method="post">
      {csrf}<input type="hidden" name="{name}" value="{hash}">{/csrf}
      <div class="form-group">
        <input type="text" value="{email}" class="form-control" disabled>
      </div>
      <div class="form-group">
        <input type="password" name="password" placeholder="Password" class="form-control">
        <small><i><?php echo form_error('password'); ?></i></small>
      </div>
      <div class="form-group">
        <input type="password" name="passconf" placeholder="Retype Password" class="form-control">
        <small><i><?php echo form_error('passconf'); ?></i></small>
      </div>
      <div class="form-group float-right mt-3">
        <input type="submit" name="login" value="Reset" class="btn btn-outline-light">
      </div>
    </form>
  </div>
</div>
