<!-- CSS JQGRID TABLE -->
<link href="<?= base_url(); ?>webroot/css/layout-datatables.css" rel="stylesheet" type="text/css" />
<hr>
<div class="row">
  <div class="col-md-12">
    <div class="alert alert-info" style="margin-bottom: 0px; padding: 14px 0px 6px 10px;">
      <h4 style="line-height: 10px;">Searched Records</h4>
    </div>
  </div>
</div>
<br>
<form method="POST" id="assignForm">
  <?php
  if(!empty($leads_result))
  {
    ?>
    <div class="row">
      <div class="col-md-6">
          <label>Assign To User <span class="text-danger"> *</span></label>
          <div class="fancy-form fancy-form-select">
            <select class="form-control" name="assign_to" id="assign_to">
              <option value="">Select User</option>
              <?php
              if(!empty($user_list))
              {
                foreach ($user_list as $u_res) 
                {
                  ?>
                  <option value="<?= $u_res->user_id; ?>"><?= $u_res->user_full_name; ?></option>
                  <?php
                }
              }
              ?>
            </select>
            <i class="fancy-arrow"></i>
          </div>
          <span style="color: red;" id="error_ast"></span>
      </div>
      <div class="col-md-6">
        <button name="assign_leads" value="Assign Leads" class="btn btn-3d btn-reveal btn-teal" style="margin-top: 23px;"><i class="fa fa-send"></i><span> Assign</span></button>
      </div>
    </div>
    <?php
  }
  ?>
  <div class="row">
    <div class="col-md-12">
      <table class="table table-striped table-bordered table-hover" id="searchedLead">
        <thead>
          <tr>
            <th class="table-checkbox">
              <input type="checkbox" class="group-checkable" data-set="#searchedLead .checkboxes"/>
            </th>
            <th>S.No.</th>
            <th>Lead Title</th>
            <th>Company</th>
            <th>Email</th>
            <th>Phone</th> 
            <th>Industry</th> 
            <th>Address</th> 
          </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($leads_result))
        {
          $i =1;
          foreach ($leads_result as $res) 
          {
            $address_arr = array();
            if($res->address != '')
            $address_arr[] = $res->address;
            if($res->city != '')
            $address_arr[] = $res->city;
            if($res->zip_code != '')
            $address_arr[] = $res->zip_code;
            ?>
            <tr class="odd gradeX">
              <td>
                <input type="checkbox" class="checkboxes" name="selected_leads[]" value="<?= $res->lead_id; ?>"/>
              </td>
              <td><?= $i; ?></td>
              <td><?= $res->lead_name; ?></td>
              <td><?= $res->organization; ?></td>
              <td><?= $res->email; ?></td>
              <td><?= $res->phone_number; ?></td>
              <td><?= $res->industry; ?></td>
              <td><?= implode(', ', $address_arr); ?></td>
            </tr>
            <?php
            $i++;
          }
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>
</form>
<script type="text/javascript">
  if (jQuery().dataTable) {
      var table = jQuery('#searchedLead');
      table.dataTable({        
        "lengthMenu": [
          [5, 15, 20, -1],
          [5, 15, 20, "All"] // change per page values here
        ],
        // set the initial value
        "paging": false,
        "searching": false,
        "columnDefs": [{  // set default column settings
          'orderable': false,
          'targets': [0]
        }, {
          "searchable": false,
          "targets": [0]
        }],
        "order": [
          [1, "asc"]
        ] // set first column as a default sort by asc
      });

      var tableWrapper = jQuery('#searchedLead_wrapper');

      table.find('.group-checkable').change(function () {
        var set = jQuery(this).attr("data-set");
        var checked = jQuery(this).is(":checked");
        jQuery(set).each(function () {
          if (checked) {
            jQuery(this).prop('checked',true);
            jQuery(this).parents('tr').addClass("active");
          } else {
            jQuery(this).prop('checked',false);
            jQuery(this).parents('tr').removeClass("active");
          }
          // checked ? jQuery('#product_submit').show() : jQuery('#product_submit').hide();
        });
      });

      table.on('change', 'tbody tr .checkboxes', function () {
        jQuery(this).parents('tr').toggleClass("active");
        // jQuery('.checkboxes:checked').length ? jQuery('#product_submit').show() : jQuery('#product_submit').hide();
        jQuery('.checkboxes:checked').length == jQuery('.checkboxes').length ? jQuery('.group-checkable').prop('checked',true) : jQuery('.group-checkable').prop('checked',false);
      });
      tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
  }

  jQuery('#assignForm').submit(function (){
    var checkedLeads = $(".checkboxes:checked").map(function(){
      return $(this).val();
    }).get();

    if($('#assign_to').val() == '')
    {
      $('#assign_to').focus();
      $('#error_ast').html('Please Select assign user.');
      return false;
    }
    else
    {
      $('#error_ast').html('');
    }

    if(checkedLeads.length === 0)
    {
      alert('Please select any leads.');
      return false;
    }
    if(confirm('Are you sure you want to assign?') === false){
      return false;
    }
  });

  $('#assign_to').select2();
</script>
