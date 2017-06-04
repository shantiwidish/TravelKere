<?php $this->load->view('search_control')?>
<h2 class="page-header">Must Join!</h2>
<div class="row">
  <?php for($i=0;$i<4;$i++){
    ?>
  <div class="col-md-3">
    <!-- Box Comment -->
    <div class="box box-widget">
      <div class="box-header with-border">
        <div class="user-block">
          <img class="img-circle" src="<?php echo base_url()."assets/admin/dist/img/user1-128x128.jpg"?>" alt="User Image">
          <span class="username"><a href="#">Trip to Untung Jawa</a></span>
          <span class="description">Jonathan Burke Jr.</span>
        </div>
        <!-- /.user-block -->
        <div class="box-tools">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Price <span class="pull-right badge bg-blue">Rp.200,000</span></a></li>
                <li><a href="#">Quota <span class="pull-right badge bg-aqua">12</span></a></li>
                <li><a href="#">Availability <span class="pull-right badge bg-green">3</span></a></li>
                <li><a href="#">Duration <span class="pull-right badge bg-red">2D1N</span></a></li>
              </ul>
            </div>
      <!-- /.box-header -->
      <div class="box-body">
        <img class="img-responsive pad" src="<?php echo base_url()."assets/admin/dist/img/photo2.png"?>" alt="Photo">

        <p>I took this photo this morning. What do you guys think?</p>
        <span class="pull-right text-muted">9 of 12 member join this trip</span>
      </div>
      <div class="box-body no-padding">
          <ul class="users-list clearfix">
            <li>
              <img src="<?php echo base_url()."assets/admin/dist/img/user1-128x128.jpg"?>" alt="User Image">
              <a class="users-list-name" href="#">Alexander Pierce</a>
              <span class="users-list-date">Today</span>
            </li>
            <li>
              <img src="<?php echo base_url()."assets/admin/dist/img/user8-128x128.jpg"?>" alt="User Image">
              <a class="users-list-name" href="#">Norman</a>
              <span class="users-list-date">Yesterday</span>
            </li>
            <li>
              <img src="<?php echo base_url()."assets/admin/dist/img/user7-128x128.jpg"?>" alt="User Image">
              <a class="users-list-name" href="#">Jane</a>
              <span class="users-list-date">12 Jan</span>
            </li>
            <li>
              <img src="<?php echo base_url()."assets/admin/dist/img/user6-128x128.jpg"?>" alt="User Image">
              <a class="users-list-name" href="#">John</a>
              <span class="users-list-date">12 Jan</span>
            </li>
            <!-- <li>
              <img src="<?php echo base_url()."assets/admin/dist/img/user2-160x160.jpg"?>" alt="User Image">
              <a class="users-list-name" href="#">Alexander</a>
              <span class="users-list-date">13 Jan</span>
            </li>
            <li>
              <img src="<?php echo base_url()."assets/admin/dist/img/user5-128x128.jpg"?>" alt="User Image">
              <a class="users-list-name" href="#">Sarah</a>
              <span class="users-list-date">14 Jan</span>
            </li>
            <li>
              <img src="<?php echo base_url()."assets/admin/dist/img/user4-128x128.jpg"?>" alt="User Image">
              <a class="users-list-name" href="#">Nora</a>
              <span class="users-list-date">15 Jan</span>
            </li>
            <li>
              <img src="<?php echo base_url()."assets/admin/dist/img/user3-128x128.jpg"?>" alt="User Image">
              <a class="users-list-name" href="#">Nadia</a>
              <span class="users-list-date">15 Jan</span>
            </li> -->
          </ul>
          <!-- /.users-list -->
        </div>
      <!-- /.box-body -->
      <!-- /.box-footer -->
      <div class="box-footer">
        <form action="#" method="post">
          <div class="form-group has-feedback">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Join</button>
          </div>
        </form>
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box -->
  </div>
  <?php
}?>
</div>
