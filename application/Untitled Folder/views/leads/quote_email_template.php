<style type="text/css">
   /* CLIENT-SPECIFIC STYLES */
body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
img { -ms-interpolation-mode: bicubic; }

/* RESET STYLES */
img { border: 0; outline: none; text-decoration: none; }
table { border-collapse: collapse !important; }
body { margin: 0 !important; padding: 0 !important; width: 100% !important; }

/* iOS BLUE LINKS */
a[x-apple-data-detectors] {
  color: inherit !important;
  text-decoration: none !important;
  font-size: inherit !important;
  font-family: inherit !important;
  font-weight: inherit !important;
  line-height: inherit !important;
}

/* ANDROID CENTER FIX */
div[style*="margin: 16px 0;"] { margin: 0 !important; }

/* MEDIA QUERIES */
@media all and (max-width:639px){ 
  .wrapper{ width:320px!important; padding: 0 !important; }
  .container{ width:300px!important;  padding: 0 !important; }
  .mobile{ width:300px!important; display:block!important; padding: 0 !important; }
  .img{ width:100% !important; height:auto !important; }
  *[class="mobileOff"] { width: 0px !important; display: none !important; }
  *[class*="mobileOn"] { display: block !important; max-height:none !important; }
}
</style>

<div style="width: 640px;margin: 20px auto;box-shadow: 0 0 1.5in -0.30in rgba(0, 0, 0, 0.5);">
   <table width="640" cellspacing="0" cellpadding="0" border="0" align="center" style="max-width:640px; width:100%;font-family: 'Open Sans', sans-serif !important;border:1px solid #ddd;border-radius: 2px;" bgcolor="#FFFFFF">
      <tr style="border-bottom:1px solid #ddd;">
         <td align="center" valign="top" style="padding:10px;padding-bottom: 0">
            <table width="600" cellspacing="0" cellpadding="0" border="0" align="center" style="max-width:600px; width:100%;">
               <tr style="background-color: #324E6E;color:#D0D0D0;">
                <td width="300" align="left" valign="top" style="padding:10px;">
                 <img src="https://dummyimage.com/80x80/000/fff.jpg">
                </td>
                <td width="300" align="center" valign="top" style="padding:10px;">
                  <div style="text-align: right">
                     <h4></h4>
                      <h4 style="margin:0; padding:0; margin-bottom:5px;"><?= $company_details->company_name; ?></h4>
                      <p style="margin:0; padding:0; margin-bottom:2px; font-size: 11px">ISO : <?= $company_details->company_iso; ?></p>
                      <p style="margin:0; padding:0; margin-bottom:2px; font-size: 11px">CIN : <?= $company_details->company_licence; ?></p>
                      <p style="margin:0; padding:0; margin-bottom:2px; font-size: 11px">GSTN : <?= $company_details->company_gstnin; ?></p>
                 </div>
                </td>
               </tr>
               <tr>
                <td width="300" align="left" valign="top" style="padding:10px;">
                  <h5 style="margin:0; padding:0; margin-bottom:5px; font-size: 12px">To,</h5>
                  <h5 style="margin:0; padding:0;padding-left:15; margin-bottom:0px;"><?= ($quote_data['quote_to'] != '') ? $quote_data['quote_to'] : ''; ?></h5>
                  <h5 style="margin:0; padding:0;padding-left:15; margin-bottom:0px; font-size: 12px"><?= ($quote_data['address1'] != '') ? $quote_data['address1'] : ''; ?> <?= ($quote_data['address2'] != '') ? $quote_data['address2'] : ''; ?></h5>
                  <h5 style="margin:0; padding:0;padding-left:15; margin-bottom:0px; font-size: 12px"><?= ($quote_data['location']) ? $quote_data['location'] : '' ?></h5>
                  <h5 style="margin:0; padding:0;padding-left:15; margin-bottom:0px; font-size: 12px"><?= ($quote_data['city'] != '') ? $quote_data['city'] : ''; ?></h5>
                </td>
                <td width="300" align="center" valign="top" style="padding:10px;">
                  <div style="text-align: right">
                  <h5 style="margin:0; padding:0;padding-left:15; margin-bottom:0px;">Quote No. <?= $quote_data['quote_version']; ?></h5>
                  <h5 style="margin:0; padding:0;padding-left:15; margin-bottom:0px;">Date. <?= date('Y-m-d'); ?></h5>
                 </div>
                </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr style="border-bottom:1px solid #ddd;">
         <td align="center" valign="top" style="padding:10px;padding-bottom: 0">
            <table width="600" cellspacing="0" cellpadding="0" border="0" align="center" style="max-width:600px; width:100%;">
               <tr>
                  <td width="50" align="left" valign="top" style="padding:10px;">
                     <h6 style="margin:0; padding:0; margin-bottom:5px;">Subject :</h6>
                  </td>
                  <td width="550" align="left" valign="top" style="padding:10px;">
                     <h6 style="margin:0; padding:0; margin-bottom:5px;font-weight: normal;"><?= $quote_data['subject']; ?></h6>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td align="center" valign="top" style="padding:10px;">
            <table width="600" cellspacing="0" cellpadding="0" border="0" align="center" style="max-width:600px; width:100%;">
                <tr style="background-color: #324E6E;color:#D0D0D0;">
                  <td width="50" align="left" valign="top" style="padding:10px;">
                     <h6 style="margin:0; padding:0; margin-bottom:5px;">S.no.</h6>
                  </td>
                  <td width="150" align="left" valign="top" style="padding:10px;">
                     <h6 style="margin:0; padding:0; margin-bottom:5px;">Product</h6>
                  </td>
                  <td width="200" align="left" valign="top" style="padding:10px;">
                     <h6 style="margin:0; padding:0; margin-bottom:5px;">Description</h6>
                  </td>
                  <td width="100" align="left" valign="top" style="padding:10px;">
                     <h6 style="margin:0; padding:0; margin-bottom:5px;">Price</h6>
                  </td>
                  <td width="50" align="left" valign="top" style="padding:10px;">
                     <h6 style="margin:0; padding:0; margin-bottom:5px;">Qty</h6>
                  </td>
                  <td width="50" align="left" valign="top" style="padding:10px;">
                     <h6 style="margin:0; padding:0; margin-bottom:5px;">Total</h6>
                  </td>
                </tr>
                <?php
                if(!empty($quote_data['quote_products']))
                {
                   $i =1;
                   $total_amt = 0;
                   foreach ($quote_data['quote_products'] as $p_res) 
                   {
                      $sub_total = $p_res['product_qty']*$p_res['product_price'];
                      $total_amt = $total_amt+$sub_total;
                      ?>                      
                      <tr style="border-bottom:1px solid #ddd;">
                        <td width="50" align="left" valign="top" style="padding:10px;">
                           <h6 style="margin:0; padding:0; margin-bottom:5px;"><?= $i; ?></h6>
                        </td>
                        <td width="150" align="left" valign="top" style="padding:10px;">
                           <h6 style="margin:0; padding:0; margin-bottom:5px;"><?= $p_res['product_name']; ?></h6>
                        </td>
                        <td width="200" align="left" valign="top" style="padding:10px;">
                           <h6 style="margin:0; padding:0; margin-bottom:5px;"><?= $p_res['product_desc']; ?></h6>
                        </td>
                        <td width="100" align="left" valign="top" style="padding:10px;">
                           <h6 style="margin:0; padding:0; margin-bottom:5px;"><?= $p_res['product_price']; ?></h6>
                        </td>
                        <td width="50" align="left" valign="top" style="padding:10px;">
                           <h6 style="margin:0; padding:0; margin-bottom:5px;"><?= $p_res['product_qty']; ?></h6>
                        </td>
                        <td width="50" align="left" valign="top" style="padding:10px;">
                           <h6 style="margin:0; padding:0; margin-bottom:5px;"><?= $sub_total; ?></h6>
                        </td>
                      </tr>
                      <?php
                      $i++;
                   }
                }
                ?>
            </table>
         </td>
      </tr>
      <tr>
         <td align="center" valign="top" style="padding:10px;">
            <table width="600" cellspacing="0" cellpadding="0" border="0" align="center" style="max-width:600px; width:100%;">
               <tr style="background-color: #324E6E;color:#D0D0D0;">
                  <td width="400" align="left" valign="top" style="padding:10px;">
                     <h6 style="margin:0; padding:0; margin-bottom:5px;">Amount In Words : <span id="amt_words"></span></h6>
                  </td>
                  <td width="100" align="right" valign="top" style="padding:10px;">
                     <h6 style="margin:0; padding:0; margin-bottom:5px;">Total</h6>
                  </td>
                  <td width="100" align="right" valign="top" style="padding:10px;">
                     <h6 style="margin:0; padding:0; margin-bottom:5px;">&#8377; <?= $total_amt; ?></h6>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr style="border-top:1px solid #ddd;">
         <td align="center" valign="top" style="padding:10px;">
            <table width="600" cellspacing="0" cellpadding="0" border="0" align="center" style="max-width:600px; width:100%;">
               <tr style="border-bottom:1px solid #ddd;">
                  <td width="150" align="left" valign="top" style="padding:10px;">
                     <h6 style="margin:0; padding:0; margin-bottom:5px;">Additional Requirement :</h6>
                  </td>
                  <td width="450" align="left" valign="top" style="padding:10px;">
                     <h6 style="margin:0; padding:0; margin-bottom:5px;font-weight: normal;"><?= $quote_data['additional_req']; ?></h6>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td align="center" valign="top" style="padding:10px;padding-top: 0">
            <table width="600" cellspacing="0" cellpadding="0" border="0" align="center" style="max-width:600px; width:100%;">
               <tr>
                  <td width="150" align="left" valign="top" style="padding:10px;">
                     <h6 style="margin:0; padding:0; margin-bottom:5px;">Terms & Conditions :</h6>
                  </td>
                  <td width="450" align="left" valign="top" style="padding:10px;">
                     <h6 style="margin:0; padding:0; margin-bottom:5px;font-weight: normal;"><?= $quote_data['terms_condition']; ?></h6>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr style="border-top:1px solid #ddd;">
         <td align="center" valign="top" style="padding:0px 0px;">
            <table width="640" cellspacing="0" cellpadding="0" border="0" align="center" style="max-width:640px; width:100%;">
               <tr style="background-color: #324E6E;color:#D0D0D0;">
                  <td width="150" align="left" valign="top" style="padding:10px;">
                     <h6 style="margin:0; padding:0; margin-bottom:5px;font-size: 10px;">403, Pukhraj Corporate, Navlakha,Indore</h6>
                  </td>
                  <td width="150" align="center" valign="top" style="padding:10px;">
                     <h6 style="margin:0; padding:0; margin-bottom:2px;font-size: 10px;">web: www.sixthsenseit.com</h6>
                     <h6 style="margin:0; padding:0; margin-bottom:2px;font-size: 10px;">mail: info@sixthsenseit.com</h6>
                  </td>
                  <td width="150" align="right" valign="top" style="padding:10px;">
                     <h6 style="margin:0; padding:0; margin-bottom:2px;font-size: 10px;">+91-731-4047527</h6>
                     <h6 style="margin:0; padding:0; margin-bottom:2px;font-size: 10px;">+91-9617350006</h6>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
