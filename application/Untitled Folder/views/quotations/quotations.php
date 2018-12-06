<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Quotations</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Quotations</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading">
            <span class="title elipsis">
            <strong>Quotations Details</strong> 
            </span>
           <div class="pull-right box-tools">
                               
                </div>           
         </div>

         <!-- panel content -->
         <div class="panel-body">

        <div id="msg_div">
            <?php echo $this->session->flashdata('message');?>
        </div>
           
         <table class="table table-striped table-bordered table-hover" id="web_view_tbl">

            <thead>
              <tr>
                <th>Opportunity Name</th>
                <th>Date</th>
                <th>Version</th>
                <th>Send To</th>  
                <th>Action</th>
              </tr>
            </thead>
               <tbody>
                  <?php
                     if(!empty($quotations_result))
                     {
                         foreach($quotations_result as $res)
                         { 
                          $lead_id = $res->lead_id;

                          $lead_name =  $this->comman_model->getData('tbl_leads', array('lead_id'=>$lead_id), 'single');
                          ?>

                            <tr>
                               <td><?php echo $lead_name->lead_name; ?></td>
                               <td><?php echo $res->submition_date; ?></td>
                               <td><?php echo $res->quote_version; ?></td>
                               <td><?php echo $res->quote_to; ?></td>
                               <td>  
                                  <a href="#"><i class="fa fa-eye fa-2x"></i></a>
                              </td>
                            </tr>
                          <?php
                             }
                         }
                         else
                         {
                         ?>                        
                      <?php
                         }
                         
                         ?>                       
               </tbody>
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
                <h4 class="modal-title" id="myModalLabel">Add Leads Process</h4>
              </div>

              <!-- Modal Body -->
              <div class="modal-body">
              <form method="POST" action="<?php echo base_url(); ?>leads/addleadsProcess">
              <input type="hidden" name="leads_id" id="leads_id" value="">
                <div class="row">
                   <div class="form-group">
                      <div class="col-md-6 col-sm-6">
                         <label>Date<span class="text-danger"> *</span></label>
                         <input autocomplete="off" type="text" name="leads_process_date" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false"><br>
                      </div>
                      <div class="col-md-6 col-sm-6">
                         <label>Process Type<span class="text-danger"> *</span></label>
                         <select name="leads_process_type" class="form-control">
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
    function delete_leads(leads_id)
    {
          bootbox.confirm("Are you sure you want to delete leads Details",function(confirmed){            
            if(confirmed)
            {
                location.href="<?php echo base_url();?>leads/deleteleads/"+lead_id;
            }
        });
    }    

    function change_lead_status(lead_status,leads_id)
    {
         location.href="<?php echo base_url();?>leads/changeLeadStatus/"+lead_status+'/'+leads_id;
    }
//     function removeAddedProduct(obj, id)
// {
//   bootbox.confirm("Are you sure you want to delete Leads Details",function(confirmed){            
//     if(confirmed)
//     {
//       var data = 'quote_id='+id;
//       $.post('<?php echo base_url();?>leads/removeLeadProductsById' , data , function(res){
//         console.log(res);
//         if(res)
//         {
//           $(obj).parent('td').closest('tr').remove();
//         }
//       });
//     }
//   });
// }

     function save_leads_id(id)
    {

      $('#leads_id').val(id);
       $('#processModal').modal('show');

    }
</script>
