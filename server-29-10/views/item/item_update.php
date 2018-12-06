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
         <li><a href="<?php echo base_url();?>itemsList">Item List</a></li>
         <li class="active">Edit Item</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
               <strong>Edit Item</strong>
               <div class="pull-right box-tools">
                  <a href="<?php echo base_url();?>itemsList" class="btn btn-teal btn-sm">Back</a>
               </div>
            </div>
            <div class="panel-body">
               <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
                  <fieldset>
                <?php
                   foreach ($edit_item as $res) 
                   {
                   ?>
                    <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Item Name<span class="text-danger"> *</span></label>
                              <input name="item_name" class="form-control" type="text" value="<?php echo $res->item_name;?>"> 
                           </div>                        
                           <div class="col-md-6 col-sm-6">
                              <label>Unit Price <span class="text-danger"> *</span></label>
                              <input name="unit_cost" class="form-control" type="text" value="<?php echo $res->unit_cost;?>"> 
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Quantity <span class="text-danger"> *</span></label>
                              <input name="quantity" class="form-control" type="text" value="<?php echo $res->quantity;?>"> 
                           </div>                       
                           <div class="col-md-6 col-sm-6">
                              <label>Tax Rate<span class="text-danger"> *</span></label>
                              <select name="item_tax_rate" class="form-control" data-parsley-id="12">
                                  <option value="0.00">None</option>
                              </select>
                           </div>
                        </div>
                     </div> 
                      <div class="row">
                       <div class="form-group">
                           <div class="col-md-12 col-sm-12">
                                <label>Description </label><span class="text-danger"> *</span>
                                <textarea class="form-control" rows="5"  name="description"><?php echo $res->item_desc;?></textarea>            
                          </div>
                       </div>
                     </div> 
                     <?php }?>
                      <h4>Add Items Information</h4>
                      <button id="add_produst_btn" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add More</button>
                       <button class="btn btn-danger btn-sm" type="button" style="margin-left: 20px; display: none;" id="removeButton"><i class="fa fa-remove"></i></button>

                      <?php
                      // $item_id = $this->uri->segment(3);
                     foreach ($attachment_list as $res) 
                     {         
                        $item_attachments = unserialize($res->item_attachment);
                        ?>
                        <div class="row" id="item_sec_<?= $res->item_doc_id; ?>">
                           <div class="form-group">
                              <div class="col-md-5 col-sm-5">
                                 <label>Item Details</label>
                                 <textarea name="item_description" class="form-control" ><?php echo $res->item_description;?></textarea>   
                              </div>
                             <!--  <div class="col-md-5 col-sm-5">
                                 <label style="margin-bottom: 10px;">Images/Attachment File</label>
                                   <input type="file" multiple="multiple" name="product_img_file[]" value="item_desc">            
                              </div> -->
                              <div class="col-md-2 col-sm-2">
                                     <button class="btn btn-sm btn-danger" onclick="removeAddedItem(this , '<?= $res->item_doc_id; ?>')" type="button"><i class="fa fa-remove"></i></button>
                                  
                              </div>
                           </div>
                        </div>  
                         <?php
                         if(!empty($item_attachments))
                         {
                          ?>
                          <div class="row">
                          <?php
                          foreach ($item_attachments as $atc_res) 
                          {
                            ?>
                             <div class="col-md-12">
                               <a target="_blank" href="<?= base_url().$atc_res; ?>"><?= base_url().$atc_res; ?></a>
                             </div>
                            <br>
                            <?php
                          }
                           echo "</div><hr>";
                         }
                     }
                    ?>
                    <div id="TextBoxesGroup"><br></div> 
                     <div class="row">
                        <div class="col-md-1">
                           <button type="submit" name="Submit" value="Edit" class="btn btn-teal margin-top-30">Submit</button>
                        </div>
                        <div class="col-md-1">
                           <a href=" <?php echo base_url().'itemsList';?>"class="btn btn-danger margin-top-30 margin-left-10 ">Cancel</a>
                        </div>
                     </div>
                     
                  </fieldset>
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
</script>
<script type="text/javascript">
 $(document).ready(function()
 {

    var counter = 0;
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
        if(counter == 0)
        {
          $('#removeButton').hide();
        }
      });
  });
</script>
<script type="text/javascript">
 
 function removeAddedItem(obj, id)
{
  bootbox.confirm("Are you sure you want to delete Leads Details",function(confirmed){            
    if(confirmed)
    {
      var data = 'id='+id;
      $.post('<?php echo base_url();?>itemsList/removeItemById' , data , function(res){
        if(res)
        {
          $('#item_sec_'+id).remove();
        }
      });
    }
  });
}
</script>


