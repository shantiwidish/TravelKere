<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">


  <?php
  if($session_data){
    $this->load->view('partial/navigation', $session_data);
  }else{
    $this->load->view('partial/navigation_blank');
  }?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
       <?php
      if(isset($form_data))
        $this->load->view($content, $form_data);
      else
        $this->load->view($content);
      ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2017</strong> All rights
    reserved.
  </footer>
