<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Department <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>settings/department">Department</a></li>
         <li class="active">Department Add</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Add Department</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>settings/department" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data">
                     <fieldset>
                        <div class="row">
                           <div class="form-group">     
                             <!--  <div class="col-md-6 col-sm-6">
                                 <label>Company<span class="text-danger"> *</span></label>
                                 <select name="company_id" class="form-control">
                                    <?php
                                    foreach ($company_list as $com_res) 
                                    {
                                       ?>
                                       <option value="">Select Company</option>
                                       <option value="<?php echo $com_res->user_id ?>"><?php echo $com_res->user_full_name ; ?></option>
                                       <?php
                                    }
                                    ?>
                                 </select>
                              </div>   -->
                              <div class="col-md-6 col-sm-6">
                                 <label>Department Name<span class="text-danger"> *</span></label>
                                 <input name="deptname" class="form-control" type="text" id="deptname" value="<?php echo set_value('deptname'); ?>" />
                                 <?php echo form_error('deptname','<span class="text-danger">','</span>'); ?>
                              </div>  
                              <div class="col-md-6 col-sm-6">
                                 <label>Status</label>
                                 <select name="department_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                 </select>
                           </div>                     
                           </div>
                        </div>       
                     </fieldset>
                     <div class="row">
                        <div class="col-md-1">
                           <button type="submit" name="Submit" value="Add" class="btn btn-teal margin-top-30 ">Submit</button>
                        </div>
                        <div class="col-md-1">
                           <a href="<?php echo base_url();?>settings/department"  type="submit" class="btn btn-danger margin-top-30 ">Cancel</a>
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
