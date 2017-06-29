<?php get_message_error();?>
<?
    $action = base_url()."/admin/user/add";
    $label = "Register New User";
?>
<form action="<?php echo $action;?>" method="post" enctype="multipart/form-data">
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title"><?php echo $label; ?></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group has-feedback">
          <input name="username" type="text" class="form-control" placeholder="Username" required>
        </div>
        <div class="form-group has-feedback">
          <input name="fullname" type="text" class="form-control" placeholder="Full name" required>
        </div>
        <div class="form-group has-feedback">
          <input name="email" type="email" class="form-control" placeholder="Email" required >
        </div>
        <!-- <div class="form-group has-feedback">
          <input name="image" type="file" class="form-control" placeholder="Profile Picture">
        </div> -->
      </div>
      <!-- /.col -->
      <div class="col-md-6">
        <div class="form-group has-feedback">
          <input name="password" type="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-group has-feedback">
          <input name="re_password" type="password" class="form-control" placeholder="Retype password" required>
        </div>
        <!-- <div class="form-group has-feedback">
            <label>
              <input name="is_admin" type="checkbox"> Is Administrator?</a>
            </label>
        </div> -->
        <div class="form-group has-feedback">
          <div class="checkbox icheck">
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Add</button>
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
