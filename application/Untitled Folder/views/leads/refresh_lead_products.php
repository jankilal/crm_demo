<?php
$i =1;
foreach ($addedProduct as $res) 
{
   $temp_added_item_arr[] = $res->product_id;
   ?>
   <tr class="odd gradeX">
      <td><?= $i ?></td>
      <td><?= $res->product_name; ?></td>
      <td><?= $res->product_price; ?></td>
      <td><?= $res->product_desc; ?></td>
      <td><button class="btn btn-sm btn-danger" onclick="removeAddedProduct(this , '<?= $res->lead_product_id; ?>')" type="button"><i class="fa fa-remove"></i></button></td>
   </tr>
   <?php
   $i++;
}
?>