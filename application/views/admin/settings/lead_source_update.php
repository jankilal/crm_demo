<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Lead source <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>settings/leadSource">Lead source</a></li>
         <li class="active">Lead source Add</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Add Lead source</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>settings/leadSource" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data">
                     <fieldset>
                     <?php
                     foreach ($edit_lead_source as $ls_val) 
                     {
                     
                     ?>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Lead source Name<span class="text-danger"> *</span></label>
                                 <input name="lead_source" class="form-control" type="text" id="lead_source" value="<?php echo $ls_val->lead_source; ?>" />
                                 <?php echo form_error('lead_source','<span class="text-danger">','</span>'); ?>
                              </div>                             
                              <div class="col-md-6 col-sm-6">
                                 <label>Status</label>
                                 <select name="lead_source_status" class="form-control">
                                    <option <?php if($ls_val->lead_source_status == '1'){ echo "selsect"; } ?> value="1">Active</option>
                                    <option <?php if($ls_val->lead_source_status == '0'){ echo "selsect"; } ?> value="0">Inactive</option>
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
