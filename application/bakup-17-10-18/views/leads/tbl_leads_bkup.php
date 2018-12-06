
        <table class="table table-striped table-bordered table-hover" id="datatable_sample">

            <thead>
              <tr>
             <th class="table-checkbox">
        <input type="checkbox" class="group-checkable" data-set="#datatable_sample .checkboxes"/>
      </th>
                <th>Title</th>
                <th>Contact Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Lead Status</th>
                <th>Add Process</th>
                <th>Action</th>                 
              </tr>
            </thead>
               <tbody>
                  <?php
                     if(!empty($leads_result))
                     {
                         foreach($leads_result as $res)
                         {                           

                             ?>
                            <tr class="odd gradeX">
                            <td>
                              <input type="checkbox" class="checkboxes" value="1"/>
                            </td>
                               <td><?php echo $res->lead_name; ?></td>                              
                               <td><?php echo $res->contact_name; ?></td>
                               <td><?php echo $res->email; ?></td>
                               <td><?php echo $res->phone; ?></td>
                               <td><span class="label label-warning"><?php echo $res->lead_type; ?></span>&nbsp;&nbsp;<?php echo $res->lead_status; ?>
                               <div>&nbsp;</div></td>
                                 <td><button onclick="save_leads_id('<?php echo $res->leads_id; ?>')" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button></td>
                               <td width="10%">
                                  <?php
                                     foreach($getAllTabAsPerRole as $role)
                                     {
                                         if($this->uri->segment(1) == $role->controller_name && $role->userEdit == '1')
                                         {
                                             ?>
                                          <a href="<?php echo base_url();?>leads/addleads/<?php echo $res->leads_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                
                                  <?php
                                     }
                                     if($this->uri->segment(1) == $role->controller_name && $role->userDelete == '1')
                                     {
                                         ?>
                                       <a class="confirm" onclick="return delete_leads('<?php echo $res->leads_id;?>');" href="" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
                                  <?php
                                     }
                                    }
                                  ?>  
                               </td>
                            </tr>
                          <?php
                             }
                         }
                         else
                         {
                         ?>
                          <tr>
                              <td colspan="3">No records found...</td>
                              <td></td>
                              <td></td>       
                              <td></td>       
                              <td></td>       
                                
                              <td></td>       
                          </tr>
                      <?php
                         }
                         
                         ?>                       
               </tbody>
            </table>