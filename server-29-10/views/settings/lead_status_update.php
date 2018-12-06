<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Lead Status <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>settings/leadStatus">Lead Status</a></li>
         <li class="active">Lead Status Edit</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Edit Lead Status</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>settings/leadStatus" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data">
                     <fieldset>
                     <?php
                     foreach ($edit_lead_status as $ls_val)
                     {
                     ?>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-4 col-sm-4">
                                 <label>Lead Status Name<span class="text-danger"> *</span></label>
                                 <input name="lead_status" class="form-control" type="text" id="lead_status" value="<?php echo $ls_val->lead_status; ?>" />
                                 <?php echo form_error('lead_status','<span class="text-danger">','</span>'); ?>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                 <label>Lead Status Type</label>
                                 <select name="lead_type" class="form-control">
                                    <option <?php if($ls_val->lead_type == 'close'){ echo "selected"; } ?> value="close">Close</option>
                                    <option <?php if($ls_val->lead_type == 'open'){ echo "selected"; } ?> value="open">Open</option>
                                 </select>
                                <?php echo form_error('lead_type','<span class="text-danger">','</span>'); ?>
                              </div> 
                           <div class="col-md-4 col-sm-4">
                                 <label>Status</label>
                                 <select name="lead_status_status" class="form-control">
                                    <option <?php if($ls_val->lead_status_status == '1'){ echo "selected"; } ?> value="1">Active</option>
                                    <option <?php if($ls_val->lead_status_status == '0'){ echo "selected"; } ?> value="0">Inactive</option>
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
                            <a href="<?php echo base_url();?>settings/leadStatus" class="btn btn-danger margin-top-30 ">Cancel</a>  
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
