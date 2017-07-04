<div class="col-md-12">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Search Trip</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-4">
            <div class="form-group">
              <label>Location</label>
              <select class="form-control" id="area" name="area">
                <option value="0">Choose Location</option>
                <?php
                // var_dump($locations[0]);die();
                foreach ($locations as $key => $value) {?>
                  <option value="<?php echo $value->area;?>"><?php echo $value->area;?></option>
                <?php }?>
              </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
              <label>Budget</label>
              <select class="form-control" id="budget" name="budget">
                <option value="0">Choose budget</option>
                <option value="1"> < Rp. 100.000</option>
                <option value="2">Rp. 100.000 - Rp 500.000</option>
                <option value="3">Rp. 500.000 - Rp. 1.000.000</option>
                <option value="4"> > Rp. 1.000.000</option>
              </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
              <label>Days</label>
              <select class="form-control" id="day" name="day">
                <option value="0">Choose days</option>
                <option value="1"> 1 day</option>
                <option value="2"> 2 days</option>
                <option value="3"> 3 days</option>
                <option value="4"> > 3 days</option>
              </select>
            </div>
        </div>
      </div>
    </div>
    <div class="box-footer clearfix">
      <button type="submit" class="btn btn-sm btn-info btn-flat"  id="search_trip">go</button>
      <button type="button" class="btn btn-sm btn-warning btn-flat" id="search_clear">clear</button>
    </div>
  </div>
</div>
<script>
$("#search_clear").click(function(){
  $("option:selected").prop("selected", false);
});
$("#search_trip").click(function(){
  base_url = "<?php echo base_url();?>";
  url = base_url+"trip/searchTrip?area="+$("#area").val()+"&budget="+$("#budget").val()+"&day="+$("#day").val();
  // alert(url);
  window.location = url;
});
</script>
