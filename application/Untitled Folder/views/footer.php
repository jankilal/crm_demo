  </div>
  <script type="text/javascript">
    var advance_data_tbl = <?php echo (isset($advance_data_tbl) && $advance_data_tbl == '1') ? 1 : 0; ?>;
    var advance_tbl = <?php echo (isset($advance_tbl) && $advance_tbl == '1') ? 1 : 0; ?>;
  </script>
  <script type="text/javascript" src="<?php echo base_url(); ?>webroot/js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>webroot/js/app.js"></script>
  <script src="<?php echo base_url();?>webroot/js/bootbox.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>webroot/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>webroot/js/fastselect.standalone.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>webroot/css/datepicker.min.css">
  <script type="text/javascript" src="<?php echo base_url();?>webroot/js/datepicker.min.js"></script>

  <script src="<?php echo base_url();?>webroot/js/jQuery.yuukCountdown.js"></script>

  <!-- ================== TopBar Js Load ===================== -->
  <script src="<?php echo base_url();?>webroot/js/topbar.js"></script>
  <!-- ================== Common Js Load ===================== -->
  <script src="<?php echo base_url();?>webroot/js/common.js"></script>
  <script type="text/javascript">
    $('.multipleSelect').fastselect(); 
    $('body').on('focus',".datepicker2", function(){
      $(this).datepicker({
         format: 'yyyy-mm-dd',
      });
    });

    // if('<?= $this->uri->segment(1)?>' != '')
    // {
    //   $.post('<?= base_url(); ?>dashboard/activeParentTab' , function( res ){
    //     console.log(res);
    //   });
    // }
  </script>
  <?php
  if($this->uri->segment(1) === 'dashboard')
  {
    ?>
    <script type="text/javascript">
      loadScript(plugin_path + "raphael-min.js", function(){
        loadScript(plugin_path + "chart.morris/morris.min.js", function(){
          if (jQuery('#graph-donut').length > 0){ 
            Morris.Donut({
              element: 'graph-donut',
              colors :['#3A89C9','#F26C4F','#39B580'],
              data: [
                {value: <?= $leads;?>, label: 'Lead'},
                {value: <?= $opportunities;?>, label: 'Opportunities'},
                {value: <?= $client?>, label: 'Client'},
              ],
              formatter: function (x) { return x + "%"}
            });
          }
        });
      }); 
      </script>
    <?php
    }
    ?>
  </body>
</html>

