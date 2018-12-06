<style type="text/css">
   .ui-slider-range
   {
      background:green;
   }

   .ui-slider-horizontal .ui-slider-handle
   {
      top: -1px;
   }
</style>
<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Task <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>task">Task</a></li>
         <li class="active">Task Add</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Add Task</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>task" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
                     <fieldset>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Task Name<span class="text-danger"> *</span></label>
                                 <input name="task_name" class="form-control" type="text" id="task_name" value="<?php echo set_value('task_name'); ?>" />
                                 <?php echo form_error('task_name','<span class="text-danger">','</span>'); ?>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Related To<span class="text-danger"> *</span></label>
                                  <select name="related_to" class="form-control" id="check_related"
                                  onchange="get_related_moduleName(this.value)">
                                    <option value="0">None</option>
                                    <option <?php if($action_type == 'Item'){
                                      echo "selected";
                                      }; ?> value="Item">Item</option>
                                    <option <?php if($action_type == 'Opportunities'); ?> value="Opportunities"><?= lang('opportunities') ?></option>
                                    <option <?php if($action_type == 'Task'){
                                      echo "selected";
                                      }; ?> value="Task">Task</option>
                                    <option <?php if($action_type == 'Leads'){
                                      echo "selected";
                                      }; ?> value="Leads">leads</option> 
                                    <option <?php if($action_type == 'Goal'){
                                      echo "selected";
                                      }; ?> value="Goal">Goal Tracking</option>
                                  </select>
                                 <?php echo form_error('related_to','<span class="text-danger">','</span>'); ?>
                              </div>
                           </div>
                        </div>
                        <span id="related_to_module"></span>
                     

                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Start Date</label>
                                 <input type="text" name="task_start_date" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false">
                                 <?php echo form_error('task_start_date','<span class="text-danger">','</span>'); ?>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Due Date</label>
                                 <input type="text" name="due_date" class="form-control datepicker" value="" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false">
                                 <?php echo form_error('due_date','<span class="text-danger">','</span>'); ?>
                              </div>
                           </div>
                        </div>
                         <div class="row">
                         <div class="form-group">
                            <div class="col-md-6 col-sm-6 project">
                               <label>Probability Of Winning %</label>
                               <div class="bar"></div>
                               <p class="percent">0%</p>
                               <input type="hidden" name="task_progress" id="probability" value="0">                       
                            </div>
                           <div class="col-md-6 col-sm-6">
                                 <label>Estimated Hour <span class="text-danger"> *</span></label>
                                  <input type="text" name="task_hour" class="form-control">
                                 <?php echo form_error('task_hour','<span class="text-danger">','</span>'); ?>
                              </div>
                         </div>
                      </div> 
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Task Status <span class="text-danger"> *</span></label>
                                   <select name="task_status" class="form-control" >
                                      <option value="not_started">Not Started </option>
                                      <option value="in_progress"> In Progress </option>
                                      <option value="completed"> Completed </option>
                                      <option value="deferred"> Deferred </option>
                                      <option value="waiting_for_someone"> Waiting For Someone </option>
                                  </select>
                                 <?php echo form_error('task_status','<span class="text-danger">','</span>'); ?>
                              </div>
                           </div>
                        </div>        
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-12 col-sm-12">
                                 <label>Task Description</label>
                                 <textarea class="form-control" rows="5" name="task_description" ></textarea>
                              </div>
                           </div>
                        </div>
                     
              <div class="row">
                 <div class="form-group">
                  <div class="col-md-12 col-sm-12">
                     <label style="padding-top: 3px;">Assigned To  <span class="text-danger"> *</span></label><br>
                     <label class="radio">
                     <input type="radio" checked name="permission" value="1">
                     <i></i>&nbsp;<span>Everyone</span></label>
                     <i title="" class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" data-original-title="who have permission for this menu and all admin user."></i><br>
                     <label class="radio">
                     <input type="radio" name="permission" value="0">
                     <i></i>&nbsp;<span>Customize Permission</span>
                     </label><i title="" class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" data-original-title="Select a individual permission . individually edit delete action"></i>
                     <?php echo form_error('permission','<span class="text-danger">','</span>'); ?>
                     <div id="permission_user" >
                        <label for="field-1" class="control-label">Select Users <span class="text-danger">*</span></label>
                        <?php
                           foreach ($user_list as $usr_val) 
                           {
                           ?>
                        <div class="col-md-12">
                           <div class="row">
                              <div  class="col-md-5 checkbox c-checkbox needsclick">
                                 <label class="checkbox">
                                 <input type="checkbox" value="<?php echo $usr_val->user_id; ?>" name="assigned_to[]" class="needsclick" data-parsley-multiple="assigned_to" data-parsley-id="30"><i></i> &nbsp;&nbsp;&nbsp;<?php echo $usr_val->user_full_name.'  ('.$usr_val->user_type.')'; ?>
                                 </label>
                              </div>
                              <div class="action_<?php echo $usr_val->user_id; ?>" id="action_<?php echo $usr_val->user_id; ?>" style="display: none;">              
                                 <label class="checkbox">
                                 <input readonly="" name="view_<?php echo $usr_val->user_id; ?>" type="checkbox" value="1">
                                 <i></i>Can View </label>
                                 <label class="checkbox">
                                 <input readonly="" name="edit_<?php echo $usr_val->user_id; ?>" type="checkbox" value="1">
                                 <i></i>Can Edit </label>
                                 <label class="checkbox">
                                 <input readonly="" name="delete_<?php echo $usr_val->user_id; ?>" type="checkbox" value="1">
                                 <i></i>Can Delete </label>
                              </div>
                           </div>
                        </div>
                        <?php
                           }
                           ?>
                     </div>
                     <div class="row">
                        <div class="col-md-1">
                           <button type="submit" name="Submit" value="Add" class="btn btn-teal margin-top-30">Submit</button>
                        </div>
                        <div class="col-md-1">
                            <a href="<?php echo base_url();?>task" type="submit" class="btn btn-danger margin-top-30 margin-left-30">Cancel</a>
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
<script src="<?php echo base_url();?>webroot/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
   $(function() {
   $('.project').each(function() {
     var $projectBar = $(this).find('.bar');
     var $projectPercent = $(this).find('.percent');
     var $projectRange = $(this).find('.ui-slider-range');
     $projectBar.slider({
       range: "min",
       animate: true,
       value: 1,
       min: 0,
       max: 100,
       step: 1,
       slide: function(event, ui) {
         $projectPercent.html(ui.value + "%");
         $('#probability').val(ui.value);
       },
       change: function(event, ui) {
         var $projectRange = $(this).find('.ui-slider-range');
         var percent = ui.value;
         if (percent < 30) {
           $projectPercent.css({
             'color': 'red'
           });
           $projectRange.css({
             'background': '#f20000'
           });
         } else if (percent > 31 && percent < 70) {
           $projectPercent.css({
             'color': 'gold'
           });
           $projectRange.css({
             'background': 'gold'
           });
         } else if (percent > 70) {
           $projectPercent.css({
             'color': 'green'
           });
           $projectRange.css({
             'background': 'green'
           });
         }
       }
     });
   })
   })


</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#permission_user').hide();
        $("div.action").hide();
        $("input[name$='permission']").click(function () {
            $("#permission_user").removeClass('show');
            if ($(this).attr("value") == "0") {
                $("#permission_user").show();
            } else {
                $("#permission_user").hide();
            }
        });

        $("input[name$='assigned_to[]']").click(function () {
            var user_id = $(this).val();           
            $("#action_" + user_id).removeClass('show');
            if (this.checked) {
                $("#action_" + user_id).show();
            } else {
                $("#action_" + user_id).hide();
            }

        });
        <?php
        if($action_type != '')
        {
          ?>
          get_related_moduleName('<?php echo $action_type; ?>')
          <?
        }
        ?>
    });


     function get_related_moduleName(val) 
     {
      //alert(val);
        var PAGE = "<?php echo base_url(); ?>task/getReletedModule"+val;
         jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : val,
            success:function(data)
            {               
               //alert(data); return false;
                if(data != "")
                {
                  $('#related_to_module').html(data);  
                }
                
            } 
        });

        
    }

</script>