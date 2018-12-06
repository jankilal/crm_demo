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
<!-- header -->
<section id="middle">
	<header id="page-header">
	  <h1>Dashboard</h1>
	  <ol class="breadcrumb">
	     <br>
	     <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
	  </ol>
	</header>
	<div id="content" class="dashboard padding-20">
		<div id="panel-1" class="panel panel-default">
			<div class="panel-body">
				<div class="row">
			      <div class="col-md-3 col-sm-6">
			         <!-- BOX -->
			         <div class="box danger">
			            <!-- default, danger, warning, info, success -->
			            <div class="box-title">
			               <!-- add .noborder class if box-body is removed -->
			               <h4><?php echo $leads?>&nbsp;&nbsp;<a href="#">Leads</a></h4>
			               <!-- <small class="block">654 New fedbacks today</small> -->
			               <i class="fa fa-rocket"></i>
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
			               <i class="fa fa-filter"></i>
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
			               <i class="fa fa-paste"></i>
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
	   		</div>
	   	</div>
	   	<div id="panel-graphs-morris-r4" class="panel panel-default">
			<!-- panel content -->
			<div class="panel-body nopadding">
				<div id="graph-donut"></div>
			</div>
			<!-- /panel content -->
		</div>
		<!-- /Donut Graph -->
	</div>
</section>
