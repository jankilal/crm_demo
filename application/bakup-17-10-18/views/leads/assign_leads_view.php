<style>
.fstMultipleMode .fstControls{padding: 0px !important; width: 100%;}
.fstElement{ width: 100% !important; font-size: 10px; padding-top: 3px; border: 2px solid #D7D7D7 !important; border-radius: 3px;  }
.fstChoiceItem{font-size: 12px; padding: 2px;left: 0px;padding-left: 20px;padding-right: 20px;margin: 5px;}
.fstMultipleMode.fstActive .fstResults{ font-size: 10px; }
</style>
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
              <strong>Assign Leads</strong>
           <div class="pull-right">
              <a href="<?= base_url('leads'); ?>" class="btn btn-3d btn-sm btn-reveal btn-default"><i class="fa fa-arrow-circle-left"></i><span>Back</span></a>
           </div>     
         </div>

         <!-- panel content -->
        <div class="panel-body">
          <form id="searchForm" method="post">
            <div id="msg_div">
                <?= $this->session->flashdata('message');?>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="alert alert-info" style="margin-bottom: 0px; padding: 14px 0px 6px 10px;">
                  <h4 style="line-height: 10px;">Criteria Component</h4>
                </div>
              </div>
            </div>
            <div class="row">
                <!-- Main Search By Column  -->
                <div class="col-md-5">
                  <label>Search By <span class="text-danger">*</span></label>
                  <div class="fancy-form fancy-form-select">
                    <select class="form-control select2" name="search_column" id="search_column">
                      <option value="">None</option>
                      <option value="lead_name" data-select="T">Lead Name</option>
                      <option value="address" data-select="T">Address</option>
                      <option value="city" data-select="T">City</option>
                      <option value="organization" data-select="T">Company</option>
                      <option value="designation" data-select="T">Designation</option>
                      <option value="email" data-select="T">Email</option>
                      <option value="industry" data-select="T">Industry</option>
                    </select>
                    <i class="fancy-arrow"></i>
                  </div>
                  <span style="color: red;" id="error_sc"></span>
                </div>
                <!-- Default Showing field-2  -->
                <div class="col-md-5 searchKeySec">
                  <label>Search By Value <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="search_key" id="search_key">
                  <span style="color: red;" id="error_sf"></span>
                </div>
                 <div class="col-md-2">
                 <br>
                  <button class="btn btn-3d btn-reveal btn-blue" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Searching.."><i class="fa fa-search"></i><span>Search</span></button>
                </div>
            </div>
          </form>
          <div id="listing_leads"></div>
        </div>
      <!-- /panel content -->
   </div>
</section>
<!-- /MIDDLE -->
<script type="text/javascript">
  $('#search_column').on('change' , function(){
    var secobj = $('.searchKeySec');
    if($(this).val())
    {
      var optText = $(this).find('option:selected').text();
      secobj.find('label').html('Search By '+optText+' <span class="text-danger">*</span>');
      secobj.find('input').attr('placeholder' , 'Enter '+optText+' Here..');
    }
  });
  $("#searchForm").submit(function(event){
    event.preventDefault();
    if($('#search_column').val() == '')
    {
      $('#search_column').focus();
      $('#error_sc').html('Please Select Search By');
      return false;
    }
    else
    {
      $('#error_sc').html('');
    }

    if($('#search_key').val() == '')
    {
      $('#search_key').focus();
      $('#error_sf').html('Please Enter '+$('#search_column').find('option:selected').text());
      return false;
    }
    else
    {
      $('#error_sf').html('');
    }
    var $this = $('#load');
    $this.button('loading');
    var PAGE = '<?= base_url() ?>leads/massAssign';
    jQuery.ajax({
      type :"POST",
      url  :PAGE,
      data : $('#searchForm').serialize()+'&search_leads='+'Search Leads',
      success:function( res )
      {
        if(res)
        {
          $('#listing_leads').html(res);
          setTimeout(function(){ 
            $this.button('reset');
          }, 1000);
        }
      }
    });
  });
</script>