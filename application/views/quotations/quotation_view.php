<?php
  $back_url = (isset($back_action)) ? $back_action : 'quotations';
?>
<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Quotation Details</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Quotations </li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading">
            <span class="title elipsis">
            <strong>Quotation Details</strong> 
            </span>

            <div class="pull-right box-tools">
                <a href="<?php echo base_url($back_url);?>" class="btn btn-teal btn-sm">Back</a>
            </div>
         </div>
         <!-- panel content -->
         <div class="panel-body">
        <div id="msg_div">
            <?php echo $this->session->flashdata('message');?>
        </div>
         <table class="table table-striped table-bordered table-hover"  id="sample_1">
              <thead>
              </thead>
              <tbody>
                <?php
                if(!empty($quote_details))
                {
                  foreach($quote_details as $res)
                  {
                    ?>
                    <tr>
                       <th>Quotation Name</th>
                       <td><?= $res->quote_name; ?></td>
                    </tr>
                    <tr>
                       <th>Quotation Version</th>
                       <td><?= $res->quote_version; ?></td>
                    </tr>
                    <tr>
                       <th>Quotation Submition Date</th>
                       <td><?= $res->submition_date; ?></td>
                    </tr>
                    <tr>
                       <th>Quotation Subtotal</th>
                       <td><?= $res->quote_subtotal; ?></td>
                    </tr>
                    <tr>
                       <th>Quotation To</th>
                       <td><?= $res->quote_to; ?></td>
                    </tr>
                    <tr>
                       <th>Subject</th>
                       <td><?= $res->subject; ?></td>
                    </tr>
                    <tr>
                       <th>Address</th>
                       <td><?= $res->address1.', '.$res->address2.', '.$res->location.', '.$res->city; ?></td>
                    </tr>
                    <tr>
                       <th>Additional Requirement</th>
                       <td><?= $res->additional_req; ?></td>
                    </tr>
                    <tr>
                       <th>Terms & Conditions</th>
                       <td><?= $res->terms_conditions; ?></td>
                    </tr>
                    <?php
                    }
                }
                ?>                       
              </tbody> 
          </table>
              <div class="panel panel-info shadow-none">
                <div class="panel-heading">Quotation Products</div>
              </div>
              <table class="table table-striped table-bordered table-hover" id="sample_1">
                <tr>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Qty.</th>
                    <th>Sub Total</th>
                </tr>
                <?php 
                if(!empty($product_details))
                {
                    foreach ($product_details as $pd_val) 
                    {
                      ?>
                        <tr>
                           <td><?= $pd_val->product_name; ?></td>
                           <td><?= $pd_val->product_desc; ?></td>
                           <td><?= round($pd_val->product_price,2); ?></td>
                           <td><?= $pd_val->product_qty; ?></td>
                           <td><?= round($pd_val->product_qty*$pd_val->product_price,2); ?></td>
                         </tr>
                      <?php
                    }
                }
                ?>
              </table>
         </div>
         <!-- /panel content -->
         <!-- panel footer -->
         <div class="panel-footer">        
         </div>  
         <!-- /panel footer -->
      </div>
   </div>
</section>
<!-- /MIDDLE -->