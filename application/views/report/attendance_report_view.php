<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Attendance Report</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Attendance Report</li>
      </ol>
   </header>
   <!-- /page title -->
    <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
          <span class="title elipsis">
            <strong>Attendance Report</strong> 
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
                <select class="form-control" name="employee">
                  <option value="">Select Employee</option>
                  <?php
                  foreach ($employee_list as $e_res) 
                  {
                    ?>
                    <option value="<?= $e_res->user_id; ?>"><?= $e_res->user_full_name; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <button class="btn btn-3d btn-reveal btn-teal"><i class="et-search"></i><span> Search</span></button>
            </div>
          </div>
          </form>

          <hr style="margin-top:0px;margin-bottom:10px;">
          <table class="table table-striped table-bordered table-hover" id="sample_5">
            <thead>
              <tr>
                <th>S.No.</th>
                <th>Employee Name</th>
                <th>Date</th>              
                <th>In Time</th>                  
                <th>Out Time</th>                  
                <th>Total Meeting</th>                  
                <th>Total Expenses</th>                  
              </tr>
            </thead>
            <tbody>
              <?php
              if(!empty($attendance_list))
              {
                $i = 1;
                foreach($attendance_list as $res)
                {
                  $employee_dtl = $this->comman_model->getData('tbl_user' , array('user_id' => $res->user_id) , 'single');
                  $total_meeting = $this->report_model->getEmpMeetingByDate($res->user_id , $res->attendance_date , 'count');
                  $expenses = $this->comman_model->getData('tbl_expenses' ,array('user_id' => $res->user_id , 'expenses_created_date' => $res->attendance_date));
                  $total_expenses = 0;
                  foreach ($expenses as $ex_res) 
                  {
                    $total_expenses = $total_expenses+$ex_res->expenses_amt;
                  }
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $employee_dtl->user_full_name; ?></td>
                    <td><?php echo $res->attendance_date; ?></td>
                    <td><?php echo $res->attendance_login_time; ?></td>
                    <td><?php echo $res->attendance_logout_time; ?></td>
                    <td><span class="label label-info" style="font-size: 14px;"><?= $total_meeting; ?></span> &nbsp;<a href="<?= base_url('attendanceReport/meetingDetails/'.$res->attendance_id); ?>" style="font-size: 20px;"><i class="fa fa-eye"></i></a></td>
                    <td><span class="label label-danger" style="font-size: 14px;">&#8377; <?= $total_expenses; ?></span> &nbsp;<a href="<?= base_url('attendanceReport/expensesDetails/'.$res->user_id.'/'.$res->attendance_date); ?>" style="font-size: 20px;"><i class="fa fa-eye"></i></a></td>
                  </tr>
                  <?php
                  $i++;
                }
              }
              ?>                   
            </tbody>
          </table>
        </div>
         <!-- /panel content -->
      </div>
    </div>
</section>

