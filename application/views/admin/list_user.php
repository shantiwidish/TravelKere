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
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">User Data Table</h3>
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
            <th>Is Administrator</th>
            <th>Modified At</th>
          </tr>
          </thead>
          <tbody>
            <?php foreach ($form_data as $key => $value) { ?>
              <tr>
                <th><?php echo $value["id"];?></th>
                <th><?php echo $value["username"];?></th>
                <th><?php echo $value["fullname"];?></th>
                <th><?php echo $value["email"];?></th>
                <th><?php echo $value["is_admin"];?></th>
                <th><?php echo $value["modified_at"];?></th>
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
