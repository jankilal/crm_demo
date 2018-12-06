<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Payment Methods <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>settings/paymentMethods">Payment Methods</a></li>
         <li class="active">Payment Methods Add</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Add Payment Methods</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>settings/paymentMethods" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data">
                     <fieldset>
                        <div class="row">
                           <div class="form-group">     
                              <div class="col-md-6 col-sm-6">
                                 <label>Payment Method Name<span class="text-danger"> *</span></label>
                                 <input name="method_name" class="form-control" type="text" id="method_name" value="<?php echo set_value('method_name'); ?>" />
                                 <?php echo form_error('method_name','<span class="text-danger">','</span>'); ?>
                              </div>  
                              <div class="col-md-6 col-sm-6">
                                 <label>Status</label>
                                 <select name="payment_methods_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                 </select>
                           </div>                            
                                                        
                           </div>
                        </div>  
                                     
                     </fieldset>
                     <div class="row">
                        <div class="col-md-1">
                           <button type="submit" name="Submit" value="Add" class="btn btn-teal margin-top-30">Submit</button>
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
