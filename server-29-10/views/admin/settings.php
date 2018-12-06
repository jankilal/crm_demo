
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
   <div class="col-lg-12">
                    <div class="row">
    <div class="col-lg-12">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked navbar-custom-nav">
                <li class="active">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings">
                        <i class="fa fa-fw fa-info-circle"></i>
                        Company Details                    </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/system">
                        <i class="fa fa-fw fa-desktop"></i>
                        System Settings                    </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/email">
                        <i class="fa fa-fw fa-envelope"></i>
                        Email Settings                    </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/templates">
                        <i class="fa fa-fw fa-pencil-square"></i>
                        Email Templates                    </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/email_integration">
                        <i class="fa fa-fw fa-envelope-o"></i>
                        Email Integration                    </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/payments">
                        <i class="fa fa-fw fa-dollar"></i>
                        Payment Settings                    </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/invoice">
                        <i class="fa fa-fw fa-money"></i>
                        Invoice Settings                    </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/estimate">
                        <i class="fa fa-fw fa-file-o"></i>
                        Estimate Settings                    </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/tickets">
                        <i class="fa fa-fw fa-ticket"></i>
                        Tickets &amp; Leads Settings                    </a>
                </li>

                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/theme">
                        <i class="fa fa-fw fa-code"></i>
                        Theme Settings                    </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/income_category">
                        <i class="fa fa-fw fa-certificate"></i>
                        Income Category                    </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/expense_category">
                        <i class="fa fa-fw fa-tasks"></i>
                        Expense Category                    </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/lead_status">
                        <i class="fa fa-fw fa-list-ul"></i>
                                             </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/lead_source">
                        <i class="fa fa-fw fa-arrow-down"></i>
                        Lead Source                    </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/opportunities_state_reason">
                        <i class="fa fa-fw fa-dot-circle-o"></i>
                        Opportunities State Reason                    </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/custom_field">
                        <i class="fa fa-fw fa-star-o "></i>
                        Custom Field                    </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/payment_method">
                        <i class="fa fa-fw fa-money"></i>
                        Payment Method                    </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/department">
                        <i class="fa fa-fw fa-list-alt"></i>
                        Department                    </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/cronjob">
                        <i class="fa fa-fw fa-contao"></i>
                        Cronjob                    </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/menu_allocation">
                        <i class="fa fa-fw fa fa-compass"></i>
                        Menu Allocation                    </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/notification">
                        <i class="fa fa-fw fa-bell-o"></i>
                        Notifications                    </a>
                </li>
                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/database_backup">
                        <i class="fa fa-fw fa-database"></i>
                        Backup Database                    </a>
                </li>

                <li class="">
                    <a href="http://sixthsenseit.com/toshow/crm/admin/settings/translations">
                        <i class="fa fa-fw fa-language"></i>
                        Translations                    </a>
                </li>
            </ul>
        </div>

        <section class="col-sm-9">
            <div class="col-sm-8  ">

                
            </div>
            <section class="">
                <!-- Load the settings form in views -->
                <div class="row">
    <!-- Start Form -->
    <div class="col-lg-12">
        <form role="form" id="form" action="http://sixthsenseit.com/toshow/crm/admin/settings/save_settings" method="post" class="form-horizontal  ">
            <section class="panel panel-custom">
                <header class="panel-heading  ">Company Details</header>
                <div class="panel-body">
                    <input type="hidden" name="settings" value="general">
                    <input type="hidden" name="languages" value="">


                    <div class="form-group">
                        <label class="col-lg-3 control-label">Company Name <span class="text-danger">*</span></label>
                        <div class="col-lg-7">
                            <input type="text" name="company_name" class="form-control" value="BACS-Billing Accounting and CRM PRO" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Legal Name <span class="text-danger">*</span></label>
                        <div class="col-lg-7">
                            <input type="text" name="company_legal_name" class="form-control" value="BACS-PRO" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Contact Person </label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" value="John Smith" name="contact_person">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Company Address <span class="text-danger">*</span></label>
                        <div class="col-lg-7">
                            <textarea class="form-control" name="company_address" required="">123, XYZ street</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Country</label>
                        <div class="col-lg-7">
                            <select class="form-control select_box select2-hidden-accessible" style="width:100%" name="company_country" tabindex="-1" aria-hidden="true">
                               
                               </select><span class="select2 select2-container select2-container--bootstrap" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-company_country-02-container"><span class="select2-selection__rendered" id="select2-company_country-02-container" title="Pakistan">Pakistan</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">City</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" value="London" name="company_city">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Zip Code </label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" value="SE1 7PB" name="company_zip_code">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Company Phone</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" value="2342432" name="company_phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Company Email</label>
                        <div class="col-lg-7">
                            <input type="email" class="form-control" value="test@gmail.com" name="company_email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Company Website</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" value="maidsontime.com" name="company_domain">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Company VAT</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" value="" name="company_vat">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3"></label>
                    <div class="col-lg-7">
                        <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                    </div>
                </div>
            </section>
        </form>
    </div>
    <!-- End Form -->
</div>

                <!-- End of settings Form -->
            </section>
        </section>
    </div>
</div>
</div>
</section>