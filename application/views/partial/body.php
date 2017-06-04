<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">


  <?php $this->load->view('partial/navigation', $session_data)?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $page_title;?>
        <small><?php echo $page_subtitle;?></small>
      </h1>
    </section>

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
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
