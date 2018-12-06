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
      <h1>Item <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>itemsList">Item</a></li>
         <li class="active">Add Item</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Add Item</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>itemsList" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
             <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
                <fieldset>
                     <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Item Name<span class="text-danger"> *</span></label>
                              <input name="item_name" class="form-control" type="text" value=""> 
                           </div>
                           <div class="col-md-6 col-sm-6">
                              <label>Unit Price <span class="text-danger"> *</span></label>
                              <input name="unit_price" class="form-control" type="text" value=""> 
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Quantity <span class="text-danger"> *</span></label>
                              <input name="quantity" class="form-control" type="text" value=""> 
                           </div>                       
                           <div class="col-md-6 col-sm-6">
                              <label>Tax Rate</label>
                              <select name="item_tax_rate" class="form-control" data-parsley-id="12">
                                  <option value="0.00">None</option>
                              </select>
                           </div>
                        </div>
                     </div>  
                     <div class="row">
                        <div class="form-group">
                          <div class="col-md-12 col-sm-12">
                                <label>Description </label>
                                <textarea class="form-control" rows="5"  name="description" ></textarea>
                          </div>
                        </div>
                     </div>  

                       <h4>Add Items Information</h4>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Item Details</label>
                                 <textarea name="product_details[]" class="form-control"></textarea>   
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label style="margin-bottom: 10px;">Images/Attachment File</label>
                                   <input type="file" multiple="multiple" name="product_img_file_0[]">            
                              </div>
                           </div>
                        </div> 
                        <button id="add_produst_btn" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add More</button>
                        <button class="btn btn-danger btn-sm" type="button" style="margin-left: 20px; display: none;" id="removeButton"><i class="fa fa-remove"></i></button>
                         <div id="TextBoxesGroup"><br></div> 

                     
                    <div class="row">
                      <div class="col-md-1">
                         <button type="submit" name="Submit" value="Add" class="btn btn-teal margin-top-30">Submit</button>
                      </div>
                        <div class="col-md-1">
                            <a href=" <?php echo base_url().'itemsList';?>"class="btn btn-danger margin-left-10 margin-top-30 ">Cancel</a>
                        </div>
                    </div>
                </fieldset>
             </form>
            </div>
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
<script type="text/javascript">
 $(document).ready(function()
 {
    var counter = 1;
    $("#add_produst_btn").click(function () 
    {
       $('#removeButton').show();
     
          var newTextBoxDiv = $(document.createElement('div'))
          .attr("id", 'TextBoxDiv' + counter);
          newTextBoxDiv.after().html('<div class="row"><div class="form-group"><div class="col-md-6 col-sm-6">'+'<label>Product Details</label><textarea name="product_details[]" class="form-control"></textarea>'+'</div><div class="col-md-6 col-sm-6"><label style="margin-bottom: 10px;">Images/Attachment File</label><input type="file" multiple="multiple" name="product_img_file_'+counter+'[]"></div></div></div><p></p>');

          newTextBoxDiv.appendTo("#TextBoxesGroup");        
          counter++;
      });

      $("#removeButton").click(function () 
      {
        counter--;
        $("#TextBoxDiv" + counter).remove();         
        if(counter == 1)
        {
          $('#removeButton').hide();
        }
      });
  });
</script>