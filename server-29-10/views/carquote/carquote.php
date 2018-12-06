<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>webroot/carquote/style.css">
<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Car Quote</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Car Quote</li>
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
                        <div class="row">                            
                            <div class="col-md-6">
                                <label class="pull-left">First Name</label>
                                <input type="text" name="personal_info_fname" id="aaaaaa_1" placeholder="" />
                            </div>
                            <div class="col-md-6">
                                <label class="pull-left">Last Name</label>
                                <input type="text" name="personal_info_lname" id="aaaaaa_1" placeholder="" />
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6">
                                <label class="pull-left">Date of Birth</label>
                                <input type="text" name="personal_info_dob" class="datepicker" id="aaaaaa_1" placeholder="" />
                            </div>
                            <div class="col-md-6">
                                <label class="pull-left">Address</label>
                                <input type="text" name="personal_info_address" id="aaaaaa_1" placeholder="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="pull-left">City</label>
                                <input type="text" name="personal_info_city" id="aaaaaa_1" placeholder="" />
                            </div>
                            <div class="col-md-6">
                                <label class="pull-left">Postal code</label>
                                <input type="text" name="personal_info_postal" id="aaaaaa_1" placeholder="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="pull-left">Primary Phone number</label>
                                <input type="text" name="personal_info_primery_phone" id="aaaaaa_1" placeholder="" />
                            </div>
                            <div class="col-md-6">
                                <label class="pull-left">Secondary Phone number</label>
                                <input type="text" name="personal_info_secnd_phone" id="aaaaaa_1" placeholder="" />
                            </div>
                        </div>   
                        <div class="row">                           
                            <div class="col-md-6">
                                <label class="pull-left">Did they authorise the company to make a credit score verification?</label><br/><br/>
                                <div class="col-md-3">
                                    <input type="radio"  value="Yes" name="personal_info_credit_score">
                                    <p style="text-align: left;">Yes</p>
                                </div>
                                <div class="col-md-3">
                                    <input type="radio" value="No" name="personal_info_credit_score">
                                    <p style="text-align: left;">No</p>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <label class="pull-left">When is the best time to reach you?(AM - PM)</label>
                                <input type="text" name="personal_info_time" id="aaaaaa_1" placeholder="" />
                            </div>
                        </div> 
                        <div class="row">                            
                            <div class="col-md-6">
                                <label class="pull-left">Do you have any criminal file</label>
                                <select name="personal_info_criminal_file">
                                    <option value="">Select Your Value</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>                                
                            </div>
                            <div class="col-md-6">
                                <label class="pull-left">can you explain what it was?</label>
                                <input type="text" name="personal_info_explain" id="aaaaaa_1" placeholder="" />
                            </div>
                        </div>
                        

                        <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>


                    <!-- *********************************************************************** -->
                    <fieldset>
                        <h2 class="fs-title">Car Information</h2>
                        <ul class="nav nav-tabs" id="tab_link">
                            <li id="tab_link_car_1" class="active"><a data-toggle="tab" href="#tab_view_car_1">Car 1</a></li>
                        </ul>
                        <div class="tab-content" id="tab_view">
                            <div id="tab_view_car_1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="pull-right">
                                        <button type="button" onclick="addAnotherVehicle('Yes', 1);" class="btn btn-success">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>

                                        <input type="hidden" id="another_vehicle_val_1" value="1">
                                        <input type="hidden" id="total_car" name="total_car" value="1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="pull-left">Brand of vehicle</label>
                                        <input type="text" name="car_info_brand_1" id="aaaaaa_1" placeholder="" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="pull-left">Model</label>
                                        <input type="text" name="car_info_model_1" id="aaaaaa_1" placeholder="" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="pull-left">Year</label>
                                        <input type="text" name="car_info_year_1" id="aaaaaa_1" placeholder="" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="pull-left">The vehicle is a purchase or a lease</label>
                                        <select name="car_info_purchese_lease_1">
                                            <option value="">Select Your Value</option>
                                            <option value="Purchase"> Purchase</option>
                                            <option value="Lease"> Lease</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">                           
                                    <div class="col-md-6">
                                        <label class="pull-left">Serial number</label>
                                        <input type="text" name="car_info_serial_num_1" id="aaaaaa_1" placeholder="" />
                                    </div>                                           
                                    <div class="col-md-6">
                                        <label class="pull-left">How many KM for business purpose</label>
                                        <input type="text" name="car_info_business_purpose_km_1" id="aaaaaa_1" placeholder="" />
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <label class="pull-left">How much was the vehicle</label>
                                        <input type="text" name="car_info_vehicle_1" id="aaaaaa_1" placeholder="" />
                                    </div>
                                     <div class="col-md-6">
                                        <label class="pull-left">How many KM per year</label>
                                        <input type="text" name="car_info_year_km_1" id="aaaaaa_1" placeholder="" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="pull-left">Is the vehicule</label>
                                        <select name="car_info_is_vehicle_1">
                                            <option value="">Select Your Value</option>
                                            <option value="Brand new">Brand new</option>
                                            <option value="Used">Used</option>
                                            <option value="Demo under 5K">Demo under 5K</option>
                                            <option value="Demo under 10K">Demo under 10K</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="pull-left">How many KM to go to work</label>
                                        <input type="text" name="car_info_work_km_1" id="aaaaaa_1" placeholder="" />
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-6">
                                        <label class="pull-left">When vehicule has been purchase</label>
                                        <input  type="text" name="car_info_vehicle_purchese_1" class="datepicker" value="" >
                                    </div>
                                    <div class="col-md-6">
                                        <label class="pull-left">Did they transport something</label>
                                        <select name="car_info_transport_1">
                                            <option value="">Select Your Value</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="pull-left">Do you go outside of the province with the vehicle</label>
                                        <select name="car_info_province_1">
                                            <option value="">Select Your Value</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                                       
                            </div>                           
                        </div>
                        <input type="button" name="previous" class="previous action-button" value="Previous" />
                        <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>
                    <!-- *********************************************************** -->
                    <fieldset>
                        <h2 class="fs-title">Driver Information</h2>
                        <ul class="nav nav-tabs" id="d_tab">
                            <li id="d_tab_link_1" class="active"><a data-toggle="tab" href="#d_tab_view_1">Driver 1</a></li>
                        </ul>
                        <div class="tab-content" id="d_tab_view">
                            <div id="d_tab_view_1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="pull-right">
                                        <button type="button" id="btn_add_1"  onclick="addAnotherDriver('Yes', 1);" class="btn btn-success">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>

                                        <input type="hidden" id="another_driver_val_1" value="1">
                                        <input type="hidden" id="total_driver" name="total_driver" value="1">
                                    </div>
                                </div>
                                <div class="row">                            
                                    <div class="col-md-6">
                                        <label class="pull-left">First Name</label>
                                        <input type="text" name="driver_info_fname_1" id="fname_1" placeholder="" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="pull-left">Last Name</label>
                                        <input type="text" name="driver_info_lname_1" id="lname_1" placeholder="" />
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="pull-left">Date of Birth</label>
                                        <input type="text" name="driver_info_dob_1"  class="datepicker" id="aaaaaa_1" placeholder="" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="pull-left">Are you</label>
                                        <select  name="driver_info_are_you_1" id="aaaaaa_1">
                                            <option value="">Select Your Value</option>
                                            <option value="Single">Single</option>
                                            <option value="Commun law">Commun law</option>
                                            <option value="Married">Married</option>
                                            <option value="Widdow">Widdow</option>
                                            <option value="Divorce">Divorce</option>
                                            <option value="Relation">Relation</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="pull-left">Owner of the vehicle</label>
                                        <select  name="driver_info_owner_1" id="aaaaaa_1">
                                            <option value="">Select Your Value</option>
                                            <option value="spouse">spouse</option>
                                            <option value="children family">children family</option>
                                            <option value="friend">friend</option>
                                            <option value="other">other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="pull-left">Driver licence number</label>
                                        <input type="text" name="driver_info_licence_num_1" id="aaaaaa_1" placeholder="" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="pull-left">From witch province</label>
                                        <select  name="driver_info_province_1" id="aaaaaa_1">
                                            <option value="">Select Your Value</option>
                                            <option value="Quebec">Quebec</option>
                                            <option value="Alberta">Alberta</option>
                                            <option value="Ontario">Ontario</option>
                                            <option value="New Brunswick">New Brunswick</option>
                                            <option value="Saskatchewan">Saskatchewan</option>
                                            <option value="Manitoba">Manitoba</option>
                                            <option value="colombie Britanique">colombie Britanique</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="pull-left">When did you get your firts driver license?</label>
                                        <input type="text" name="driver_info_license_date_1" id="aaaaaa_1" class="datepicker" placeholder="" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="pull-left">Since when are you driving a vehicle has a owner and has primary driver?</label>
                                        <input type="text" name="driver_info_primary_date_1" id="aaaaaa_1" class="datepicker" placeholder="" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="pull-left">Did you follow a course?</label>
                                        <select  name="driver_info_follow_course_1" id="aaaaaa_1">
                                            <option value="">Select Your Value</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                                                              
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="pull-left">Did you have any conviction in the past 3 year's?</label>
                                        <input type="text" name="driver_info_conviction_1" id="aaaaaa_1" placeholder="" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="pull-left">Witch vehicle are you driving has a primary driver?</label>
                                       <select  name="driver_info_primary_driver_1" id="add_car">
                                            <option value="">Select Your Value</option>
                                            <option value="1">1</option>
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
                        </div>                        
                        <input type="button" name="previous" class="previous action-button" value="Previous" />
                        <input type="button" name="next" onclick="addDriverName(1);" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">Vehicle Claim</h2>
                         <ul class="nav nav-tabs" id="c_tab">
                            <li id="c_tab_link_1" class="active"><a data-toggle="tab" href="#c_tab_view_1">Claim 1</a></li>
                        </ul>
                        <div class="tab-content" id="c_tab_view">
                            <div id="c_tab_view_1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="pull-right">
                                        <button type="button" onclick="addAnotherClaim('Yes', 1);" class="btn btn-success">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                        <input type="hidden" name="totel_vehicle_claim" id="another_claim_val_1" value="1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="pull-left">Who was driving the vehicle?</label>
                                        <select  name="vehicle_claim_driver_1" id="driver_name_1">
                                            <option value="">Select Your Value</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="pull-left">need to know when</label>
                                        <input type="text" name="vehicle_claim_need_know_1" id="aaaaaa_1" placeholder="" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="pull-left">need to know if they were responsible</label>
                                        <select name="vehicle_claim_responsible_1" id="aaaaaa_1">
                                            <option value="">Select Your Value</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="pull-left">small explanation of how the claim happen</label>
                                        <input type="text" name="vehicle_claim_explain_1" id="aaaaaa_1" placeholder="" />
                                    </div>
                                </div>  
                               <!--  <div class="row">
                                    <div class="col-md-6">
                                        <label class="pull-left">Add More Claim</label>
                                        <select name="aaaaaa_1" id="aaaaaa_1" onchange="addAnotherClaim(this.value, 1);">
                                            <option value="">Select Your Value</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                         <input type="hidden" id="another_claim_val_1" value="1">
                                    </div>
                                </div>   -->
                            </div>
                        </div>
                        <input type="button" name="previous" class="previous action-button" value="Previous" />
                        <input type="button" name="next" onclick="addVehicleProtection('ADD');" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">Vehicle protection</h2>
                        <div id="protection_div">
                        </div>
                        <ul class="nav nav-tabs" id="c_vp_tab">
                            
                        </ul>
                        <div class="tab-content" id="c_vp_tab_view">
                            
                        </div>
                        <input type="button" name="previous" onclick="addVehicleProtection('REMOVE');" class="previous action-button" value="Previous" />
                        <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">insurance Information</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="pull-left">With who are you insured? </label>
                                <input type="text" name="insurance_info_insured" id="aaaaaa_1" placeholder="" />
                            </div>
                            <div class="col-md-6">
                                <label class="pull-left">How much do you pay without the taxe</label>
                                <input type="text" name="insurance_info_tax" id="aaaaaa_1" placeholder="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="pull-left">The policy number </label>
                                <input type="text" name="insurance_info_policy_num" id="aaaaaa_1" placeholder="" />
                            </div>
                            <div class="col-md-6">
                                <label class="pull-left">The renewal date</label>
                                <input type="text" class="datepicker" name="insurance_info_renewal" id="aaaaaa_1" placeholder="" />
                            </div>
                        </div>
                        <input type="button" name="previous"   class="previous action-button" value="Previous" />
                        <input type="submit" name="submit" class="submit action-button" value="Submit" />
                     </fieldset>
                  </form>
                
            </div>
        </div>
            
        <div class="tab-pane" id="create">
                    
        </div>
    </div>
</section>


