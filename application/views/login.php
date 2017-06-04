<link rel="stylesheet" href="<?php echo base_url();?>/assets/travelkere.css">
<body class="hold-transition login-page bgimg">
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Travel</b>Kere</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="<?php echo base_url()."/admin/user/doLogin"?>" method="post">
      <div class="form-group has-feedback">
        <input name="username" type="text" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
      </div>

    </form>

    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->
    <center>
    <p>Not registered yet? <a href="<?php echo base_url()."admin/user/form_register"?>">Sign Up</a></p>
    <a href="#">Forgot Password</a><br>
  </center>

  </div>

</div>
</body>
