<style type="text/css">
   .ui-slider-range{background:green;}
   .ui-slider-horizontal .ui-slider-handle{top: -1px;}
</style>
<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Opportunities <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>opportunities">Opportunities Process Details</a></li>
         <li class="active">Opportunities Process Details</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Add Opportunities Process Details</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>opportunities" class="btn btn-teal btn-sm">Back</a>             
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data" onsubmit="return onSubmitProcessForm(this)" data-success="Sent! Thank you!">
                     <fieldset>
                        <input type="hidden" name="opportunities_process_id" value="<?php echo $this->uri->segment(3); ?>">     
                        <input type="hidden" name="product_id_array" id="product_id_array">
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Minutes Of Meeting</label>
                                 <textarea name="meeting_minutes" class="form-control"></textarea>
                              </div>
                              <div class="col-md-6 col-sm-6 project">
                                 <label>Response Levels %</label>
                                 <div class="bar"></div>
                                 <p style="margin-bottom: 0px;" class="percent">0%</p>
                                 <input type="hidden" name="response_levels" id="probability" value="0">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Next Meeting Or Call</label>
                                 <select onchange="showNextMeeting(this.value)" class="form-control" name="next_meeting_call">
                                    <option value="">Select Any One</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                 </select>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>To Do List</label>
                                 <input type="text" class="form-control" name="to_do_list" >
                              </div>
                           </div>
                        </div>
                        <div class="row" id="nextmeet" style="display: none;">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Next Meeting Date</label>
                                 <input autocomplete="off" type="text" name="next_meeting_date" class="form-control datepicker" placeholder="<?php echo date('Y-m-d') ?>" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false">
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Next Meeting Time</label>
                                 <input type="text" name="next_meeting_time" class="form-control timepicker" placeholder="00 : 00 : PM" data-timepicki-tim="05" data-timepicki-mini="16" data-timepicki-meri="PM">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Sample Request</label>
                                 <select onchange="showSampleRequest(this.value)" class="form-control" name="sampleRequest">
                                    <option value="">Select Any One</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                 </select>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Quote Request</label>
                                 <input type="text" name="quote_request" class="form-control">
                              </div>
                           </div>
                        </div>
                        <div id="sampleRequestSelect" style="display: none;">
                           <hr>
                           <div class="panel panel-info shadow-none">
                            <div class="panel-heading">Add Sample Request</div>
                           </div>
                           <div class="row">
                              <div class="form-group">
                                 <div class="col-md-6 col-sm-6">
                                    <label>Sample Details</label>
                                    <textarea name="sample_details[]" class="form-control"></textarea>
                                 </div>
                                 <div class="col-md-4 col-sm-4">
                                    <label style="margin-bottom: 10px;">Images/Request File</label>
                                    <input type="file" multiple="multiple" name="sample_files_0[]">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group">
                                 <div class="col-md-6 col-sm-6">
                                    <label>Order Date</label>
                                    <input type="text" name="order_date_0" class="form-control datepicker" placeholder="<?php echo date('Y-m-d') ?>">
                                 </div>
                                 <div class="col-md-6 col-sm-6">
                                    <label>Delivery Date</label>
                                    <input type="text" name="delivery_date_0" class="form-control datepicker" placeholder="<?php echo date('Y-m-d') ?>">
                                 </div>
                              </div>
                           </div>
                           <button id="add_produst_btn" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add More</button>
                           <button class="btn btn-danger btn-sm" type="button" style="margin-left: 20px; display: none;" id="removeButton"><i class="fa fa-remove"></i></button>
                           <div id="TextBoxesGroup"></div>
                           <hr>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <div class="panel panel-info shadow-none">
                                    <div class="panel-heading">Select & Add Poducts Information</div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                       <button type="button" onclick="loadProductModal()" class="btn btn-featured btn-aqua"><span>Select Product</span><i class="fa fa-list"></i></button>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                       <button type="button" onclick="openAddProductModal()" class="btn btn-featured btn-dirtygreen"><span>Add Product</span><i class="fa fa-plus"></i></button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="panel panel-info shadow-none">
                                 <div class="panel-heading">Send Document & Quotation</div>
                              </div>
                              <div class="row">
                                 <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                       <button type="button" class="btn btn-featured btn-dirtygreen onSendDoc"><span>Send Document</span><i class="fa fa-send"></i></button>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                       <button type="button" class="btn btn-featured btn-dirtygreen onSendQuote"><span>Send Quote</span><i class="fa fa-send"></i></button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- Load Send Quation View -->
                        <div id="sendQuoteView" style="display: none;">
                           <hr>
                              <?php
                                 $this->load->view('leads/send_quotation_view');
                              ?>
                           <hr>
                        </div>
                        <div id="product_documents" style="display: none;"></div>
                        <div id="load_added_product"></div>
                        <hr>
                        <?php
                        $oppo_process = $this->session->userdata('opportunities_process');
                        $addedProduct = $this->comman_model->getData('tbl_lead_product',array('lead_id'=> $oppo_process['opportunities_id']));
                        $temp_added_item_arr = array();
                        if(!empty($addedProduct))
                        {
                           ?>
                           <div class="panel panel-info shadow-none">
                              <div class="panel-heading">Added Products Information</div>
                           </div>
                           <table class="table table-striped table-bordered table-hover">
                              <thead>
                                 <tr>
                                    <th>S.No.</th>
                                    <th>Title</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody id="refreshLeadProduct">
                                 <?php
                                 $i =1;
                                 foreach ($addedProduct as $res) 
                                 {
                                    $temp_added_item_arr[] = $res->product_id;
                                    ?>
                                    <tr class="odd gradeX">
                                       <td><?= $i ?></td>
                                       <td><?= $res->product_name; ?></td>
                                       <td><?= $res->product_price; ?></td>
                                       <td><?= $res->product_desc; ?></td>
                                       <td><button class="btn btn-sm btn-danger" onclick="removeAddedProduct(this , '<?= $res->lead_product_id; ?>')" type="button"><i class="fa fa-remove"></i></button></td>
                                    </tr>
                                    <?php
                                    $i++;
                                 }
                                 ?>
                              </tbody>
                           </table>
                           <?php
                        }
                        ?>
                     </fieldset>

                     <div class="row">
                        <div class="col-md-1">
                           <button type="submit" name="Submit" value="Add" class="btn btn-teal margin-top-30">Submit</button>
                        </div>
                        <div class="col-md-1">
                           <a href="<?php echo base_url();?>opportunities"   type="submit" class="btn btn-danger margin-left-10 margin-top-30 ">Cancel</a>
                        </div>
                     </div>
                  </form>
                    <?php
                  if(!empty($quotation_detail))
                  {
                     ?>
                     <div class="panel panel-info shadow-none">
                        <div class="panel-heading">Sent Quotation Information</div>
                     </div>
                     <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                           <tr>
                              <th>Quote To</th>
                              <th>Date</th>
                              <th>Address</th>
                              <th>Price</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           foreach($quotation_detail as $res)
                           {
                              ?>
                              <tr>
                                 <td><?php echo $res->quote_to; ?></td>
                                 <td><?php echo $res->submition_date; ?></td>
                                 <td><?php echo $res->address1.' '.$res->location.' '.$res->city; ?></td>
                                 <td><?php echo $res->quote_subtotal; ?></td>     
                              </tr>
                              <?php
                           }  
                           ?>                       
                        </tbody>
                     </table>
                     <?php
                  }

                  if(!empty($process_list))
                  {
                     ?>
                     <div class="panel panel-info shadow-none">
                        <div class="panel-heading">Added Process Information</div>
                     </div>
                     <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                           <th>Process Date</th>
                           <th>Process Type</th>
                           <th>Min.Of Call</th>
                           <th>Responce Level</th>
                           <th>Next Meeting Or Call</th>
                           <th>To Do List</th>
                           <!-- <th>Sample Request</th> -->
                           <th>Quote Request</th>
                           <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                           <?php
                           foreach($process_list as $res)
                           {
                              if($res->response_levels != '')
                              {
                                 $prg_width = $res->response_levels.'%';
                              }
                              ?>
                              <tr>
                                 <td><?php echo $res->opportunities_process_date; ?></td>
                                 <td><?php echo $res->opportunities_process_type; ?></td>

                                 <td><?php echo substr($res->meeting_minutes, 0,20).'...'; ?></td>
                                 <td>
                                 <div style="margin-top: 8px;" class="progress progress-xxs margin-bottom-0">
                                    <div class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prg_width; ?>;">
                                    </div>
                                 </div>
                                 <br><?php echo $prg_width; ?></td>
                                 <td>
                                 <?php 
                                 if($res->next_meeting_call == 'yes')
                                 {
                                    if($res->next_meeting_date != '')
                                    {
                                       echo 'Date - '.date_format(date_create_from_format('Y-m-d', $res->next_meeting_date),'d M Y').'<br>'.'Time - '.$res->next_meeting_time;
                                    }
                                 }
                                 else
                                 {
                                    echo $res->next_meeting_call;
                                 }
                                 ?>   
                                 </td>
                                 <td><?php echo $res->to_do_list; ?></td>
                                 <!-- <td><?php echo $res->sample_request; ?></td> -->
                                 <td><?php echo $res->quote_request; ?></td>
                                 <td><a href="<?php echo base_url().'opportunities/viewProcessDetails/'.$res->opportunities_process_details_id; ?>"><i class="fa fa-eye"></i></a></td>
                              </tr>
                              <?php
                           }
                           ?>                       
                        </tbody>
                     </table>
                     <?php
                  }
                  ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- /MIDDLE -->
