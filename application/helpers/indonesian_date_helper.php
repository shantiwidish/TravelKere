<?php
function get_day_label($day){
  switch ($day) {
    case "1":
      return "senin";
      break;
    case "2":
      return "selasa";
      break;
    case "3":
      return "rabu";
      break;
    case "4":
      return "kamis";
      break;
    case "5":
      return "jumat";
      break;
    case "6":
      return "sabtu";
      break;
    case "7":
      return "minggu";
      break;
    default:
      # code...
      break;
  }
}
?>
