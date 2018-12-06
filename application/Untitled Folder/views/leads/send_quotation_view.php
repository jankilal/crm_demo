<style type="text/css">
   .ui-slider-range
   {background:green;}
   .ui-slider-horizontal .ui-slider-handle{top: -1px;}
   .page_potrait{
   height: auto;
   /*max-height:842px;*/
   border:1px solid #ddd;
   border-radius: 2px;
   overflow: hidden;
   font-size: 12px;
   width: 100%;
   font-family: 'Open Sans', sans-serif !important;
   }
   .page_potrait h1,.page_potrait h2,.page_potrait h3,.page_potrait h4,.page_potrait h5,.page_potrait h6{margin: 0;}
   .frame_padding{padding: 15px;}
   .quote_header{width: 100%;height: 120px;background-color: #324E6E;color: #D0D0D0;}
   .width_50{float: left;width: calc((100% - 5px)/2);}
   .quote_header_info h4,.quote_header_info h5{color: #D0D0D0;}
   .txt_right{
   text-align: right;
   }
   .quote_footer{
   background-color: #324E6E;
   color: #D0D0D0; 
   font-size: 10px;
   }
   .list_inline{
   padding-left: 0;
   list-style: none;
   margin: 0;
   text-align: center;
   }
   .list_inline li:first-child{
   width: 200px;
   text-align: left;
   }
   .list_inline li {
   display: inline-block;
   padding-right: 5px;
   padding-left: 5px;
   width: calc((100% - 35px)/3);
   text-align: right;
   }
   .list_inline li a{
   color: #D0D0D0; 
   }
   .quote_info_to{
   /*background-color: #D0D0D0;*/
   background-color:whitesmoke;
   color: #324E6E;
   display: inline-block;
   width: 100%;
   }
   .quote_date_no{
   display: inline-block;
   text-align: right;
   padding-right: 5px;
   }
   .quote_date_no ul{
   padding-left: 0;
   margin-bottom: 0;
   }
   .quote_date_no ul li{
   list-style: none;
   }
   .quote_date_no ul li q:before,.quote_date_no ul li q:after{
   display: none;
   }
   .quote_date_no ul li q{
   width: 120px;
   display: inline-block;
   }
   .quote_date_no ul li b{
   display: inline-block;
   margin-right: 10px;
   }
   .quote_to_company ul li{
   list-style: none;
   }
   .quote_to_company li:nth-child(2){
   padding-left: 20px;
   }
   .quote_to_company_frame{
   background-color: #fff;
   width: 300px;
   }
   .quote_to_company ul{
   padding: 0;
   margin: 0;
   }
   .quote_to_company h4{
   font-size: 14px;
   }
   .clear-fix{
   clear: both;
   }
   .quote_sub{
   background-color: #d0d0d0;
   }
   .quote_content table{
   width: 100%;
   border-collapse: collapse;
   font-size: 12px;
   }
   .quote_content table thead{
   background-color: rgb(50, 78, 110);
   color: #d0d0d0;
   }
   .quote_content table th , .quote_content table td {
   padding: 8px 15px;
   }
   .tbl_pdf tbody tr:first-child td{
   border-top:0;
   }
   .tbl_pdf tbody tr td{
   border-top: 1px solid #1B2A3B;
   }
   .prd_name{
   width: 130px;
   }
   .prd_desc{
   width: 200px;
   }
   .border_none td{
   border-top: 0;
   }
   .amount_words h5{
   font-size: 12px;
   }
   .terms_conditions , .additional_req{
   margin-top: 20px;
   }
   .terms_conditions h5{
   font-size: 12px;
   margin-bottom: 10px;
   }
   .terms_conditions ol{
   padding:0;
   margin: 0;
   margin-left: 15px; 
   font-size: 12px;
   }
   .mandat_field b:after{
   content: '*';
   color: #ff0000;
   margin-left: 2px;
   }
   .tbl_input_user{
   width: 100%;
   margin-bottom: 0;
   }
   .tbl_input_user th , .tbl_input_user td {
   padding-right: 8px;
   }
   .tbl_input_user td:last-child {
   padding-right: 0px;
   }
   .tbl_input_user input[type=text] {
   height: auto; 
   margin: 2px 0;
   border: 0;
   background: transparent;
   padding: 6px 0
   }
   .tbl_name_frame{
   padding: 8px;
   background: #324e6e;
   color: #d0d0d0;
   font-weight: bold;
   }
   .blank-border{
      border-bottom: 1px solid gray;
      width: 100%;
      display: inline-block;
   }
   .page_potrait span{
      color: #333;
   }
   .custom-hr{
      margin: 10px auto;
      margin-left: -10px;
      margin-right: -10px;
   }
</style>
<!-- QUOTATION FORM START -->
<div class="row quote-wrapper send-quote-main">
   <div class="col-md-6">
      <div class="panel panel-info shadow-none">
         <div class="panel-heading">Quotation Form Preview</div>
      </div>
      <div class="page_potrait">
         <div class="quote_header frame_padding">
            <div class="width_50 logo_box">
               <img src="https://dummyimage.com/80x60/000/fff.jpg">
            </div>
            <div class="width_50 txt_right">
               <div class="quote_header_info">
                  <h4><?= $company_details->company_name; ?></h4>
                  <h5>ISO : <?= $company_details->company_iso; ?></h5>
                  <h5>CIN : <?= $company_details->company_licence; ?></h5>
                  <h5>GSTN : <?= $company_details->company_gstnin; ?></h5>
               </div>
            </div>
         </div>
         <div class="quote_info_to frame_padding">
            <div class="quote_to_company width_50">
               <ul>
                  <li>
                     <h4><b>To</b></h4>
                  </li>
                  <li>
                     <h4><b><span id="QT-Text" class="<?= ($send_quote_detail->email != '') ? '' : 'blank-border'; ?>"><?= ($send_quote_detail->email != '') ? $send_quote_detail->email : ''; ?></span></b></h4>
                     <h5><span id="AD1-Text" class="<?= ($send_quote_detail->address != '') ? '' : 'blank-border'; ?>"><?= ($send_quote_detail->address != '') ? $send_quote_detail->address : ''; ?></span> <span id="AD2-Text"></span></h5>
                     <h5><span id="LCT-Text" class="blank-border"></span></h5>
                     <h5><span id="CT-Text" class="<?= ($send_quote_detail->city != '') ? '' : 'blank-border'; ?>"><?= ($send_quote_detail->city != '') ? $send_quote_detail->city : ''; ?></span></h5>
                  </li>
               </ul>
            </div>
            <div class="quote_date_no width_50">
               <ul>
                  <li><b>Quote No.</b> <span id="QTN-Text"></span></li>
                  <li><b>Date</b> <span><?= date('Y-m-d'); ?></span></li>
               </ul>
            </div>
            <div class="clear-fix"></div>
         </div>
         <div class="quote_sub frame_padding">
            <h5><b>Subject:</b> <span id="SBJ-Text"></span></h5>
         </div>
         <div class="quote_content">
            <table class="tbl_pdf">
               <thead>
                  <tr>
                     <th>S.no</th>
                     <th class="prd_name">Product Name</th>
                     <th class="prd_desc">Description</th>
                     <th>Price</th>
                     <th>Qty.</th>
                     <th>Total</th>
                  </tr>
               </thead>
               <tbody>
                 
               </tbody>
            </table>
            <div class="frame_padding">
               <div class="amount_words">
                  <h5><b>Amount In Words:</b> <span id="AMTW-Text"></span></h5>
               </div>
               <div class="additional_req">
                  <hr class="custom-hr">
                  <h5><b>Additional Requirement:</b> <span id="AR-Text"></span></h5>
               </div>
               <div class="terms_conditions">
                  <hr class="custom-hr">
                  <h5><b>Terms & Conditions:</b> <span id="TQ-Text"></span></h5>
               </div>
            </div>
         </div>
         <div class="quote_footer frame_padding">
            <div style="width: 30%;display: inline-block;margin-left: 10px">
               403, Pukhraj Corporate, Navlakha<br>Indore-452001, M.P. INDIA
            </div>
             <div style="width: 36%;display: inline-block;margin-left: 10px">              
               <a href="www.sixthsenseit.com" style="color: #fff">web: www.sixthsenseit.com</a><br><a href="mailto:info@sixthsenseit.com" style="color: #fff">mail: info@sixthsenseit.com</a>  
            </div>
             <div style="width: 28%;display: inline-block;text-align: right;">              
               +91-731-4047527<br>+91-9617350006
            </div>
            <!-- <ul class="list_inline">
               <li>403, Pukhraj Corporate, Navlakha<br>Indore-452001, M.P. INDIA</li>
               <li><a href="www.sixthsenseit.com">web: www.sixthsenseit.com</a><br><a href="mailto:info@sixthsenseit.com">mail: info@sixthsenseit.com</a></li>
               <li>+91-731-4047527<br>+91-9617350006</li>
            </ul> -->
         </div>
      </div>
   </div>
   <div class="col-md-6">
      <div class="panel panel-info shadow-none">
         <div class="panel-heading">Quotation Form</div>
      </div>
      <div class="row">
         <div class="col-md-6">
            <label class="mandat_field"><b>Quote To</b></label>
            <input type="text" class="form-control onQTInfo required" name="quote_to" placeholder="Send quote to" data-point="QT" value="<?= ($send_quote_detail->email != '') ? $send_quote_detail->email : ''; ?>">
         </div>
         <div class="col-md-6">
            <label class="mandat_field"><b>Address 1</b></label>
            <input type="text" class="form-control onQTInfo required" data-point="AD1" name="qt_address1" placeholder="Enter address 1" value="<?= ($send_quote_detail->address != '') ? $send_quote_detail->address : ''; ?>">
         </div>
      </div>
      <div class="row">
         <div class="col-md-6">
            <label><b>Address 2</b></label>
            <input type="text" class="form-control onQTInfo" data-point="AD2" name="qt_address2" placeholder="Enter address 2" value="">
         </div>
         <div class="col-md-3">
            <label><b>Location</b></label>
            <input type="text" class="form-control onQTInfo" data-point="LCT" name="qt_location" placeholder="Enter location" value="">
         </div>
         <div class="col-md-3">
            <label class="mandat_field"><b>City</b></label>
            <input type="text" class="form-control onQTInfo required" data-point="CT" name="qt_city" placeholder="Indore" value="<?= ($send_quote_detail->city != '') ? $send_quote_detail->city : ''; ?>">
         </div>
      </div>
       <div class="row">
         <div class="col-md-12">
            <label><b>Subject</b></label>
            <textarea rows="2" data-point="SBJ" name="qt_subject" class="form-control onaddQTInfo required" placeholder="Enter Subject here ..."></textarea>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12 col-md-12">
            <div class="tbl_name_frame">
               <div class="tbl_name">Products Information</div>
            </div>
            <table class="table table-striped table-bordered tbl_input_user">
               <thead>
                  <tr>
                     <th style="width: 20px">S. No.</th>
                     <th style="width: 200px">Product Name</th>
                     <th>Description</th>
                     <th style="width: 90px">Qty</th>
                     <th style="width: 90px">Price</th>
                  </tr>
               </thead>
               <tbody class="onChangeProduct">
               <?php 
                  $total_amt = 0; 
                  foreach ($leads_products as $pro) 
                  {
                     $total_amt = $total_amt+$pro->product_price*1;
                    ?>
                     <tr>
                        <td>
                           <input type="checkbox" class="checkboxes onCheckQTItem" name="selected_products[]" data-mjson="<?php echo htmlspecialchars(json_encode($pro), ENT_QUOTES, 'UTF-8'); ?>" value="<?= $pro->lead_product_id; ?>"/>
                        </td>
                        <td>
                           <input type="text" disabled="true" class="form-control" name="qp_product_name[]" data-key="product_name" placeholder="Enter product name" value="<?php echo $pro->product_name;?>">
                        </td>
                        <td>
                           <input type="text" disabled="true" class="form-control" name="qp_product_des[]" data-key="product_desc" placeholder="Enter product desc" value="<?php echo $pro->product_desc?>">
                        </td>
                        <td>
                           <input type="text" disabled="true" class="form-control checkNumFilter" name="qp_product_qty[]" data-key="product_qty" placeholder="Enter Qty" value="1">
                        </td>
                        <td>
                           <input type="text" disabled="true" class="form-control checkNumFilter" name="qp_product_price[]" data-key="product_price" placeholder="0.00" value="<?php echo $pro->product_price?>">
                        </td>
                     </tr>
                     <?php 
                  } 
                  ?>
                  <tr>
                     <td colspan="4" class="text-right" style="vertical-align: middle;"><b>Total</b></td>
                     <td><b>&#8377; <?= $total_amt; ?></b></td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <label><b>Additional Requirement <small><i>(If Any)</i></small></b></label>
            <textarea rows="4" data-point="AR"  name="additional_req" class="form-control onaddQTInfo" placeholder="Additional requirement here ..."></textarea>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <label><b>Terms & Conditions</small></b></label>
            <textarea rows="4" data-point="TQ" name="termsConditions" class="form-control onaddQTInfo" placeholder="Terms & conditions here..."></textarea>
         </div>
      </div>
   </div>
</div>
<!-- QUOTATION FORM ENDS -->

<script type="text/javascript">
   $(document).on('keyup' , '.onQTInfo' ,function(){
      var $obj = $(this);
      var input = $obj.data('point');
      var point_id = $('#'+input+'-Text');
      point_id.html($obj.val());
      if($obj.val())
      {
         point_id.removeClass('blank-border');
      }
      else{
         if(input != 'AD2')
         point_id.addClass('blank-border');
      }
   });

   $(document).on('keyup' , '.onaddQTInfo' , function(){
      var $obj = $(this);
      var input = $obj.data('point');
      var point_id = $('#'+input+'-Text');
      point_id.html($obj.val());
   });

   
   var tota
   $(document).on('click' , '.onCheckQTItem', function(){
      var $obj = $(this);
      var itmMObj = $obj.data('mjson');
      reloadProducts();
      if($obj.prop('checked') === true)
      {
         $obj.closest('tr').find('input[type=text]').attr('disabled' , false);
      }
      else
      {
          $obj.closest('tr').find('input[type=text]').each(function(k,i){
            var key = $(this).data('key');
            if(key === 'product_qty'){
               $(this).val(1);
            }else{
               $(this).val(itmMObj[key]);
            }
            $(this).attr('disabled' , true);
         });
      }
   });

   $(document).on('keyup' , '.onChangeProduct tr td input', function(){
      var $obj = $(this);
      var key = $obj.data('key');
      var value = $obj.val();
      var selectItm = $obj.closest('tr').find('input:checkbox');
      var itemNData = selectItm.val();
      var nitmObj = JSON.parse(itemNData);
      nitmObj[key] = value;
      selectItm.val(JSON.stringify(nitmObj));
      reloadProducts();
   });

   function reloadProducts()
   {
      var i = 1;
      var proDtl = '';
      var totalAmt = 0;
      $('.onCheckQTItem').each(function(){
         var $obj = $(this);
         var itemNData = $obj.val();
         var nitmObj = JSON.parse(itemNData);
         console.log(nitmObj);
         if($obj.prop('checked') === true)
         {
            proDtl += '<tr> <td>'+i+'</td>';

            var product_qty = 1; 
            var product_price = 0;
            var product_name = '';
            var product_desc = '';
            var product_desc_full = '';
            $obj.closest('tr').find('input[type=text]').each(function(k){
               var key = $(this).data('key');
               var val = $(this).val();
               if(key === 'product_qty'){
                  product_qty = val;
               }
               if(key === 'product_price')
               {
                  product_price = val;
               }
               if(key === 'product_desc')
               {
                  product_desc =  (val.length > 100) ? val.substr(0, 100) + '...' : val;
                  product_desc_full =  val;
               }
               if(key === 'product_name')
               {
                  product_name = val;
               }
            });
            proDtl += `<td>`+product_name+`</td>`;
            proDtl += `<td title="`+product_desc_full+`">`+product_desc+`</td>`;
            proDtl += `<td>`+product_price+`</td>`;
            proDtl += `<td>`+product_qty+`</td>`;
            var productSubTotal = parseFloat(product_price)*parseInt(product_qty);
            proDtl += '<td>'+productSubTotal+'</td></tr>';
            totalAmt = parseFloat(totalAmt)+parseFloat(productSubTotal);
            i++;
         }
      });
      var textAmt = convertNumberToWords(parseFloat(totalAmt));
      proDtl += `<tr><td colspan="4" style="text-align: right;"><b>Total</b></td><td colspan="2" style="text-align: right;"><b><span id="AMT-Text">&#8377; `+totalAmt+`</span></b></td></tr>`;
      $('.tbl_pdf tbody').html(proDtl);
      $('#AMTW-Text').html(textAmt);
   }
</script>