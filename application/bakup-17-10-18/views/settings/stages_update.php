<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Department <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>settings/stages">Stages</a></li>
         <li class="active">Stages Update</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Update Stages</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>settings/stages" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data">
                     <fieldset>
                        <div class="row">
                           <div class="form-group">     
                              <div class="col-md-6 col-sm-6">
                                 <label>Stage Name<span class="text-danger"> *</span></label>
                                 <input name="stage_name" class="form-control" type="text" id="stage_name" value="<?php echo $edit_stages->stage_name; ?>" />
                                 <?php echo form_error('stage_name','<span class="text-danger">','</span>'); ?>
                              </div> 
                              <div class="col-md-6 col-sm-6">
                                 <label>Stage Description<span class="text-danger"> *</span></label>
                                 <input name="stage_description" class="form-control" type="text" id="stage_description" value="<?php echo $edit_stages->stage_description; ?>" />
                                 <?php echo form_error('stage_description','<span class="text-danger">','</span>'); ?>
                              </div>  
                              <div class="col-md-6 col-sm-6">
                                 <label>Status</label>
                                  <select name="status" id="status" class="form-control">
                                     <option <?php if($edit_stages->status == '1'){ echo "selected";} ?> value="1">Active</option>
                                     <option value="0" <?php if($edit_stages->status == '0'){ echo "selected";} ?>>Inactive</option>
                                 </select>
                           </div>                                                                   
                           </div>
                        </div>       
                     </fieldset>
                     <div class="row">
                        <div class="col-md-1">
                           <button type="submit" name="Submit" value="Edit" class="btn btn-teal margin-top-30">Submit</button>
                        </div>
                        <div class="col-md-1">
                           <a href="<?php echo base_url();?>settings/stages" class="btn btn-danger margin-top-30">Cancel</a> 
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
