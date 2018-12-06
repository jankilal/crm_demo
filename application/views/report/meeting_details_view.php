<style type="text/css">
#map_canvas {height: 350px; width: 100%; background-color: gray;}
</style>
<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Meeting Details</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Meeting Details</li>
      </ol>
   </header>
   <!-- /page title -->
    <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
          <span class="title elipsis">
            <strong>Meeting Details of <?php echo $employee_dtl->user_full_name; ?> Date - <?= $attendance_dtl->attendance_date; ?></strong> 
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
                <th>Time</th>              
                <th>Start Time</th>                  
                <th>End Time</th>        
                <th>Start Address</th>        
                <th>End Address</th>    
                <th>Status</th>       
                <th width="10%">Location</th>                  
              </tr>
            </thead>
            <tbody>
              <?php
              if(!empty($meeting_list))
              {
                $i = 1;
                foreach($meeting_list as $res)
                {
                  ?>
                  <?php
                  $start_address = '';
                  $end_address = '';
                  if($res->lm_start_lat && $res->lm_start_lng)
                  {
                    $geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($res->lm_start_lat).','.trim($res->lm_start_lng).'&sensor=true_or_false&key=AIzaSyA47YEA7hkdrE6PJYe91NawcsmvW9DL3ss'); 
                    $output = json_decode($geocodeFromLatLong);
                    $status = $output->status;
                    $start_address = ($status=="OK" && !empty($output->results[1]->formatted_address))?$output->results[1]->formatted_address:'';
                    ?>
                    <?php
                  }

                  if($res->lm_end_lat && $res->lm_end_lng)
                  {
                    $geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($res->lm_end_lat).','.trim($res->lm_end_lng).'&sensor=true_or_false&key=AIzaSyA47YEA7hkdrE6PJYe91NawcsmvW9DL3ss'); 
                    $output = json_decode($geocodeFromLatLong);
                    $status = $output->status;
                    $end_address = ($status=="OK" && !empty($output->results[1]->formatted_address))?$output->results[1]->formatted_address:'';
                    ?>
                    
                    <?php
                  }
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $res->lm_time; ?></td>
                    <td><?php echo $res->lm_start_time; ?></td>
                    <td><?php echo $res->lm_end_time; ?></td>
                    <td title="<?= $start_address; ?>"><?php echo substr($start_address, 0,30); ?>...</td>
                    <td title="<?= $end_address; ?>"><?php echo substr($end_address, 0,30); ?>...</td>
                    <td><?php echo $res->lm_notes; ?></td>
                    <td><a href="javascript:;" onclick="showMeetingMap({'start_lat':'<?= $res->lm_start_lat ?>' , 'start_lng' : '<?= $res->lm_start_lng ?>' , 'start_addrs' : '<?= $start_address; ?>' , 'end_lat':'<?= $res->lm_end_lat ?>' , 'end_lng' : '<?= $res->lm_end_lng ?>' , 'end_addrs' : '<?= $end_address; ?>'})"><i class="fa fa-map fa-2x"></i></a></td>
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

<div id="costumModal26" class="modal" data-easein="perspectiveRightIn" tabindex="-1" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="transform: translateY(0px);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
                <h4 class="modal-title">
                    Modal Header
                </h4>
            </div>
            <div class="modal-body" id="loadMap">
                <div id="map_canvas"></div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.ui.min.js"></script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA47YEA7hkdrE6PJYe91NawcsmvW9DL3ss">
    </script>
<script type="text/javascript">
  function showMeetingMap(ltlng)
  {
    var locations= [];
    if(ltlng.start_lat !== undefined && ltlng.start_lat && ltlng.start_lng !== undefined && ltlng.start_lng)
    {
      locations.push([ltlng.start_addrs, parseFloat(ltlng.start_lat), parseFloat(ltlng.start_lng),1]);
    }

    if(ltlng.end_lat !== undefined && ltlng.end_lat && ltlng.end_lng !== undefined && ltlng.end_lng)
    {
      locations.push([ltlng.end_addrs, parseFloat(ltlng.end_lat), parseFloat(ltlng.end_lng),2]);
    }
    var geocoder;
    var map;
    var directionsDisplay;
    if(locations.length > 1)
    {
      directionsDisplay = new google.maps.DirectionsRenderer();
      var map = new google.maps.Map(document.getElementById('map_canvas'), {
        zoom: 14,
        center: new google.maps.LatLng(locations[0][1], locations[0][2]),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      directionsDisplay.setMap(map);
      var marker, i;
      var request = {
        travelMode: google.maps.TravelMode.DRIVING
      };
      for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(locations[i][1], locations[i][2]),
          title: locations[i][0],
          map: map
        });

        if (i == 0) request.origin = marker.getPosition();
        else if (i == locations.length - 1) request.destination = marker.getPosition();
        else {
          if (!request.waypoints) request.waypoints = [];
          request.waypoints.push({
            location: marker.getPosition(),
            stopover: true
          });
        }
      }
    }
    else if(locations.length > 0)
    {
      for (var i = 0; i<locations.length;i++) 
      {
        var latval = locations[i][1];
        var lngval = locations[i][2];
        var mapOptions = {
            zoom: 14,
            center: new google.maps.LatLng(latval, lngval),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
        var marker = new google.maps.Marker({
          position: new google.maps.LatLng(latval, lngval),
          title: locations[i][0],
          map: map,
          draggable: true
        });
      };
    }

    $('.modal-dialog').velocity('transition.' + 'perspectiveRightIn');
    $('#costumModal26').modal('show');
  }
</script>