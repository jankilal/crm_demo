<style type="text/css">
   .ui-slider-range{background:green;}
   .ui-slider-horizontal .ui-slider-handle{top: -1px;}
</style>
<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Leads Process <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>leads">Leads Process Details</a></li>
         <li class="active">Leads Process Details</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Add Leads Process Details</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>leads" class="btn btn-teal btn-sm">Back</a>                    
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" onsubmit="return onSubmitProcessForm(this)" enctype="multipart/form-data" >
                     <fieldset>
                        <input type="hidden" required name="leads_process_id" value="<?php echo $this->uri->segment(3);?>">     
                        <input type="hidden" required name="product_id_array" id="product_id_array">
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Minutes Of Call</label>
                                 <textarea name="meeting_minutes" class="form-control"></textarea>
                                 <?php echo form_error('meeting_minutes','<span class="text-danger">','</span>'); ?>
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
                                 <?php echo form_error('next_meeting_call','<span class="text-danger">','</span>'); ?>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>To Do List</label>
                                 <input type="text" class="form-control" name="to_do_list" >
                                 <?php echo form_error('to_do_list','<span class="text-danger">','</span>'); ?>
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
                                 <input type="text" name="next_meeting_time" class="form-control timepicker" placeholder="00 : 00 : PM">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Quote Request</label>
                                 <input type="text" name="quote_request" class="form-control">
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Leads Status</label>
                                 <select name="lead_status_id" class="form-control">
                                    <option value="">Select status</option>
                                    <?php
                                       foreach ($lead_status as $lst_val) 
                                       {
                                          ?>
                                          <option value="<?php echo $lst_val->lead_status_id; ?>"><?php echo $lst_val->lead_status.' ('.$lst_val->lead_type.')'; ?></option>
                                          <?php 
                                       }
                                       ?>
                                 </select>
                                 <?php echo form_error('lead_status_id','<span class="text-danger">','</span>'); ?>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <br>
                                 <label class="checkbox">
                                 <input type="checkbox" name="move_to_opportunity" id="move_to_opportunity" onclick="extraOpportunityDetails(this.value)" value="move">
                                 <i></i> Move To Opportunity
                                 </label>                   
                              </div>
                           </div>
                        </div>
                        <div id="sampleRequestSelect" style="display: none;">
                           <h4>Add Sample Request</h4>
                           <div class="row">
                              <div class="form-group">
                                 <div class="col-md-6 col-sm-6">
                                    <label>Sample Details</label>
                                    <textarea name="product_details[]" class="form-control"></textarea>
                                 </div>
                                 <div class="col-md-4 col-sm-4">
                                    <label style="margin-bottom: 10px;">Images/Request File</label>
                                    <input type="file" multiple="multiple" name="product_img_file_0[]">
                                 </div>
                                 <div class="col-md-2 col-sm-2">
                                    <label class="checkbox">
                                    <input type="checkbox" name="sample_request_0" id="sample_request_0" value="1" onclick="sampleRequest('0')">
                                    <i></i>Sample Request</label>       
                                 </div>
                              </div>
                           </div>
                           <div class="row" id="sample_req_dates_0" style="display: none;">
                              <div class="form-group">
                                 <div class="col-md-6 col-sm-6">
                                    <label>Order Date</label>
                                    <input autocomplete="off" type="text" name="order_date_0" class="form-control datepicker" placeholder="<?php echo date('Y-m-d') ?>">
                                 </div>
                                 <div class="col-md-6 col-sm-6">
                                    <label>Delivery Date</label>
                                    <input autocomplete="off" type="text" name="delivery_date_0" class="form-control datepicker" placeholder="<?php echo date('Y-m-d') ?>">
                                 </div>
                              </div>
                           </div>
                           <button id="add_produst_btn" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add More</button>
                           <button class="btn btn-danger btn-sm" type="button" style="margin-left: 20px; display: none;" id="removeButton"><i class="fa fa-remove"></i></button>
                        </div>
                        <div id="more_opp_details" style="display: none;">
                           <div class="row">
                              <div class="form-group">
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
                                 <div class="col-md-6 col-sm-6">
                                    <label>Forecast Close Date</label>
                                    <input autocomplete="off" type="text" name="close_date" class="form-control datepicker" value="<?php echo date('Y-m-d') ?>" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false">
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
                                    <input type="text" name="expected_revenue" class="form-control checkNumFilter">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group">
                                 <div class="col-md-6 col-sm-6">
                                    <label>Add New Link</label>
                                    <input type="text" name="new_link" class="form-control">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <br>  
                        <div class="sampleRequestClick"></div>
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
                        <div id="sendQuoteView" style="display: none;">
                           <hr>
                           <?php
                              $this->load->view('leads/send_quotation_view');
                              ?>
                           <hr>
                        </div>
                        <div id="product_documents" style="display: none;"></div>
                        <div id="load_added_product"></div>
                        <?php
                        $leads_process = $this->session->userdata('leads_process');
                        $addedProduct  = $this->comman_model->getData('tbl_lead_product',array('lead_id'=> $leads_process['lead_id']));
                        $temp_added_item_arr = array();
                        if(!empty($addedProduct))
                        {
                           ?>
                           <div class="panel panel-info shadow-none">
                              <div class="panel-heading">Selected Product Information</div>
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
                     <!-- ******************************************************* -->
                     <!-- ADD QUOTASTION PAGE -->
                     <!-- ******************************************************* -->
                     <div class="row">
                        <div class="col-md-1">
                           <button type="submit" name="Submit" value="Add" class="btn btn-teal margin-top-30 ">Submit</button>
                        </div>
                        <div class="col-md-1">
                           <a href="<?php base_url()?>leads"  type="submit" class="btn btn-danger margin-left-10 margin-top-30 ">Cancel</a>
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
                           <th>Sample Request</th>
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
                                    <td><?php echo $res->leads_process_date; ?></td>
                                    <td><?php echo $res->leads_process_type; ?></td>
                                    <td><?php echo $res->meeting_minutes; ?></td>
                                    <td><div style="margin-top: 8px;" class="progress progress-xxs margin-bottom-0">
                                    <div class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prg_width; ?>;"></div></div><br><?php echo $prg_width; ?></td>
                                    <td>
                                    <?php 
                                       if($res->next_meeting_call == 'yes')
                                       {
                                         if($res->next_meeting_date != '')
                                         echo 'Date - '.date_format(date_create_from_format('Y-m-d', $res->next_meeting_date),'d M Y').'<br>'.'Time - '.$res->next_meeting_time;
                                       }
                                       else
                                       {
                                          echo $res->next_meeting_call;
                                       } ; ?></td>
                                    <td><?php echo $res->to_do_list; ?></td>
                                    <td><?php echo $res->sample_request; ?></td>
                                    <td><?php echo $res->quote_request; ?></td>
                                    <td><a href="<?php echo base_url().'leads/viewProcessDetails/'.$res->leads_process_details_id; ?>"><i class="fa fa-eye"></i></a></td>
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
<!--################### Product Modal Section  ################### -->
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

<!--################### Product Modal Section ###################-->
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
                        <label>Description </label><!-- <span class="text-danger"> *</span> -->
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
   var selected_product_array = [];
   var temp_added_item_arr = <?= json_encode($temp_added_item_arr);?>;
   var sendQute = false;
   $('.onSendQuote').on('click' , function(){
      sendQute = (sendQute === false) ? true : false;
      getLastQuoteNo();
      $('#sendQuoteView').slideToggle('slow');
   });

   function getLastQuoteNo()
   {
      $.post('<?= base_url('leads/getLastQuoteNo/'.$leads_process['lead_id']); ?>', function( res ){
         var obj = JSON.parse(res);
         $('#QTN-Text').html(obj.quote_version);
      });
   }

   function onSubmitProcessForm(obj)
   {
      if(sendQute === true)
      {
         $(obj).append('<input type="hidden" name="send_quote" value="Send" />')
      }
     $('#product_id_array').val(JSON.stringify(selected_product_array));
   }
   
   function extraOpportunityDetails(str)
   {
      var move_opp = document.getElementById("move_to_opportunity").checked;
      if(move_opp === true)
      {
         $('#more_opp_details').show();
      }
      else
      {
         $('#more_opp_details').hide();
      }
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
   });
