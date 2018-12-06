<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Lead Status <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>settings/leadStatus">Lead Status</a></li>
         <li class="active">Lead Status Add</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Add Lead Status</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>settings/leadStatus" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data">
                     <fieldset>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-4 col-sm-4">
                                 <label>Lead Status Name<span class="text-danger"> *</span></label>
                                 <input name="lead_status" class="form-control" type="text" id="lead_status" value="<?php echo set_value('lead_status'); ?>" />
                                 <?php echo form_error('lead_status','<span class="text-danger">','</span>'); ?>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                 <label>Lead Status Type</label>
                                 <select name="lead_type" class="form-control">
                                    <option value="close">Close</option>
                                    <option value="open">Open</option>
                                 </select>
                                <?php echo form_error('lead_type','<span class="text-danger">','</span>'); ?>
                              </div> 
                           <div class="col-md-4 col-sm-4">
                                 <label>Status</label>
                                 <select name="lead_status_status" class="form-control">
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
                           <button type="submit" class="btn btn-danger margin-top-30 ">Cancel</button>
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
