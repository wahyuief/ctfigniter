<?php if (!empty($categories)) { foreach ($categories as $cate) {  ?>
<div class="card mb-4">
<div class="card-header font-weight-bold"><?php echo $cate['title'] ?></div>
<div class="card-body">
<?php foreach ($challenges as $chall) { if ($cate['id'] == $chall['category']) { ?>
<div class="list-group mb-2">
<a href="#" data-toggle="modal" data-target="#chall-<?php echo $chall['id'] ?>" class="list-group-item list-group-item-action"><?php echo $chall['title'] ?>&nbsp;<?php echo($new <= $chall['publish'] ? '<span class="badge badge-danger">New</span>' : '').' '.($this->challenges_m->solvers($chall['id'], $this->session->userdata('ctfigniter')['user_id']) > 0 ? '<span class="badge badge-success">Solved</span>' : '') ?><span class="float-right"><?php echo $chall['score'] ?>pt</span></a>
</div>
<div class="modal fade" id="chall-<?php echo $chall['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo $chall['title'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo $chall['description'] ?>
        <hr>
        <?php echo(is_file('uploads/'.$chall['link']) ? '<a href="'.base_url('uploads/').$chall['link'].'">'.$chall['link'].'</a>' : "".$chall['link']."") ?>
      </div>
      <form action="<?php echo base_url('flag/verify/').$chall['id'] ?>" method="post">
        {csrf}<input type="hidden" name="{name}" value="{hash}">{/csrf}
        <div class="modal-footer">
          <?php if ($this->challenges_m->solvers($chall['id'], $this->session->userdata('ctfigniter')['user_id']) > 0) { ?>
          <div class="input-group">
            <input type="text" class="form-control" value="[Solved]" disabled>
            <div class="input-group-append">
              <button type="button" class="input-group-text" disabled>Submit</button>
            </div>
          </div>
          <?php } else { ?>
          <div class="input-group">
            <input type="text" name="flag" class="form-control" placeholder="Input your flag here" required>
            <div class="input-group-append">
              <button type="submit" name="submit" class="input-group-text">Submit</button>
            </div>
          </div>
          <?php } ?>
        </div>
      </form>
    </div>
  </div>
</div>
<?php }} ?>
</div>
</div>
<?php }} else { ?>
<div class="card">
  <div class="card-body">
    Currently the challenge is not available.
  </div>
</div>
<?php } ?>
