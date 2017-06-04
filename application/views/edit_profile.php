<?php get_message_error();?>
<form action="<?php echo base_url()."/member/add"?>" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group has-feedback">
        <label>Username</label>
        <input name="username" type="text" class="form-control" value="<?php echo $username?>" disabled>
      </div>
      <div class="form-group has-feedback">
        <label>Fullname</label>
        <input name="fullname" type="text" class="form-control" value="<?php echo $fullname?>" required>
      </div>
      <div class="form-group has-feedback">
        <label>Email</label>
        <input name="email" type="email" class="form-control" value="<?php echo $email?>" disabled>
      </div>
      <div class="form-group has-feedback">
        <label>Phone Number</label>
        <input name="phone" type="phone" class="form-control" value="<?php echo $phone_number?>" required >
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group has-feedback">
        <label>Address</label>
        <textarea name="address" class="form-control" rows="3" placeholder="Enter ...">
        <?php echo $address;?>
        </textarea>
      </div>
      <div class="form-group has-feedback">
        <label>Profile Picture</label>
        <input name="image" type="file" class="form-control" placeholder="Profile Picture">
      </div>
      <div class="form-group has-feedback">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Update</button>
      </div>
    </div>
  </div>
</form>
