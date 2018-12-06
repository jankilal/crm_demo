<style type="text/css">
   .ui-slider-range
   {
   background:green;
   }
   .ui-slider-horizontal .ui-slider-handle
   {
   top: -1px;
   }
</style>
<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Lead <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url('leads');?>">Lead</a></li>
         <li class="active">Lead View</li>
      </ol>
   </header>
   <!-- /page title -->
    <form method="post" enctype="multipart/form-data" onsubmit="return onViewLeadData(this)">
           <div id="content" class="padding-20">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading panel-heading-transparent">
                              <strong>View Process</strong>
                              <div class="pull-right box-tools">
                              <a href="<?php echo base_url('leads');?>" class="btn btn-teal btn-sm">Back</a>
                              </div>
                            </div>
                            <div class="panel-body">
                                <fieldset>
                                    <hr>
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                          <tr>
                                            <th>Process Date</th>
                                            <th>Process Type</th>
                                            <th>Min.Of Call</th>
                                            <th>Responce Level</th>
                                            <th>Next Meeting Or Call</th>
                                            <th>To Do List</th>
                                            <!-- <th>Sample Request</th> -->
                                            <th>Quote Request</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                               if(!empty($process_list))
                                               {
                                                   foreach($process_list as $pres)
                                                   {

                                                      if($pres->response_levels != '')
                                                      {
                                                        $prg_width = $pres->response_levels.'%';
                                                      }
                                                       ?>
                                                      <tr>
                                                         <td><?php echo $pres->leads_process_date; ?></td>
                                                         <td><?php echo $pres->leads_process_type; ?></td>
                                                         <td><?php echo $pres->meeting_minutes; ?></td>
                                                         <td><div style="margin-top: 8px;" class="progress progress-xxs margin-bottom-0">
                                                          <div class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prg_width; ?>;"></div></div><br><?php echo $prg_width; ?></td>
                                                         <td>

                                                          <?php 
                                                          if($pres->next_meeting_call == 'yes')
                                                          {
                                                            if($pres->next_meeting_date != '')
                                                            echo 'Date - '.date_format(date_create_from_format('Y-m-d', $pres->next_meeting_date),'d M Y').'<br>'.'Time - '.$pres->next_meeting_time;
                                                          }
                                                          else{
                                                             echo $pres->next_meeting_call;
                                                            } ; ?></td>
                                                         <td><?php echo $pres->to_do_list; ?></td>
                                                         <!-- <td><?php echo $pres->sample_request; ?></td> -->
                                                         <td><?php echo $pres->quote_request; ?></td>
                                                         <td><a href="<?php echo base_url().'leads/viewProcessDetails/'.$pres->leads_process_details_id; ?>"><i class="fa fa-eye"></i></a></td>
                                                      </tr>
                                                    <?php
                                                       }
                                                   }
                                                 ?>                       
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
 </div>

</section>
<!-- /MIDDLE -->
<script type="text/javascript"> 

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
   $('#state_id').html(data);
  }
  else
  {
   $('#client_state_id').html('<option value=""></option>');
  }
  } 
  });
  }  
  $(function() {
    $('.switch-btn-change').click(function() {
      alert($(this).children().checked);
    });
  });

  
</script>