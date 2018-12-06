<style type="text/css">
    .panel-body h3 {
        color: #fff;
        background: #005777;
        margin: 0;
        padding: 10px;
        margin-bottom: 15px;
        font-size: 22px;
        letter-spacing: 1px;
    }
    .box{
        margin-bottom:15px;
        border-top: 1px solid #ddd;
    }
    .no_padding_right{
        padding-right: 0 !important;
    }
    table.table-bordered thead th{
        font-size: 0.8em;
        vertical-align: middle;
        text-align: center;
    }
    table.table-bordered tbody td{
        font-size: 0.85em;
        vertical-align: middle;
        text-align: center;
    }
    .panel_body_height{
      height: 520px;
      overflow-y: auto;
    }
    table thead tr th:first-child{
        white-space: nowrap;
    }
    table tbody tr td:first-child{
        white-space: nowrap;
    }
    table#mpos_transaction thead tr th:last-child{
        white-space: nowrap;
    }         
    table#mpos_transaction tbody tr td:last-child{
        white-space: nowrap;
    }
</style>
<div id="content" class="dashboard padding-20">
	<section id="middle">
		<!-- header -->
		<header id="page-header">
	      <h1>Dashboard</h1>
	      <ol class="breadcrumb">
	         <br>
	         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
	         <li class="active">Dashboard</li>
	      </ol>
	   </header>
	    <!-- BOXES -->
	   <div class="row">
	      <!-- Feedback Box -->
	      <div class="col-md-3 col-sm-6">
	         <!-- BOX -->
	         <div class="box danger">
	            <!-- default, danger, warning, info, success -->
	            <div class="box-title">
	               <!-- add .noborder class if box-body is removed -->
	               <h4><?php echo $leads?>&nbsp;&nbsp;<a href="#">Leads</a></h4>
	               <!-- <small class="block">654 New fedbacks today</small> -->
	               <i class="fa fa-comments"></i>
	            </div>
	            <div class="box-body text-center">
	               <span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
	               331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
	               </span>
	            </div> 
	         </div>
	         <!-- /BOX -->
	      </div>
	      <!-- Profit Box -->
	      <div class="col-md-3 col-sm-6">
	         <!-- BOX -->
	         <div class="box warning">
	            <!-- default, danger, warning, info, success -->
	            <div class="box-title">
	               <!-- add .noborder class if box-body is removed -->
	                <h4><?php echo $opportunities;?> &nbsp;&nbsp; Opportunities</h4>
	               <!-- <small class="block">1,2 M Profit for this month</small> -->
	               <i class="fa fa-bar-chart-o"></i>
	            </div>
	            <div class="box-body text-center">
	               <span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
	               331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
	               </span>
	            </div>
	         </div>
	         <!-- /BOX -->
	      </div>
	      <!-- Orders Box -->
	      <div class="col-md-3 col-sm-6">
	         <!-- BOX -->
	         <div class="box default">
	            <!-- default, danger, warning, info, success -->
	            <div class="box-title">
	               <!-- add .noborder class if box-body is removed -->
	               <h4><?php echo $sampleRequest;?>&nbsp;&nbsp;Sample Request</h4>
	               <!-- <small class="block">18 New Orders</small> -->
	               <i class="fa fa-shopping-cart"></i>
	            </div>
	            <div class="box-body text-center">
	               <span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
	               331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
	               </span>
	            </div>
	         </div>
	         <!-- /BOX -->
	      </div>
	      <!-- Online Box -->
	      <div class="col-md-3 col-sm-6">
	         <!-- BOX -->
	         <div class="box success">
	            <!-- default, danger, warning, info, success -->
	            <div class="box-title">
	               <!-- add .noborder class if box-body is removed -->
	               <h4><?php echo $quotation;?>&nbsp;&nbsp;Quotation</h4>
	               <!-- <small class="block">78185 Unique visitors today</small> -->
	               <i class="fa fa-globe"></i>
	            </div>
	            <div class="box-body text-center">
	               <span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
	               331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
	               </span>
	            </div>
	         </div>
	         <!-- /BOX -->
	      </div>
	   </div>
	   <!-- /BOXES -->
	   <!-- Donut Graph -->
		<div id="panel-graphs-morris-r4" class="panel panel-default">

			<div class="panel-heading">

				<span class="elipsis"><!-- panel title -->
					<strong>Donut Graph</strong>
				</span>

				<!-- right options -->
				<ul class="options pull-right list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
					<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
				</ul>
				<!-- /right options -->


			</div>

			<!-- panel content -->
			<div class="panel-body nopadding">

				<div id="graph-donut"><!-- GRAPH CONTAINER -->
				</div>

			</div>
			<!-- /panel content -->

		</div>
		<!-- /Donut Graph -->
	   
	</section>
</div>
<script type="text/javascript">var plugin_path = '<?php echo base_url(); ?>webroot/plugins/';</script>
<script type="text/javascript" src="<?php echo base_url(); ?>webroot/plugins/jquery/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>webroot/js/app.js"></script>

<!-- PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
loadScript(plugin_path + "raphael-min.js", function(){
	loadScript(plugin_path + "chart.morris/morris.min.js", function(){
		// demo js script
		// loadScript("<?php echo base_url(); ?>webroot/js/view/demo.graphs.morris.js");
		if (jQuery('#graph-donut').length > 0){ 
			Morris.Donut({
			  element: 'graph-donut',
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
