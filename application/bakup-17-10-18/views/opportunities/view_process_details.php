<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Opportunities Process Details</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Opportunities </li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading">
            <span class="title elipsis">
              <strong>Opportunities Process Details</strong> 
              <div class="pull-right box-tools">
                <a href="<?php echo base_url();?>opportunities/opportunities" class="btn btn-teal btn-sm">Back</a>
              </div>
            </span>
         </div>
         <!-- panel content -->
         <div class="panel-body">
        <div id="msg_div">
            <?php echo $this->session->flashdata('message');?>
        </div>
           
        <table class="table table-striped table-bordered table-hover" id="sample_1">
          <tbody>
              <?php
                 if(!empty($process_details))
                {
                  foreach($process_details as $res)
                  {
                      if($res->response_levels != '')
                      {
                        $prg_width = $res->response_levels.'%';
                      }
                       ?>
                      <tr>
                        <th>Process Date</th>
                        <td><?php echo date_format(date_create_from_format('Y-m-d', $res->opportunities_process_date),'d M Y'); ?></td>
                      </tr> 
                      <tr>
                         <th>Process Type</th>
                         <td><?php echo $res->opportunities_process_type; ?></td>
                      </tr>
                      <tr>
                        <th>Response Levels</th>
                        <td><?php echo $prg_width; ?><div style="margin-top: 8px;" class="progress progress-xxs margin-bottom-0">
                        <div class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prg_width; ?>;"></div></div></td>
                      </tr>
                      <tr>
                        <th>Next Meeting Or Call</th>
                        <td><?php echo $res->next_meeting_call; ?></td>
                      </tr>
                      <?php
                      if($res->next_meeting_call == 'yes')
                      {
                      ?>
                      <tr>
                          <th>Next Meeting Date</th>
                          <td>
                              <?php
                                if($res->next_meeting_date != '')
                                echo date_format(date_create_from_format('Y-m-d', $res->next_meeting_date),'d M Y'); 
                               ?>
                          </td>
                      </tr>
                      <tr>
                        <th>Next Meeting Time</th>
                        <td><?php echo $res->next_meeting_time; ?></td>
                      </tr>
                      <?php
                      }
                      ?>
                      <tr>
                        <th>To Do List</th>
                        <td><?php echo $res->to_do_list; ?></td>
                      </tr>
                      <tr>
                        <th>Sample Request</th>
                         <td><?php echo ($res->sample_request) ? 'Yes' : 'No'; ?></td>
                      </tr>
                      <tr>
                        <th>Quote Request</th>
                         <td><?php echo $res->quote_request; ?></td>
                      </tr>
                     <?php
                  }
                }
                    ?>                       
          </tbody>
        </table>
            <p></p>
            <div class="alert alert-theme-color margin-bottom-30"><!-- THEME COLOR -->
              <h4><strong>Minutes Of Meeting</strong></h4>
              <p><?php echo $res->meeting_minutes; ?></p>
            </div>
            <h4>All Products Details</h4>
            <table class="table table-striped table-bordered table-hover" id="sample_1">
              <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
   
          <?php if(!empty($products_details))
           {
              foreach ($products_details as $pd_val) 
              {
                ?>
                  <tr>
                    <td><?php echo $pd_val->product_name; ?></td>
                    <td><?php echo $pd_val->product_price; ?></td>
                    <td><?php echo $pd_val->product_desc; ?></td>
                    <td>
                    <button class="btn btn-sm btn-danger" onclick="removeAddedProduct(this , '<?= $pd_val->lead_product_id; ?>')" type="button"><i class="fa fa-remove"></i></button></td>
                  </tr>
                <?php
              }
           } 
           ?>
            </table>
         </div>
         <!-- /panel content -->
         <!-- panel footer -->
         <div class="panel-footer">          
         </div>

         <div id="processModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Opportunities Process</h4>
              </div>

              <!-- Modal Body -->
              <div class="modal-body">
              <form method="POST" action="<?php echo base_url(); ?>opportunities/addOpportunitiesProcess">
              <input type="hidden" name="opportunities_id" id="opportunities_id" value="">
                <div class="row">
                   <div class="form-group">
                      <div class="col-md-6 col-sm-6">
                         <label>Date<span class="text-danger"> *</span></label>
                         <input type="text" name="opportunities_process_date" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false"><br>
                      </div>
                      <div class="col-md-6 col-sm-6">
                         <label>Process Type<span class="text-danger"> *</span></label>
                         <select name="opportunities_process_type" class="form-control">
                            <option value="initial-discussion">Initial Discussion</option>
                            <option value="presentation">Presentation</option>
                            <option value="following-quote">Following Quotes</option>
                            <option value="sales-done">Sales Done</option>
                            <option value="product-teach-discussion">Product Teach Discussion</option>                          
                         </select>  
                         <br>                          
                      </div>
                   </div>
                </div>             
              <!-- Modal Footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
              </div>
               </form>

            </div>
          </div>
        </div>
         <!-- /panel footer -->
      </div>
   </div>
</section>
<!-- /MIDDLE -->
<script type="text/javascript">
function delete_Opportunities(Opportunities_id)
{

      bootbox.confirm("Are you sure you want to delete Opportunities Details",function(confirmed){            
        if(confirmed)
        {
            location.href="<?php echo base_url();?>opportunities/deleteOpportunities/"+Opportunities_id;
        }
    });
}    
function save_opportunities_id(id)
{

  $('#opportunities_id').val(id);
   $('#processModal').modal('show');

}
function removeAddedProduct(obj,id)
{
  // var id = $(obj).data('id');
   bootbox.confirm("Are you sure you want to delete Leads Details",function(confirmed){            
      if(confirmed)
      {
        var data = 'lead_product_id='+id;
        $.post('<?php echo base_url();?>leads/removeLeadProductsById' , data , function(res){
          console.log(res);
          if(res)
          {
             $(obj).parent('td').closest('tr').remove();
          }
        });
      }
    });
}
</script>
