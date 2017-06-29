<div class="col-md-4">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Search Destination</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="box-body">
      <!-- <div class="row">
        <div class="col-md-4"> -->
            <div class="form-group">
              <label>Province</label>
              <select class="form-control">
                  <option value="">Choose</option>
                <?php
                  foreach ($province as $key => $value) {
                ?>
                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                <?php  }
                 ?>
              </select>
            </div>
            <div class="form-group">
              <label>City</label>
              <select class="form-control">
                <option>option 1</option>
                <option>option 2</option>
                <option>option 3</option>
                <option>option 4</option>
                <option>option 5</option>
              </select>
            </div>
            <div class="form-group">
              <label>Area</label>
              <select class="form-control">
                <option>option 1</option>
                <option>option 2</option>
                <option>option 3</option>
                <option>option 4</option>
                <option>option 5</option>
              </select>
            </div>
        <!-- </div>
      </div> -->
    </div>
    <div class="box-footer clearfix">
      <button type="button" class="btn btn-sm btn-info btn-flat">go</button>
      <button type="button" class="btn btn-sm btn-warning btn-flat">clear</button>
    </div>
  </div>
</div>
