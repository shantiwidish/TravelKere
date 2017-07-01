
    <option value="">Choose Destination</option>
  <?php
    foreach ($destinations as $key => $value) {
  ?>
  <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
  <?php  }
   ?>

<?php
$js_destinations = json_encode($destinations);
echo "<script>";
echo "var js_destinations = ". $js_destinations . ";\n";
echo "</script>";
?>
