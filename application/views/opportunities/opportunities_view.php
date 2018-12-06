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
      <h1>Opportunities <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>opportunities">Opportunities</a></li>
         <li class="active">Opportunities View</li>
      </ol>
   </header>
   <!-- /page title -->
  <div id="content" class="padding-20">
   <?php
   $op_val = $edit_opportunities[0];
   $lead_details = $this->comman_model->getData('tbl_leads' , array('lead_id' => $op_val->opportunities_id) , 'single');

   ?>

    <div class="row">
       <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
                <strong>Add Opportunities</strong>
                <div class="pull-right box-tools">
                   <a href="<?php echo base_url();?>opportunities" class="btn btn-teal btn-sm">Back</a>
                </div>
            </div>
            <div class="panel-body">
                <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
                  <fieldset>
                    <div class="row">
                       <div class="form-group">
                          <div class="col-md-6 col-sm-6">
                             <label>Opportunities Name<span class="text-danger"> *</span></label>
                             <input disabled name="Opportunities_name" class="form-control" type="text" id="opportunities_name" value="<?php echo $op_val->opportunity_name; ?>" />
                             <?php echo form_error('Opportunities_name','<span class="text-danger">','</span>'); ?>
                          </div>
                          <div class="col-md-6 col-sm-6">
                             <label>Stages <span class="text-danger"> *</span></label>
                             <select disabled name="stages" class="form-control">
                                <option <?php if($op_val->stages == 'new'){ echo "selected"; } ?> value="new">New</option>
                                <option <?php if($op_val->stages == 'qualification'){ echo "selected"; } ?> value="qualification" >Qualification</option>
                                <option <?php if($op_val->stages == 'proposition'){ echo "selected"; } ?> value="proposition" >Proposition</option>
                                <option <?php if($op_val->stages == 'won'){ echo "selected"; } ?> value="won">Won</option>
                                <option <?php if($op_val->stages == 'lost'){ echo "selected"; } ?> value="lost">Lost</option>
                                <option <?php if($op_val->stages == 'dead'){ echo "selected"; } ?> value="dead">Dead</option>
                             </select>                              
                          </div>
                       </div>
                    </div>
                    <div class="row">
                       <div class="form-group">
                          <div class="col-md-6 col-sm-6 project">
                             <label>Probability Of Winning %</label>
                             <div disabled class="bar"></div>
                             <p disabled class="percent"><?php echo $op_val->probability.'%'; ?></p>
                             <input disabled type="hidden" name="probability" id="probability" value="<?php echo $op_val->probability; ?>">                       
                          </div>
                          <div class="col-md-6 col-sm-6">
                             <label>Forecast Close Date</label>
                             <input autocomplete="off" disabled type="text" name="close_date" class="form-control datepicker" value="<?php echo $op_val->close_date; ?>" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false">
                          </div>
                       </div>
                    </div>
                    <div class="row">
                       <div class="form-group">
                          <div class="col-md-6 col-sm-6">
                             <label>Current State <span class="text-danger"> *</span></label>
                             <select disabled class="form-control" name="opportunities_state_reason_id">
                                <?php
                                foreach ($opp_reson_states as $oprs_val)
                                {
                                  ?>
                                  <option <?php if($op_val->opportunities_state_reason_id == $oprs_val->opportunities_state_reason_id){ echo "selected"; } ?> value="<?php echo $oprs_val->opportunities_state_reason_id ;?>"><?php echo $oprs_val->opportunities_state.' ('.$oprs_val->opportunities_state_reason.')' ?></option>
                                    <?php
                                }
                                ?>
                             </select>
                             <?php echo form_error('opportunities_state_reason_id','<span class="text-danger">','</span>'); ?>
                          </div>
                          <div class="col-md-6 col-sm-6">
                             <label>Expected Revenue </label>
                             <input disabled type="text" name="expected_revenue" class="form-control" value="<?php echo $op_val->expected_revenue; ?>">     
                          </div>
                       </div>
                    </div>
                    <div class="row">
                       <div class="form-group">
                          <div class="col-md-6 col-sm-6">
                             <label>Add New Link</label>
                             <input disabled type="text" value="<?php echo $op_val->new_link; ?>" name="new_link" class="form-control">                            
                          </div>
                       </div>
                    </div>
                    <div class="row">
                       <div class="form-group">
                          <div class="col-md-12 col-sm-12">
                             <label>Short Note</label>
                             <textarea disabled     class="form-control"  rows="5" name="notes" ><?php echo $lead_details->notes; ?></textarea>
                          </div>
                       </div>
                    </div>
                    <?php
                    $addedProduct = $this->comman_model->getData('tbl_lead_product',array('lead_id'=> $op_val->opportunities_id));
                    if(!empty($addedProduct))
                    {
                      ?>
                      <div class="panel panel-info shadow-none">
                        <div class="panel-heading">Added Product Information</div>
                      </div>
                      <table class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Description</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                          $i =1;
                          foreach ($addedProduct as $res) 
                          {
                            ?>
                            <tr class="odd gradeX">                            
                              <td><?= $i ?></td>
                              <td><?= $res->product_name; ?></td>
                              <td><?= $res->product_price; ?></td>
                              <td><?= $res->product_desc; ?></td>
                            </tr>
                            <?php
                            $i++;
                          }
                          ?>
                        </tbody>
                      </table>
                      <?php
                    }
                    ?>
                    <div class="panel panel-info shadow-none">
                      <div class="panel-heading">Added Process Information</div>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                      <thead>
                        <tr>
                          <th>Process Date</th>
                          <th>Process Type</th>
                          <th>Min.Of Meeting</th>
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
                                foreach($process_list as $res)
                                 {
                                    if($res->response_levels != '')
                                    {
                                      $prg_width = $res->response_levels.'%';
                                    }
                                     ?>
                                    <tr>
                                       <td><?php echo $res->opportunities_process_date; ?></td>
                                       <td><?php echo $res->opportunities_process_type; ?></td>
                                       
                                       <td><?php echo substr($res->meeting_minutes, 0,20).'...'; ?></td>
                                       <td>
                                          <div style="margin-top: 8px;" class="progress progress-xxs margin-bottom-0">
                                              <div class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prg_width; ?>;">
                                              </div>
                                          </div>
                                        <br><?php echo $prg_width; ?></td>

                                       <td>
                                          <?php 
                                          if($res->next_meeting_call == 'yes')
                                          {
                                            if($res->next_meeting_date != ''){
                                              echo 'Date - '.date_format(date_create_from_format('Y-m-d', $res->next_meeting_date),'d M Y').'<br>'.'Time - '.$res->next_meeting_time;}
                                          }
                                          else
                                          {
                                              echo $res->next_meeting_call;
                                          } ; ?>   
                                       </td>
                                       <td><?php echo $res->to_do_list; ?></td>
                                       <!-- <td><?php echo $res->sample_request; ?></td> -->
                                       <td><?php echo $res->quote_request; ?></td>
                                       <td><a href="<?php echo base_url().'opportunities/viewProcessDetails/'.$res->opportunities_process_details_id; ?>"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                  <?php
                                     }
                                 }
                                 else
                                 {
                                 ?>
                                  <tr>
                                      <td colspan="7">No records found...</td>  
                                  </tr>
                                <?php
                                  }
                                ?>                       
                      </tbody>
                    </table>

                    <div class="row">
                          <div class="col-md-12">
                            <div class="alert alert-info" style="margin-bottom: 0px; padding: 14px 0px 6px 10px;">
                              <h4 style="line-height: 10px;">Quotations Information</h4>
                            </div>
                          </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                               <tr>
                                  <th>S.No.</th>
                                  <th>Quotation Name</th>
                                  <th>Quotation Version</th>
                                  <th>Quotation To</th>
                                  <th>Submition Date</th>
                                  <th>Address</th>
                                  <th>Price</th>
                                  <th>View</th>
                               </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($quotation_detail))
                            {
                              $i = 0;
                              foreach($quotation_detail as $res)
                              {
                                $i++;
                                ?>
                                <tr>
                                   <td><?= $i; ?></td>
                                   <td><?= $res->quote_name; ?></td>
                                   <td><?= $res->quote_version; ?></td>
                                   <td><?= $res->quote_to; ?></td>
                                   <td><?= $res->submition_date; ?></td>
                                   <td><?= $res->address1.' '.$res->location.' '.$res->city; ?></td>
                                   <td><?= $res->quote_subtotal; ?></td>     
                                   <td><a title="View Details" href="<?php echo base_url().'leads/viewQuotationDetails/'.$res->quote_id.'/addOpportunities/'.$this->uri->segment(3); ?>"><i class="fa fa-eye fa-2x"></i></a></td>     
                                </tr>
                                <?php
                              }
                            }
                            ?>                       
                            </tbody>
                        </table>
                  </fieldset>
                </form>
            </div>
          </div>
       </div>
    </div>
  </div>
