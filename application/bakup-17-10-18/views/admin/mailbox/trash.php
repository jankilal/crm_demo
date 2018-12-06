<section id="middle">
<style type="text/css">
    .mail_active { border-top: 1px solid gray; background:#5a6667; }
    .mail_active:hover a{  background: #4b5354 !important;  }
    .mail_box_custom{box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15)}
    .mail_box_custom ul li a{color: #c2c9c9;}
    .selected_tab{background: #4b5354 !important;}
</style>
   <!-- page title -->
   <header id="page-header">
      <h1>User Profile</h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Mailbox</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="page-profile">
         <div class="row">
            <!-- COL 1 -->
            <div class="col-md-3 col-lg-3">
               <section class="panel">
                  <div class="panel-body noradius padding-10 mail_box_custom">
                     <ul class="nav nav-list">
                        <li class="mail_active el_primary" >
                            <a href="<?php echo base_url() ?>mailbox" ><i class="fa fa-inbox" style="font-size: 16px;"></i> &nbsp;<span>Inbox</span><span class="label label-info pull-right"><?php echo $inbox_count; ?></span></a>
                        </li>      
                        <li class="mail_active el_primary" >
                            <a href="<?php echo base_url() ?>mailbox/sentMail" ><i class="fa fa-envelope-o" style="font-size: 16px;"></i> &nbsp;<span>Sent Mail</span></a>
                        </li>
                        <li class="mail_active el_primary" >
                            <a href="<?php echo base_url() ?>mailbox/draftMail" ><i class="fa fa-file-text-o" style="font-size: 16px;"></i> &nbsp;<span>Drafts</span></a>
                        </li>
                        <li class="mail_active el_primary" >
                            <a href="<?php echo base_url() ?>mailbox/favouritesMail" ><i class="fa fa-star text-green" style="font-size: 16px;"></i> &nbsp;<span>Favourites</span></a>
                        </li>         
                        <li class="selected_tab mail_active el_primary" >
                            <a href="<?php echo base_url() ?>mailbox/trashMail" ><i class="fa fa-trash text-warning" style="font-size: 16px;"></i> &nbsp;<span>Trash</span><span class="label label-danger pull-right"><?php echo $trash_count; ?></span></a>
                        </li>                        
                    </ul>   
                  </div>
               </section>
            </div>
            <!-- /COL 1 -->
            <!-- COL 2 -->
            <form method="POST">
            <div class="col-md-9 col-lg-9">
               <div class="tabs nomargin-top">
                <div class="panel-body mail_box_custom">              
                   <a href="javascript:;" onclick="location.reload()">
                    <i class="fa fa-refresh" style="font-size: 16px;"></i>
                    </a>&nbsp;&nbsp;
                    <?php if(!empty($trash_result)){ ?><a href="javascript:;" title="Delete"><button type="submit" name="Delete" value="Delete">
                    <i class="fa fa-trash text-red" style="font-size: 16px;"></i></button></a>&nbsp;&nbsp;<?php } ?>
                    <a href="<?php echo base_url(); ?>mailbox/compose" style="padding: 2px 10px 2px 10px;" class="btn btn-3d btn-xs btn-reveal btn-red">
                    <i class="fa fa-plus"></i>
                    <span>Compose</span></a>
                    <hr>  
                    <?php if(isset($email_view) && !empty($email_view))
                    {
                      ?>
                        
                      <?php
                    }else
                    { ?>
                    <?php
                    if(!empty($trash_result))
                    {
                    ?>
                        <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                          <thead>
                            <tr>                          
                              <th><input type="checkbox" name="checkAll" id="checkAll"></th>                            
                              <th>Subject</th>
                              <th>Date</th>
                              <th>View</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                            foreach ($trash_result as $ib_res) 
                            {
                              ?>
                                  <tr class="odd gradeX">
                                    <td width="6%">
                                      <input type="checkbox" class="checkboxes" name="mail_checked[]" value="<?php echo $ib_res->mailbox_id; ?>"/></td>
                                    
                                    <td><?php echo $ib_res->subject; ?></td>
                                    <td><?php echo date_format(date_create_from_format('Y-m-d H:i:s', $ib_res->message_time), 'd M');?></td>                 
                                    <td width="10%">
                                    <a href="<?php echo base_url().'mailbox/index/'.$ib_res->mailbox_id; ?>" title="View" class="btn btn-xs btn-default btn-bordered"><i class="fa fa-eye" style="padding: 0px;"></i></a></td>
                                  </tr>
                                 
                             <?php
                            }
                          ?>
                          </tbody>
                        </table>
                        <?
                            }
                          else
                          {
                          ?>
                          <p class="text-red">Nothing to display here!</p>
                          <?php
                          }
                         
                    }
                    ?>
                </div>
              </form>
            </div>
          </div>
       </div>
    </div>           
  </div>
</div>
</section>
<script type="text/javascript">
  
  $(function () {
    $("#datatable_sample #checkAll").click(function () {
        if ($("#datatable_sample #checkAll").is(':checked')) {
            $("#datatable_sample input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#datatable_sample input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
</script>