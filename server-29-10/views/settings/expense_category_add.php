<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Expense Category <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>settings/expenseCategory">Expense Category</a></li>
         <li class="active">Expense Category Add</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Add Expense Category</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>settings/expenseCategory" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data">
                     <fieldset>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Expense Category Name<span class="text-danger"> *</span></label>
                                 <input name="expense_category" class="form-control" type="text" id="expense_category" value="<?php echo set_value('expense_category'); ?>" />
                                 <?php echo form_error('expense_category','<span class="text-danger">','</span>'); ?>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Status</label>
                               <select name="expense_category_status" class="form-control">
                                 <option value="1">Active</option>
                                 <option value="0">Inactive</option>
                               </select>
                              </div>                             
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-12 col-sm-12">
                                 <label>Description</label>
                                 <textarea class="form-control" name="description" rows="4"><?php echo set_value('description'); ?></textarea>
                              </div>
                           </div>
                        </div>
                     </fieldset>
                     <div class="row">
                        <div class="col-md-1">
                           <button type="submit" name="Submit" value="Add" class="btn btn-teal margin-top-30">Submit</button>
                        </div>
                        <div class="col-md-1">
                           <a type="submit" href="<?php echo base_url();?>settings/expenseCategory" class="btn btn-danger margin-top-30 ">Cancel</a>
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
