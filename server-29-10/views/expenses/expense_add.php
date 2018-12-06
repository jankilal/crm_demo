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
      <h1>Expenses <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>expense">expense</a></li>
         <li class="active">Expenses Add</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Add Expenses</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>expense" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
                     <fieldset>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Amount<!-- <span class="text-danger"> *</span> --></label>
                                 <input name="expenses_amt" class="form-control" type="text" value=""> 
                              </div>
                               <div class="col-md-6 col-sm-6 project">
                                 <label>Category</label>
                                 <select name="expenses_category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    <?php
                                       foreach ($expense_category as $ec_val) 
                                       {
                                          ?>
                                         <option value="<?php echo $ec_val->expense_category_id; ?>"><?php echo $ec_val->expense_category; ?></option>
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
                              <div class="col-md-6 col-sm-6">
                                 <label>Attachment </label><!-- <span class="text-danger"> *</span> -->
                                 <input type="file" name="expenses_attachment">            
                              </div></div></div>
                              <div class="row">
                           <div class="form-group">
                              <div class="col-md-12 col-sm-12">
                                 <label>Narration </label><span class="text-danger"> *</span>
                                 <textarea class="form-control" rows="5"  name="expenses_narration" ></textarea>            
                              </div></div></div>
               <div class="row">
                 <div class="col-md-1">
                      <button type="submit" name="Submit" value="Add" class="btn btn-teal margin-top-30">Submit</button>
                   </div>
                   <div class="col-md-1">
                       <a href="<?php echo base_url();?>expense" class="btn btn-danger margin-top-30">Cancel</a> 
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

  // Add Extra Contact Persons

  $(document).ready(function()
  {

    var counter = 0;
    $("#extra_contact").click(function () {
       $('#removeContact').show();
       
            var newTextBoxDiv = $(document.createElement('div'))
            .attr("id", 'TextBoxDiv' + counter);
            newTextBoxDiv.after().html('<div class="row"><div class="form-group"><div class="col-md-6 col-sm-6"><label>Contact Name </label><span class="text-danger"></span>'+'<input required="required" type="text" name="other_contact_name[]" class="form-control"  value=""></div>'+'<div class="col-md-6 col-sm-6"><label>Email </label><span class="text-danger"> *</span><input required="required" type="text" name="other_email[]" class="form-control"  value=""></div></div></div>'+'<div class="row">'+'<div class="form-group"><div class="col-md-6 col-sm-6"><label>Designation</label><span class="text-danger"> *</span><input required="required" type="text" name="other_designation[]" class="form-control" value=""></div>'+'<div class="col-md-6 col-sm-6"><label>Mobile </label><span class="text-danger"> *</span><input required="required" type="text" name="other_mobile[]" class="form-control"></div></div></div><br>'); 

            newTextBoxDiv.appendTo("#TextBoxesGroup");        
            counter++;

        });

        $("#removeContact").click(function () {
        counter--;
        $("#TextBoxDiv" + counter).remove();         
        if(counter == 0){
        $('#removeContact').hide();
        }


        });
  });

</script>