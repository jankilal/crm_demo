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
      <h1>Client <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>opportunities">Client</a></li>
         <li class="active">Client View</li>
      </ol>
   </header>
   <!-- /page title -->
  <div id="content" class="padding-20">
   <?php
   foreach ($edit_client as $op_val) 
   {
   ?>
    <div class="row">
       <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
                <strong>Add Client</strong>
                <div class="pull-right box-tools">
                   <a href="<?php echo base_url();?>client" class="btn btn-teal btn-sm">Back</a>
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
                               <textarea disabled     class="form-control"  rows="5" name="notes" ><?php echo $op_val->notes; ?></textarea>
                            </div>
                         </div>
                      </div>
                    <?php
                    }
                    ?>
                    <?php
                    $leads_process = $this->session->userdata('leads_process');
                    $addedProduct = $this->comman_model->getData('tbl_lead_product',array('lead_id'=> $leads_process['lead_id']));
                      
                    ?>
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
                 <h3>Preview Quotation Details</h3>
                  <table class="table table-striped table-bordered table-hover" id="sample_1">
                     <thead>
                        <tr>
                           <th>Quote To</th>
                           <th>Date</th>
                           <th>Address</th>
                           <th>Price</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                     <?php
                     if(!empty($quotation_list))
                     {
                        foreach($quotation_list as $res)
                        {
                          if (!empty($approvedQuote))
                            {
                              $cheak_quote_id = array();
                              foreach ($approvedQuote as $q_res)
                              {
                                $cheak_quote_id[] = $q_res->quote_id;
                              
                              }
                            }
                           ?>
                           <tr>
                              <td><?php echo $res->quote_to; ?></td>
                              <td><?php echo $res->submition_date; ?></td>
                              <td><?php echo $res->address1.' '.$res->location.' '.$res->city; ?></td>
                              <td><?php echo $res->quote_subtotal; ?></td>
                                 <?php
                                  if (in_array($res->quote_id, $cheak_quote_id)) {
                                    ?>
                                    <td class="text-center"><label style="padding: 3px; color: white" class="label-success ">Approved</label></td>

                                    <?php
                                  }
                                  else
                                  {
                                    ?>
                                      <td></td>
                                    <?php
                                  }
                                ?>
                              <!-- <td width="5%">
                                 <input type="checkbox" class="checkboxes" name="approve_products[]" value="<?= $res->quote_id; ?>" />
                              </td> -->
                              <td><a href="<?php echo base_url().'client/viewProcessDetails/'.$res->quote_id; ?>"><i class="fa fa-eye"></i></a></td>
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