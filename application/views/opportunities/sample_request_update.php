<style type="text/css">
   .ui-slider-range
   {
      background:green;
   }

   .ui-slider-horizontal .ui-slider-handle
   {
      top: -1px;
   }

</style>
<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Sample Request <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>sampleRequest">Sample Request</a></li>
         <li class="active">Sample Request Edit</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
   <?php
   foreach ($request_details as $sr_val) 
   {
    // $sample_request = json_decode($sr_val->sample_request);
   ?>
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                 <!--  <strong>Add Opportunities</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>opportunities" class="btn btn-teal btn-sm">Back</a>                           
                  </div> -->
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
                     <fieldset>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Opportunities Name</label>
                                 <input readonly name="Opportunities_name" class="form-control" type="text" id="opportunities_name" value="<?php echo $sr_val->lead_name; ?>" />
                                 <?php echo form_error('Opportunities_name','<span class="text-danger">','</span>'); ?>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Order Date</label>
                                 <input type="text" name="order_date" readonly class="form-control" value="<?= $sample_request->order_date; ?>">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6 project">
                                 <label>Delivery Date</label>
                                 <input type="text" name="delivery_date" class="form-control datepicker" value="<?= $sample_request->delivery_date; ?>">                       
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Approve Status</label>
                                 <select name="approve_status" class="form-control">
                                   <option value="Pending" <?php if($sample_request->approve_status == 'Pending'){ echo "selected";} ?> >Pending</option>
                                   <option value="Approve" <?php if($sample_request->approve_status == 'Approve'){ echo "selected";} ?> >Approve</option>
                                   <option value="Rejected" <?php if($sample_request->approve_status == 'Rejected'){ echo "selected";} ?> >Rejected</option>
                                 </select>
                              </div>
                           </div>
                        </div>                
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-12 col-sm-12">
                                 <label>Details</label>
                                 <textarea class="form-control" rows="5" name="product_details" ><?php echo $sr_val->product_details; ?></textarea>
                              </div>
                           </div>
                        </div>
                      <?php
                      }
                      ?>
                    </div>
                     </fieldset>
                     <div class="row">
                        <div class="col-md-1">
                           <button type="submit" name="Submit" value="Edit" class="btn btn-teal margin-top-30">Submit</button>
                        </div>
                        <div class="col-md-1">
                           <button type="submit" class="btn btn-danger margin-top-30 margin-left-30">Cancel</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- /MIDDLE -->