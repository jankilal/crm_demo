<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Role</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Role</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading">
            <span class="title elipsis">
            <strong>Role Details</strong> 
            </span>
           <div class="pull-right box-tools">
              <?php
                  foreach($getAllTabAsPerRole as $role)
                  {
                      if($this->uri->segment(1) == $role->controller_name && $role->userAdd == '1')
                      {
                          ?>
                              <a href="<?php echo base_url();?>role/addRole" class="btn btn-info btn-sm">Add New</a>              
                          <?php
                      }
                  }
              ?>                    
            </div>
         </div>

         <!-- panel content -->
         <div class="panel-body">

          <div id="msg_div">
            <?php echo $this->session->flashdata('message');?>
        </div>
           
          <table class="table table-striped table-bordered table-hover" id="sample_5">
            <thead>
              <tr>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>                 
              </tr>
            </thead>
                <tbody>
                <?php
                if(!empty($role_result))
                {
                  foreach($role_result as $res)
                  {
                    ?>
                    <tr>
                      <td><?php echo $res->role_name; ?></td>
                      <td width="10%">
                      <?php
                      if($res->role_status == '1')
                      {
                        ?>
                        <span class="text-success">Active</span>
                        <?php
                      }
                      else
                      {
                        ?>
                        <span class="text-danger">Inactive</span>
                        <?php
                      }
                      ?>
                      </td>
                      <td width="10%">
                        <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                          if($this->uri->segment(1) == $role->controller_name && $role->userEdit == '1')
                          {
                            ?>
                            <a href="<?php echo base_url();?>role/addRole/<?php echo $res->role_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;
                            <?php
                          }                               
                        }
                        ?>
                      </td>
                    </tr>
                    <?php
                  }
                }
                ?>                      
                </tbody>
            </table>
         </div>
         <!-- /panel content -->
         <!-- panel footer -->
         <div class="panel-footer">
          
         </div>
         <!-- /panel footer -->
      </div>
   </div>
</section>
<!-- /MIDDLE -->
<script type="text/javascript">
    function delete_role(role_id)
    {

          bootbox.confirm("Are you sure you want to delete role details",function(confirmed){            
            if(confirmed)
            {
                location.href="<?php echo base_url();?>role/delete_role/"+role_id;
            }
        });
    }    
</script>