<!--  </div> -->
</section>
<!-- /MIDDLE -->

<script type="text/javascript">
  $(function() {
    $('.project').each(function() {
     var $projectBar = $(this).find('.bar');
     var $projectPercent = $(this).find('.percent');
     var $projectRange = $(this).find('.ui-slider-range');
     $projectBar.slider({
       range: "min",
       animate: true,
       value: 1,
       min: 0,
       max: 100,
       step: 1,
       slide: function(event, ui) {
         $projectPercent.html(ui.value + "%");
         $('#probability').val(ui.value);
       },
      change: function(event, ui) {
         var $projectRange = $(this).find('.ui-slider-range');

         var percent = ui.value;
           
         if (percent < 30) {
           $projectPercent.css({
             'color': 'red'
           }); 
           $projectRange.css({
             'background': '#f20000'
           });
         } else if (percent > 31 && percent < 70) {
           $projectPercent.css({
             'color': 'gold'
           });
           $projectRange.css({
             'background': 'gold'
           });
         } else if (percent > 70) {
           $projectPercent.css({
             'color': 'green'
           });
           $projectRange.css({
             'background': 'green'
          });
        }
      }
    });
   })
  })

 $(document).ready(function()
  {
    $(".ui-slider-range").removeAttr("style");       
    $(".ui-slider-handle").removeAttr("style");       
    $(".ui-slider-range").attr("style" , "width : <?php echo $op_val->probability.'%'; ?>");     
    $(".ui-slider-handle").attr("style" , "left : <?php echo $op_val->probability.'%'; ?>");       
  });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#permission_user').hide();
        $("div.action").hide();
        $("input[name$='permission']").click(function () {
            $("#permission_user").removeClass('show');
            if ($(this).attr("value") == "0") {
                $("#permission_user").show();
            } else {
                $("#permission_user").hide();
            }
        });

        $("input[name$='assigned_to[]']").click(function () {
            var user_id = $(this).val();           
            $("#action_" + user_id).removeClass('show');
            if (this.checked) {
                $("#action_" + user_id).show();
            } else {
                $("#action_" + user_id).hide();
            }

        });
    });

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