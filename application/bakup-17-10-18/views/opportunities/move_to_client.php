<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Move To Client Process <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>opportunities">Move To Client Process</a></li>
         <li class="active">Move To Client Process</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Move To Client Process</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>opportunities" class="btn btn-teal btn-sm">Back</a>             
                  </div>
               </div>
               <div class="panel-body">
                  <form method="POST">
                  <h3>Preview Quotation Details</h3>
                  <table class="table table-striped table-bordered table-hover" id="sample_1">
                     <thead>
                        <tr>
                           <th>Quote Name</th>
                           <th>Quote No.</th>
                           <th>Quote To</th>
                           <th>Date</th>
                           <th>Address</th>
                           <th>Price</th>
                           <th>Approve</th>
                        </tr>
                     </thead>
                     <tbody>
                     <?php
                     if(!empty($quotation_list))
                     {
                        $subtotal = 0;
                        foreach($quotation_list as $res)
                        {
                           $subtotal = 0;
                           $products = $this->comman_model->getData('tbl_quotation_products' , array('quote_id' => $res->quote_id));
                           foreach ($products as $p_res) 
                           {
                              $subtotal = $subtotal+($p_res->product_price*$p_res->product_qty);
                           }
                           ?>
                           <tr>
                              <td><?php echo $res->quote_name; ?></td>
                              <td><?php echo $res->quote_version; ?></td>
                              <td><?php echo $res->quote_to; ?></td>
                              <td><?php echo $res->submition_date; ?></td>
                              <td><?php echo $res->address1.' '.$res->location.' '.$res->city; ?></td>
                              <td><?php echo $subtotal; ?></td>
                              <td width="5%">
                                 <input type="checkbox" class="checkboxes" name="approve_products[]" value="<?= $res->quote_id; ?>" />
                              </td>
                           </tr>
                           <?php
                        }
                     }
                     ?>    
                     </tbody>
                  </table>
                  <div class="row">
                     <div class="col-md-1">
                        <button type="submit" name="move_to_client" value="Move" class="btn btn-teal margin-top-30">Submit</button>
                     </div>
                     <div class="col-md-1">
                        <button type="submit" class="btn btn-danger  margin-top-30 margin-left_10">Cancel</button>
                     </div>
                  </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>