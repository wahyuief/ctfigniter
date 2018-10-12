<script src="<?php echo base_url('assets/js/fontawesome.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/ctfigniter.js') ?>" type="text/javascript"></script>
<?php
if ($this->session->flashdata('success')) {
  echo '<script>swal("'.$this->session->flashdata('success').'", "", "success");</script>';
}else if ($this->session->flashdata('warning')) {
  echo '<script>swal("'.$this->session->flashdata('warning').'", "", "warning");</script>';
}else if ($this->session->flashdata('error')) {
  echo '<script>swal("'.$this->session->flashdata('error').'", "", "error");</script>';
}
?>
<div class="text-center mt-4">
<small>Made with <i class="fas fa-heart text-danger"></i> by <a href="https://github.com/wahyuief/ctfigniter">Wahyuief</a></small>
</div>
</div>
</div>
</body>
</html>
