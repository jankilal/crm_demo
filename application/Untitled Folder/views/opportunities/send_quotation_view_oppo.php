<style type="text/css">

/*<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,600i,700,800" rel="stylesheet">
*/
 .ui-slider-range
 {
    background:green;
 }

 .ui-slider-horizontal .ui-slider-handle
 {
    top: -1px;
 }

 /*Quatation CSS*/
/*
 #324E6E blue
#1B2A3B dark blue
#D0D0D0 grey
*/
 .page_potrait{
  height: auto;
  max-height:842px;
 /* width:595px;
  max-width:595px;*/
  border:1px solid #ddd;
  border-radius: 2px;
  overflow: hidden;
  /*padding: 15px;*/
  font-size: 12px;

  width: 100%;
  font-family: 'Open Sans', sans-serif !important;
}

.page_potrait h1,
.page_potrait h2,
.page_potrait h3,
.page_potrait h4,
.page_potrait h5,
.page_potrait h6{
  margin: 0;
}


.frame_padding{
    padding: 15px;
}

.quote_header{
  width: 100%;
  height: 120px;
  background-color: #324E6E;
  color: #D0D0D0;
}

.width_50{
  float: left;
  width: calc((100% - 5px)/2);
}

.quote_header_info h4, 
.quote_header_info h5{
  color: #D0D0D0;
}

.txt_right{
text-align: right;
}

/*.logo_box img{
  margin: 20px 20px;
}*/

