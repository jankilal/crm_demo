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
      <h1>Opportunities <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>opportunities">Opportunities</a></li>
         <li class="active">Opportunities Add</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Add Opportunities</strong>
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
                                 <label>Opportunities Name<span class="text-danger"> *</span></label>
                                 <input name="Opportunities_name" class="form-control" type="text" id="Opportunities_name" value="<?php echo set_value('Opportunities_name'); ?>" />
                                 <?php echo form_error('Opportunities_name','<span class="text-danger">','</span>'); ?>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Stages <span class="text-danger"> *</span></label>
                                 <select name="stages" class="form-control">
                                    <option value="new">New</option>
                                    <option value="qualification" >Qualification</option>
                                    <option value="proposition" >Proposition</option>
                                    <option value="won">Won</option>
                                    <option value="lost">Lost</option>
                                    <option value="dead">Dead</option>
                                 </select>
                                 <?php echo form_error('stages','<span class="text-danger">','</span>'); ?>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6 project">
                                 <label>Probability Of Winning %</label>
                                 <div class="bar"></div>
                                 <p class="percent">0%</p>
                                 <input type="hidden" name="probability" id="probability" value="0">                       
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Forecast Close Date</label>
                                 <input type="text" name="close_date" class="form-control datepicker" value="<?php echo date('Y-m-d') ?>" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Current State <span class="text-danger"> *</span></label>
                                 <select class="form-control" name="opportunities_state_reason_id">
                                    <?php
                                       foreach ($opp_reson_states as $oprs_val)
                                       {
                                         ?>
                                    <option value="<?php echo $oprs_val->opportunities_state_reason_id ;?>"><?php echo $oprs_val->opportunities_state.' ('.$oprs_val->opportunities_state_reason.')' ?></option>
                                    <?php
                                       }
                                       ?>
                                 </select>
                                 <?php echo form_error('opportunities_state_reason_id','<span class="text-danger">','</span>'); ?>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Expected Revenue </label>
                                 <input type="text" name="expected_revenue" class="form-control">     
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Add New Link</label>
                                 <input type="text" name="new_link" class="form-control">                            
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Next Action </label>
                                 <input type="text" name="next_action" class="form-control">                             
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Next Action Date</label>
                                 <input autocomplete="off" type="text" name="next_action_date" class="form-control datepicker" data-format="yyyy-mm-dd" value="<?php echo date('Y-m-d') ?>" data-lang="en" data-rtl="false">
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label style="padding-top: 3px;">Who's Responsible <span class="text-danger"> *</span></label><br>
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
                                 <label>Short Note</label>
                                 <textarea class="form-control" rows="5" name="notes" ></textarea>
                              </div>
                           </div>
                        </div>
                     </fieldset>
                     <div class="row">
                        <div class="col-md-1">
                           <button type="submit" name="Submit" value="Add" class="btn btn-teal margin-top-30">Submit</button>
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
    });
</script>