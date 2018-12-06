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
      <h1>Leads Process <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>leads">Leads Process Details</a></li>
         <li class="active">Leads Process Details</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Leads Process Details</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>leads" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body"> 
                 <table class="table table-striped table-bordered table-hover" id="sample_1">
                  <thead>
                    <tr>
                      <th>Process Date</th>
                      <th>Process Type</th>                    
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
                                     <td><?php echo $res->leads_process_date; ?></td>
                                     <td><?php echo $res->leads_process_type; ?></td>                       
                                     <td><div style="margin-top: 8px;" class="progress progress-xxs margin-bottom-0">
                                      <div class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prg_width; ?>;"></div></div><br><?php echo $prg_width; ?></td>
                                     <td><?php if($res->next_meeting_call == 'yes'){
                                      echo 'Date - '.date_format(date_create_from_format('Y-m-d', $res->next_meeting_date),'d M Y').'<br>'.'Time - '.$res->next_meeting_time;
                                      }else{
                                         echo $res->next_meeting_call;
                                        } ; ?></td>
                                     <td><?php echo $res->to_do_list; ?></td>
                                     <!-- <td><?php echo $res->sample_request; ?></td> -->
                                     <td><?php echo $res->quote_request; ?></td>
                                     <td><a href="<?php echo base_url().'leads/viewProcessDetails/'.$res->leads_process_details_id; ?>"><i class="fa fa-eye fa-2x"></i></a></td>
                                    
                                  </tr>
                                <?php
                                   }
                               }
                             ?>                       
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- /MIDDLE -->
<script type="text/javascript">
  function extraOpportunityDetails(str)
  {
     var move_opp = document.getElementById("move_to_opportunity").checked;
     if(move_opp == true)
     {
        $('#more_opp_details').show();
     }
     else
     {
        $('#more_opp_details').hide();
     }
  }
  function showNextMeeting(str)
  {
    if(str =='yes')
    {
      $('#nextmeet').show();
    }  
    else
    {
      $('#nextmeet').hide();
    }
  }
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
</script>

<script type="text/javascript">
 $(document).ready(function()
 {

    var counter = 0;
    $("#add_produst_btn").click(function () {
       $('#removeButton').show();
       
            var newTextBoxDiv = $(document.createElement('div'))
            .attr("id", 'TextBoxDiv' + counter);
            newTextBoxDiv.after().html('<div class="row"><div class="form-group"><div class="col-md-6 col-sm-6">'+'<label>Product Details</label><textarea name="product_details[]" class="form-control"></textarea>'+'</div><div class="col-md-6 col-sm-6"><label style="margin-bottom: 10px;">Images/Attachment File</label><input type="file" multiple="multiple" name="product_img_file_'+counter+'[]"></div></div></div><p></p>');

            newTextBoxDiv.appendTo("#TextBoxesGroup");        
            counter++;

        });

        $("#removeButton").click(function () {
        counter--;
        $("#TextBoxDiv" + counter).remove();         
        if(counter == 0){
        $('#removeButton').hide();
        }


        });
});
</script>