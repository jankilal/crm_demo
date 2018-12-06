<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Stages <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>settings/Stages">Stages</a></li>
         <li class="active">Stages Add</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Add Stages</strong>
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
                                 <label>Stages Name<span class="text-danger"> *</span></label>
                                  <input name="stageName" class="form-control" type="text" id="stageName" value="<?php echo set_value('stageName'); ?>" />
                                 <?php echo form_error('stageName','<span class="text-danger">','</span>'); ?>
                              </div>  
                              <div class="col-md-6 col-sm-6">
                                 <label>Stage Description<span class="text-danger"> *</span></label>
                                 <input name="stageDescription" class="form-control" type="text" id="stageDescription" value="<?php echo set_value('stageDescription'); ?>" />
                                 <?php echo form_error('stageDescription','<span class="text-danger">','</span>'); ?>
                              </div>  
                              <div class="col-md-6 col-sm-6">
                                 <label>Status</label>
                                 <select name="status" class="form-control">
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
                            <a href=" <?php echo base_url().'settings/stages';?>"class="btn btn-danger margin-top-30">Cancel</a>
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