.quote_footer{
background-color: #324E6E;
color: #D0D0D0; 
font-size: 12px;
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

</style>


<!-- QUOTATION FORM START -->
<div class="row">
   <div class="col-md-6">
      <div class="page_potrait">
         <div class="quote_header frame_padding">
            <div class="width_50 logo_box">
               <img src="https://dummyimage.com/80x60/000/fff.jpg">
            </div>
            <div class="width_50 txt_right">
               <div class="quote_header_info">
                  <h4>Company Name</h4>
                  <h5>ISO : 123456</h5>
                  <h5>CIN : 123456</h5>
                  <h5>GSTN : 123456</h5>
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
                     <h4><b>COMPANY NAME</b></h4>
                     <h5>A 123 Trade Center</h5>
                     <h5>Location, Road</h5>
                     <h5>City</h5>
                     <h5>123456</h5>
                  </li>
               </ul>
            </div>
            <div class="quote_date_no width_50">
               <ul>
                  <li><b>Quote No.</b> <q>0123</q></li>
                  <li><b>Date</b> <q>01/01/2018</q></li>
               </ul>
            </div>
            <div class="clear-fix"></div>
            
         </div>
         <div class="quote_sub frame_padding">
               <h5><b>Subject:</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua.
               </h5>
            </div>
         <div class="quote_content">
            <table class="tbl_pdf ">
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
                  <tr>
                     <td>01</td>
                     <td>Business Sense</td>
                     <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit</td>
                     <td>Rs.2,50,000</td>
                     <td>002</td>
                     <td>Rs.5,00,000</td>
                  </tr>
                  <!--  <tr class="border_none">
                     <td colspan="5" style="text-align: right;"><b>Tax-1</b></td>
                     <td>Rs.1000</td>
                     </tr>
                     <tr class="border_none">
                     <td colspan="5" style="text-align: right;"><b>Tax-2</b></td>
                     <td>Rs.1000</td>
                     </tr> -->
                  <tr>
                     <td>01</td>
                     <td>Business Sense</td>
                     <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit</td>
                     <td>Rs.2,50,000</td>
                     <td>002</td>
                     <td>Rs.5,00,000</td>
                  </tr>
                  <!--  <tr class="border_none">
                     <td colspan="5" style="text-align: right;"><b>Tax-1</b></td>
                     <td>Rs.1000</td>
                     </tr>
                     <tr class="border_none">
                     <td colspan="5" style="text-align: right;"><b>Tax-2</b></td>
                     <td>Rs.1000</td>
                     </tr> -->
                  <tr>
                     <td colspan="5" style="text-align: right;"><b>Total</b></td>
                     <td><b>Rs.10,04,000</b></td>
                  </tr>
               </tbody>
            </table>
            <div class="frame_padding">
              <div class="amount_words">
                 <h5><b>Amount In Words:</b> Rupees Ten Lakhs Four thousand Only</h5>
              </div>
              <div class="additional_req">
                 <h5><b>Additional Requirement:</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim</h5>
              </div>
              <div class="terms_conditions">
                 <h5><b>Terms & Conditions:</b></h5>
                 <ol>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                 </ol>
              </div>
            </div>
         </div>
         <div class="quote_footer frame_padding">
            <ul class="list_inline">
               <li>403, Pukhraj Corporate, Navlakha<br>Indore-452001, M.P. INDIA</li>
               <li><a href="www.sixthsenseit.com">web: www.sixthsenseit.com</a><br><a href="mailto:info@sixthsenseit.com">mail: info@sixthsenseit.com</a></li>
               <li>+91-731-4047527<br>+91-9617350006</li>
            </ul>
         </div>
      </div>
   </div>
   <div class="col-md-6">
    <?php 
        foreach($send_quote_detail as $res) 
        {
            ?>
            <div class="row">
         <div class="col-md-6">
            <label class="mandat_field"><b>Quote To</b></label>
            <!-- <textarea name="" class="form-control"></textarea> -->
            <input type="text" class="form-control" name="quote_to" placeholder="Sixth Sense IT Solutions" value="<?php echo $res->organization; ?>">
         </div>
         <div class="col-md-6">
            <label class="mandat_field"><b>Address 1</b></label>
            <!-- <textarea name="" class="form-control"></textarea> -->
            <input type="text" class="form-control" name="address1" placeholder="123 Trade Center" value="<?php echo $res->address; ?>">
         </div>
      </div>
      <div class="row">
         <div class="col-md-6">
            <label><b>Address 2</b></label>
            <!-- <textarea name="" class="form-control"></textarea> -->
            <input type="text" class="form-control" name="address2" placeholder="Block A No. 200" value="<?php echo $res->address; ?>">
         </div>
         <div class="col-md-3">
            <label><b>Location</b></label>
            <!-- <textarea name="" class="form-control"></textarea> -->
            <input type="text" class="form-control" name="location" placeholder="Palasia Road" value="<?php echo $res->city; ?>">
         </div>
         <div class="col-md-3">
            <label class="mandat_field"><b>City</b></label>
            <!-- <textarea name="" class="form-control"></textarea> -->
            <input type="text" class="form-control" name="city" placeholder="Indore" 
            value="<?php echo $res->city; ?>">
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
                <th style="width: 60px">Qty.</th>
                <th style="width: 90px">Price</th>
              </tr>
            </thead>
            <tbody>
                <?php 
                    foreach ($leads_products as $pro) {
                ?>
              <tr>
                <td>
                    <input type="checkbox" class="checkboxes" name="selected_products[]" value="<?= $pro->id;?>"/>
                </td>
                <td>
                  <input type="text" class="form-control" name="qp_product_name[]" placeholder="Business Sense Standard" value="<?php echo $pro->product_name?>">
                </td>
                <td>
                  <input type="text" class="form-control" name="qp_product_des[]" placeholder="Lorem ipsum dolor sit amet, consectetur adipisicing elit" value="<?php echo $pro->product_desc?>">
                </td>
                <td>
                  <input type="text" class="form-control" name="qp_product_qty[]" placeholder="01" value="">
                </td>
                <td>
                  <input type="text" class="form-control" name="qp_product_price[]" placeholder="12500" value="<?php echo $pro->product_price?>">
                </td>
              </tr>

              <?php } ?>
              <tr>
                <td colspan="3" class="text-right" style="vertical-align: middle;"><b>Total</b></td>
                <td><b><input type="text" class="form-control" name="quote_qty" placeholder="0"></b></td>
                <td><b><input type="text" class="form-control" name="quote_subtotal" placeholder="000"></b></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
          <div class="col-md-12">
            <label><b>Additional Requirement <small><i>(If Any)</i></small></b></label>
            <textarea  name="additional_req" class="form-control" placeholder="" style="height: 80px;"  ></textarea>
            <!-- <input type="text" class="form-control" name="" placeholder="Lorem ipsum dolor sit amet, consectetur adipisicing elit dolor sit amet"> -->
          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
            <label><b>Terms & Conditions</small></b></label>
            <textarea  name="termsConditions" class="form-control" placeholder="" style="height: 80px;"></textarea>
            <!-- <input type="text" class="form-control" name="" placeholder="Lorem ipsum dolor sit amet, consectetur adipisicing elit dolor sit amet"> -->
          </div>
      </div>
      <?php  }
    ?>
   </div>
</div>
<!-- QUOTATION FORM ENDS -->

                       