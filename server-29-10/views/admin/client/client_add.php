<section id="middle">
<!-- page title -->
<header id="page-header">
   <h1>Client <small>Control panel</small></h1>
   
   <ol class="breadcrumb">
   <br>
            <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>client">Client</a></li>
            <li class="active">Client Add</li>
        </ol>

</header>
 
<!-- /page title -->
<div id="content" class="padding-20">
   <div class="row">
      <div class="col-md-12">
        
         <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
               <strong>Add Client</strong>
                 <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>client" class="btn btn-teal btn-sm">Back</a>                           
                </div>
            </div>

            <div class="panel-body">
               <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
                  <fieldset>                   
                    
                     <div class="row">
                        <div class="form-group">
                           <div class="col-md-4 col-sm-4">
                              <label>Client Name<span class="text-danger"> *</span></label>
                                <input name="client_name" class="form-control" type="text" id="client_name" value="<?php echo set_value('client_name'); ?>" />
                                <?php echo form_error('client_name','<span class="text-danger">','</span>'); ?>
                           </div> 
                           <div class="col-md-4 col-sm-4">
                              <label>Client Email<span class="text-danger"> *</span></label>
                                <input name="client_email" class="form-control" type="text" id="client_email" value="<?php echo set_value('client_email'); ?>" />
                                <?php echo form_error('client_email','<span class="text-danger">','</span>'); ?>
                           </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Client Phone<span class="text-danger"> *</span></label>
                                <input name="client_phone" class="form-control" type="text" id="client_phone" value="<?php echo set_value('client_phone'); ?>" />
                                <?php echo form_error('client_phone','<span class="text-danger">','</span>'); ?>
                           </div>
                          
                         </div>
                       </div>
                       <div class="row">
                         <div class="form-group">
                           <div class="col-md-4 col-sm-4">
                              <label>Password<span class="text-danger"> *</span></label>
                                <input type="password" name="client_password" class="form-control" id="client_password" value="<?php echo set_value('client_password'); ?>" />
                                <?php echo form_error('client_password','<span class="text-danger">','</span>'); ?>
                           </div>
                           <div class="col-md-4 col-sm-4">
                              <label>Confirm Password<span class="text-danger"> *</span></label>
                                <input type="password" name="client_conf_password" class="form-control" id="client_conf_password" value="<?php echo set_value('client_conf_password'); ?>" />
                                <?php echo form_error('client_conf_password','<span class="text-danger">','</span>'); ?>
                           </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Client Image<span class="text-danger"></span></label>
                                <div class="fancy-file-upload fancy-file-primary">
                                  <i class="fa fa-upload"></i>
                                  <input type="file" class="form-control" name="client_img" onchange="jQuery(this).next('input').val(this.value);">
                                  <input type="text" class="form-control" placeholder="no file selected" readonly="">
                                  <span class="button">Choose File</span>
                                </div>                                
                            </div> 
                         </div>
                       </div>                      
                       <div class="row">
                         <div class="form-group"> 
                            <div class="col-md-4 col-sm-4">
                             <label>City<span class="text-danger"> *</span></label>
                                <input name="client_city" class="form-control" type="text" id="client_city" value="<?php echo set_value('client_city'); ?>" />
                                <?php echo form_error('client_city','<span class="text-danger">','</span>'); ?>
                           </div>
                           <div class="col-md-4 col-sm-4">
                            <label>Country<span class="text-danger">*</span></label>
                                <select class="form-control"  name="client_country_id" id="client_country_id" onchange="getStateList(this.value)">
                                    <option value=""></option>
                                    <?php 
                                        foreach ($country_list as $c_list)
                                        {
                                            ?>
                                            <option value="<?php echo $c_list->country_id; ?>"><?php echo $c_list->country_name; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>                
                             </div>
                             <div class="col-md-4 col-sm-4">
                              <label>State<span class="text-danger">*</span></label>
                                <select class="form-control"  name="client_state_id" id="client_state_id">
                                    <option value=""></option>
                                </select>
                                <?php echo form_error('client_state_id','<span class="text-danger">','</span>'); ?>
                           </div>
                         </div>
                        </div> 
                      <div class="row">
                         <div class="form-group">
                           <div class="col-md-4 col-sm-4">
                              <label>Zip Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="client_zip_code" value="<?php echo set_value('client_zip_code'); ?>"  >
                                <?php echo form_error('client_zip_code','<span class="text-danger">','</span>'); ?>
                           </div>
                           <div class="col-md-4 col-sm-4">
                              <label>Address<span class="text-danger">*</span></label>
                               <textarea name="client_address" class="form-control"></textarea>
                                <?php echo form_error('client_address','<span class="text-danger">','</span>'); ?>
                           </div>
                            <div class="col-md-4 col-sm-4">
                              <label>client Website<span class="text-danger"></span></label>
                                <input type="text" name="client_website" placeholder="http://yourclientsite.com" value="<?php echo set_value('client_website'); ?>" class="form-control">
                                <?php echo form_error('client_website','<span class="text-danger">','</span>'); ?>
                            </div>
                           
                         </div>
                       </div>                     
                        <div class="row">
                         <div class="form-group">
                            <div class="col-md-4 col-sm-4">
                              <label>Currency type</label>
                              <select name="client_currency_type" class="form-control" data-currency="EUR">
                              <option value="">Select any One</option>
                              <option value="AED">United Arab Emirates dirham</option>
                              <option value="AFN">Afghan afghani</option>
                              <option value="ALL">Albanian lek</option>
                              <option value="AMD">Armenian dram</option>
                              <option value="AOA">Angolan kwanza</option>
                              <option value="ARS">Argentine peso</option>
                              <option value="AUD">Australian dollar</option>
                              <option value="AWG">Aruban florin</option>
                              <option value="AZN">Azerbaijani manat</option>
                              <option value="BAM">Bosnia and Herzegovina convertible mark</option>
                              <option value="BBD">Barbadian dollar</option>
                              <option value="BDT">Bangladeshi taka</option>
                              <option value="BGN">Bulgarian lev</option>
                              <option value="BHD">Bahraini dinar</option>
                              <option value="BIF">Burundian franc</option>
                              <option value="BMD">Bermudian dollar</option>
                              <option value="BND">Brunei dollar</option>
                              <option value="BOB">Bolivian boliviano</option>
                              <option value="BRL">Brazilian real</option>
                              <option value="BSD">Bahamian dollar</option>
                              <option value="BTN">Bhutanese ngultrum</option> 
                              <option value="BWP">Botswana pula</option>
                              <option value="BYR">Belarusian ruble</option>
                              <option value="BZD">Belize dollar</option>
                              <option value="CAD">Canadian dollar</option>
                              <option value="CDF">Congolese franc</option>
                              <option value="CHF">Swiss franc</option>
                              <option value="CLP">Chilean peso</option>
                              <option value="CNY">Chinese yuan</option><option value="COP">Colombian peso</option>
                              <option value="CRC">Costa Rican colón</option>
                              <option value="CUP">Cuban convertible peso</option>
                              <option value="CVE">Cape Verdean escudo</option>
                              <option value="CZK">Czech koruna</option>
                              <option value="DJF">Djiboutian franc</option>
                              <option value="DKK">Danish krone</option>
                              <option value="DOP">Dominican peso</option>
                              <option value="DZD">Algerian dinar</option>
                              <option value="EGP">Egyptian pound</option>
                              <option value="ERN">Eritrean nakfa</option>
                              <option value="ETB">Ethiopian birr</option>
                              <option value="EUR">Euro</option>
                              <option value="FJD">Fijian dollar</option>
                              <option value="FKP">Falkland Islands pound</option>
                              <option value="GBP">British pound</option>
                              <option value="GEL">Georgian lari</option>
                              <option value="GHS">Ghana cedi</option>
                              <option value="GMD">Gambian dalasi</option>
                              <option value="GNF">Guinean franc</option>
                              <option value="GTQ">Guatemalan quetzal</option>
                              <option value="GYD">Guyanese dollar</option>
                              <option value="HKD">Hong Kong dollar</option>
                              <option value="HNL">Honduran lempira</option>
                              <option value="HRK">Croatian kuna</option>
                              <option value="HTG">Haitian gourde</option>
                              <option value="HUF">Hungarian forint</option>
                              <option value="IDR">Indonesian rupiah</option>
                              <option value="ILS">Israeli new shekel</option>
                              <option value="IMP">Manx pound</option>
                              <option value="INR">Indian rupee</option>
                              <option value="IQD">Iraqi dinar</option>
                              <option value="IRR">Iranian rial</option>
                              <option value="ISK">Icelandic króna</option>
                              <option value="JEP">Jersey pound</option>
                              <option value="JMD">Jamaican dollar</option>
                              <option value="JOD">Jordanian dinar</option>
                              <option value="JPY">Japanese yen</option>
                              <option value="KES">Kenyan shilling</option>
                              <option value="KGS">Kyrgyzstani som</option>
                              <option value="KHR">Cambodian riel</option>
                              <option value="KMF">Comorian franc</option>
                              <option value="KPW">North Korean won</option>
                              <option value="KRW">South Korean won</option>
                              <option value="KWD">Kuwaiti dinar</option>
                              <option value="KYD">Cayman Islands dollar</option>
                              <option value="KZT">Kazakhstani tenge</option>
                              <option value="LAK">Lao kip</option>
                              <option value="LBP">Lebanese pound</option>
                              <option value="LKR">Sri Lankan rupee</option>
                              <option value="LRD">Liberian dollar</option>
                              <option value="LSL">Lesotho loti</option>
                              <option value="LTL">Lithuanian litas</option>
                              <option value="LVL">Latvian lats</option>
                              <option value="LYD">Libyan dinar</option>
                              <option value="MAD">Moroccan dirham</option>
                              <option value="MDL">Moldovan leu</option>
                              <option value="MGA">Malagasy ariary</option>
                              <option value="MKD">Macedonian denar</option>
                              <option value="MMK">Burmese kyat</option>
                              <option value="MNT">Mongolian tögrög</option>
                              <option value="MOP">Macanese pataca</option>
                              <option value="MRO">Mauritanian ouguiya</option>
                              <option value="MUR">Mauritian rupee</option>
                              <option value="MVR">Maldivian rufiyaa</option>
                              <option value="MWK">Malawian kwacha</option>
                              <option value="MXN">Mexican peso</option>
                              <option value="MYR">Malaysian ringgit</option>
                              <option value="MZN">Mozambican metical</option>
                              <option value="NAD">Namibian dollar</option>
                              <option value="NGN">Nigerian naira</option>
                              <option value="NIO">Nicaraguan córdoba</option>
                              <option value="NOK">Norwegian krone</option>
                              <option value="NPR">Nepalese rupee</option>
                              <option value="NZD">New Zealand dollar</option>
                              <option value="OMR">Omani rial</option>
                              <option value="PAB">Panamanian balboa</option>
                              <option value="PEN">Peruvian nuevo sol</option>
                              <option value="PGK">Papua New Guinean kina</option>
                              <option value="PHP">Philippine peso</option>
                              <option value="PKR">Pakistani rupee</option>
                              <option value="PLN">Polish złoty</option>
                              <option value="PRB">Transnistrian ruble</option>
                              <option value="PYG">Paraguayan guaraní</option>
                              <option value="QAR">Qatari riyal</option>
                              <option value="RON">Romanian leu</option>
                              <option value="RSD">Serbian dinar</option>
                              <option value="RUB">Russian ruble</option>
                              <option value="RWF">Rwandan franc</option>
                              <option value="SAR">Saudi riyal</option>
                              <option value="SBD">Solomon Islands dollar</option>
                              <option value="SCR">Seychellois rupee</option>
                              <option value="SDG">Singapore dollar</option>
                              <option value="SEK">Swedish krona</option>
                              <option value="SGD">Singapore dollar</option>
                              <option value="SHP">Saint Helena pound</option>
                              <option value="SLL">Sierra Leonean leone</option>
                              <option value="SOS">Somali shilling</option>
                              <option value="SRD">Surinamese dollar</option>
                              <option value="SSP">South Sudanese pound</option>
                              <option value="STD">São Tomé and Príncipe dobra</option>
                              <option value="SVC">Salvadoran colón</option>
                              <option value="SYP">Syrian pound</option>
                              <option value="SZL">Swazi lilangeni</option>
                              <option value="THB">Thai baht</option>
                              <option value="TJS">Tajikistani somoni</option>
                              <option value="TMT">Turkmenistan manat</option>
                              <option value="TND">Tunisian dinar</option>
                              <option value="TOP">Tongan paʻanga</option>
                              <option value="TRY">Turkish lira</option>
                              <option value="TTD">Trinidad and Tobago dollar</option>
                              <option value="TWD">New Taiwan dollar</option>
                              <option value="TZS">Tanzanian shilling</option>
                              <option value="UAH">Ukrainian hryvnia</option>
                              <option value="UGX">Ugandan shilling</option>
                              <option value="USD">United States dollar</option>
                              <option value="UYU">Uruguayan peso</option>
                              <option value="UZS">Uzbekistani som</option>
                              <option value="VEF">Venezuelan bolívar</option>
                              <option value="VND">Vietnamese đồng</option>
                              <option value="VUV">Vanuatu vatu</option>
                              <option value="WST">Samoan tālā</option>
                              <option value="XAF">Central African CFA franc</option>
                              <option value="XCD">East Caribbean dollar</option>
                              <option value="XOF">West African CFA franc</option>
                              <option value="XPF">CFP franc</option>
                              <option value="YER">Yemeni rial</option>
                              <option value="ZAR">South African rand</option>
                              <option value="ZMW">Zambian kwacha</option>
                              <option value="ZWL">Zimbabwean dollar</option>
                              </select>
                            </div>
                              <div class="col-md-4 col-sm-4">
                               <label>Fax Number</label>
                                <input name="client_fax" class="form-control" type="text" id="client_fax" value="<?php echo set_value('client_fax'); ?>" />
                                  <?php echo form_error('client_fax','<span class="text-danger">','</span>'); ?>             
                            </div> 
                            <div class="col-md-4 col-sm-4">
                             <label>client Status<span class="text-danger">*</span></label>
                                <select name="client_status" id="client_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <?php echo form_error('client_status','<span class="text-danger">','</span>'); ?>
                           </div>                           
                          </div>
                         </div>
                         <div class="col-md-12">
                         <div class="alert alert-warning">
                        <h4>client Social Details</h4>
                        </div>                          
                         </div>

                         <div class="row">
                         <div class="form-group">
                            <div class="col-md-4 col-sm-4">
                              <label>Skype Id<span class="text-danger"></span></label>
                                <input type="text" name="client_skype_id" value="<?php echo set_value('client_skype_id'); ?>" class="form-control">
                                <?php echo form_error('client_skype_id','<span class="text-danger">','</span>'); ?>
                            </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Facebook Url</label>
                                <input name="client_fb_id" class="form-control" type="text" id="client_fb_id" value="<?php echo set_value('client_fb_id'); ?>" />
                                  <?php echo form_error('client_fb_id','<span class="text-danger">','</span>'); ?>
                            </div>

                            <div class="col-md-4 col-sm-4">
                              <label>Twitter Id</label>
                                <input name="client_twitter_id" class="form-control" type="text" id="client_twitter_id" value="<?php echo set_value('client_twitter_id'); ?>" />
                                  <?php echo form_error('client_twitter_id','<span class="text-danger">','</span>'); ?>
                            </div>
                          </div>
                         </div>

                         <div class="row">
                         <div class="form-group">
                            <div class="col-md-4 col-sm-4">
                               <label>Linkedin Url</label>
                                <input name="client_linkedin_url" class="form-control" type="text" id="client_linkedin_url" value="<?php echo set_value('client_linkedin_url'); ?>" />
                                  <?php echo form_error('client_linkedin_url','<span class="text-danger">','</span>'); ?>             
                            </div> 
                          
                            <div class="col-md-6 col-sm-6">
                              <label>client Short Note<span class="text-danger">*</span></label>
                               <textarea name="client_short_note" class="form-control"></textarea>
                                <?php echo form_error('client_short_note','<span class="text-danger">','</span>'); ?>
                           </div>
                           
                          </div>
                         </div>
                  </fieldset>
                  <div class="row">
                     <div class="col-md-1">
                        <button type="submit" name="Submit" value="Add" class="btn btn-teal margin-top-30">Submit</button>
                     </div>
                     <div class="col-md-1">
                     <a href="<?php echo base_url();?>client" ><button type="button" class="btn btn-danger margin-top-30 ">Cancel</button></a>
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
    $(function () {
       
        $('#emp_dob_i').datetimepicker({
             format: 'Y-M-D'
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
                    $('#client_state_id').html(data);
                }
                else
                {
                    $('#client_state_id').html('<option value=""></option>');
                }
            } 
        });
    }
</script>