<!-- Product Modal Section -->
<div class="modal fade" id="productModal" role="basic" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Products</h4>
         </div>
         <div class="text-center" id="loading_img">
            <img src="<?= base_url() ?>webroot/images/loaders/7.gif" alt="" />
         </div>
         <div id="load_data"> </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-success" id="product_submit" style="display: none;">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<!-- Product Modal Section -->
<div class="modal fade" id="addProductModal" role="basic" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <form method="post" onsubmit="return addNewLeadProduct(this)">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title" id="myModalLabel">New Product</h4>
            </div>
            <div id="content" class="padding-20">
               <div class="row">
                  <div class="form-group">
                     <div class="col-md-6 col-sm-6">
                        <label>
                           Item Name<!-- <span class="text-danger"> *</span> -->
                        </label>
                        <input name="item_name" class="form-control" type="text" value=""> 
                     </div>
                     <div class="col-md-6 col-sm-6">
                        <label>
                           Unit Price <!-- <span class="text-danger"> *</span> -->
                        </label>
                        <input name="unit_price" class="form-control" type="text" value=""> 
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group">
                     <div class="col-md-6 col-sm-6">
                        <label>
                           Quantity <!-- <span class="text-danger"> *</span> -->
                        </label>
                        <input name="quantity" class="form-control" type="text" value=""> 
                     </div>
                     <div class="col-md-6 col-sm-6">
                        <label>
                           Tax Rate<!-- <span class="text-danger"> *</span> -->
                        </label>
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
                        <!-- <span class="text-danger"> *</span> -->
                        <textarea class="form-control" rows="5" id="description"  name="description" ></textarea>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-success">Submit</button>
               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>
