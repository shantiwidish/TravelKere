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
        <div class="form-group">
          <label>Province</label>
          <select class="form-control" id="province">
              <option value="">Choose Province</option>
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
          <select class="form-control"  id="city">
            <option value="">Choose City</option>
          </select>
        </div>
        <div class="form-group">
          <label>Area</label>
          <select class="form-control"  id="area">
            <option value="">Choose Area</option>
          </select>
        </div>
    </div>
    <div class="box-footer clearfix">
      <button type="button" class="btn btn-sm btn-info btn-flat" id="search">go</button>
      <button type="button" class="btn btn-sm btn-warning btn-flat" id="search_clear">clear</button>
    </div>
  </div>
</div>
<?php
$js_province_city = json_encode($city);
$js_city_area = json_encode($area);
echo "<script>";
echo "var js_province_city = ". $js_province_city . ";\n";
echo "var js_city_area = ". $js_city_area . ";\n";
echo "</script>";
?>
<script>
function search(keyword){
  ///trip/search_destination/
  var get_url = "<?php echo base_url();?>/trip/search_destination/"+keyword;
  // alert(get_url);
  $.ajax({
  method: "GET",
  url: get_url
  }).done(function(data) {
    $("#search_result").html(data);
  });
}

function clear(){
  $("#province").empty();
  $("#province").append(
    "<option value=''>Choose Province</option"
  );
  $("#city").empty();
  $("#city").append(
    "<option value=''>Choose City</option"
  );
  $("#area").empty();
  $("#area").append(
    "<option value=''>Choose Area</option"
  );
}

$( document ).ready(function() {
  $("#search").click(function(){
    search($("#area").find(":selected").text());
  });
  $("#search_clear").click(function(){
    clear();
  });
  $("#province").change(function() {
    province_selected = $(this).val();
    $("#city").empty();
    $("#city").append(
      "<option value=''>Choose City</option"
    );
    for (entry in js_province_city[province_selected]){
      $("#city").append(
        "<option value='"+js_province_city["DKI Jakarta"][entry]+"'>"+js_province_city["DKI Jakarta"][entry]+"</option"
      );
    }
    // js_province_city[province_selected].forEach(function(entry) {
    //   $("#city").append(
    //     "<option value='"+entry+"'>"+entry+"</option"
    //   );
    // });
  });

  $("#city").change(function() {
    city_selected = $(this).val();
    $("#area").empty();
    $("#area").append(
      "<option value=''>Choose Area</option"
    );
    js_city_area[city_selected].forEach(function(entry) {
      $("#area").append(
        "<option value='"+entry+"'>"+entry+"</option"
      );
    });
  });

});
</script>
