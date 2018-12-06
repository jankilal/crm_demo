<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Item</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Item</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20 ">
      <div id="panel-1" class="panel panel-default">
          <div class="panel-heading">
            <span class="title elipsis">
            <strong>Item Details</strong> 
            </span>
            <div class="pull-right box-tools">
                <?php
                foreach($getAllTabAsPerRole as $role)
                {
                  if($this->uri->segment(1) == $role->controller_name && $role->userAdd == '1')
                  {
                    ?>
                      <a href="<?php echo base_url();?>itemsList/additem" class="btn btn-info btn-sm">Add New</a>              
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
          <table class="table table-striped table-bordered table-hover" id="web_view_tbl">
            <thead>
              <tr>
                <th>Item Name </th>
                <th>Description</th>
                <th>Unit Price</th> 
                <th>Quantity</th>
                <th>Tax Rate</th>
                <th>Action</th>                  
              </tr>
            </thead>
            <tbody>
              <?php
              if(!empty($item_result))
              {
                 foreach($item_result as $res)
                 {
                    ?>
                    <tr>
                       <td><?php echo $res->item_name; ?></td>
                       <td><?php echo substr($res->item_desc,0, 45);?></td>
                       <td><?php echo $res->unit_cost; ?></td>
                       <td><?php echo $res->quantity; ?></td>
                       <td><?php echo $res->item_tax_rate; ?></td>
                       <td width="10%">
                           <?php
                             foreach($getAllTabAsPerRole as $role)
                             {
                                 if($this->uri->segment(1) == $role->controller_name && $role->userEdit == '1')
                                 {
                                     ?>
                                  <a href="<?php echo base_url();?>itemsList/additem/<?php echo $res->item_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                
                                  <?php
                             }
                             if($this->uri->segment(1) == $role->controller_name && $role->userDelete == '1')
                             {
                                 ?>
                               <a onclick="delete_item('<?php echo $res->item_id; ?>')" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
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
<script type="text/javascript">
  function delete_item(item_id)
  {
    bootbox.confirm("Are you sure you want to delete Item Details",function(confirmed){            
      if(confirmed)
      {
          location.href="<?php echo base_url();?>itemsList/deleteitem/"+item_id;
      }
    });
  }
</script>
