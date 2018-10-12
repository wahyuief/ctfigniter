<div style="width: 100%;margin:0 auto;">
<div style="margin: 0 auto;">
<div style="background: #333;border: 1px solid #666;border-radius: 0;color: #ccc;">
<div style="background-color: #444;border-bottom: 1px solid #666;padding: .75rem 1.25rem;">
<b><?php echo $title ?></b>
</div>
<div style="padding: 1.25rem;">
<b>Hey <?php echo $fullname ?>,</b>
<br>
<div style="color:#ccc;">You recently requested to reset your password for your <?php echo $website ?> account. Click the button below to reset it.</div>
<div style="max-width: 100%;width:200px;margin:1em auto;">
<a href="<?php echo base_url('auth/reset/').$token ?>" style="display: inline-block;width: 200px;text-align: center;background: #222;border: 1px solid #666;border-radius: 0;cursor:pointer;padding: .375rem .75rem;color:#ccc;text-decoration:none;text-transform:uppercase;"><?php echo $title ?></a>
</div>
<div style="color:#ccc">If you did not request a password reset, please ignore this email or reply to let us know.</div>
</div>
</div>
</div>
</div>
