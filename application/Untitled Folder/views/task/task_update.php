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
         <li><a href="<?php echo base_url();?>opportunities">Task</a></li>
         <li class="active">Task Add</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
   <?php
   foreach ($edit_task as $t_val) 
   {
   ?>
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Add Task</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>opportunities" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
                     <fieldset>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Task Name<span class="text-danger"> *</span></label>
                                 <input name="task_name" class="form-control" type="text" id="task_name" value="<?php echo $t_val->task_name; ?>" />
                                 <?php echo form_error('task_name','<span class="text-danger">','</span>'); ?>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Related To<span class="text-danger"> *</span></label>
                                  <select name="related_to" class="form-control" id="check_related"
                                  onchange="get_related_moduleName(this.value)">
                                    <option <?php if($t_val->related_to == '0'){ echo "selected"; } ?> value="0">None</option>
                                    <option <?php if($t_val->related_to == 'item'){ echo "selected"; } ?> value="item">item</option>
                                    <option <?php if($t_val->related_to == 'Opportunities'){ echo "selected"; } ?> value="Opportunities">Opportunities</option>
                                    <option <?php if($t_val->related_to == 'Leads'){ echo "selected"; } ?> value="Leads">leads</option>
                                    <option <?php if($t_val->related_to == 'Task'){ echo "selected"; } ?> value="Task">Task</option>
                                    <option <?php if($t_val->related_to == 'Goal'){ echo "selected"; } ?> value="Goal">Goal Tracking</option>
                                  </select>
                                 <?php echo form_error('related_to','<span class="text-danger">','</span>'); ?>
                              </div>
                           </div>
                        </div>
                        <span id="related_to_module">
                          <?php if($t_val->related_to)
                          {
                            if($t_val->related_to == 'Leads')
                            {
                              $related_to_id = 'leads_id';
                              $related_to_name = 'lead_name';
                            }
                            elseif ($t_val->related_to == 'Opportunities') 
                            {
                              $related_to_id = 'opportunities_id';
                              $related_to_name = 'opportunity_name';
                            } 
                            elseif ($t_val->related_to == 'Goal') 
                            {
                              $related_to_id = 'goal_tracking_id';
                              $related_to_name = 'goal_tracking_id';
                            } 
                            elseif ($t_val->related_to == 'Bug') 
                            {
                              $related_to_id = 'task_id';
                              $related_to_name = 'task_name';
                            } 
                            elseif ($t_val->related_to == 'Project') 
                            {
                              $related_to_id = 'items_id';
                              $related_to_name = 'item_name';
                            
                            }
                              $related_fun = 'getReletedModule'.$t_val->related_to;
                              $task_releted_res = $this->task_model->{$related_fun}();
                              if(!empty($task_releted_res))
                              {
                                ?>
                                <div style="margin-bottom: 20px;" class="row"><div class="form-group"><div class="col-md-6 col-sm-6"><label>Select Leads</label><select name="leads_id" id="related_to" class="form-control">
                                <?php
                                foreach ($task_releted_res as $trt_val) 
                                {
                                  ?>
                                    <option <?php if($trt_val->{$related_to_id} == $t_val->{$related_to_id}){ echo "selected"; } ?> value="<?php echo $trt_val->{$related_to_id}; ?>"><?php echo $trt_val->{$related_to_name}; ?></option>
                                  <?php  
                                } 
                                ?>
                                </select>
                                </div>
                                </div>
                                </div>
                                <?php
                              }
                          }
                          ?>

                        </span>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Start Date</label>
                                 <input autocomplete="off" type="text" name="task_start_date" class="form-control datepicker" value="<?php echo $t_val->task_start_date; ?>" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false">
                                 <?php echo form_error('task_start_date','<span class="text-danger">','</span>'); ?>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Due Date</label>
                                 <input autocomplete="off" type="text" name="due_date" class="form-control datepicker" value="<?php echo $t_val->due_date; ?>" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false">
                                 <?php echo form_error('due_date','<span class="text-danger">','</span>'); ?>
                              </div>
                           </div>
                        </div>
                         <div class="row">
                         <div class="form-group">
                            <div class="col-md-6 col-sm-6 project">
                               <label>Probability Of Winning %</label>
                               <div class="bar"></div>
                               <p class="percent"><?php echo $t_val->task_progress.'%'; ?></p>
                               <input type="hidden" name="task_progress" id="probability" value="<?php echo $t_val->task_progress; ?>">                       
                            </div>
                           <div class="col-md-6 col-sm-6">
                                 <label>Estimated Hour <span class="text-danger"> *</span></label>
                                  <input type="text" name="task_hour" class="form-control" value="<?php echo $t_val->task_hour; ?>">
                                 <?php echo form_error('task_hour','<span class="text-danger">','</span>'); ?>
                              </div>
                         </div>
                      </div> 
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Task Status <span class="text-danger"> *</span></label>
                                   <select name="task_status" class="form-control" >
                                      <option <?php if($t_val->task_status == 'not_started'){ echo "selected"; } ?> value="not_started">Not Started </option>
                                      <option <?php if($t_val->task_status == 'in_progress'){ echo "selected"; } ?> value="in_progress"> In Progress </option>
                                      <option <?php if($t_val->task_status == 'completed'){ echo "selected"; } ?> value="completed"> Completed </option>
                                      <option <?php if($t_val->task_status == 'deferred'){ echo "selected"; } ?> value="deferred"> Deferred </option>
                                      <option <?php if($t_val->task_status == 'waiting_for_someone'){ echo "selected"; } ?> value="waiting_for_someone"> Waiting For Someone </option>
                                  </select>
                                 <?php echo form_error('task_status','<span class="text-danger">','</span>'); ?>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label style="padding-top: 3px;">Assigned To  <span class="text-danger"> *</span></label><br>
                                 <label class="radio">
                                 <input type="radio" <?php if($t_val->permission == '1'){ echo "checked"; } ?> checked name="permission" value="1">
                                 <i></i>&nbsp;<span>Everyone</span></label>
                                 <i title="" class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" data-original-title="who have permission for this menu and all admin user."></i><br>
                                 <label class="radio">
                                 <input <?php if($t_val->permission == '0'){ echo "checked"; } ?> type="radio" name="permission" value="0">
                                 <i></i>&nbsp;<span>Customize Permission</span>
                                 </label><i title="" class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" data-original-title="Select a individual permission . individually edit delete action"></i>
                                 <?php echo form_error('permission','<span class="text-danger">','</span>'); ?>
                                  <div id="permission_user" >
                                     <label for="field-1" class="control-label">Select Users <span class="text-danger">*</span></label>
                                     <div class="checkbox c-checkbox needsclick">
                                     
                                      <label class="checkbox">
                                     <input type="checkbox" value="1" name="assigned_to[]" class="needsclick" data-parsley-multiple="assigned_to" data-parsley-id="30"><i></i> &nbsp;&nbsp;&nbsp;Admin</label>
                                     </div>
                                     <div class="action_" id="action_1" style="display: none;">              
                                        <label class="checkbox">
                                        <input readonly="" checked name="action_[]" type="checkbox" value="view">
                                        <i></i>Can View </label>
                                        <label class="checkbox">
                                        <input readonly="" checked name="action_[]" type="checkbox" value="edit">
                                        <i></i>Can Edit </label>
                                        <label class="checkbox">
                                        <input readonly="" checked name="action_[]" type="checkbox" value="delete">
                                        <i></i>Can Delete </label>  
                                       
                                     </div>
                                 </div>
                                </div>
                              </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-12 col-sm-12">
                                 <label>Task Description</label>
                                 <textarea class="form-control" rows="5" name="task_description" ><?php echo $t_val->task_description; ?></textarea>
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
                           <button type="submit" class="btn btn-danger margin-top-30 margin-left-30">Cancel</button>
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

  $(document).ready(function()
  {
      $(".ui-slider-range").removeAttr("style");       
      $(".ui-slider-handle").removeAttr("style");       
      $(".ui-slider-range").attr("style" , "width : <?php echo $t_val->task_progress.'%'; ?>");     
      $(".ui-slider-handle").attr("style" , "left : <?php echo $t_val->task_progress.'%'; ?>");       
  });


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