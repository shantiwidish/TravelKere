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
    var r = confirm("Are you sure want to close this trip?");
    if (r == true) {
        window.location = "<?php echo base_url()."/admin/trip/closeTrip/";?>"+id;
    }
  }
</script>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        <table id="usertable" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
            <?php foreach ($form_data as $key => $value) { ?>
              <tr>
                <th><?php echo $value["id"];?></th>
                <th><?php echo $value["title"];?></th>
                <th><?php echo $value["description"];?></th>
                <th><?php echo $value["start_at"];?></th>
                <th><?php echo ($value["isActive"]==0)?"inactive":"active";?></th>
                <th>
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
