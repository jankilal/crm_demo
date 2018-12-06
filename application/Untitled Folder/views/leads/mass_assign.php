<style>
.fstMultipleMode .fstControls{padding: 0px !important; width: 100%;}
.fstElement{ width: 100% !important; font-size: 10px; padding-top: 3px; border: 2px solid #D7D7D7 !important; border-radius: 3px;  }
.fstChoiceItem{font-size: 12px; padding: 2px;left: 0px;padding-left: 20px;padding-right: 20px;margin: 5px;}
.fstMultipleMode.fstActive .fstResults{ font-size: 10px; }
</style>
<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>leads</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?= base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">leads</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20 lead-wrapper">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading" style="height: 63px">
              <strong>Mass Assign Leads</strong>
           <div class="pull-right">
              <a href="<?= base_url('leads'); ?>" class="btn btn-3d btn-sm btn-reveal btn-default"><i class="fa fa-arrow-circle-left"></i><span>Back</span></a>
           </div>     
         </div>

         <!-- panel content -->
        <div class="panel-body">
            <div id="msg_div">
                <?= $this->session->flashdata('message');?>
            </div>

            <div class="alert alert-bordered margin-bottom-30" style="border: #eff0f0 2px solid;background: #eff0f0;border-radius: 0px;">
              <p><strong>Tip: </strong></p>
              <div style="padding-left: 5%; line-height: 20px;">
                <p>This page will help you to assign multiple records in one step.</p>
                <p>Use criteria to isolate the records you want to assign.</p>
                <p>Choose custom views to list records based on specific criteria.</p>
              </div>
            </div>
            <div class="row">
              <hr>
              <div class="col-md-12">
                <h4>Criteria Component</h4>
              </div>
            </div>
            <div class="row">
                <!-- Main Search By Column  -->
                <div class="col-md-3">
                  <!-- select2 -->
                  <div class="fancy-form fancy-form-select">
                    <select class="form-control select2" name="searchfield1[]" id="searchfield1" onchange="showHideField1ByColumn(this ,'')">
                      <option value="">None</option>
                      <option value="annual_revenue" data-select="N">Annual Revenue</option>
                      <option value="city" data-select="T">City</option>
                      <option value="organization" data-select="T">Company</option>
                      <option value="created_by" data-select="U">Created By</option>
                      <option value="email" data-select="T">Email</option>
                      <option value="email_opt_out" data-select="B">Email Opt Out</option>
                      <option value="industry" data-select="T">Industry</option>
                      <option value="lead_source_id" data-select="T">Lead Source</option>
                      <option value="lead_status_id" data-select="T">Lead Status</option>
                    </select>
                    <i class="fancy-arrow"></i>
                  </div>
                </div>

                <!-- Default Showing field-1  -->
                <div class="col-md-3 default_select">
                  <!-- select2 -->
                  <div class="fancy-form fancy-form-select">
                    <select class="form-control select2" id="defaultField2">
                      <option value="">None</option>
                    </select>
                    <i class="fancy-arrow"></i>
                  </div>
                </div>

                <!-- Default Showing field-2  -->
                <div class="col-md-3 default_select">
                  <!-- select2 -->
                  <input type="text" disabled="disabled" name="" class="form-control">
                </div>

                <div class="col-md-3 cond_select" id="show1ForT" style="display: none;">
                  <div class="fancy-form fancy-form-select">
                    <select name="textCondition1[]" onchange="enableDisableField(this,'textCondition2')" id="textCondition1" class="form-control select2">
                      <option value="">None</option>
                      <option value="is">is</option>
                      <option value="isn't">isn't</option>
                      <option value="contains">contains</option>
                      <option value="doesn't contain">doesn't contain</option>
                    </select>
                    <i class="fancy-arrow"></i>
                  </div>
                </div>

                <div class="col-md-3 cond_select" id="show1ForN" style="display: none;">
                  <div class="fancy-form fancy-form-select">
                    <select name="numcondition1[]" id="numcondition1" class="form-control select2">
                     <option value="=">=</option>
                     <option value="!=">!=</option>
                     <option value="<">&lt;</option>
                     <option value="<=">&lt;=</option>
                     <option value=">">&gt;</option>
                     <option value=">=">&gt;=</option>
                     <option value="between">between</option>
                     <option value="not between">not between</option>
                    </select>
                    <i class="fancy-arrow"></i>
                  </div>
                </div>

                <div class="col-md-3 cond_select" id="show1ForB" style="display: none;">
                  <div class="fancy-form fancy-form-select">
                    <select name="booleancondition1[]" id="booleancondition1" class="form-control select2">
                      <option value="is">is</option>
                    </select>
                    <i class="fancy-arrow"></i>
                  </div>
                </div>

                <div class="col-md-3 cond_select" id="show1ForU" style="display: none;">
                  <div class="fancy-form fancy-form-select">
                    <select name="usercondition1[]" id="usercondition1" class="form-control select2">
                      <option value="is">is</option>
                      <option value="isn't" >isn't</option>
                    </select>
                    <i class="fancy-arrow"></i>
                  </div>
                </div>

                <div class="col-md-3 cond_select" id="show2ForT" style="display: none;">
                  <input type="text" class="form-control" disabled="disabled" name="textCondition2[]" id="textCondition2">
                </div>

                <div class="col-md-3 cond_select" id="show2ForN" style="display: none;">
                  <input type="text" class="form-control checkNumFilter" name="numcondition2[]" id="numcondition2">
                </div>

                <div class="col-md-4 cond_select" id="show2ForB" style="display: none;">
                  <div class="fancy-form fancy-form-select">
                    <select name="booleancondition2[]" id="booleancondition2" class="form-control select2">
                      <option value="selected">Selected</option>
                      <option value="not_selected">Not Selected</option>
                    </select>
                    <i class="fancy-arrow"></i>
                  </div>
                </div>

                <div class="col-md-4 cond_select" id="show2ForU" style="display: none;">
                  <select class="multipleSelect form-control" placeholder="Click to select user" multiple name="language" name="usercondition2[]" id="usercondition2">
                      <?php
                      $users_list = $this->comman_model->getData('tbl_user' , array('user_status' => 1));
                      foreach ($users_list as $u_res) 
                      {
                        ?>
                        <option value="<?= $u_res->user_id ?>"><?= $u_res->user_full_name ?></option>
                        <?php
                      }
                      ?>
                  </select>
                </div>

                <div class="'col-md-2" id="addRmButton">
                  <a href="javascript:;" style="display: none;" class="rm_criteria_btn"><i class="fa fa-minus text-danger" style="margin-top: 10px; font-size: 20px;"></i></a>
                  <a href="javascript:;" style="margin-left: 15px;" onclick="addNewCriteria(this)" class="add_criteria_btn"><i class="fa fa-plus text-success" style="margin-top: 10px; font-size: 20px;"></i></a>
                </div>
            </div>
            <div id="criteriaGroup"></div>
            <div class="row">
            <hr>
              <div class="col-md-12">
                <button class="btn btn-3d btn-reveal btn-blue"><i class="fa fa-search"></i><span>Search</span></button>
              </div>
            </div>
        </div>
      <!-- /panel content -->
   </div>
</section>
<!-- /MIDDLE -->
<script type="text/javascript">
var criteria_count = 0;
function showHideField1ByColumn(obj , counter)
{
  alert(counter)
    if($(obj).val())
    {
      var select_type = $(obj).find(':selected').data('select');
      $('.cond_select'+counter).hide();
      $('.default_select'+counter).hide();
      $('.cond_select'+counter+' .select2-container--default').css('width' ,'242px');
      $('#show2ForB'+counter+' .select2-container--default').css('width' ,'332px');
      $('.cond_select'+counter).find('select').prop('selectedIndex', -1);
      $('.cond_select'+counter).find('input:text').val(''); 
      $('#show1For'+select_type+counter).show();
      $('#show2For'+select_type+counter).show();
    }
    else
    {
      $('.default_select'+counter).show();
      $('.cond_select'+counter).hide();
      $('.cond_select'+counter).find('select').prop('selectedIndex', -1);
      $('.cond_select'+counter).find('input:text').val(''); 
    }
}

function enableDisableField(obj , id)
{
  if($(obj).val())
    $('#'+id).attr('disabled' , false);
  else
    $('#'+id).attr('disabled' , true);
}

function addNewCriteria(obj){
  $(obj).prev().show();
  $(obj).remove();
  $('#criteriaGroup').append(`<br><div class="row">
                <!-- Main Search By Column  -->
                <div class="col-md-3" id="criteria_sub_`+criteria_count+`">
                  <!-- select2 -->
                  <div class="fancy-form fancy-form-select">
                    <select class="form-control select2" name="searchfield1[]" id="searchfield1`+criteria_count+`" onchange="showHideField1ByColumn(this,`+criteria_count+`)">
                      <option value="">None</option>
                      <option value="annual_revenue" data-select="N">Annual Revenue</option>
                      <option value="city" data-select="T">City</option>
                      <option value="organization" data-select="T">Company</option>
                      <option value="created_by" data-select="U">Created By</option>
                      <option value="email" data-select="T">Email</option>
                      <option value="email_opt_out" data-select="B">Email Opt Out</option>
                      <option value="industry" data-select="T">Industry</option>
                      <option value="lead_source_id" data-select="T">Lead Source</option>
                      <option value="lead_status_id" data-select="T">Lead Status</option>
                    </select>
                    <i class="fancy-arrow"></i>
                  </div>
                </div>

                <!-- Default Showing field-1  -->
                <div class="col-md-3 default_select`+criteria_count+`">
                  <!-- select2 -->
                  <div class="fancy-form fancy-form-select">
                    <select class="form-control select2" id="defaultField2`+criteria_count+`">
                      <option value="">None</option>
                    </select>
                    <i class="fancy-arrow"></i>
                  </div>
                </div>

                <!-- Default Showing field-2  -->
                <div class="col-md-3 default_select`+criteria_count+`">
                  <!-- select2 -->
                  <input type="text" disabled="disabled" name="" class="form-control">
                </div>

                <div class="col-md-3 cond_select`+criteria_count+`" id="show1ForT`+criteria_count+`" style="display: none;">
                  <div class="fancy-form fancy-form-select">
                    <select name="textCondition1[]" onchange="enableDisableField(this,'textCondition2`+criteria_count+`')" id="textCondition1`+criteria_count+`" class="form-control select2">
                      <option value="">None</option>
                      <option value="is">is</option>
                      <option value="isn't">isn't</option>
                      <option value="contains">contains</option>
                      <option value="doesn't contain">doesn't contain</option>
                    </select>
                    <i class="fancy-arrow"></i>
                  </div>
                </div>

                <div class="col-md-3 cond_select`+criteria_count+`" id="show1ForN`+criteria_count+`" style="display: none;">
                  <div class="fancy-form fancy-form-select">
                    <select name="numcondition1[]" id="numcondition1`+criteria_count+`" class="form-control select2">
                     <option value="=">=</option>
                     <option value="!=">!=</option>
                     <option value="<">&lt;</option>
                     <option value="<=">&lt;=</option>
                     <option value=">">&gt;</option>
                     <option value=">=">&gt;=</option>
                     <option value="between">between</option>
                     <option value="not between">not between</option>
                    </select>
                    <i class="fancy-arrow"></i>
                  </div>
                </div>

                <div class="col-md-3 cond_select`+criteria_count+`" id="show1ForB`+criteria_count+`" style="display: none;">
                  <div class="fancy-form fancy-form-select">
                    <select name="booleancondition1[]" id="booleancondition1`+criteria_count+`" class="form-control select2">
                      <option value="is">is</option>
                    </select>
                    <i class="fancy-arrow"></i>
                  </div>
                </div>

                <div class="col-md-3 cond_select`+criteria_count+`" id="show1ForU`+criteria_count+`" style="display: none;">
                  <div class="fancy-form fancy-form-select">
                    <select name="usercondition1[]" id="usercondition1`+criteria_count+`" class="form-control select2">
                      <option value="is">is</option>
                      <option value="isn't" >isn't</option>
                    </select>
                    <i class="fancy-arrow"></i>
                  </div>
                </div>

                <div class="col-md-3 cond_select`+criteria_count+`" id="show2ForT`+criteria_count+`" style="display: none;">
                  <input type="text" class="form-control" disabled="disabled" name="textCondition2[]" id="textCondition2`+criteria_count+`">
                </div>

                <div class="col-md-3 cond_select`+criteria_count+`" id="show2ForN`+criteria_count+`" style="display: none;">
                  <input type="text" class="form-control checkNumFilter" name="numcondition2[]" id="numcondition2`+criteria_count+`">
                </div>

                <div class="col-md-4 cond_select`+criteria_count+`" id="show2ForB`+criteria_count+`" style="display: none;">
                  <div class="fancy-form fancy-form-select">
                    <select name="booleancondition2[]" id="booleancondition2`+criteria_count+`" class="form-control select2">
                      <option value="selected">Selected</option>
                      <option value="not_selected">Not Selected</option>
                    </select>
                    <i class="fancy-arrow"></i>
                  </div>
                </div>

                <div class="col-md-4 cond_select`+criteria_count+`" id="show2ForU`+criteria_count+`" style="display: none;">
                  <select class="multipleSelect form-control" placeholder="Click to select user" multiple name="language" name="usercondition2[]" id="usercondition2`+criteria_count+`">
                      <?php
                      $users_list = $this->comman_model->getData('tbl_user' , array('user_status' => 1));
                      foreach ($users_list as $u_res) 
                      {
                        ?>
                        <option value="<?= $u_res->user_id ?>"><?= $u_res->user_full_name ?></option>
                        <?php
                      }
                      ?>
                  </select>
                </div>

                <div class="'col-md-2" id="addRmButton`+criteria_count+`">
                  <a href="javascript:;" class="rm_criteria_btn"><i class="fa fa-minus text-danger" style="margin-top: 10px; font-size: 20px;"></i></a>
                  <a href="javascript:;" style="margin-left: 15px;" onclick="addNewCriteria(this)"><i class="fa fa-plus text-success" style="margin-top: 10px; font-size: 20px;"></i></a>
                </div>
            </div>`);
  criteria_count++;
  $('.multipleSelect').fastselect();  
}

</script>