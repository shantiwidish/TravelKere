<?php get_message_error();?>
<form action="<?php echo base_url()."/member/add"?>" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group has-feedback">
        <label>Username</label>
        <input name="username" type="text" class="form-control" placeholder="Username" required>
      </div>
      <div class="form-group has-feedback">
        <label>Fullname</label>
        <input name="fullname" type="text" class="form-control" placeholder="Full name" required>
      </div>
      <div class="form-group has-feedback">
        <label>Email</label>
        <input name="email" type="email" class="form-control" placeholder="Email" required >
      </div>
      <div class="form-group has-feedback">
        <label>Phone Number</label>
        <input name="phone_number" type="phone_number" class="form-control" placeholder="Phone Number" required >
      </div>
      <div class="form-group has-feedback">
        <label>Address</label>
        <textarea name="address" class="form-control" rows="3" placeholder="Enter ..."></textarea>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group has-feedback">
        <label>Profile Picture</label>
        <input name="image" type="file" class="form-control" placeholder="Profile Picture">
      </div>
      <div class="form-group has-feedback">
        <label>Password</label>
        <input name="password" type="password" class="form-control" placeholder="Password" required>
      </div>
      <div class="form-group has-feedback">
        <label>Confirm Password</label>
        <input name="re_password" type="password" class="form-control" placeholder="Retype password" required>
      </div>
      <div class="form-group has-feedback">
          <label>
            <input name="agreement" type="checkbox">I understand <a href="#">terms & conditions</a>
          </label>
      </div>
      <div class="form-group has-feedback">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
      </div>
    </div>
  </div>
</form>
