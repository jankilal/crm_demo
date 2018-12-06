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
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>S.No.</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Date</th>              
                <th>Narration</th>                  
                <th>Attachment</th>        
              </tr>
            </thead>
            <tbody>
              <?php
              if(!empty($expenses_list))
              {
                $i = 1;
                foreach($expenses_list as $res)
                {
                  $expense_cat = $this->comman_model->getData('tbl_expense_category' , array('expense_category_id' => $res->expenses_category_id) , 'single');
                  ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $expense_cat->expense_category; ?></td>
                    <td><i class="fa fa-rupee"></i> <?= round($res->expenses_amt,2); ?></td>
                    <td><?= $res->expenses_date; ?></td>
                    <td><?= $res->expenses_narration; ?></td>
                    <td><a href="<?= base_url().$res->expenses_attachment ?>"><?= ($res->expenses_attachment) ? base_url().$res->expenses_attachment : ''; ?></a></td>
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