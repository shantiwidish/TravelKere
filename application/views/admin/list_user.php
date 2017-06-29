<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url();?>/assets/admin/plugins/datatables/dataTables.bootstrap.css">
<!-- DataTables -->
<script src="<?php echo base_url();?>/assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>/assets/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- page script -->
<script>
  $(function () {
    $('#usertable').DataTable({
      "paging": true,
      "searching": false,
      "ordering": true,
      "info": true,
      "responsive": true
    });
  });
//      "autoWidth": false,
//            "lengthChange": false,

  function doDelete(id){
    var r = confirm("Are you sure want to delete this user?");
    if (r == true) {
        window.location = "<?php echo base_url()."/admin/user/delete/";?>"+id;
    }
  }
</script>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <a class="btn btn-success" href="<?php echo base_url()."/admin/user/form";?>"><i class="fa fa-plus"></i></a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="usertable" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Fullname</th>
            <th>Email</th>
            <!-- <th>Is Administrator</th> -->
            <th>Modified At</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
            <?php foreach ($form_data as $key => $value) { ?>
              <tr>
                <th><?php echo $value["id"];?></th>
                <th><?php echo $value["username"];?></th>
                <th><?php echo $value["fullname"];?></th>
                <th><?php echo $value["email"];?></th>
                <!-- <th><?php echo $value["is_admin"];?></th> -->
                <th><?php echo $value["modified_at"];?></th>
                <th><a class="btn btn-warning" href="<?php echo base_url()."/admin/user/form/".$value["id"];?>"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-danger" onclick="doDelete(<?php echo $value["id"];?>);"><i class="fa fa-close"></i></a></th>
              </tr>
            <?php }?>
          </tbody>
          <!-- <tfoot>
          <tr>
            <th>Rendering engine</th>
            <th>Browser</th>
            <th>Platform(s)</th>
            <th>Engine version</th>
            <th>CSS grade</th>
          </tr>
          </tfoot> -->
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
