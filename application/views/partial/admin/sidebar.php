<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!--
    side bar icon style
    fa-dashboard
    fa-files-o
    fa-circle-o
    fa-th
    fa-pie-chart
    fa-angle-left
    fa-laptop
    fa-edit
    fa-table
    fa-calendar
    fa-envelope
    fa-folder
    -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active treeview">
        <a href="<?php echo base_url();?>">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          <!-- <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span> -->
        </a>
      </li>
      <li class="treeview">
        <a href="<?php echo base_url()."admin/user"?>">
          <i class="fa fa-files-o"></i>
          <span>User Administration</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <!-- <ul class="treeview-menu">
          <li><a href="admin/super/list_users"><i class="fa fa-circle-o"></i> List Users</a></li>
          <li><a href="admin/super/list_admins"><i class="fa fa-circle-o"></i> List Admins</a></li>
        </ul> -->
      </li>
      <li class="active treeview">
        <a href="<?php echo base_url()."admin/trip";?>">
          <i class="fa fa-dashboard"></i> <span>Manage Trip</span>
          <!-- <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span> -->
        </a>
      </li>
  </section>
  <!-- /.sidebar -->
</aside>
