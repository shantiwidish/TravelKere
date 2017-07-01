<div class="row">
  <?php
  $index = 0;
  foreach ($data_trip["trip_list"] as $key => $value) {
  ?>
  <div class="col-md-3">
    <!-- Box Comment -->
    <div class="box box-widget">
      <div class="box-header with-border">
        <div class="user-block">
          <img class="img-circle" src="<?php echo base_url()."assets/images/upload/".$value["image"]?>" alt="User Image">
          <?php if(strlen($value["title"])>30){
            $title = substr($value["title"],0,25)."...";
          }else{
            $title = $value["title"];
          }?>
          <span class="username"><?php echo $title;?></span>
          <span class="description"><a href="<?php echo base_url()."member/trip/".$value["traveller_id"]; ?>"><?php echo $value["fullname"]?></a></span>
        </div>
        <!-- /.user-block -->
        <!-- /.box-tools -->
        <div>
          <ul class="nav nav-stacked">
            <li><a href="#">Date <span class="pull-right badge bg-yellow">
              <?php echo DateTime::createFromFormat('Y-m-d H:i:s', $value['start_at'])->format('Y-m-d')?></span></a></li>
            <li><a href="#">Price <span class="pull-right badge bg-blue">Rp.<?php echo number_format($value["budget"])?></span></a></li>
            <li><a href="#">Quota <span class="pull-right badge bg-aqua"><?php echo $value["quota"]?></span></a></li>
            <li><a href="#">Availability <span class="pull-right badge bg-green"><?php echo $value["quota"] - $data_trip["trip_group"][$value["id"]]["participate"]?></span></a></li>
            <?php
            $date1 = new DateTime($value["start_at"]);
            $date2 = new DateTime($value["end_at"]);
            $diff = $date2->diff($date1)->format("%a");
             ?>
            <li><a href="#">Duration <span class="pull-right badge bg-red"><?php echo $diff+1;?> days</span></a></li>
          </ul>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body" id="detailBody<?php echo $index;?>" style="display: none;">
        <h4><?php echo $value["title"];?></h4>
        <?php if($value["cover_image"] != "" && $value["cover_image"] != NULL){?>
          <img class="img-responsive pad" src="<?php echo base_url()."assets/images/upload/".$value["cover_image"]?>" alt="Photo">
        <?php } ?>
        <p><?php echo $value["description"];?></p>
        <p><?php echo "<b>Meet Up Point</b>".$value["meetup_at"];?></p>
        <p><?php echo "<b>Contact Info :</b> ".$value["phone_number"];?></p>
        <span class="pull-right text-muted"><?php echo $data_trip["trip_group"][$value["id"]]["count_member"]?> member join this trip</span>
          <ul class="users-list clearfix">
            <?php
            $ids_member = array();
            foreach ($data_trip["trip_group"][$value["id"]]["member"] as $key => $trip_group) {
              array_push($ids_member, $trip_group["traveller_id"]);
              ?>
              <li>
                <img class="img-circle" src="<?php echo base_url()."assets/images/upload/".$trip_group["image"]?>" alt="User Image">
                <a class="users-list-name" href="#"><?php echo substr($trip_group["fullname"],0,10);?></a>
                <span class="users-list-date">Today</span>
              </li>
          <?php  }?>
          </ul>
          <!-- /.users-list -->
          <!-- <div class="row"> -->
          <?php if(!in_array($session_data["user_id"],$ids_member)){?>
            <form action="<?php echo base_url()."/trip/joinTrip"?>" method="post">
              <label>Lets journey together!</label>
              <input name="traveller_id" type="hidden" class="form-control" value="<?php echo $session_data["user_id"]?>" />
              <input name="trip_id" type="hidden" class="form-control" value="<?php echo $value["id"]?>" />
              <input name="destination_id" type="hidden" class="form-control" value="<?php echo $value["destination_id"]?>" />
              <div class="form-group has-feedback">
                <input name="participate" type="text" class="form-control" placeholder="Number of party" required/>
              </div>
              <div class="form-group has-feedback">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Join</button>
              </div>
            </form>
          <?php }else{?>
            <form action="<?php echo base_url()."/trip/cancelTrip"?>" method="post">
              <input name="traveller_id" type="hidden" class="form-control" value="<?php echo $session_data["user_id"]?>" />
              <input name="trip_id" type="hidden" class="form-control" value="<?php echo $value["id"]?>" />
              <input name="destination_id" type="hidden" class="form-control" value="<?php echo $value["destination_id"]?>" />
              <div class="form-group has-feedback">
                <button type="submit" class="btn btn-danger btn-block btn-flat">Cancel Trip</button>
              </div>
            </form>
          <?php }?>
          <!-- </div> -->
        </div>
      <!-- /.box-body -->
      <!-- /.box-footer -->
      <div class="box-footer">
        <div class="form-group has-feedback">
          <button type="button" class="btn btn-primary btn-block btn-flat" id="btnToggle<?php echo $index;?>" onclick="showDetail(<?php echo $index;?>)">Expand</button>
        </div>
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box -->
  </div>
  <?php
  $index++;
}?>
</div>
<script>
function showDetail(index){
  id="#detailBody"+index;
  btn = "#btnToggle"+index;
  if($(id).is( ":hidden" )){
    $("[id^='detailBody']").hide();
    $("[id^='btnToggle']").html("Expand");
    $("[id^='btnToggle']").prop('class', "btn btn-primary btn-block btn-flat");
    $( id ).slideDown( "slow" );
    $(btn).html("Hide");
    $(btn).prop('class', "btn btn-warning btn-block btn-flat");
  }else{
    $( id ).hide();
    $(btn).html("Expand");
    $(btn).prop('class', "btn btn-primary btn-block btn-flat");
  }
}
</script>
