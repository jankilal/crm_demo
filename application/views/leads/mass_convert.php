<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>leads</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?= base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">leads</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20 lead-wrapper">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading" style="height: 63px">
              <strong>Mass Convert Leads</strong>
           <div class="pull-right">
              <a href="<?= base_url('leads'); ?>" class="btn btn-3d btn-sm btn-reveal btn-default"><i class="fa fa-arrow-circle-left"></i><span>Back</span></a>
           </div>     
         </div>

         <!-- panel content -->
        <div class="panel-body">
            <div id="msg_div">
                <?= $this->session->flashdata('message');?>
            </div>

            <div class="alert alert-bordered margin-bottom-30">
              <p><strong>Tip: </strong></p>
              <div style="padding-left: 5%; line-height: 20px;">
                <p>This page will help you to convert multiple records in one step.</p>
                <p>Use criteria to isolate the records you want to convert.</p>
                <p>Choose custom views to list records based on specific criteria.</p>
              </div>
            </div>
            <div class="row">
            <hr>
              <div class="col-md-12">
                <h4>Criteria Component</h4>
                <div class="col-md-3">
                  <!-- select2 -->
                  <div class="fancy-form fancy-form-select">
                    <select class="form-control select2">
                      <option value="">None</option>
                      <option value="annual_revenue" data-select="N">Annual Revenue</option>
                      <option value="city" data-select="N">City</option>
                      <option value="organization">Company</option>
                      <option value="organization">Company</option>
                    </select>
                    <i class="fancy-arrow"></i>
                  </div>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
              </div>
            </div>
        </div>
         <!-- /panel content -->
       
   </div>
</section>
<!-- /MIDDLE -->