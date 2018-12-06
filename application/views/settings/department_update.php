<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Department <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>settings/department">Department</a></li>
         <li class="active">Department Edit</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Edit Department</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>settings/department" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data">
                     <fieldset>
                     <?php
                     foreach ($edit_department as $d_val) 
                     {

                     ?>
                        <div class="row">
                           <div class="form-group">     
                              <div class="col-md-6 col-sm-6">
                                 <label>Department Name<span class="text-danger">*</span></label>
                                 <input name="deptname" class="form-control" type="text" id="deptname" value="<?php echo $d_val->deptname; ?>" />
                                 <?php echo form_error('deptname','<span class="text-danger">','</span>'); ?>
                              </div>  
                              <div class="col-md-6 col-sm-6">
                                 <label>Status</label>
                                 <select name="department_status" class="form-control">
                                    <option <?= ($d_val->department_status == '1') ? 'selected' : ''; ?> value="1">Active</option>
                                    <option <?= ($d_val->department_status == '0') ? 'selected' : ''; ?> value="0">Inactive</option>
                                 </select>
                           </div>                            
                                                        
                           </div>
                        </div>  
                        <?php }?>
                                     
                     </fieldset>
                     <div class="row">
                        <div class="col-md-1">
                           <button type="submit" name="Submit" value="Edit" class="btn btn-teal margin-top-30">Submit</button>
                        </div>
                        <div class="col-md-1">
                           <a type="submit" href="<?php echo base_url();?>settings/department"  class="btn btn-danger margin-top-30 ">Cancel</a> 
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
