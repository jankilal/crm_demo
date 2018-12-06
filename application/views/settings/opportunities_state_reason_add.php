<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Opportunities State Reason <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>settings/opportunitiesStateReason">Opportunities State Reason</a></li>
         <li class="active">Opportunities State Reason Add</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Add Opportunities State Reason</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>settings/opportunitiesStateReason" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data">
                     <fieldset>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Opportunities State<span class="text-danger"> *</span></label>
                                <select name="opportunities_state" class="form-control">

                                      <option value="open">Open</option>
                                      <option value="won">Won</option>
                                      <option value="abandoned">Abandoned</option>
                                      <option value="suspended">Suspended</option>
                                      <option value="lost">Lost</option>
                                 </select>
                                 <?php echo form_error('opportunities_state','<span class="text-danger">','</span>'); ?>
                              </div>            
                              <div class="col-md-6 col-sm-6">
                                 <label>Opportunities State Reason<span class="text-danger"> *</span></label>
                                 <input name="opportunities_state_reason" class="form-control" type="text" id="opportunities_state_reason" value="<?php echo set_value('opportunities_state_reason'); ?>" />
                                 <?php echo form_error('opportunities_state_reason','<span class="text-danger">','</span>'); ?>
                              </div>                             
                                                        
                           </div>
                        </div>  
                        <div class="row">
                           <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                 <label>Status</label>
                                 <select name="opportunities_state_reason_status" class="form-control">
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
                         <div class="col-md-1">
                           <a href="<?php echo base_url();?>settings/opportunitiesStateReason"  type="submit" class="btn btn-danger margin-top-30 ">Cancel</a>
                        </div>
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