</script>
<script type="text/javascript">
   $(document).ready(function(){
     var counter = 0;
     $("#add_produst_btn").click(function (){
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
           if(counter == 0){
             $('#removeButton').hide();
           }
         });
   });
   
   function removeAddedProduct(obj, id)
   {
      bootbox.confirm("Are you sure you want to delete Leads Details",function(confirmed){
         if(confirmed)
         {
            var data = 'lead_product_id='+id;
            $.post('<?php echo base_url();?>leads/removeLeadProductsById' , data , function(res){
              if(res)
              {
                  reloadQuoteProduct();
                  $(obj).parent('td').closest('tr').remove();
              }
            });
         }
      });
   }
   
   function addNewLeadProduct(obj)
   {  
     // console.log(selected_product_array); return false;
     var str = '&action_add_product='+'Add Product' + '&ids_array='+JSON.stringify(selected_product_array); 
     var PAGE = '<?php echo base_url(); ?>leads/addNewLeadProduct';
    
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
         setNotificationMsg('Product Added Successfully.' , 'success');
       } 
      });  
     return false;
   }
   
   function openAddProductModal()
   {
     reloadTopBar();
     $('#addProductModal').modal('show');
   } 
   
   function loadProductModal()
   {
     $('#loading_img').fadeIn();
     $('#productModal').modal('show');
     var str = 'action_load_product='+'Load Product'; 
     var PAGE = '<?php echo base_url(); ?>leads/loadProductData';
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
   
   $('.onSendDoc').on('click' , function(){
      $('#loading_img').fadeIn();
      var str = 'action_send_document='+'Send Document'+'&lead_id='+'<?= $lead_id ?>'+'&send_type'+'Lead'; 
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

   function reloadQuoteProduct()
   {
      $.post('<?= base_url().'leads/refreshQuoteProducts' ?>' , 'lead_id='+'<?= $lead_id ?>' , function( res ){
         if(res){
            $('.onChangeProduct').html(res);
         }
      });
   }
 
</script>