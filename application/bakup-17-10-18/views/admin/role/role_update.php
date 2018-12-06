<section id="middle">
<!-- page title -->
<header id="page-header">
   <h1>Role <small>Control panel</small></h1>
   
   <ol class="breadcrumb">
   <br>
            <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>role">Role</a></li>
            <li class="active">Role Add</li>
        </ol>

</header>
 
<!-- /page title -->
<div id="content" class="padding-20">
   <div class="row">
      <div class="col-md-12">
        
         <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
               <strong>Add Role</strong>
                 <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>role" class="btn btn-teal btn-sm">Back</a>                           
                </div>
            </div>

            <div class="panel-body">
               <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
                  <fieldset>                   
                    <?php
                    foreach($role_edit as $res)
                    {
                        ?>
                     <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Role Name<span class="text-danger">*</span></label>
                                <input name="role_name" class="form-control" type="text" id="role_name" value="<?php echo $res->role_name; ?>" />
                                <?php echo form_error('role_name','<span class="text-danger">','</span>'); ?>
                           </div>
                           <div class="col-md-6 col-sm-6">
                             <label>Role Status<span class="text-danger">*</span></label>
                            <select name="role_status" id="role_status" class="form-control">
                                <option value="1" <?php if($res->role_status == '1'){ echo "selected"; }?>>Active</option>
                                <option value="0" <?php if($res->role_status == '0'){ echo "selected"; }?>>Inactive</option>
                            </select>
                            <?php echo form_error('role_status','<span class="text-danger">','</span>'); ?>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                            <div class="box-header">
                                <label>Permission</label> 
                            </div><!-- form start -->
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tab Name</th>
                                        <th>All</th>
                                        <th><input type="checkbox" name="all_tab" id="all_tab" value="" onclick="checkedAllCheckboxVerticale('all_tab', 'tab_')" >&nbsp;&nbsp; Tab</th>
                                        <th><input type="checkbox" name="all_add" id="all_add" value="" onclick="checkedAllCheckboxVerticale('all_add', 'add_')" >&nbsp;&nbsp; Add</th>            
                                        <th><input type="checkbox" name="all_edit" id="all_edit" value="" onclick="checkedAllCheckboxVerticale('all_edit', 'edit_')" >&nbsp;&nbsp; Edit</th>           
                                        <th><input type="checkbox" name="all_delete" id="all_delete" value="" onclick="checkedAllCheckboxVerticale('all_delete', 'delete_')" >&nbsp;&nbsp; Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($role_permissions as $res)
                                {
                                    ?>
                                    <tr>        
                                      <td><?php echo $res->tabname; ?></td>
                                      <td><input type="checkbox" name="all_<?php echo $res->tab_id; ?>" <?= ($res->userView == 1 && $res->userAdd == 1 && $res->userEdit == 1 && $res->userDelete == 1) ? 'checked' : ''; ?> id="all_<?php echo $res->tab_id; ?>" value="1" onclick="checkedAllCheckbox(<?php echo $res->tab_id; ?>)" ></td>
                                      <td><input  <?= ($res->userView == 1) ? 'checked' : ''; ?> type="checkbox" onclick="checkAllCheckBox('<?php echo $res->tab_id; ?>')" class="check_checkbox_<?php echo $res->tab_id; ?>" name="tab_<?php echo $res->tab_id; ?>" id="tab_<?php echo $res->tab_id; ?>" value="1" ></td>
                                      <td><input <?= ($res->userAdd == 1) ? 'checked' : ''; ?> type="checkbox" onclick="checkAllCheckBox('<?php echo $res->tab_id; ?>')" class="check_checkbox_<?php echo $res->tab_id; ?>" name="add_<?php echo $res->tab_id; ?>" id="add_<?php echo $res->tab_id; ?>" value="1" ></td>
                                      <td><input <?= ($res->userEdit == 1) ? 'checked' : ''; ?> type="checkbox" onclick="checkAllCheckBox('<?php echo $res->tab_id; ?>')" class="check_checkbox_<?php echo $res->tab_id; ?>" name="edit_<?php echo $res->tab_id; ?>" id="edit_<?php echo $res->tab_id; ?>" value="1" ></td>
                                      <td><input <?= ($res->userDelete == 1) ? 'checked' : ''; ?> type="checkbox" onclick="checkAllCheckBox('<?php echo $res->tab_id; ?>')" class="check_checkbox_<?php echo $res->tab_id; ?>" name="delete_<?php echo $res->tab_id; ?>" id="delete_<?php echo $res->tab_id; ?>" value="1" ></td>
                                    </tr>
                                    <input type="hidden" name="user_permission_id_<?= $res->tab_id; ?>" value="<?= $res->user_permission_id; ?>">
                                    <?php
                                }
                            ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>  
                  </fieldset>
                  <?php }  ?>
                  <div class="row">
                     <div class="col-md-1">
                        <button type="submit" name="Submit" value="Edit" class="btn btn-teal margin-top-30">Submit</button>
                     </div>
                     <div class="col-md-1">
                        <a href="<?= base_url('role'); ?>"><button type="button" class="btn btn-danger margin-top-30 margin-left-10">Cancel</button></a>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      
      </div>
  
   </div>
</div>
</section>
<!-- /MIDDLE -->
<?php
$tab_list = $this->comman_model->getData('tbl_sidebar_tabs' , array('status' => 1));
?>
<script type="text/javascript">
    function checkedAllCheckbox(tab_id)
    {
        if(document.getElementById('all_'+tab_id).checked)
        {
            document.getElementById("tab_"+tab_id).checked = true;
            //document.getElementById("view_"+tab_id).checked = true;
            document.getElementById("add_"+tab_id).checked = true;
            document.getElementById("edit_"+tab_id).checked = true;
            document.getElementById("delete_"+tab_id).checked = true;
        }
        else
        {
            document.getElementById("tab_"+tab_id).checked = false;
            //document.getElementById("view_"+tab_id).checked = false;
            document.getElementById("add_"+tab_id).checked = false;
            document.getElementById("edit_"+tab_id).checked = false;
            document.getElementById("delete_"+tab_id).checked = false;
        }

    }

    function checkAllCheckBox(tab_id)
    {
        var check_arr = [];
        $('.check_checkbox_'+tab_id).each(function () {
            if(this.checked == true)
            {
                check_arr.push($(this).val());
            }
        });
        if(check_arr.length < 5)
        {
            document.getElementById('all_'+tab_id).checked = false;
        }
        else
        {
            document.getElementById('all_'+tab_id).checked = true;
        }
    }

    function checkedAllCheckboxVerticale(main_tab, sub_tab)
    {
        if(document.getElementById(main_tab).checked)
        {
            <?php
                foreach ($tab_list as $t_l) 
                {
                    ?>
                    document.getElementById(sub_tab+"<?php echo $t_l->tab_id; ?>").checked = true;
                    <?php
                }
            ?>
        }
        else
        {
            <?php
                foreach ($tab_list as $t_l) 
                {
                    ?>
                    document.getElementById(sub_tab+"<?php echo $t_l->tab_id; ?>").checked = false;
                    <?php
                }
            ?>
        }
    }     
</script>