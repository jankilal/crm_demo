<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
<section id="middle">
   <style type="text/css">
      .mail_active { border-top: 1px solid gray; background:#5a6667; }
      .mail_active:hover a{  background: #4b5354 !important;  }
      .mail_box_custom{box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.15)}
      .mail_box_custom ul li a{color: #c2c9c9;}      
      .fstMultipleMode .fstControls{padding: 0px !important; width: 100%;}
      .fstElement{ width: 100% !important; font-size: 10px; padding-top: 5px; border: 2px solid #D7D7D7 !important;   }
      .fstChoiceItem{font-size: 12px; padding: 2px;left: 0px;padding-left: 20px;margin: 5px;}
      .fstMultipleMode.fstActive .fstResults{ font-size: 10px; }
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
                        <li class="mail_active el_primary" >
                            <a href="<?php echo base_url() ?>mailbox/trashMail" ><i class="fa fa-trash text-warning" style="font-size: 16px;"></i> &nbsp;<span>Trash</span><span class="label label-danger pull-right"><?php echo $trash_count; ?></span></a>
                        </li> 
                     </ul>
                  </div>
               </section>
            </div>
            <!-- /COL 1 -->
            <!-- COL 2 -->
            <div class="col-md-9 col-lg-9">
               <div class="tabs nomargin-top">
                  <div class="panel-body mail_box_custom">
                     <div class="box-body">
                     <form method="post" onsubmit="return checkMailBoxValidation()" enctype="multipart/form-data">
                        <div class="form-group col-md-12">
                        <select id='user_emails' class="form-control multipleSelect" multiple name="email_addresses[]">
                        <?php
                        foreach ($all_user_mail as $um_res) 
                        {
                        ?>
                            <option value="<?php echo $um_res->user_email.','.$um_res->user_id; ?>"><?php echo $um_res->user_email ?></option>
                        <?php
                        }
                        ?>
                        </select>
                        <span id="error_user_emails" style="color: red"></span>
                        </div>
                        <div class="form-group col-md-12">
                           <input class="form-control" value="" type="text" name="subject" id="subject" placeholder="Subject:"/>
                           <span id="error_subject" style="color: red"></span>

                        </div>
                        <div class="form-group col-md-12">
                           <textarea name="email_description" class="summernote form-control" data-height="200" data-lang="en-US"></textarea>                   
                        </div>
                        <div class="form-group col-md-12">
                           <div class="fileinput fileinput-new" data-provides="fileinput">
                           <input type="file" id="mail_attechment" name="mail_attechment" >
                           <span style="color: red;" id="error_file"></span>
                              <input type="hidden" id="valid_file_attch">
                              <p class="help-block">Max. 15 MB</p>
                           </div>
                           <div id="msg_pdf" style="color: #e11221"></div>
                        </div>                        
                        <div class="pull-right">                       
                            <button name="Draft" value="Draft" class="btn btn-danger btn-sm">Draft</button>&nbsp;
                            <button name="Send" value="Send" class="btn btn-success btn-sm">Send</button>
                        </div>
                        </form>                       
                     </div>
                     <!-- /.box-body -->        
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
</section>
<!-- /MIDDLE -->
</div>
  <script type="text/javascript">
    function checkMailBoxValidation()
    {
        var email_addresses = document.getElementById('user_emails').value;
        var subject = document.getElementById('subject').value;
        var file_valid = document.getElementById('valid_file_attch').value;
        if(email_addresses == "")
        {         
           $('#error_user_emails').html('Please select any mail*');
           $("#user_emails").focus();         
            return false;
        }
        else
        {
            $('#error_user_emails').html('');            
        }  
        if(subject == "")
        {         
           $('#error_subject').html('Please select any mail*');
           $("#subject").focus();         
            return false;
        }
        else
        {
            $('#error_subject').html('');            
        }
        if(file_valid == '1')
        {
            $('#error_file').html('Attachment size should be less than 15MB ..!');
            return false;
        }
        else
        {
           $('#error_file').html('');
           $('#valid_file_attch').val('');
        }


    }

 $( document ).ready(function() {
 $('#mail_attechment').bind('change', function() {

  //this.files[0].size gets the size of your file.
  if(this.files[0].size > 15000000)
  {
    $('#valid_file_attch').val('1');
  }
  else
  {
    $('#valid_file_attch').val('');
  }

});
 
});
   
</script>