<script type="text/javascript">
   var sendQute = false;
   var selected_product_array = [];
   var temp_added_item_arr = <?= json_encode($temp_added_item_arr);?>;
   $('.onSendQuote').on('click' , function(){
      sendQute = (sendQute === false) ? true : false;
      //alert(sendQute);
      getLastQuoteNo();
      $('#sendQuoteView').slideToggle('slow');
   });

   function getLastQuoteNo()
   {
      $.post('<?= base_url('leads/getLastQuoteNo/'.$oppo_process['opportunities_id']); ?>', function( res ){
         var obj = JSON.parse(res);
         $('#QTN-Text').html(obj.quote_version);
      });
   }
   function showNextMeeting(str)
   {
     if(str =='yes')
     {
       $('#nextmeet').show();
     }  
     else
     {
       $('#nextmeet').hide();
     }
   }

   function onSubmitProcessForm(obj)
   {
      if(sendQute === true)
      {
         $(obj).append('<input type="hidden" name="send_quote" value="Send" />')
      }
      $('#product_id_array').val(JSON.stringify(selected_product_array));
      if (confirm('are you sure you want to add this process.') === false)
      {
         return false;
      }
   }
</script>
<script type="text/javascript">
   $(function(){
   $('.project').each(function()
    {
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
     });
   });
   
   var selected_product_array = [];   
   <?php
      if(!empty($lead_products))
      {
         foreach ($lead_products as $id)
         {
            ?>
            selected_product_array.push('<?= $id->product_id?>');
            <?php
         }
      }
      ?>
   
   // loadAddedProduct();
   function loadAddedProduct()
   {
    console.log(selected_product_array);
      var str = 'action_get_product_by_ids='+'Get Product By Ids' + '&ids_array='+JSON.stringify(selected_product_array)+'&actionType='+'update';
         var PAGE = '<?php echo base_url(); ?>leads/getLeadProductsById';
         jQuery.ajax({
             type :"POST",
             url  :PAGE,
             data : str,
             success:function(response)
             {    
              $('#load_added_product').html(response);
             }
         });
   }
   
   function removeAddedProduct(obj,id)
   {
    // var id = $(obj).data('id');
     bootbox.confirm("Are you sure you want to delete Leads Details",function(confirmed){            
        if(confirmed)
        {
          var data = 'lead_product_id='+id;
          $.post('<?php echo base_url();?>leads/removeLeadProductsById' , data , function(res){
            console.log(res);
            if(res)
            {
               $(obj).parent('td').closest('tr').remove();
            }
          });
        }
      });
   }
   
   function addNewLeadProduct(obj)
   {      
      var str = '&action_add_product='+'Add Product' + '&ids_array='+JSON.stringify(selected_product_array);
      var PAGE = '<?php echo base_url(); ?>opportunities/addNewLeadProduct';
      jQuery.ajax({
        type :"POST",
        url  :PAGE,
        data : $(obj).serialize()+str,
        beforeSend: function( xhr ) {
          reloadTopBar();
        },
        success:function(response)
        {    
          $('#load_added_product').html(response);
          $('#addProductModal').modal('hide');
          $(obj)[0].reset();
          setNotificationMsg('Product Added Successfully!' , 'success');
        } 
      });  
      return false;
   }
   
   function loadProductModal()
   {
    $('#loading_img').fadeIn();
    $('#productModal').modal('show');
    var str = 'action_load_product='+'Load Product'; 
    var PAGE = '<?php echo base_url(); ?>opportunities/loadProductData';
    jQuery.ajax({
      type :"POST",
      url  :PAGE,
      data : str,
      beforeSend: function( xhr ) {
        reloadTopBar();
      },
      success:function(data)
      {    
        $('#loading_img').fadeOut();       
        $('#load_data').html(data);
        $('#load_data').fadeIn();       
      } 
    });
   }
   function openAddProductModal()
   {
    reloadTopBar();
    $('#addProductModal').modal('show');
   }
   
   $('.onSendDoc').on('click' , function(){
     var str = 'action_send_document='+'Send Document'+'&lead_id='+'<?= $oppo_process['opportunities_id'] ?>'+'&send_type'+'Opportunities'; 
   
     var PAGE = '<?php echo base_url(); ?>leads/loadSendDocument';
     jQuery.ajax({
        type :"POST",
        url  :PAGE,
        data : str,
        beforeSend: function( xhr ){
          reloadTopBar();
        },
        success:function(data)
        {    
           if(data != '')
           {
              $('#loading_img').fadeOut();       
              $('#product_documents').html(data);
              $('#product_documents').slideDown();
           }
        } 
     });
   });
   $(document).ready(function()
   {
      var counter = 1;
      $("#add_produst_btn").click(function () {
         $('#removeButton').show();
              var newTextBoxDiv = $(document.createElement('div'))
              .attr("id", 'TextBoxDiv' + counter);
              newTextBoxDiv.after().html('<hr><div class="row"><div class="form-group"><div class="col-md-6 col-sm-6"><label>Sample Details</label><textarea name="sample_details[]" class="form-control"></textarea></div><div class="col-md-4 col-sm-4"><label style="margin-bottom: 10px;">Images/Request File</label><input type="file" multiple="multiple" name="sample_files_'+counter+'[]"></div></div></div><div class="row"><div class="form-group"><div class="col-md-6 col-sm-6"><label>Order Date</label><input type="text" id="" name="order_date_'+counter+'" class="form-control datepicker2" placeholder="<?= date('Y-m-d'); ?>"></div><div class="col-md-6 col-sm-6"><label>Delivery Date</label><input type="text" name="delivery_date_'+counter+'" class="form-control datepicker2" placeholder="<?= date('Y-m-d'); ?>"></div></div></div>');
   
              newTextBoxDiv.appendTo("#TextBoxesGroup");        
              counter++;
   
          });
   
          $("#removeButton").click(function () {
          counter--;
          $("#TextBoxDiv" + counter).remove();         
          if(counter == 1){
          $('#removeButton').hide();
          }
          });
   });
   
   function showSampleRequest(str)
   {
     if(str =='yes')
    {
      $('#sampleRequestSelect').show();
    }  
    else
    {
      $('#sampleRequestSelect').hide();
    }
   }

   function reloadQuoteProduct()
   {
      $.post('<?= base_url().'leads/refreshQuoteProducts' ?>' , 'lead_id='+'<?= $opportunities_id ?>' , function( res ){
         if(res){
            $('.onChangeProduct').html(res);
         }
      });
   }
</script>