</div>
<script type="text/javascript">
   var amt_words = convertNumberToWords('<?= $total_amt; ?>');
   document.getElementById('amt_words').innerHTML=amt_words;
   function convertNumberToWords(amount) 
   {
      var words = new Array();
      words[0] = '';
      words[1] = 'One';
      words[2] = 'Two';
      words[3] = 'Three';
      words[4] = 'Four';
      words[5] = 'Five';
      words[6] = 'Six';
      words[7] = 'Seven';
      words[8] = 'Eight';
      words[9] = 'Nine';
      words[10] = 'Ten';
      words[11] = 'Eleven';
      words[12] = 'Twelve';
      words[13] = 'Thirteen';
      words[14] = 'Fourteen';
      words[15] = 'Fifteen';
      words[16] = 'Sixteen';
      words[17] = 'Seventeen';
      words[18] = 'Eighteen';
      words[19] = 'Nineteen';
      words[20] = 'Twenty';
      words[30] = 'Thirty';
      words[40] = 'Forty';
      words[50] = 'Fifty';
      words[60] = 'Sixty';
      words[70] = 'Seventy';
      words[80] = 'Eighty';
      words[90] = 'Ninety';
      amount = amount.toString();
      var atemp = amount.split(".");
      var number = atemp[0].split(",").join("");
      var n_length = number.length;
      var words_string = "";
      if (n_length <= 9) {
          var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
          var received_n_array = new Array();
          for (var i = 0; i < n_length; i++) {
              received_n_array[i] = number.substr(i, 1);
          }
          for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
              n_array[i] = received_n_array[j];
          }
          for (var i = 0, j = 1; i < 9; i++, j++) {
              if (i == 0 || i == 2 || i == 4 || i == 7) {
                  if (n_array[i] == 1) {
                      n_array[j] = 10 + parseInt(n_array[j]);
                      n_array[i] = 0;
                  }
              }
          }
          value = "";
          for (var i = 0; i < 9; i++) {
              if (i == 0 || i == 2 || i == 4 || i == 7) {
                  value = n_array[i] * 10;
              } else {
                  value = n_array[i];
              }
              if (value != 0) {
                  words_string += words[value] + " ";
              }
              if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                  words_string += "Crores ";
              }
              if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                  words_string += "Lakhs ";
              }
              if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                  words_string += "Thousand ";
              }
              if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                  words_string += "Hundred and ";
              } else if (i == 6 && value != 0) {
                  words_string += "Hundred ";
              }
          }
          words_string = words_string.split("  ").join(" ");
      }
      return words_string;
   } 
</script>