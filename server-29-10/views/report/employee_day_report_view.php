<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Day Wise Report</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Day Wise Report</li>
      </ol>
   </header>
   <!-- /page title -->
    <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
          <span class="title elipsis">
            <strong>Day Wise Report</strong> 
          </span>
        </div>
         <!-- panel content -->
        <div class="panel-body">
          <div id="msg_div">
              <?php echo $this->session->flashdata('message');?>
          </div>
          <form method="GET"  style="margin:0px">
          <div class="row">
            <div class="col-md-2">
              <p style="margin:0px;margin-top: 8px;"><strong>Search By Employee : </strong></p>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <select class="form-control" name="by_employee">
                  <option value="">Select Employee</option>
                  <?php
                  foreach ($employee_list as $e_res) 
                  {
                    ?>
                    <option <?= (isset($_GET['by_employee']) && $e_res->user_id == $_GET['by_employee']) ? 'selected' : ''; ?> value="<?= $e_res->user_id; ?>"><?= $e_res->user_full_name; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" class="form-control datepicker2" name="by_date" placeholder="<?= date('Y-m-d') ?>" value="<?= (isset($_GET['by_date']) && $_GET['by_date']) ? $_GET['by_date'] : date('Y-m-d'); ?>">
              </div>
            </div>
            <div class="col-md-2">
              <button class="btn btn-3d btn-reveal btn-teal" name="search" value="search-report"><i class="et-search"></i><span> Search</span></button>
            </div>
          </div>
          </form>
          <hr style="margin-top:0px;margin-bottom:10px;">
          <?php
          if(!empty($day_wise_list))
          {
          ?>
              <div class="alert alert-info" style="margin-bottom: 0px; padding: 14px 0px 6px 10px;">
                <h4 style="line-height: 10px;"><?= (!empty($day_wise_list)) ? $day_wise_list->attendance_date.' Report Of '.$day_wise_list->user_full_name : ''; ?></h4>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <div class="alert alert-default" style="margin-bottom: 0px; padding: 14px 0px 6px 10px;">
                    <h4 style="line-height: 10px;">Login/Logout and Expenses</h4>
                  </div>
                  <br>
                  <a class="btn btn-block btn-social btn-github">
                    <i class="fa fa-sign-in"></i> Login Time - <?= (!empty($day_wise_list)) ? $day_wise_list->attendance_login_time: ''; ?>
                  </a>  
                  <a class="btn btn-block btn-social btn-google">
                    <i class="fa fa-sign-out"></i> Logout Time - <?= (!empty($day_wise_list)) ? $day_wise_list->attendance_logout_time: ''; ?>
                  </a> 
                  <a class="btn btn-block btn-social btn-instagram">
                    <i class="fa fa-money"></i> Total Expenses - <i class="fa fa-rupee"></i> <?= (!empty($expenses_report)) ? round($expenses_report->total_expenses , 2) : ''; ?>
                  </a> 
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="alert alert-default" style="margin-bottom: 0px; padding: 14px 0px 6px 10px;">
                    <h4 style="line-height: 10px;">Meeting Details</h4>
                  </div>
                  <br>
                  <a class="btn btn-block btn-social btn-vk">
                    <i class="fa fa-users"></i> Total Meeting - <?= (!empty($total_meetings)) ? count($total_meetings) : '0'; ?>
                  </a> 
                  <a class="btn btn-block btn-social btn-twitter">
                    <i class="fa fa-users"></i> Pending Meeting - <?= (!empty($pending_meetings)) ? count($pending_meetings) : '0'; ?>
                  </a>
                  <a class="btn btn-block btn-social btn-success">
                    <i class="fa fa-users"></i> Completed Meeting - <?= (!empty($done_meetings)) ? count($done_meetings) : '0'; ?>
                  </a>
                </div>
                <div class="col-md-7 col-sm-7">

                </div>
              </div>
            <?php
          }
          ?>
          </div>
         <!-- /panel content -->
      </div>
    </div>
</section>

