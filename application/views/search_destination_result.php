<div class="box-body">
  <table class="table table-responsive no-padding">
    <tbody>
      <tr>
        <th>#</th>
        <th>Destinations</th>
        <th>Open Day</th>
        <th>Open Gate</th>
        <th>Price</th>
        <th>Action</th>
      </tr>
      <?php
      $index = 1;
      if($destinations != NULL){
        foreach ($destinations as $key => $value) {
         ?>
        <tr>
          <td><?php echo $index;?></td>
          <td><?php echo $value->name;?></td>
          <td><?php echo get_day_label($value->opening_day);?></td>
          <td><?php echo $value->opening_gate;?></td>
          <td><?php echo $value->price;?></td>
          <td><button type="button" class="btn btn-sm btn-info btn-flat">more</button>
            <button type="button" class="btn btn-sm btn-warning btn-flat">select</button>
          </td>
        </tr>
      <?php $index++;
        }
      }else{
        ?>
        <tr><td colspan="6">
          <center>no data</center>
        </td></tr>
    <?php
    }?>
    </tbody>
  </table>
</div>
