<section id="middle">
<!-- page title -->
<header id="page-header">
   <h1>Profile <small>Control panel</small></h1>
   
       <ol class="breadcrumb">
       <br>
            <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>employee">Profile</a></li>
            <li class="active">Profile Edit</li>
        </ol>

</header>
 
<!-- /page title -->
<div id="content" class="padding-20">
   <div class="row">
      <div class="col-md-12">
        
         <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
               <strong>Profile Edit</strong>
                 <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>" class="btn btn-teal btn-sm">Back</a>                           
                </div>
            </div>

            <div class="panel-body">
               <form method="post" onsubmit="return checkProfileUpdate()" enctype="multipart/form-data" data-success="Sent! Thank you!">
                  <fieldset>   
                  <?php
                  foreach ($user_details as $res) 
                  {
                  ?>                
                    
                     <div class="row">
                        <div class="form-group">
                           <div class="col-md-4 col-sm-4">
                              <label>Name<span class="text-danger"> *</span></label>
                                <input name="employee_name" class="form-control" type="text" id="employee_name" value="<?php echo $res->user_full_name; ?>" />
                                <?php echo form_error('employee_name','<span class="text-danger">','</span>'); ?>
                           </div> 
                           <div class="col-md-4 col-sm-4">
                              <label>Email<span class="text-danger"> *</span></label>
                                <input name="employee_email" onchange="check_email_address(this.value)" class="form-control" type="text" id="employee_email" value="<?php echo $res->user_email; ?>" />
                                <input type="hidden" id="validate_email">
                                <span style="color: red;" id="error_email"></span>
                           </div>
                            <div class="col-md-4 col-sm-4">
                              <label>employee Phone<span class="text-danger"> *</span></label>
                                <input name="employee_phone" class="form-control" type="text" id="employee_phone" value="<?php echo $res->user_phone; ?>" />
                                <?php echo form_error('employee_phone','<span class="text-danger">','</span>'); ?>
                           </div>
                          
                         </div>
                       </div>
                       <div class="row">
                         <div class="form-group"> 
                            <div class="col-md-4 col-sm-4">
                              <label>employee Image<span class="text-danger"></span></label>
                                <div class="fancy-file-upload fancy-file-primary">
                                  <i class="fa fa-upload"></i>
                                  <input type="file" class="form-control" name="employee_img" onchange="jQuery(this).next('input').val(this.value);">
                                  <input type="text" class="form-control" placeholder="no file selected" readonly="">
                                  <span class="button">Choose File</span>
                                </div>                                
                            </div> 
                        
                          <div class="col-md-4 col-sm-4">
                            <label>Country<span class="text-danger">*</span></label>
                                <select class="form-control"  name="employee_country_id" id="employee_country_id" onchange="getStateList(this.value)">
                                    <option value=""></option>
                                    <?php 
                                        foreach ($country_list as $c_list)
                                        {
                                            ?>
                                            <option <?php if($res->user_country_id == $c_list->country_id){ echo "selected"; } ?> value="<?php echo $c_list->country_id; ?>"><?php echo $c_list->country_name; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>                
                             </div>
                             <div class="col-md-4 col-sm-4">
                               <label>State<span class="text-danger">*</span></label>
                                <select class="form-control"  name="employee_state_id" id="employee_state_id">
                                    <option value=""></option> 
                                    <?php 
                                        foreach ($state_list as $s_list)
                                        {
                                            ?>
                                            <option value="<?php echo $s_list->state_id; ?>" <?php if($res->user_state_id == $s_list->state_id){ echo "selected"; }?>><?php echo $s_list->state_name; ?></option>
                                            <?php
                                        }
                                    ?>                                 
                                </select>
                                <?php echo form_error('employee_state_id','<span class="text-danger">','</span>'); ?>
                           </div>
                         </div>
                       </div>                      
                       <div class="row">
                         <div class="form-group"> 
                            <div class="col-md-4 col-sm-4">
                             <label>City<span class="text-danger"> *</span></label>
                                <input name="employee_city" class="form-control" type="text" id="employee_city" value="<?php echo $res->user_city; ?>" />
                                <?php echo form_error('employee_city','<span class="text-danger">','</span>'); ?>
                           </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Zip Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control masked" data-format="99999" data-placeholder="12345" placeholder="Zip code" name="employee_zip_code" value="<?php echo  $res->user_zip_code; ?>"  >
                                <?php echo form_error('employee_zip_code','<span class="text-danger">','</span>'); ?>
                           </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Address<span class="text-danger">*</span></label>
                               <textarea name="employee_address" class="form-control"><?php echo $res->user_address; ?></textarea>
                                <?php echo form_error('employee_address','<span class="text-danger">','</span>'); ?>
                           </div>
                          
                        </div> 
                        </div>
                      <div class="row">
                         <div class="form-group">
                          
                          
                            <div class="col-md-4 col-sm-4">
                              <label>employee Website<span class="text-danger"></span></label>
                                <input type="text" name="employee_website" placeholder="http://youremployeesite.com" value="<?php echo $res->user_website; ?>" class="form-control">
                                <?php echo form_error('employee_website','<span class="text-danger">','</span>'); ?>
                            </div>
                             <div class="col-md-4 col-sm-4">
                              <label>Currency type</label>
                             <select name="employee_currency_type" class="form-control" data-currency="EUR">
                              <option <?php if($res->user_currency_type == 'AED'){ echo "selected"; } ?> value="AED">Select any One</option>

                              <option <?php if($res->user_currency_type == 'AED'){ echo "selected"; } ?> value="AED">United Arab Emirates dirham</option>

                              <option  <?php if($res->user_currency_type == 'AFN'){ echo "selected"; } ?> value="AFN">Afghan afghani</option>
                              <option <?php if($res->user_currency_type == 'ALL'){ echo "selected"; } ?> value="ALL">Albanian lek</option>
                              <option <?php if($res->user_currency_type == 'AMD'){ echo "selected"; } ?> value="AMD">Armenian dram</option>
                              <option <?php if($res->user_currency_type == 'AOA'){ echo "selected"; } ?> value="AOA">Angolan kwanza</option>
                              <option <?php if($res->user_currency_type == 'ARS'){ echo "selected"; } ?> value="ARS">Argentine peso</option>
                              <option <?php if($res->user_currency_type == 'AUD'){ echo "selected"; } ?> value="AUD">Australian dollar</option>
                              <option <?php if($res->user_currency_type == 'AWG'){ echo "selected"; } ?> value="AWG">Aruban florin</option>
                              <option <?php if($res->user_currency_type == 'AZN'){ echo "selected"; } ?> value="AZN">Azerbaijani manat</option>
                              <option <?php if($res->user_currency_type == 'BAM'){ echo "selected"; } ?> value="BAM">Bosnia and Herzegovina convertible mark</option>
                              <option <?php if($res->user_currency_type == 'BBD'){ echo "selected"; } ?> value="BBD">Barbadian dollar</option>
                              <option <?php if($res->user_currency_type == 'BDT'){ echo "selected"; } ?> value="BDT">Bangladeshi taka</option>
                              <option <?php if($res->user_currency_type == 'BGN'){ echo "selected"; } ?> value="BGN">Bulgarian lev</option>
                              <option <?php if($res->user_currency_type == 'BHD'){ echo "selected"; } ?> value="BHD">Bahraini dinar</option>
                              <option <?php if($res->user_currency_type == 'BIF'){ echo "selected"; } ?> value="BIF">Burundian franc</option>
                              <option <?php if($res->user_currency_type == 'BMD'){ echo "selected"; } ?> value="BMD">Bermudian dollar</option>
                              <option <?php if($res->user_currency_type == 'BND'){ echo "selected"; } ?> value="BND">Brunei dollar</option>
                              <option <?php if($res->user_currency_type == 'BOB'){ echo "selected"; } ?> value="BOB">Bolivian boliviano</option>
                              <option <?php if($res->user_currency_type == 'BRL'){ echo "selected"; } ?> value="BRL">Brazilian real</option>
                              <option <?php if($res->user_currency_type == 'BSD'){ echo "selected"; } ?> value="BSD">Bahamian dollar</option>
                              <option <?php if($res->user_currency_type == 'BTN'){ echo "selected"; } ?> value="BTN">Bhutanese ngultrum</option> 
                              <option <?php if($res->user_currency_type == 'BWP'){ echo "selected"; } ?> value="BWP">Botswana pula</option>
                              <option <?php if($res->user_currency_type == 'BYR'){ echo "selected"; } ?> value="BYR">Belarusian ruble</option>
                              <option <?php if($res->user_currency_type == 'BZD'){ echo "selected"; } ?> value="BZD">Belize dollar</option>
                              <option <?php if($res->user_currency_type == 'CAD'){ echo "selected"; } ?> value="CAD">Canadian dollar</option>
                              <option <?php if($res->user_currency_type == 'CDF'){ echo "selected"; } ?> value="CDF">Congolese franc</option>
                              <option <?php if($res->user_currency_type == 'CHF'){ echo "selected"; } ?> value="CHF">Swiss franc</option>
                              <option <?php if($res->user_currency_type == 'CLP'){ echo "selected"; } ?> value="CLP">Chilean peso</option>
                              <option <?php if($res->user_currency_type == 'CNY'){ echo "selected"; } ?> value="CNY">Chinese yuan</option><option <?php if($res->user_currency_type == 'COP'){ echo "selected"; } ?> value="COP">Colombian peso</option>
                              <option <?php if($res->user_currency_type == 'CRC'){ echo "selected"; } ?> value="CRC">Costa Rican colón</option>
                              <option <?php if($res->user_currency_type == 'CUP'){ echo "selected"; } ?> value="CUP">Cuban convertible peso</option>
                              <option <?php if($res->user_currency_type == 'CVE'){ echo "selected"; } ?> value="CVE">Cape Verdean escudo</option>
                              <option <?php if($res->user_currency_type == 'CZK'){ echo "selected"; } ?> value="CZK">Czech koruna</option>
                              <option <?php if($res->user_currency_type == 'DJF'){ echo "selected"; } ?> value="DJF">Djiboutian franc</option>
                              <option <?php if($res->user_currency_type == 'DKK'){ echo "selected"; } ?> value="DKK">Danish krone</option>
                              <option <?php if($res->user_currency_type == 'DOP'){ echo "selected"; } ?> value="DOP">Dominican peso</option>
                              <option <?php if($res->user_currency_type == 'DZD'){ echo "selected"; } ?> value="DZD">Algerian dinar</option>
                              <option <?php if($res->user_currency_type == 'EGP'){ echo "selected"; } ?> value="EGP">Egyptian pound</option>
                              <option <?php if($res->user_currency_type == 'ERN'){ echo "selected"; } ?> value="ERN">Eritrean nakfa</option>
                              <option <?php if($res->user_currency_type == 'ETB'){ echo "selected"; } ?> value="ETB">Ethiopian birr</option>
                              <option <?php if($res->user_currency_type == 'EUR'){ echo "selected"; } ?> value="EUR">Euro</option>
                              <option <?php if($res->user_currency_type == 'FJD'){ echo "selected"; } ?> value="FJD">Fijian dollar</option>
                              <option <?php if($res->user_currency_type == 'FKP'){ echo "selected"; } ?> value="FKP">Falkland Islands pound</option>
                              <option <?php if($res->user_currency_type == 'GBP'){ echo "selected"; } ?> value="GBP">British pound</option>
                              <option <?php if($res->user_currency_type == 'GEL'){ echo "selected"; } ?> value="GEL">Georgian lari</option>
                              <option <?php if($res->user_currency_type == 'GHS'){ echo "selected"; } ?> value="GHS">Ghana cedi</option>
                              <option <?php if($res->user_currency_type == 'GMD'){ echo "selected"; } ?> value="GMD">Gambian dalasi</option>
                              <option <?php if($res->user_currency_type == 'GNF'){ echo "selected"; } ?> value="GNF">Guinean franc</option>
                              <option <?php if($res->user_currency_type == 'GTQ'){ echo "selected"; } ?> value="GTQ">Guatemalan quetzal</option>
                              <option <?php if($res->user_currency_type == 'GYD'){ echo "selected"; } ?> value="GYD">Guyanese dollar</option>
                              <option <?php if($res->user_currency_type == 'HKD'){ echo "selected"; } ?> value="HKD">Hong Kong dollar</option>
                              <option <?php if($res->user_currency_type == 'HNL'){ echo "selected"; } ?> value="HNL">Honduran lempira</option>
                              <option <?php if($res->user_currency_type == 'HRK'){ echo "selected"; } ?> value="HRK">Croatian kuna</option>
                              <option <?php if($res->user_currency_type == 'HTG'){ echo "selected"; } ?> value="HTG">Haitian gourde</option>
                              <option <?php if($res->user_currency_type == 'HUF'){ echo "selected"; } ?> value="HUF">Hungarian forint</option>
                              <option <?php if($res->user_currency_type == 'IDR'){ echo "selected"; } ?> value="IDR">Indonesian rupiah</option>
                              <option <?php if($res->user_currency_type == 'ILS'){ echo "selected"; } ?> value="ILS">Israeli new shekel</option>
                              <option <?php if($res->user_currency_type == 'IMP'){ echo "selected"; } ?> value="IMP">Manx pound</option>
                              <option <?php if($res->user_currency_type == 'INR'){ echo "selected"; } ?> value="INR">Indian rupee</option>
                              <option <?php if($res->user_currency_type == 'IQD'){ echo "selected"; } ?> value="IQD">Iraqi dinar</option>
                              <option <?php if($res->user_currency_type == 'IRR'){ echo "selected"; } ?> value="IRR">Iranian rial</option>
                              <option <?php if($res->user_currency_type == 'ISK'){ echo "selected"; } ?> value="ISK">Icelandic króna</option>
                              <option <?php if($res->user_currency_type == 'JEP'){ echo "selected"; } ?> value="JEP">Jersey pound</option>
                              <option <?php if($res->user_currency_type == 'JMD'){ echo "selected"; } ?> value="JMD">Jamaican dollar</option>
                              <option <?php if($res->user_currency_type == 'JOD'){ echo "selected"; } ?> value="JOD">Jordanian dinar</option>
                              <option <?php if($res->user_currency_type == 'JPY'){ echo "selected"; } ?> value="JPY">Japanese yen</option>
                              <option <?php if($res->user_currency_type == 'KES'){ echo "selected"; } ?> value="KES">Kenyan shilling</option>
                              <option <?php if($res->user_currency_type == 'KGS'){ echo "selected"; } ?> value="KGS">Kyrgyzstani som</option>
                              <option <?php if($res->user_currency_type == 'KHR'){ echo "selected"; } ?> value="KHR">Cambodian riel</option>
                              <option <?php if($res->user_currency_type == 'KMF'){ echo "selected"; } ?> value="KMF">Comorian franc</option>
                              <option <?php if($res->user_currency_type == 'KPW'){ echo "selected"; } ?> value="KPW">North Korean won</option>
                              <option <?php if($res->user_currency_type == 'KRW'){ echo "selected"; } ?> value="KRW">South Korean won</option>
                              <option <?php if($res->user_currency_type == 'KWD'){ echo "selected"; } ?> value="KWD">Kuwaiti dinar</option>
                              <option <?php if($res->user_currency_type == 'KYD'){ echo "selected"; } ?> value="KYD">Cayman Islands dollar</option>
                              <option <?php if($res->user_currency_type == 'KZT'){ echo "selected"; } ?> value="KZT">Kazakhstani tenge</option>
                              <option <?php if($res->user_currency_type == 'LAK'){ echo "selected"; } ?> value="LAK">Lao kip</option>
                              <option <?php if($res->user_currency_type == 'LBP'){ echo "selected"; } ?> value="LBP">Lebanese pound</option>
                              <option <?php if($res->user_currency_type == 'LKR'){ echo "selected"; } ?> value="LKR">Sri Lankan rupee</option>
                              <option <?php if($res->user_currency_type == 'LRD'){ echo "selected"; } ?> value="LRD">Liberian dollar</option>
                              <option <?php if($res->user_currency_type == 'LSL'){ echo "selected"; } ?> value="LSL">Lesotho loti</option>
                              <option <?php if($res->user_currency_type == 'LTL'){ echo "selected"; } ?> value="LTL">Lithuanian litas</option>
                              <option <?php if($res->user_currency_type == 'LVL'){ echo "selected"; } ?> value="LVL">Latvian lats</option>
                              <option <?php if($res->user_currency_type == 'LYD'){ echo "selected"; } ?> value="LYD">Libyan dinar</option>
                              <option <?php if($res->user_currency_type == 'MAD'){ echo "selected"; } ?> value="MAD">Moroccan dirham</option>
                              <option <?php if($res->user_currency_type == 'MDL'){ echo "selected"; } ?> value="MDL">Moldovan leu</option>
                              <option <?php if($res->user_currency_type == 'MGA'){ echo "selected"; } ?> value="MGA">Malagasy ariary</option>
                              <option <?php if($res->user_currency_type == 'MKD'){ echo "selected"; } ?> value="MKD">Macedonian denar</option>
                              <option <?php if($res->user_currency_type == 'MMK'){ echo "selected"; } ?> value="MMK">Burmese kyat</option>
                              <option <?php if($res->user_currency_type == 'MNT'){ echo "selected"; } ?> value="MNT">Mongolian tögrög</option>
                              <option <?php if($res->user_currency_type == 'MOP'){ echo "selected"; } ?> value="MOP">Macanese pataca</option>
                              <option <?php if($res->user_currency_type == 'MRO'){ echo "selected"; } ?> value="MRO">Mauritanian ouguiya</option>
                              <option <?php if($res->user_currency_type == 'MUR'){ echo "selected"; } ?> value="MUR">Mauritian rupee</option>
                              <option <?php if($res->user_currency_type == 'MVR'){ echo "selected"; } ?> value="MVR">Maldivian rufiyaa</option>
                              <option <?php if($res->user_currency_type == 'MWK'){ echo "selected"; } ?> value="MWK">Malawian kwacha</option>
                              <option <?php if($res->user_currency_type == 'MXN'){ echo "selected"; } ?> value="MXN">Mexican peso</option>
                              <option <?php if($res->user_currency_type == 'MYR'){ echo "selected"; } ?> value="MYR">Malaysian ringgit</option>
                              <option <?php if($res->user_currency_type == 'MZN'){ echo "selected"; } ?> value="MZN">Mozambican metical</option>
                              <option <?php if($res->user_currency_type == 'NAD'){ echo "selected"; } ?> value="NAD">Namibian dollar</option>
                              <option <?php if($res->user_currency_type == 'NGN'){ echo "selected"; } ?> value="NGN">Nigerian naira</option>
                              <option <?php if($res->user_currency_type == 'NIO'){ echo "selected"; } ?> value="NIO">Nicaraguan córdoba</option>
                              <option <?php if($res->user_currency_type == 'NOK'){ echo "selected"; } ?> value="NOK">Norwegian krone</option>
                              <option <?php if($res->user_currency_type == 'NPR'){ echo "selected"; } ?> value="NPR">Nepalese rupee</option>
                              <option <?php if($res->user_currency_type == 'NZD'){ echo "selected"; } ?> value="NZD">New Zealand dollar</option>
                              <option <?php if($res->user_currency_type == 'OMR'){ echo "selected"; } ?> value="OMR">Omani rial</option>
                              <option <?php if($res->user_currency_type == 'PAB'){ echo "selected"; } ?> value="PAB">Panamanian balboa</option>
                              <option <?php if($res->user_currency_type == 'PEN'){ echo "selected"; } ?> value="PEN">Peruvian nuevo sol</option>
                              <option <?php if($res->user_currency_type == 'PGK'){ echo "selected"; } ?> value="PGK">Papua New Guinean kina</option>
                              <option <?php if($res->user_currency_type == 'PHP'){ echo "selected"; } ?> value="PHP">Philippine peso</option>
                              <option <?php if($res->user_currency_type == 'PKR'){ echo "selected"; } ?> value="PKR">Pakistani rupee</option>
                              <option <?php if($res->user_currency_type == 'PLN'){ echo "selected"; } ?> value="PLN">Polish złoty</option>
                              <option <?php if($res->user_currency_type == 'PRB'){ echo "selected"; } ?> value="PRB">Transnistrian ruble</option>
                              <option <?php if($res->user_currency_type == 'PYG'){ echo "selected"; } ?> value="PYG">Paraguayan guaraní</option>
                              <option <?php if($res->user_currency_type == 'QAR'){ echo "selected"; } ?> value="QAR">Qatari riyal</option>
                              <option <?php if($res->user_currency_type == 'RON'){ echo "selected"; } ?> value="RON">Romanian leu</option>
                              <option <?php if($res->user_currency_type == 'RSD'){ echo "selected"; } ?> value="RSD">Serbian dinar</option>
                              <option <?php if($res->user_currency_type == 'RUB'){ echo "selected"; } ?> value="RUB">Russian ruble</option>
                              <option <?php if($res->user_currency_type == 'RWF'){ echo "selected"; } ?> value="RWF">Rwandan franc</option>
                              <option <?php if($res->user_currency_type == 'SAR'){ echo "selected"; } ?> value="SAR">Saudi riyal</option>
                              <option <?php if($res->user_currency_type == 'SBD'){ echo "selected"; } ?> value="SBD">Solomon Islands dollar</option>
                              <option <?php if($res->user_currency_type == 'SCR'){ echo "selected"; } ?> value="SCR">Seychellois rupee</option>
                              <option <?php if($res->user_currency_type == 'SDG'){ echo "selected"; } ?> value="SDG">Singapore dollar</option>
                              <option <?php if($res->user_currency_type == 'SEK'){ echo "selected"; } ?> value="SEK">Swedish krona</option>
                              <option <?php if($res->user_currency_type == 'SGD'){ echo "selected"; } ?> value="SGD">Singapore dollar</option>
                              <option <?php if($res->user_currency_type == 'SHP'){ echo "selected"; } ?> value="SHP">Saint Helena pound</option>
                              <option <?php if($res->user_currency_type == 'SLL'){ echo "selected"; } ?> value="SLL">Sierra Leonean leone</option>
                              <option <?php if($res->user_currency_type == 'SOS'){ echo "selected"; } ?> value="SOS">Somali shilling</option>
                              <option <?php if($res->user_currency_type == 'SRD'){ echo "selected"; } ?> value="SRD">Surinamese dollar</option>
                              <option <?php if($res->user_currency_type == 'SSP'){ echo "selected"; } ?> value="SSP">South Sudanese pound</option>
                              <option <?php if($res->user_currency_type == 'STD'){ echo "selected"; } ?> value="STD">São Tomé and Príncipe dobra</option>
                              <option <?php if($res->user_currency_type == 'SVC'){ echo "selected"; } ?> value="SVC">Salvadoran colón</option>
                              <option <?php if($res->user_currency_type == 'SYP'){ echo "selected"; } ?> value="SYP">Syrian pound</option>
                              <option <?php if($res->user_currency_type == 'SZL'){ echo "selected"; } ?> value="SZL">Swazi lilangeni</option>
                              <option <?php if($res->user_currency_type == 'THB'){ echo "selected"; } ?> value="THB">Thai baht</option>
                              <option <?php if($res->user_currency_type == 'TJS'){ echo "selected"; } ?> value="TJS">Tajikistani somoni</option>
                              <option <?php if($res->user_currency_type == 'TMT'){ echo "selected"; } ?> value="TMT">Turkmenistan manat</option>
                              <option <?php if($res->user_currency_type == 'TND'){ echo "selected"; } ?> value="TND">Tunisian dinar</option>
                              <option <?php if($res->user_currency_type == 'TOP'){ echo "selected"; } ?> value="TOP">Tongan paʻanga</option>
                              <option <?php if($res->user_currency_type == 'TRY'){ echo "selected"; } ?> value="TRY">Turkish lira</option>
                              <option <?php if($res->user_currency_type == 'TTD'){ echo "selected"; } ?> value="TTD">Trinidad and Tobago dollar</option>
                              <option <?php if($res->user_currency_type == 'TWD'){ echo "selected"; } ?> value="TWD">New Taiwan dollar</option>
                              <option <?php if($res->user_currency_type == 'TZS'){ echo "selected"; } ?> value="TZS">Tanzanian shilling</option>
                              <option <?php if($res->user_currency_type == 'UAH'){ echo "selected"; } ?> value="UAH">Ukrainian hryvnia</option>
                              <option <?php if($res->user_currency_type == 'UGX'){ echo "selected"; } ?> value="UGX">Ugandan shilling</option>
                              <option <?php if($res->user_currency_type == 'USD'){ echo "selected"; } ?> value="USD">United States dollar</option>
                              <option <?php if($res->user_currency_type == 'UYU'){ echo "selected"; } ?> value="UYU">Uruguayan peso</option>
                              <option <?php if($res->user_currency_type == 'UZS'){ echo "selected"; } ?> value="UZS">Uzbekistani som</option>
                              <option <?php if($res->user_currency_type == 'VEF'){ echo "selected"; } ?> value="VEF">Venezuelan bolívar</option>
                              <option <?php if($res->user_currency_type == 'VND'){ echo "selected"; } ?> value="VND">Vietnamese đồng</option>
                              <option <?php if($res->user_currency_type == 'VUV'){ echo "selected"; } ?> value="VUV">Vanuatu vatu</option>
                              <option <?php if($res->user_currency_type == 'WST'){ echo "selected"; } ?> value="WST">Samoan tālā</option>
                              <option <?php if($res->user_currency_type == 'XAF'){ echo "selected"; } ?> value="XAF">Central African CFA franc</option>
                              <option <?php if($res->user_currency_type == 'XCD'){ echo "selected"; } ?> value="XCD">East Caribbean dollar</option>
                              <option <?php if($res->user_currency_type == 'XOF'){ echo "selected"; } ?> value="XOF">West African CFA franc</option>
                              <option <?php if($res->user_currency_type == 'XPF'){ echo "selected"; } ?> value="XPF">CFP franc</option>
                              <option <?php if($res->user_currency_type == 'YER'){ echo "selected"; } ?> value="YER">Yemeni rial</option>
                              <option <?php if($res->user_currency_type == 'ZAR'){ echo "selected"; } ?> value="ZAR">South African rand</option>
                              <option <?php if($res->user_currency_type == 'ZMW'){ echo "selected"; } ?> value="ZMW">Zambian kwacha</option>
                              <option <?php if($res->user_currency_type == 'ZWL'){ echo "selected"; } ?> value="ZWL">Zimbabwean dollar</option>
                              </select>
                            </div>
                             <div class="col-md-4 col-sm-4">
                               <label>Fax Number</label>
                                <input name="employee_fax" class="form-control" type="text" id="employee_fax" value="<?php echo $res->user_fax; ?>" />
                                  <?php echo form_error('employee_fax','<span class="text-danger">','</span>'); ?>             
                            </div> 
                           
                         </div>
                       </div>                     
                        <div class="row">
                         <div class="form-group">
                             
                            <div class="col-md-4 col-sm-4">
                             <label>employee Status<span class="text-danger">*</span></label>
                                <select name="employee_status" id="employee_status" class="form-control">
                                    <option <?php if($res->user_status == '1'){ echo "selected";} ?> value="1">Active</option>
                                    <option value="0" <?php if($res->user_status == '0'){ echo "selected";} ?>>Inactive</option>
                                </select>
                                <?php echo form_error('employee_status','<span class="text-danger">','</span>'); ?>
                           </div>                           
                          </div>
                         </div>
                         <div class="col-md-12">
                         <div class="alert alert-warning">
                        <h4>employee Social Details</h4>
                        </div>                          
                         </div>

                         <div class="row">
                         <div class="form-group">
                            <div class="col-md-4 col-sm-4">
                              <label>Skype Id<span class="text-danger"></span></label>
                                <input type="text" name="employee_skype_id" value="<?php echo $res->user_skype_id;?>" class="form-control">
                                <?php echo form_error('employee_skype_id','<span class="text-danger">','</span>'); ?>
                            </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Facebook Url</label>
                                <input name="employee_fb_id" class="form-control" type="text" id="employee_fb_id" value="<?php echo $res->user_facebook_url; ?>" />
                                  <?php echo form_error('employee_fb_id','<span class="text-danger">','</span>'); ?>
                            </div>

                            <div class="col-md-4 col-sm-4">
                              <label>Twitter Id</label>
                                <input name="employee_twitter_id" class="form-control" type="text" id="employee_twitter_id" value="<?php echo $res->user_twitter_id; ?>" />
                                  <?php echo form_error('employee_twitter_id','<span class="text-danger">','</span>'); ?>
                            </div>
                          </div>
                         </div>

                         <div class="row">
                         <div class="form-group">
                            <div class="col-md-4 col-sm-4">
                               <label>Linkedin Url</label>
                                <input name="employee_linkedin_url" class="form-control" type="text" id="employee_linkedin_url" value="<?php echo $res->user_linkedin_url; ?>" />
                                  <?php echo form_error('employee_linkedin_url','<span class="text-danger">','</span>'); ?>             
                            </div> 
                          
                            <div class="col-md-6 col-sm-6">
                              <label>employee Short Note<span class="text-danger">*</span></label>
                               <textarea name="employee_short_note" class="form-control"><?php echo $res->user_short_note; ?></textarea>
                                <?php echo form_error('employee_short_note','<span class="text-danger">','</span>'); ?>
                           </div>
                           
                          </div>
                         </div>

                         <h5 id="change_pass_btn"><a href="javascript:;" onclick="show_change_password()">Click To Change Password</a></h5>
                         <div id="change_pass" style="display: none;">
                         <input type="hidden" name="check_change_password" id="check_change_password" >
                          <div class="col-md-12">
                            <div class="alert alert-warning">
                             <h4>Change Password</h4>
                            </div>                          
                          </div>
                           <div class="row">
                             <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                  <label>New Password <span class="text-danger">*</span></label>
                                    <input type="password" id="employee_new_pass" name="employee_new_pass" value="" class="form-control">
                                     <span style="color: red;" id="error_new_pass"></span>
                                   
                                </div>
                                <div class="col-md-6 col-sm-6">
                                  <label>Confirm New Password <span class="text-danger"> *</span></label>
                                    <input name="employee_c_new_pass" class="form-control" type="password" id="employee_c_new_pass" value="" /> 
                                    <span style="color: red;" id="error_c_new_pass"></span>
                                </div>
                              </div>
                            </div>
                         </div>
                      <?php
                      }
                      ?>
                  </fieldset>
                  <div class="row">
                     <div class="col-md-1">
                        <button type="submit" name="Submit" value="Profile" class="btn btn-teal margin-top-30">Submit</button>
                     </div>
                     <div class="col-md-1">
                        <a href="<?php echo base_url();?>employee" ><button type="button" class="btn btn-danger margin-top-30 margin-left-30">Cancel</button></a>
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
  function show_change_password()
  {
    $('#change_pass').show();
    $('#check_change_password').val('1');
    $('#change_pass_btn').html('<a href="javascript:;" onclick="cancel_cahange_pass()" >Cancel</a>');
  }

  function cancel_cahange_pass()
  {
    $('#change_pass').hide();
    $('#check_change_password').val('');
    $('#change_pass_btn').html('<a href="javascript:;" onclick="show_change_password()" >Click To Change Password</a>');
  }
  function checkProfileUpdate()
  {

   if($('#employee_email').val() == "")
    {         
       $('#error_email').html('Email is required *');
       $("#employee_email").focus();
       return false;
    }
    else
    {      
          if($('#validate_email').val() == '1')
          {
            $('#error_email').html('This email is already ragistered!.');
            $("#employee_email").focus();           
            return false;
          }    
          else
          {
            $('#error_email').html('');

          } 
    }
    if($('#check_change_password').val() == '1')
    {
      if($('#employee_new_pass').val() == "")
      {         
         $('#error_new_pass').html('Password is required *');
         $("#employee_new_pass").focus();
         return false;
      }
      else
      {
        $('#error_new_pass').html('');
      }
      if($('#employee_c_new_pass').val() == "")
      {       
          $('#error_c_new_pass').html('Please enter your confirm Password.');
          $("#employee_c_new_pass").focus();       
          return false;     
      }
      else
      {
          if ($('#employee_c_new_pass').val() == $('#employee_new_pass').val())
          {            
              $('#error_c_new_pass').html('');
              return true;
           
           }
           else
           {            
               $('#error_c_new_pass').html('Password and confirm Password is not match.');
               $("#employee_c_new_pass").focus();
               return false;            
           }      
       }
     }   

  }

  function check_email_address(emailId)
  {
   
        var action_check_emailId = 'check_email';       
        var check_dataString = 'action_check_emailId=' + action_check_emailId + '&user_ragister_email=' + emailId;  
        var check_PAGE = '<?php echo base_url();?>login/checkUserEmailId'; 
          $.ajax({
          type: "POST",
          url: check_PAGE,
          data: check_dataString,
          cache: false,         
          success: function(check_data)
          {
            
            if(check_data == "1")
            {            
              $('#validate_email').val('1');             
              return false;
            }
            else
            {
              $('#error_email').html('');
              $('#validate_email').val('0');             
            }  
           }
          }); 

    }
    $(function () {
       
        $('#emp_dob_i').datetimepicker({
             format: 'Y-M-D'
        });    
    });

    function getStateList(country_id)
    {
        var str = 'country_id='+country_id;
        var PAGE = '<?php echo base_url(); ?>login/getStateList';
        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,
            success:function(data)
            {           
                if(data != "")
                {
                    $('#employee_state_id').html(data);
                }
                else
                {
                    $('#employee_state_id').html('<option value=""></option>');
                }
            } 
        });
    }
</script>