<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>webroot/carquote/style.css">
<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Client</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">client</li>
      </ol>
   </header>
   <!-- /page title -->
    <div class="tab-content bg-white">
        <!-- ************** general *************-->
         <div id="msg_div">
            <?php echo $this->session->flashdata('message');?>
        </div>
        <div class="tab-pane active" id="manage">            
            <div class="panel panel-custom">              
                 <form id="msform" method="POST" >
                     <!-- progressbar -->
                     <ul id="progressbar">
                        <li class="active"></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                     </ul>
                    <!--  <ul id="progressbar">
                        <li class="active">First Step</li>
                        <li>Second Step</li>
                        <li>Third Step</li>
                        <li>Fourth Step</li>
                        <li>Fifth Step</li>
                        <li>Final Step</li>
                     </ul> -->
                     <!-- fieldsets -->
                     <fieldset>
                        <h2 class="fs-title">Personal Information</h2>
                        <?php
                        foreach ($personal_profile as $p_i) 
                        {
                            ?>
                            <div class="row">                            
                                <div class="col-md-6">
                                <input type="hidden" name="personal_profile_id" value="<?php echo $p_i->personal_info_id; ?>">
                                    <label class="pull-left">First Name</label>
                                    <input type="text" value="<?php echo $p_i->personal_info_fname;?>" name="personal_info_fname" id="aaaaaa_1" placeholder="" />
                                </div>
                                <div class="col-md-6">
                                    <label class="pull-left">Last Name</label>
                                    <input type="text" value="<?php echo $p_i->personal_info_lname;?>" name="personal_info_lname" id="aaaaaa_1" placeholder="" />
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="pull-left">Date of Birth</label>
                                    <input type="text" value="<?php echo $p_i->personal_info_dob;?>" name="personal_info_dob" class="datepicker" id="aaaaaa_1" placeholder="" />
                                </div>
                                <div class="col-md-6">
                                    <label class="pull-left">Address</label>
                                    <input type="text" value="<?php echo $p_i->personal_info_address;?>" name="personal_info_address" id="aaaaaa_1" placeholder="" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="pull-left">City</label>
                                    <input type="text" value="<?php echo $p_i->personal_info_city;?>" name="personal_info_city" id="aaaaaa_1" placeholder="" />
                                </div>
                                <div class="col-md-6">
                                    <label class="pull-left">Postal code</label>
                                    <input type="text" value="<?php echo $p_i->personal_info_postal;?>" name="personal_info_postal" id="aaaaaa_1" placeholder="" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="pull-left">Primary Phone number</label>
                                    <input type="text" value="<?php echo $p_i->personal_info_primery_phone;?>" name="personal_info_primery_phone" id="aaaaaa_1" placeholder="" />
                                </div>
                                <div class="col-md-6">
                                    <label class="pull-left">Secondary Phone number</label>
                                    <input type="text" value="<?php echo $p_i->personal_info_secnd_phone;?>" name="personal_info_secnd_phone" id="aaaaaa_1" placeholder="" />
                                </div>
                            </div>   
                            <div class="row">                           
                                <div class="col-md-6">
                                    <label class="pull-left">Did they authorise the company to make a credit score verification?</label><br/><br/>
                                    <div class="col-md-3">
                                        <input <?php if($p_i->personal_info_credit_score == 'Yes'){ echo "checked"; } ?> type="radio"  value="Yes" name="personal_info_credit_score">
                                        <p style="text-align: left;">Yes</p>
                                    </div>
                                    <div class="col-md-3">
                                        <input <?php if($p_i->personal_info_credit_score == 'No'){ echo "checked"; } ?> type="radio" value="No" name="personal_info_credit_score">
                                        <p style="text-align: left;">No</p>
                                     </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="pull-left">When is the best time to reach you?(AM - PM)</label>
                                    <input type="text" value="<?php echo $p_i->personal_info_time;?>" name="personal_info_time" id="aaaaaa_1" placeholder="" />
                                </div>
                            </div> 
                            <div class="row">                            
                                <div class="col-md-6">
                                    <label class="pull-left">Do you have any criminal file</label>
                                    <select name="personal_info_criminal_file">
                                        <option <?php if($p_i->personal_info_criminal_file == 'Yes'){ echo "selected"; } ?> value="Yes">Yes</option>
                                        <option <?php if($p_i->personal_info_criminal_file == 'No'){ echo "selected"; } ?> value="No">No</option>
                                    </select>                                
                                </div>
                                <div class="col-md-6">
                                    <label class="pull-left">can you explain what it was?</label>
                                    <input type="text" value="<?php echo $p_i->personal_info_explain;?>" name="personal_info_explain" id="aaaaaa_1" placeholder="" />
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        
                        

                        <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>


                    <!-- *********************************************************************** -->
                    <fieldset>
                        <h2 class="fs-title">Car Information</h2>
                        <ul class="nav nav-tabs" id="tab_link">
                            <?php
                            $i=1;
                            foreach ($car_info as $c_info) 
                            {
                               ?>
                               <li id="tab_link_car_<?php echo $i; ?>" <?php if($i=='1'){ echo ' class="active"'; }?> ><a data-toggle="tab" href="#tab_view_car_<?php echo $i; ?>">Car <?php echo $i; ?></a></li>
                               <?php
                               $i++;
                            }
                            ?>
                            
                        </ul>
                        <div class="tab-content" id="tab_view">
                            <?php
                            $j=1;
                            foreach ($car_info as $c_info) 
                            {
                               ?>
                                <div id="tab_view_car_<?php echo $j; ?>" class="tab-pane fade <?php if($j==1){ echo 'in active'; } ?>">
                                    <div class="row">
                                        <?php
                                        if($j == count($car_info))
                                        {
                                            ?>
                                            <div class="pull-right">
                                                <button type="button" onclick="addAnotherVehicle('Yes', <?php echo $j; ?>);" class="btn btn-success">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>

                                                <input type="hidden" id="another_vehicle_val_<?php echo $j; ?>" value="<?php echo $j; ?>">
                                                <input type="hidden" id="last_car_count" value="<?php echo $j; ?>">
                                                <input type="hidden" id="total_car" name="total_car" value="<?php echo $j; ?>">
                                                 <input type="hidden" id="total_edit_car" name="total_edit_car" value="0">
                                            </div>
                                            <?php
                                        }
                                        ?>
                                            
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="pull-left">Brand of vehicle</label>
                                            <input type="text" value="<?php echo $c_info->car_info_brand; ?>" name="car_info_brand_<?php echo $j; ?>" id="aaaaaa_1" placeholder="" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="pull-left">Model</label>
                                            <input type="text" value="<?php echo $c_info->car_info_model; ?>" name="car_info_model_<?php echo $j; ?>" id="aaaaaa_1" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="pull-left">Year</label>
                                            <input type="text" value="<?php echo $c_info->car_info_year; ?>" name="car_info_year_<?php echo $j; ?>" id="aaaaaa_1" placeholder="" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="pull-left">The vehicle is a purchase or a lease</label>
                                            <select name="car_info_purchese_lease_<?php echo $j; ?>">
                                                <option <?php if($c_info->car_info_purchese_lease == 'Purchase'){ echo "selected"; } ?> value="Purchase"> Purchase</option>
                                                <option <?php if($c_info->car_info_purchese_lease == 'Lease'){ echo "selected"; } ?> value="Lease"> Lease</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">                           
                                        <div class="col-md-6">
                                            <label class="pull-left">Serial number</label>
                                            <input type="text" value="<?php echo $c_info->car_info_serial_num; ?>" name="car_info_serial_num_<?php echo $j; ?>" id="aaaaaa_1" placeholder="" />
                                        </div>                                           
                                        <div class="col-md-6">
                                            <label class="pull-left">How many KM for business purpose</label>
                                            <input type="text" value="<?php echo $c_info->car_info_business_purpose_km; ?>" name="car_info_business_purpose_km_<?php echo $j; ?>" id="aaaaaa_1" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <label class="pull-left">How much was the vehicle</label>
                                            <input type="text" value="<?php echo $c_info->car_info_vehicle; ?>" name="car_info_vehicle_<?php echo $j; ?>" id="aaaaaa_1" placeholder="" />
                                        </div>
                                         <div class="col-md-6">
                                            <label class="pull-left">How many KM per year</label>
                                            <input type="text" value="<?php echo $c_info->car_info_year_km; ?>" name="car_info_year_km_<?php echo $j; ?>" id="aaaaaa_1" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="pull-left">Is the vehicule</label>
                                            <select name="car_info_is_vehicle_<?php echo $j; ?>">
                                                <option <?php if($c_info->car_info_is_vehicle == 'Brand new'){ echo "selected"; } ?> value="Brand new">Brand new</option>
                                                <option <?php if($c_info->car_info_is_vehicle == 'Used'){ echo "selected"; } ?> value="Used">Used</option>
                                                <option <?php if($c_info->car_info_is_vehicle == 'Demo under 5K'){ echo "selected"; } ?> value="Demo under 5K">Demo under 5K</option>
                                                <option <?php if($c_info->car_info_is_vehicle == 'Demo under 10K'){ echo "selected"; } ?> value="Demo under 10K">Demo under 10K</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="pull-left">How many KM to go to work</label>
                                            <input type="text" value="<?php echo $c_info->car_info_work_km; ?>" name="car_info_work_km_<?php echo $j; ?>" id="aaaaaa_1" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-md-6">
                                            <label class="pull-left">When vehicule has been purchase</label>
                                            <input  type="text" value="<?php echo $c_info->car_info_vehicle_purchese; ?>" name="car_info_vehicle_purchese_<?php echo $j; ?>" class="datepicker" value="" >
                                        </div>
                                        <div class="col-md-6">
                                            <label class="pull-left">Did they transport something</label>
                                            <select name="car_info_transport_<?php echo $j; ?>">
                                                <option <?php if($c_info->car_info_transport == 'Yes'){ echo "selected"; } ?> value="Yes">Yes</option>
                                                <option <?php if($c_info->car_info_transport == 'No'){ echo "selected"; } ?> value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="pull-left">Do you go outside of the province with the vehicle</label>
                                            <select name="car_info_province_<?php echo $j; ?>">
                                                <option <?php if($c_info->car_info_province == 'Yes'){ echo "selected"; } ?> value="Yes">Yes</option>
                                                <option <?php if($c_info->car_info_province == 'No'){ echo "selected"; } ?> value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                                           
                                </div>                           
                               <?php
                               $j++;
                            }
                            ?>
                            </div>
                            
                        <input type="button" name="previous" class="previous action-button" value="Previous" />
                        <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>
                    <!-- *********************************************************** -->
                    <fieldset>
                        <h2 class="fs-title">Driver Information</h2>
                        <ul class="nav nav-tabs" id="d_tab">
                            <?php
                            $k=1;
                            foreach ($driver_info as $d_info) 
                            {
                                ?>
                                <li id="d_tab_link_<?php echo $k; ?>" <?php if($k==1){ echo 'class="active"'; } ?>><a data-toggle="tab" href="#d_tab_view_<?php echo $k; ?>">Driver <?php echo $k; ?></a></li>
                                <?php
                            $k++;
                            }
                            ?>
                            
                        </ul>
                        <div class="tab-content" id="d_tab_view">
                            <?php
                            $kk=1;
                            foreach ($driver_info as $d_info) 
                            {
                                ?>
                                <div id="d_tab_view_<?php echo $kk; ?>" class="tab-pane fade <?php if($kk==1){ echo ' in active'; } ?>">
                                    <?php
                                    if($kk == count($driver_info))
                                    {
                                        ?>
                                        <div class="row">
                                            <div class="pull-right">
                                                <button type="button" id="btn_add_1"  onclick="addAnotherDriver('Yes', <?php echo $kk; ?>);" class="btn btn-success">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>

                                                <input type="hidden" id="another_driver_val_<?php echo $kk; ?>" value="<?php echo $kk; ?>">
                                                <input type="hidden" id="total_driver" name="total_driver" value="<?php echo $kk; ?>">
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    
                                    <div class="row">                            
                                        <div class="col-md-6">
                                            <label class="pull-left">First Name</label>
                                            <input type="text" value="<?php echo $d_info->driver_info_fname; ?>" name="driver_info_fname_<?php echo $kk; ?>" id="fname_1" placeholder="" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="pull-left">Last Name</label>
                                            <input type="text" value="<?php echo $d_info->driver_info_lname; ?>" name="driver_info_lname_<?php echo $kk; ?>" id="lname_1" placeholder="" />
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="pull-left">Date of Birth</label>
                                            <input type="text" value="<?php echo $d_info->driver_info_dob; ?>" name="driver_info_dob_<?php echo $kk; ?>"  class="datepicker" id="aaaaaa_1" placeholder="" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="pull-left">Are you</label>
                                            <select  name="driver_info_are_you_<?php echo $kk; ?>" id="aaaaaa_1">
                                                <option <?php if($d_info->driver_info_are_you == 'Single'){ echo "selected"; } ?> value="Single">Single</option>
                                                <option <?php if($d_info->driver_info_are_you == 'Commun law'){ echo "selected"; } ?> value="Commun law">Commun law</option>
                                                <option <?php if($d_info->driver_info_are_you == 'Married'){ echo "selected"; } ?> value="Married">Married</option>
                                                <option <?php if($d_info->driver_info_are_you == 'Widdow'){ echo "selected"; } ?> value="Widdow">Widdow</option>
                                                <option <?php if($d_info->driver_info_are_you == 'Divorce'){ echo "selected"; } ?> value="Divorce">Divorce</option>
                                                <option <?php if($d_info->driver_info_are_you == 'Relation'){ echo "selected"; } ?> value="Relation">Relation</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="pull-left">Owner of the vehicle</label>
                                            <select  name="driver_info_owner_<?php echo $kk; ?>" id="aaaaaa_1">
                                                <option <?php if($d_info->driver_info_owner == 'spouse'){ echo "selected"; } ?> value="spouse">spouse</option>
                                                <option <?php if($d_info->driver_info_owner == 'children family'){ echo "selected"; } ?> value="children family">children family</option>
                                                <option <?php if($d_info->driver_info_owner == 'friend'){ echo "selected"; } ?> value="friend">friend</option>
                                                <option <?php if($d_info->driver_info_owner == 'other'){ echo "selected"; } ?> value="other">other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="pull-left">Driver licence number</label>
                                            <input type="text" value="<?php echo $d_info->driver_info_licence_num; ?>"  name="driver_info_licence_num_<?php echo $kk; ?>" id="aaaaaa_1" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="pull-left">From witch province</label>
                                            <select  name="driver_info_province_<?php echo $kk; ?>" id="aaaaaa_1">
                                                <option <?php if($d_info->driver_info_province == 'Quebec'){ echo "selected"; } ?> value="Quebec">Quebec</option>
                                                <option <?php if($d_info->driver_info_province == 'Alberta'){ echo "selected"; } ?> value="Alberta">Alberta</option>
                                                <option <?php if($d_info->driver_info_province == 'Ontario'){ echo "selected"; } ?> value="Ontario">Ontario</option>
                                                <option <?php if($d_info->driver_info_province == 'New Brunswick'){ echo "selected"; } ?> value="New Brunswick">New Brunswick</option>
                                                <option <?php if($d_info->driver_info_province == 'Saskatchewan'){ echo "selected"; } ?> value="Saskatchewan">Saskatchewan</option>
                                                <option <?php if($d_info->driver_info_province == 'Manitoba'){ echo "selected"; } ?> value="Manitoba">Manitoba</option>
                                                <option <?php if($d_info->driver_info_province == 'colombie Britanique'){ echo "selected"; } ?> value="colombie Britanique">colombie Britanique</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="pull-left">When did you get your firts driver license?</label>
                                            <input type="text" value="<?php echo $d_info->driver_info_license_date; ?>" name="driver_info_license_date_<?php echo $kk; ?>" id="aaaaaa_1" class="datepicker" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="pull-left">Since when are you driving a vehicle has a owner and has primary driver?</label>
                                            <input type="text" value="<?php echo $d_info->driver_info_primary_date; ?>" name="driver_info_primary_date_<?php echo $kk; ?>" id="aaaaaa_1" class="datepicker" placeholder="" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="pull-left">Did you follow a course?</label>
                                            <select  name="driver_info_follow_course_<?php echo $kk; ?>" id="aaaaaa_1">
                                                <option <?php if($d_info->driver_info_follow_course == 'Yes'){ echo "selected"; } ?> value="Yes">Yes</option>
                                                <option <?php if($d_info->driver_info_follow_course == 'No'){ echo "selected"; } ?> value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                                                                  
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="pull-left">Did you have any conviction in the past 3 year's?</label>
                                            <input type="text" value="<?php echo $d_info->driver_info_conviction; ?>" name="driver_info_conviction_<?php echo $kk; ?>" id="aaaaaa_1" placeholder="" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="pull-left">Witch vehicle are you driving has a primary driver?</label>
                                           <select  name="driver_info_primary_driver_<?php echo $kk; ?>" id="add_car">
                                                <?php
                                                for($ii=1; $ii<=count($car_info); $ii++)
                                                {
                                                    ?>
                                                    <option <?php if($ii == $d_info->driver_info_primary_driver){ echo 'selected'; } ?> value="<?php echo $ii; ?>"><?php echo $ii; ?></option>
                                                    <?php
                                                }
                                                ?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-md-6">
                                            <label class="pull-left">Any other driver?</label>
                                            <select id="aaaaaa_1" name="aaaaaa_1" onchange="addAnotherDriver(this.value, 1);">
                                                <option value="">Select Your Value</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            <input type="hidden" id="another_driver_val_1" value="1">
                                            <input type="hidden" id="total_driver" value="1">
                                        </div>
                                    </div> -->
                                </div>
                                <?php
                            $kk++;
                            }
                            ?>
                            
                        </div>                        
                        <input type="button" name="previous" class="previous action-button" value="Previous" />
                        <input type="button" name="next" onclick="addDriverName(1);" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">Vehicle Claim</h2>
                         <ul class="nav nav-tabs" id="c_tab">
                            <?php
                            $m=1;
                            foreach ($vehicle_claim as $v_claim) 
                            {
                                ?>
                                <li id="c_tab_link_<?php echo $m; ?>" class="active"><a data-toggle="tab" href="#c_tab_view_<?php echo $m; ?>">Claim <?php echo $m; ?></a></li>
                                <?php
                            $m++;
                            }
                            ?>
                            
                        </ul>
                        <div class="tab-content" id="c_tab_view">
                            <?php
                            $mm=1;
                            foreach ($vehicle_claim as $v_claim) 
                            {
                                ?>
                                <div id="c_tab_view_<?php echo $mm; ?>" class="tab-pane fade <?php if($mm == 1){ echo 'in active'; } ?>">
                                    <?php
                                    if($mm == count($vehicle_claim))
                                    {
                                        ?>
                                            <div class="row">
                                                <div class="pull-right">
                                                    <button type="button" onclick="addAnotherClaim('Yes', <?php echo $mm; ?>);" class="btn btn-success">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                    </button>
                                                    <input type="hidden" name="totel_vehicle_claim" id="another_claim_val_<?php echo $mm; ?>" value="<?php echo $mm; ?>">
                                                </div>
                                            </div>
                                        <?php
                                    }
                                    ?>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="pull-left">Who was driving the vehicle?</label>
                                            <select  name="vehicle_claim_driver_<?php echo $mm; ?>" id="driver_name_1">
                                                <?php
                                                foreach ($driver_info as $d_info_c) 
                                                {
                                                    ?>
                                                    <option <?php if($v_claim->vehicle_claim_driver == $d_info_c->driver_info_fname.' '.$d_info_c->driver_info_lname){ echo "selected"; } ?> value="<?php echo $d_info_c->driver_info_fname.' '.$d_info_c->driver_info_lname; ?>"><?php echo $d_info_c->driver_info_fname.' '.$d_info_c->driver_info_lname; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="pull-left">need to know when</label>
                                            <input type="text" value="<?php echo $v_claim->vehicle_claim_need_know; ?>" name="vehicle_claim_need_know_<?php echo $mm; ?>" id="aaaaaa_1" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="pull-left">need to know if they were responsible</label>
                                            <select name="vehicle_claim_responsible_<?php echo $mm; ?>" id="aaaaaa_1">
                                                <option <?php if($v_claim->vehicle_claim_responsible == 'Yes'){ echo "selected"; } ?> value="Yes">Yes</option>
                                                <option <?php if($v_claim->vehicle_claim_responsible == 'No'){ echo "selected"; } ?> value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="pull-left">small explanation of how the claim happen</label>
                                            <input type="text" value="<?php echo $v_claim->vehicle_claim_explain; ?>"  name="vehicle_claim_explain_<?php echo $mm; ?>" id="aaaaaa_1" placeholder="" />
                                        </div>
                                    </div>  
                                   
                                </div>
                                <?php
                            $mm++;
                            }
                            ?>
                            
                        </div>
                        <input type="button" name="previous" class="previous action-button" value="Previous" />
                        <input type="button" name="next" onclick="addVehicleProtection('ADD');" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">Vehicle protection</h2>
                        <div id="protection_div">
                        </div>
                        <ul class="nav nav-tabs" id="c_vp_tab">
                            <?php
                            $vp=1;
                            foreach ($vehicle_protect as $vp_info) 
                            {
                               ?>
                                <li id="c_vp_tab_link_<?php echo $vp; ?>" <?php if($vp==1){ echo 'class="active"'; } ?> >
                                   <a data-toggle="tab" href="#c_vp_tab_view_<?php echo $vp; ?>">Car <?php echo $vp; ?></a>
                                </li>
                               <?php
                               $vp++;
                            }
                            ?>
                            
                        </ul>
                        <div class="tab-content" id="c_vp_tab_view">
                            <?php
                            $vpt=1;
                            foreach ($vehicle_protect as $vp_info) 
                            {
                                $endorsement = explode(',', $vp_info->vehicle_protect_endorsement);

                               ?>
                               <div id="c_vp_tab_view_<?php echo $vpt; ?>" class="tab-pane <?php if($vpt==1){ echo 'in active'; } ?>">
                                  <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="pull-left">Liability</label>
                                                    <select name="vehicle_protect_liability_<?php echo $vpt; ?>" id="aaaaaa_<?php echo $vpt; ?>">
                                                        <option <?php if($vp_info->vehicle_protect_liability == '1 Million'){ echo "selected"; } ?> value="1 Million">1 Million</option>
                                                        <option <?php if($vp_info->vehicle_protect_liability == '2 Million'){ echo "selected"; } ?>  value="2 Million">2 Million</option>
                                                    </select>
                                            </div>
                                        </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="pull-left">B1:All Peril</label>
                                            <input type="text" value="<?php echo $vp_info->vehicle_protect_peril; ?>" name="vehicle_protect_peril_<?php echo $vpt; ?>" id="aaaaaa_<?php echo $vpt; ?>" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="pull-left">B2: Collision and upset</label>
                                            <input type="text" value="<?php echo $vp_info->vehicle_protect_collision_upset; ?>" name="vehicle_protect_collision_upset_<?php echo $vpt; ?>" id="aaaaaa_<?php echo $vpt; ?>" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="pull-left">B3: Comprehensive</label>
                                            <input type="text" value="<?php echo $vp_info->vehicle_protect_comprehensive; ?>" name="vehicle_protect_comprehensive_<?php echo $vpt; ?>" id="aaaaaa_<?php echo $vpt; ?>" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="pull-left">B4: Specified peril</label>
                                            <input type="text" value="<?php echo $vp_info->vehicle_protect_specified_peril; ?>" name="vehicle_protect_specified_peril_<?php echo $vpt; ?>" id="aaaaaa_<?php echo $vpt; ?>" placeholder="" />
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="pull-left">Do you have any other protection or comment to make?</label>
                                                <textarea name="vehicle_protect_comment_<?php echo $vpt; ?>" id="aaaaaa_<?php echo $vpt; ?>" rows="8"><?php echo $vp_info->vehicle_protect_comment; ?> </textarea>
                                            </div>
                                       </div>
                                   </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                           <label class="pull-left">Endorsement</label>
                                            <br/>
                                            <br/>
                                           <div class="col-md-2">
                                                <input type="checkbox" <?php if (in_array("1", $endorsement)) { echo "checked"; } ?> name="vehicle_protect_endorsement_<?php echo $vpt; ?>[]">
                                                <p class="pull-left">2</p>
                                           </div>
                                            <div class="col-md-2">
                                                    <input type="checkbox" <?php if (in_array("2", $endorsement)) { echo "checked"; } ?> name="vehicle_protect_endorsement_<?php echo $vpt; ?>[]">
                                                    <p class="pull-left">20</p>
                                            </div>
                                            <div class="col-md-2">
                                                    <input type="checkbox" <?php if (in_array("3", $endorsement)) { echo "checked"; } ?> name="vehicle_protect_endorsement_<?php echo $vpt; ?>[]">
                                                    <p class="pull-left">34</p>
                                            </div>
                                            <div class="col-md-2">
                                                    <input type="checkbox" <?php if (in_array("on", $endorsement)) { echo "checked"; } ?> name="vehicle_protect_endorsement_<?php echo $vpt; ?>[]">
                                                    <p class="pull-left">27</p>
                                            </div>
                                            <div class="col-md-2">
                                                    <input type="checkbox" <?php if (in_array("4", $endorsement)) { echo "checked"; } ?> name="vehicle_protect_endorsement_<?php echo $vpt; ?>[]">
                                                    <p class="pull-left">41</p>
                                            </div>
                                            <div class="col-md-2">
                                                    <input type="checkbox" <?php if (in_array("5", $endorsement)) { echo "checked"; } ?> name="vehicle_protect_endorsement_<?php echo $vpt; ?>[]">
                                                    <p class="pull-left">43A&E</p>
                                            </div>
                                            <div class="col-md-4">
                                                    <input type="checkbox" <?php if (in_array("on", $endorsement)) { echo "checked"; } ?> name="vehicle_protect_endorsement_<?php echo $vpt; ?>[]">
                                                    <p class="pull-left">I dont know</p>
                                            </div>
                                     </div>  
                                 </div>
                                    
                                                           
                                </div>                           
                               <?php
                               $vpt++;
                            }
                            ?>
                            </div>
                        <input type="button" name="previous" onclick="addVehicleProtection('REMOVE');" class="previous action-button" value="Previous" />
                        <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset>

                        <h2 class="fs-title">insurance Information</h2>
                        <?php foreach ($insurance_info as $ii_value) {
                            # code...
                        } ?>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="pull-left">With who are you insured? </label>
                                <input type="text" name="insurance_info_insured" id="aaaaaa_1" placeholder="" value="<?php echo $ii_value->insurance_info_insured; ?>" />
                            </div>
                            <div class="col-md-6">
                                <label class="pull-left">How much do you pay without the taxe</label>
                                <input type="text" name="insurance_info_tax" id="aaaaaa_1" placeholder="" value="<?php echo $ii_value->insurance_info_tax; ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="pull-left">The policy number </label>
                                <input type="text" name="insurance_info_policy_num" id="aaaaaa_1" placeholder="" value="<?php echo $ii_value->insurance_info_policy_num; ?>" />
                            </div>
                            <div class="col-md-6">
                                <label class="pull-left">The renewal date</label>
                                <input type="text" class="datepicker" name="insurance_info_renewal" id="aaaaaa_1" placeholder="" value="<?php echo $ii_value->insurance_info_renewal; ?>" />
                            </div>
                        </div>
                        <input type="button" name="previous"   class="previous action-button" value="Previous" />
                        <input type="submit" name="update" class="submit action-button" value="Update" />
                     </fieldset>
                  </form>
                
            </div>
        </div>
            
        <div class="tab-pane" id="create">
                    
        </div>
    </div>
</section>
<!-- jQuery easing plugin --> 
      
      <script>
         $(function() {
         
         //jQuery time
         var current_fs, next_fs, previous_fs; //fieldsets
         var left, opacity, scale; //fieldset properties which we will animate
         var animating; //flag to prevent quick multi-click glitches
         
         $(".next").click(function(){
            if(animating) return false;
            animating = true;
            
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();
            
            //activate next step on progressbar using the index of next_fs
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
            
            //show the next fieldset
            next_fs.show(); 
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale current_fs down to 80%
                    scale = 1 - (1 - now) * 0.2;
                    //2. bring next_fs from the right(50%)
                    left = (now * 50)+"%";
                    //3. increase opacity of next_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({'transform': 'scale('+scale+')'});
                    next_fs.css({'left': left, 'opacity': opacity});
                }, 
                duration: 800, 
                complete: function(){
                    current_fs.hide();
                    animating = false;
                }, 
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
         });
         
         $(".previous").click(function(){
            if(animating) return false;
            animating = true;
            
            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();
            
            //de-activate current step on progressbar
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
            
            //show the previous fieldset
            previous_fs.show(); 
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale previous_fs from 80% to 100%
                    scale = 0.8 + (1 - now) * 0.2;
                    //2. take current_fs to the right(50%) - from 0%
                    left = ((1-now) * 50)+"%";
                    //3. increase opacity of previous_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({'left': left});
                    previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
                }, 
                duration: 800, 
                complete: function(){
                    current_fs.hide();
                    animating = false;
                }, 
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
         });         
         
         
         });
        </script>
        <script type="text/javascript">
        function addAnotherVehicle(other_vehicle, num_val)
        {            
            if(other_vehicle == 'Yes')
            {
                var car_number = $('#another_vehicle_val_'+num_val).val();
                var edit_car_num = $('#total_edit_car').val();
                var new_edit_car = parseInt(edit_car_num) + 1;
                var new_car_number = parseInt(car_number) + 1;                
                var a = "'No'";
                var b = "'Yes'";
                //var car_number = $('#another_vehicle_val_'+new_car_number).val();
                $('#tab_link').append('<li id="tab_link_car_'+new_car_number+'" class="active"><a data-toggle="tab" href="#tab_view_car_'+new_car_number+'">Car # '+new_car_number+'   </a></li>');
                $('#tab_view').append('<div id="tab_view_car_'+new_car_number+'" class="tab-pane fade in active"><div class="row"><div class="pull-right"><button id="c_add_btn_'+new_car_number+'" type="button" onclick="addAnotherVehicle('+b+', '+new_car_number+');" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></button>&nbsp;&nbsp;<button id="c_remove_btn_'+new_car_number+'"  type="button" onclick="addAnotherVehicle('+a+', '+new_car_number+');" class="btn btn-danger btn-sm"><span class="fa fa-remove"></span></button><input type="hidden" id="another_vehicle_val_'+new_car_number+'" value="'+new_car_number+'"><input type="hidden" id="total_car_OLD" value="'+new_car_number+'"></div></div><div class="row"><div class="col-md-6"><label class="pull-left">Brand of vehicle</label><input type="text" name="car_info_brand_'+new_car_number+'" id="aaaaaa_'+new_car_number+'" placeholder="" /></div><div class="col-md-6"><label class="pull-left">Model</label><input type="text" name="car_info_model_'+new_car_number+'" id="aaaaaa_'+new_car_number+'" placeholder="" /></div></div><div class="row"><div class="col-md-6"><label class="pull-left">Year</label><input type="text" name="car_info_year_'+new_car_number+'" id="aaaaaa_'+new_car_number+'" placeholder="" /></div><div class="col-md-6"><label class="pull-left">The vehicle is a purchase or a lease</label><select name="car_info_purchese_lease_'+new_car_number+'" id="aaaaaa_'+new_car_number+'"><option value="">Select Your Value</option><option value="Purchase"> Purchase</option><option value="Lease"> Lease</option></select></div></div><div class="row"><div class="col-md-6"><label class="pull-left">Serial number</label><input type="text" name="car_info_serial_num_'+new_car_number+'" id="aaaaaa_'+new_car_number+'" placeholder="" /></div><div class="col-md-6"><label class="pull-left">How many KM for business purpose</label><input type="text" class="datepicker" name="car_info_business_purpose_km_'+new_car_number+'" id="aaaaaa_'+new_car_number+'" placeholder="" /></div></div><div class="row"><div class="col-md-6"><label class="pull-left">How much was the vehicle</label><input type="text" name="car_info_vehicle_'+new_car_number+'" id="aaaaaa_'+new_car_number+'" placeholder="" /></div><div class="col-md-6"><label class="pull-left">How many KM per year</label><input type="text" name="car_info_year_km_'+new_car_number+'" id="aaaaaa_'+new_car_number+'" placeholder="" /></div></div><div class="row"><div class="col-md-6"><label class="pull-left">Is the vehicule</label><select name="car_info_is_vehicle_'+new_car_number+'" id="aaaaaa_'+new_car_number+'"><option value="">Select Your Value</option><option value="Brand new">Brand new</option><option value="Used">Used</option><option value="Demo under 5K">Demo under 5K</option><option value="Demo under 10K">Demo under 10K</option></select></div><div class="col-md-6"><label class="pull-left">How many KM to go to work</label><input type="text" name="car_info_work_km_'+new_car_number+'" id="aaaaaa_'+new_car_number+'" placeholder="" /></div></div><div class="row"><div class="col-md-6"><label class="pull-left">When vehicule has been purchase</label><input  type="text" name="car_info_vehicle_purchese_'+new_car_number+'" id="datepicker_'+new_car_number+'" class="datepicker" value="" ></div><div class="col-md-6"><label class="pull-left">Did they transport something</label><select name="car_info_transport_'+new_car_number+'" id="aaaaaa_'+new_car_number+'" ><option value="">Select Your Value</option><option value="Yes">Yes</option><option value="No">No</option></select></div></div><div class="row"><div class="col-md-6"><label class="pull-left">Do you go outside of the province with the vehicle</label><input type="text" name="car_info_province_'+new_car_number+'" id="aaaaaa_'+new_car_number+'" placeholder="" /></div></div>   </div>');
                $('#tab_link_car_'+car_number).removeClass('active');
                $('#tab_view_car_'+car_number).removeClass('in active');
               // $('#another_vehicle_val').val(new_car_number);
                $('#total_car').val(new_car_number);
                $('#total_edit_car').val(new_edit_car);
                $('#add_car').append('<option value="'+new_car_number+'">'+new_car_number+'</option>');
                $('#c_add_btn_'+car_number).hide();
                $('#c_remove_btn_'+car_number).hide();


                $('#datepicker_'+new_car_number).datepicker({
                   format: 'yyyy-mm-dd'
                });                 
            }
            else if(other_vehicle == 'No')
            {
                var car_number = $('#another_vehicle_val_'+num_val).val();
                var new_car_number = parseInt(car_number) - 1;
                $('#tab_link_car_'+new_car_number).addClass('active');
                $('#tab_view_car_'+new_car_number).addClass('in active');
                $('#tab_link_car_'+car_number).remove();
                $('#tab_view_car_'+car_number).remove();
                $('#c_add_btn_'+new_car_number).show();
                $('#c_remove_btn_'+new_car_number).show();
                $('#total_car').val(new_car_number);
            }
        }

        function addAnotherDriver(driver_val, d_num_val)
        {
            var a = "'No'";
            var b = "'Yes'";
            if(driver_val == 'Yes')
            {
                
                var driver_num = $('#another_driver_val_'+d_num_val).val();
                //alert(driver_num);
                var new_d_number = parseInt(driver_num) + 1;
                $('#d_tab').append('<li id="d_tab_link_'+new_d_number+'" class="active"><a data-toggle="tab" href="#d_tab_view_'+new_d_number+'">Driver '+new_d_number+'</a></li>');
                $('#d_tab_view').append('<div id="d_tab_view_'+new_d_number+'" class="tab-pane fade in active"><div class="row"><div class="pull-right"><button id="btn_add_'+new_d_number+'" type="button" onclick="addAnotherDriver('+b+', '+new_d_number+');" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></button>&nbsp;&nbsp;<button id="btn_remove_'+new_d_number+'" type="button" onclick="addAnotherDriver('+a+', '+new_d_number+');" class="btn btn-danger btn-sm"><span class="fa fa-remove"></span></button><input type="hidden" id="another_driver_val_'+new_d_number+'" value="'+new_d_number+'"><input type="hidden" id="l_driver_val_'+new_d_number+'" value="'+new_d_number+'"><input type="hidden" id="total_driverOLD" value="'+new_d_number+'"></div></div><div class="row"><div class="col-md-6"><label class="pull-left">First Name</label><input type="text" name="driver_info_fname_'+new_d_number+'" id="fname_'+new_d_number+'" placeholder="" /></div><div class="col-md-6"><label class="pull-left">Last Name</label><input type="text" name="driver_info_lname_'+new_d_number+'" id="lname_'+new_d_number+'" placeholder="" /></div></div><div class="row"><div class="col-md-6"><label class="pull-left">Date of Birth</label><input type="text" name="driver_info_dob_'+new_d_number+'"  class="datepicker" id="driver_dob_datepicker_'+new_d_number+'" placeholder="" /></div><div class="col-md-6"><label class="pull-left">Are you</label><select name="driver_info_are_you_'+new_d_number+'" id="aaaaaa_'+new_d_number+'"><option value="">Select Your Value</option><option value="Single">Single</option><option value="Commun law">Commun law</option><option value="Married">Married</option><option value="Widdow">Widdow</option><option value="Divorce">Divorce</option><option value="Relation">Relation</option></select></div></div><div class="row"><div class="col-md-6"><label class="pull-left">Owner of the vehicle</label><select name="driver_info_owner_'+new_d_number+'" id="aaaaaa_'+new_d_number+'"><option value="">Select Your Value</option><option value="spouse">spouse</option><option value="children family">children family</option><option value="friend">friend</option><option value="other">other</option></select></div><div class="col-md-6"><label class="pull-left">Driver licence number</label><input type="text" name="driver_info_licence_num_'+new_d_number+'" id="aaaaaa_'+new_d_number+'" placeholder="" /></div></div><div class="row"><div class="col-md-6"><label class="pull-left">From witch province</label><select name="driver_info_province_'+new_d_number+'" id="aaaaaa_'+new_d_number+'"><option value="">Select Your Value</option><option value="Quebec">Quebec</option><option value="Alberta">Alberta</option><option value="Ontario">Ontario</option><option value="New Brunswick">New Brunswick</option><option value="Saskatchewan">Saskatchewan</option><option value="Manitoba">Manitoba</option><option value="colombie Britanique">colombie Britanique</option></select></div><div class="col-md-6"><label class="pull-left">When did you get your firts driver license?</label><input type="text" name="driver_info_license_date_'+new_d_number+'" id="aaaaaa_'+new_d_number+'" class="datepicker" placeholder="" /></div></div><div class="row"><div class="col-md-6"><label class="pull-left">Since when are you driving a vehicle has a owner and has primary driver?</label><input type="text" name="driver_info_primary_date_'+new_d_number+'" id="primary_driver_datepicker_'+new_d_number+'" class="datepicker" placeholder="" /></div><div class="col-md-6"><label class="pull-left">Did you follow a course?</label><select name="driver_info_follow_course_'+new_d_number+'" id="aaaaaa_'+new_d_number+'"><option value="">Select Your Value</option><option value="Yes">Yes</option><option value="No">No</option></select></div></div><div class="row"><div class="col-md-6"><label class="pull-left">Did you have any conviction in the past 3 years?</label><input type="text" name="driver_info_conviction_'+new_d_number+'" id="aaaaaa_'+new_d_number+'" placeholder="" /></div><div class="col-md-6"><label class="pull-left">Witch vehicle are you driving has a primary driver?</label><select  name="driver_info_primary_driver_'+new_d_number+'" id="add_car_'+new_d_number+'"><option value="">Select Your Value</option></select></div></div></div>');
                $('#d_tab_link_'+driver_num).removeClass('active');
                $('#d_tab_view_'+driver_num).removeClass('in active');               
                $('#total_driver').val(new_d_number);
                var total_car = $('#total_car').val();
                for (var i = 1; i <= total_car; i++) 
                {
                   $('#add_car_'+new_d_number).append('<option value="'+i+'">'+i+'</option>');
                }
                $('#btn_add_'+d_num_val).hide();
                $('#btn_remove_'+d_num_val).hide();
                $('#primary_driver_datepicker_'+new_d_number).datepicker({
                   format: 'yyyy-mm-dd'
                });
                $('#driver_dob_datepicker_'+new_d_number).datepicker({
                   format: 'yyyy-mm-dd'
                });
            }
            else if(driver_val == 'No')
            {
                var driver_num = $('#another_driver_val_'+d_num_val).val();
                var new_d_number = parseInt(driver_num) - 1;
                $('#d_tab_link_'+new_d_number).addClass('active');
                $('#d_tab_view_'+new_d_number).addClass('in active');
                $('#total_driver').val(new_d_number);
                $('#d_tab_link_'+driver_num).remove();
                $('#d_tab_view_'+driver_num).remove();
                $('#btn_add_'+new_d_number).show();
                $('#btn_remove_'+new_d_number).show();
                var total_car = $('#total_car').val();
                for (var i = 1; i <= total_car; i++) 
                {
                   $('#add_car_'+new_d_number).append('<option value="'+i+'">'+i+'</option>');
                }
            }
        }

        function addDriverName(dirver_num)
        {
            var total_driver = $('#total_driver').val();           
            for(j=1; j<=total_driver; j++)
            {
                var fname = $('#fname_'+j).val();
                var lname = $('#lname_'+j).val();
                $('#driver_name_'+dirver_num).append('<option value="'+fname+' '+lname+'">'+fname+' '+lname+'</option>');                
            }
        }


        function addAnotherClaim(claim_val, claim_num)
        {
            var a = "'No'";
            var b = "'Yes'";
            if(claim_val == 'Yes')
            {                
                var claim_num_n = claim_num;
                var new_c_number = parseInt(claim_num_n) + 1;
                $('#c_tab').append('<li id="c_tab_link_'+new_c_number+'" class="active"><a data-toggle="tab" href="#c_tab_view_'+new_c_number+'">Claim # '+new_c_number+'</a></li>');
                $('#c_tab_view').append('<div id="c_tab_view_'+new_c_number+'" class="tab-pane fade in active"><div class="row"><div class="pull-right"><button id="cl_add_btn_'+new_c_number+'" type="button" onclick="addAnotherClaim('+b+', '+new_c_number+');" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></button>&nbsp;&nbsp;<button id="cl_remove_btn_'+new_c_number+'"  type="button" onclick="addAnotherClaim('+a+', '+new_c_number+');" class="btn btn-danger btn-sm"><span class="fa fa-remove"></span></button><input type="hidden" id="another_claim_val_'+new_c_number+'" value="'+new_c_number+'"></div></div><div class="row"><div class="col-md-6"><label class="pull-left">Who was driving the vehicle?</label><select  name="vehicle_claim_driver_'+new_c_number+'" id="driver_name_'+new_c_number+'"><option value="">Select Your Value</option></select></div><div class="col-md-6"><label class="pull-left">need to know when</label><input type="text" name="vehicle_claim_need_know_'+new_c_number+'" id="aaaaaa_'+new_c_number+'" placeholder="" /></div></div><div class="row"><div class="col-md-6"><label class="pull-left">need to know if they were responsible</label><select name="vehicle_claim_responsible_'+new_c_number+'" id="aaaaaa_'+new_c_number+'"><option value="">Select Your Value</option><option value="Yes">Yes</option><option value="No">No</option></select></div><div class="col-md-6"><label class="pull-left">small explanation of how the claim happen</label><input type="text" name="vehicle_claim_explain_'+new_c_number+'" id="aaaaaa_'+new_c_number+'" placeholder="" /></div></div></div>');
                $('#c_tab_link_'+claim_num_n).removeClass('active');
                $('#c_tab_view_'+claim_num_n).removeClass('in active');
                $('#another_claim_val_'+claim_num_n).val(new_c_number);

                var total_driver = $('#total_driver').val();               
                for(j=1; j<=total_driver; j++)
                {
                    var fname = $('#fname_'+j).val();
                    var lname = $('#lname_'+j).val();
                    $('#driver_name_'+new_c_number).append('<option value="'+fname+' '+lname+'">'+fname+' '+lname+'</option>');                
                }
                $('#cl_add_btn_'+claim_num_n).hide();
                $('#cl_remove_btn_'+claim_num_n).hide();
            }
            else if(claim_val == 'No')
            {
                var claim_num_n = claim_num;
                var new_c_number = parseInt(claim_num_n) - 1;               
                $('#c_tab_link_'+new_c_number).addClass('active');
                $('#c_tab_view_'+new_c_number).addClass('in active');
                $('#c_tab_link_'+claim_num_n).remove();
                $('#c_tab_view_'+claim_num_n).remove();
                $('#cl_add_btn_'+new_c_number).show();
                $('#cl_remove_btn_'+new_c_number).show();                
            }
        }

       function addVehicleProtection(add_remove_val)
        {
            if(add_remove_val == 'ADD')
            {
                // $('#protection_div').html('<ul class="nav nav-tabs" id="c_vp_tab"></ul><div class="tab-content" id="c_vp_tab_view"></div>');
                var total_car = $('#total_edit_car').val();                
                var total_car_edit = $('#last_car_count').val();
                 var car_num = parseInt(total_car_edit)+1;
                var count_car_vp = parseInt(total_car)+parseInt(car_num);               
                for(j=car_num; j < count_car_vp; j++)            
                {   

                    $('#c_vp_tab').append('<li id="c_vp_tab_link_'+j+'" ><a data-toggle="tab" href="#c_vp_tab_view_'+j+'">Car '+j+'</a></li>');   
                    $('#c_vp_tab_view').append('<div id="c_vp_tab_view_'+j+'" class="tab-pane "><div class="row"><div class="col-md-6"><div class="row"><div class="col-md-12"><label class="pull-left">Liability</label><select name="vehicle_protect_liability_'+j+'" id="aaaaaa_'+j+'"><option value="">Select Your Value</option><option value="1 Million">1 Million</option><option value="2 Million">2 Million</option></select></div></div><div class="row"><div class="col-md-12"><label class="pull-left">B1:All Peril</label><input type="text" name="vehicle_protect_peril_'+j+'" id="aaaaaa_'+j+'" placeholder="" /></div></div><div class="row"><div class="col-md-12"><label class="pull-left">B2: Collision and upset</label><input type="text" name="vehicle_protect_collision_upset_'+j+'" id="aaaaaa_'+j+'" placeholder="" /></div></div><div class="row"><div class="col-md-12"><label class="pull-left">B3: Comprehensive</label><input type="text" name="vehicle_protect_comprehensive_'+j+'" id="aaaaaa_'+j+'" placeholder="" /></div></div><div class="row"><div class="col-md-12"><label class="pull-left">B4: Specified peril</label><input type="text" name="vehicle_protect_specified_peril_'+j+'" id="aaaaaa_'+j+'" placeholder="" /></div></div></div><div class="col-md-6"><div class="row"><div class="col-md-12"><label class="pull-left">Do you have any other protection or comment to make?</label><textarea name="vehicle_protect_comment_'+j+'" id="aaaaaa_'+j+'" rows="8"></textarea></div></div></div></div><div class="row"><div class="col-md-12"><label class="pull-left">Endorsement</label><br/><br/><div class="col-md-2"><input type="checkbox" name="vehicle_protect_endorsement_'+j+'[]"><p class="pull-left">2</p></div><div class="col-md-2"><input type="checkbox" name="vehicle_protect_endorsement_'+j+'[]"><p class="pull-left">20</p></div><div class="col-md-2"><input type="checkbox" name="vehicle_protect_endorsement_'+j+'[]"><p class="pull-left">34</p></div><div class="col-md-2"><input type="checkbox" name="vehicle_protect_endorsement_'+j+'[]"><p class="pull-left">27</p></div><div class="col-md-2"><input type="checkbox" name="vehicle_protect_endorsement_'+j+'[]"><p class="pull-left">41</p></div><div class="col-md-2"><input type="checkbox" name="vehicle_protect_endorsement_'+j+'[]"><p class="pull-left">43A&E</p></div><div class="col-md-4"><input type="checkbox" name="vehicle_protect_endorsement_'+j+'[]"><p class="pull-left">I dont know</p></div></div></div></div>');             
                }
            }
            else if(add_remove_val == 'REMOVE')
            {
                // $('#c_vp_tab').remove();
                // $('#c_vp_tab_view').remove();
                var total_car = $('#total_car').val();               
                for(j=1; j<=total_car; j++)            
                {
                    $('#c_vp_tab_link_'+j).remove();
                    $('#c_vp_tab_view_'+j).remove();
                } 
            }
            
        }
        </script>

