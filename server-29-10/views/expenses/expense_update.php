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
      <h1>leads <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>expense">addexpense</a></li>
         <li class="active">Expenses Edit</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Edit Expenses</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>expense" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
                     <fieldset>
                     <?php
                     foreach ($edit_expense as $res) 
                     {
                      // echo "<pre>"; print_r($edit_expense); die();
                     ?>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Amount<span class="text-danger"> *</span></label>
                                 <input name="expenses_amt" class="form-control" type="text" value="<?php echo $res->expenses_amt; ?>" />
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Category<span class="text-danger"> *</span></label>
                                  <select name="expenses_category_id" class="form-control">
                                   <?php
                                       foreach ($expense_category as $ec_val) 
                                       {
                                          ?>
                                         <option <?php if($ec_val->expense_category_id == $res->expenses_category_id){ echo "selected"; }?> value="<?php echo $ec_val->expense_category_id; ?>"><?php echo $ec_val->expense_category; ?></option>
                                        <?php 
                                       }
                                       ?>
                                 </select>
                             <?php echo form_error('expense_category_id','<span class="text-danger">','</span>'); ?>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-2 col-sm-2 project">
                                <label>Attachment</label><br>
                                <img width="100px" src="<?php echo base_url().''.$res->expenses_attachment; ?>">
                              </div>
                               <div class="col-md-4 col-sm-4 project">

                                 <label>Attachment</label>
                                  <div class="fancy-file-upload fancy-file-primary">
                                      <i class="fa fa-upload"></i>
                                      <input type="file" id="expenses_attachment" class="form-control" name="expenses_attachment" onchange="jQuery(this).next('input').val(this.value);">
                                      <input type="text" class="form-control" placeholder="no file selected" readonly="">
                                      <span class="button">Choose File</span>
                                  </div>
                              </div>

                              <div class="col-md-6 col-sm-6">
                                 <label>Narration</label>
                                 <input name="expenses_narration" class="form-control" type="text" value="<?php echo $res->expenses_narration; ?>" />            
                              </div>
                           </div>
                        </div> 
               <div class="row">
                 <div class="col-md-1">
                      <button type="submit" name="Submit" value="Edit" class="btn btn-teal margin-top-30">Submit</button>
                   </div>
                   <div class="col-md-1">
                       <a href="<?php echo base_url();?>expense" class="btn btn-danger margin-top-30">Cancel</a> 
                     
                 </div>
               </div>
               <?php
               }
               ?>
            </form>
          </div>
        </div>
      </div>
    </div>
   </div>
</section>
<!-- /MIDDLE -->

<script type="text/javascript">
    $(document).ready(function () {
        $('#permission_user').hide();
        $("div.action").hide();
        $("input[name$='permission']").click(function () {
            $("#permission_user").removeClass('show');
            if ($(this).attr("value") == "0") {
                $("#permission_user").show();
            } else {
              $('#permission_user').find('input[type=checkbox]:checked').removeAttr('checked');
                $("#permission_user").hide();
            }
        });

        $("input[name$='assigned_to[]']").click(function () {
            var user_id = $(this).val();           
            $("#action_"+user_id).removeClass('show');
            if (this.checked) {
                $("#action_"+user_id).show();
            } else {
                $("#action_"+user_id).hide();
            }

        });
    });


    function getStateList(country_id)
    {
        var str = 'country_id='+country_id;
        var PAGE = '<?php echo base_url(); ?>client/getStateList';
        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,
            success:function(data)
            {           
                if(data != "")
                {
                    $('#state_id').html(data);
                }
                else
                {
                    $('#client_state_id').html('<option value=""></option>');
                }
            } 
        });
    }
</script>