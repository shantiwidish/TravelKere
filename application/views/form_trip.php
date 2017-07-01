<div class="row">
<?php $this->load->view('side_search_control', $side_search)?>
<div class="col-md-8">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Make a Trip</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="box-body">
      <form action="<?php echo base_url()."/trip/create"?>" method="post"  enctype="multipart/form-data">
        <input name="traveller_id" type="hidden" class="form-control" value="<?php echo $session_data["user_id"]?>" />
        <div class="form-group has-feedback">
          <label>Destination</label>
          <div class="row">
            <div class="col-sm-10" id="search_result">
              <p>Please search destination</p>
            </div>
            <div class="col-sm-2">
              <!-- <button type="buton" class="btn btn-sm btn-info btn-flat">see detail</button> -->
            </div>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label>Title</label>
          <input name="title" type="text" class="form-control" placeholder="Title" required>
        </div>
        <div class="form-group has-feedback">
          <label>Cover Image</label>
          <input name="image" type="file" class="form-control" placeholder="Cover Image">
        </div>
        <div class="form-group has-feedback">
          <label>Description</label>
          <textarea name="description" class="form-control" rows="3" placeholder="Enter ..."></textarea>
        </div>
        <div class="form-group has-feedback">
          <label>Meet Up Point</label>
          <input name="meetup_at" type="text" class="form-control" placeholder="Gathering Place" required>
        </div>
        <div class="form-group has-feedback">
          <label>Departure</label>
          <input name="start_at" type="text" class="form-control" placeholder="Date and Time" id="datetimepicker1" required>
        </div>
        <div class="form-group has-feedback">
          <label>Arrival</label>
          <input name="end_at" type="text" class="form-control" placeholder="Date and Time" id="datetimepicker2" required>
        </div>
        <div class="form-group has-feedback">
          <label>Budget</label>
          <input name="budget" type="text" class="form-control" placeholder="Estimated Budget" required>
        </div>
        <div class="form-group has-feedback">
          <label>Quota</label>
          <input name="quota" type="text" class="form-control" placeholder="Maximum member of group" required>
        </div>
        <div class="form-group has-feedback">
          <label>Participate</label>
          <input name="participate" type="text" class="form-control" placeholder="Number of your existing party" required>
        </div>
        <div class="form-group has-feedback">
            <label>Visibility</label>
            <div >
              <input type="radio" name="visibility" value="1"> Public<br>
              <input type="radio" name="visibility" value="0"> Private<br>
            </div>
        </div>
        <div class="form-group has-feedback">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
        </div>
      </form>
    </div>
    <div class="box-footer clearfix">

    </div>
  </div>
</div>
</div>
<script>
  $(function () {
      $('#datetimepicker1').datetimepicker({
        format: 'Y-MM-DD H:m:s'
      });
      $('#datetimepicker2').datetimepicker({
        format: 'Y-MM-DD H:m:s'
      });
  });
</script>
