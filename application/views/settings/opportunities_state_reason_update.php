<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Opportunities State Reason <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>settings/opportunitiesStateReason">Opportunities State Reason</a></li>
         <li class="active">Opportunities State Reason Edit</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Edit Opportunities State Reason</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>settings/opportunitiesStateReason" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data">
                     <fieldset>
                     <?php
                     foreach ($edit_opportunities_state_reason as $ops_val) 
                     {
                     ?>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Opportunities State<span class="text-danger"> *</span></label>
                                <select name="opportunities_state" class="form-control">

                                      <option <?php if($ops_val->opportunities_state == 'open'){ echo "selected"; } ?> value="open">Open</option>
                                      <option <?php if($ops_val->opportunities_state == 'won'){ echo "selected"; } ?> value="won">Won</option>
                                      <option <?php if($ops_val->opportunities_state == 'abandoned'){ echo "selected"; } ?> value="abandoned">Abandoned</option>
                                      <option <?php if($ops_val->opportunities_state == 'suspended'){ echo "selected"; } ?> value="suspended">Suspended</option>
                                      <option <?php if($ops_val->opportunities_state == 'lost'){ echo "selected"; } ?> value="lost">Lost</option>
                                 </select>
                                 <?php echo form_error('opportunities_state','<span class="text-danger">','</span>'); ?>
                              </div>            
                              <div class="col-md-6 col-sm-6">
                                 <label>Opportunities State Reason<span class="text-danger"> *</span></label>
                                 <input name="opportunities_state_reason" class="form-control" type="text" id="opportunities_state_reason" value="<?php echo $ops_val->opportunities_state_reason; ?>" />
                                 <?php echo form_error('opportunities_state_reason','<span class="text-danger">','</span>'); ?>
                              </div>                             
                                                        
                           </div>
                        </div>  
                        <div class="row">
                           <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                 <label>Status</label>
                                 <select name="opportunities_state_reason_status" class="form-control">
                                    <option <?php if($ops_val->opportunities_state_reason_status == '1'){ echo "selected"; } ?> value="1">Active</option>
                                    <option <?php if($ops_val->opportunities_state_reason_status == '0'){ echo "selected"; } ?> value="0">Inactive</option>
                                 </select>
                              </div> 
                           </div>
                        </div>   
                     <?php
                     }
                     ?>                  
                     </fieldset>
                     <div class="row">
                        <div class="col-md-1">
                           <button type="submit" name="Submit" value="Edit" class="btn btn-teal margin-top-30">Submit</button>
                        </div>
                        <div class="col-md-1">
                          <a href="<?php echo base_url();?>settings/opportunitiesStateReason"  type="submit" class="btn btn-danger margin-left-10 margin-top-30 ">Cancel</a>
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
