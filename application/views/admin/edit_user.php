<?php get_message_error();?>
<?
    $action = base_url()."/admin/user/edit";
    $label = "Edit User";
    $hidden_id = "<input type='hidden' name='id' value='".$form_data['id']."'>";
?>
<form action="<?php echo $action;?>" method="post" enctype="multipart/form-data">
  <?php echo $hidden_id;?>
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title"><?php echo $label; ?></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group has-feedback">
          <input name="username" type="text" class="form-control" placeholder="Username"
          <?php echo "value='".$form_data['username']."' ";?> disabled >
        </div>
        <div class="form-group has-feedback">
          <input name="fullname" type="text" class="form-control" placeholder="Full name"
            <?php echo "value='".$form_data['fullname']."' ";?> required>
        </div>
        <div class="form-group has-feedback">
          <input name="email" type="email" class="form-control" placeholder="Email"
          <?php echo "value='".$form_data['email']."' ";?> disabled>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-md-6">
        <!-- <div class="form-group has-feedback">
          <input name="image" type="file" class="form-control" placeholder="Profile Picture">
        </div> -->

        <div class="form-group has-feedback">
            <label>
              <input name="isActive" type="checkbox" <?php if($form_data['isActive']==1)"checked";?>> Is Active?</a>
            </label>
        </div>
        <div class="form-group has-feedback">
          <div class="checkbox icheck">
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Update</button>
            </div>
          </div>
        </div>

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
</form>
