<?php echo message_box('success'); ?>
<?php echo message_box('error'); 
   $can_edit = $this->task_model->can_action('tbl_task', 'edit', array('task_id' => $task_details->task_id),'task_id');
   // get all comments by tasks id
   $comment_details = $this->db->where('task_id', $task_details->task_id)->get('tbl_task_comment')->result();
   // get all $total_timer by tasks id
   $total_timer = $this->db->where(array('task_id' => $task_details->task_id))->get('tbl_tasks_timer')->result();
   $activities_info = $this->db->where(array('module' => 'tasks', 'module_field_id' => $task_details->task_id))->order_by('activity_date', 'desc')->get('tbl_activities')->result();
   $where = array('user_id' => $this->data['user_id'], 'module_id' => $task_details->task_id, 'module_name' => 'tasks');
   $check_existing = $this->task_model->check_by($where, 'tbl_pinaction');
   if (!empty($check_existing)) {
       $url = 'remove_todo/' . $check_existing->pinaction_id;
       $btn = 'danger';
       $title = lang('remove_todo');
   } else {
       $url = 'add_todo_list/tasks/' . $task_details->task_id;
       $btn = 'warning';
       $title = lang('add_todo_list');
   }
   ?> 
<style>
.tooltip-inner {
white-space: pre-wrap;
}
</style>
<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Opportunities</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Opportunities</li>
      </ol>
   </header>
   <!-- /page title -->
   <!-- Stacked Left -->
   <div id="panel-ui-tan-l2" class="panel panel-default">
      <!-- panel content -->
      <div class="panel-body">
         <div class="row tabs">
            <!-- tabs -->
            <div class="col-md-3 col-sm-3">
               <ul class="nav nav-pills nav-stacked navbar-custom-nav">
                  <li class="<?= $active == 1 ? 'active' : '' ?>">
                     <a href="#task_details" data-toggle="tab"><?= lang('task_details') ?></a>
                  </li>
                  <li class="<?= $active == 4 ? 'active' : '' ?>"><a href="#task_comments" data-toggle="tab"><?= lang('comments') ?><strong class="pull-right"><?= (!empty($comment_details) ? count($comment_details) : null) ?></strong></a>
                  </li>
                  <li class="<?= $active == 5 ? 'active' : '' ?>"><a href="#task_attachments" data-toggle="tab"><?= lang('attachment') ?><strong class="pull-right"><?= (!empty($project_files_info) ? count($project_files_info) : null) ?></strong></a>
                  </li>
                  <li class="<?= $active == 6 ? 'active' : '' ?>"><a href="#task_notes" data-toggle="tab"><?= lang('notes') ?>
                     <strong class="pull-right"><span class="label label-info text-black" ><?= (!empty($all_task_info) ? count($all_task_info) : null) ?></span></strong></a>
                  </li>
                  <li class="<?= $active == 7 ? 'active' : '' ?>"><a href="#timesheet" data-toggle="tab"><?= lang('timesheet') ?>
                     <strong class="pull-right"><span class="label label-info text-black" ><?= (!empty($all_task_info) ? count($all_task_info) : null) ?></span></strong></a>
                  </li>
                  <li class="<?= $active == 8 ? 'active' : '' ?>"><a href="#activities" data-toggle="tab"><?= lang('activities') ?><strong class="pull-right"><?= (!empty($activities_info) ? count($activities_info) : null) ?></strong></a>
                  </li>
               </ul>
            </div>
            <!-- tabs content -->
            <div class="col-md-9 col-sm-9">
               <div class="tab-content nav-tabs-custom">
                  <!-- Task Details tab Starts -->           
                  <div class="tab-pane <?= $active == 1 ? 'active' : '' ?>" id="task_details"
                     style="position: relative;">
                     <div class="panel panel-custom">
                        <div class="panel-heading">
                           <h3 class="panel-title">
                              <?php if (!empty($task_details->task_name)) echo $task_details->task_name; ?>
                             
                              <?php
                                 if (!empty($can_edit)) {
                                     ?>
                              <span class="btn-xs pull-right"><a
                                 href="<?= base_url() ?>task/addTask/<?= $task_details->task_id ?>"><?= lang('edit') . ' ' . lang('task') ?></a>
                              </span>
                              <?php } ?>
                           </h3>
                        </div>
                        <div class="panel-body row form-horizontal task_details">
                           <div class="form-group col-sm-6">
                              <label class="control-label col-sm-5"><strong><?= lang('task_status') ?>
                              :</strong></label>
                              <div class="pull-left mt">
                                 <?php
                                    if ($task_details->task_status == 'completed') {
                                        $label = 'success';
                                    } elseif ($task_details->task_status == 'not_started') {
                                        $label = 'info';
                                    } elseif ($task_details->task_status == 'deferred') {
                                        $label = 'danger';
                                    } else {
                                        $label = 'warning';
                                    }
                                    ?>
                                 <span class="label label-<?= $label ?>  "><?= lang($task_details->task_status) ?></span>
                              </div>
                           <!--    <div class="col-sm-1 mt">
                                 <div class="btn-group">
                                    <button class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown">
                                    <?= lang('change') ?>
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu animated zoomIn">
                                       <li>
                                          <a href="<?= base_url() ?>admin/tasks/change_status/<?= $task_details->task_id . '/not_started' ?>"><?= lang('not_started') ?></a>
                                       </li>
                                       <li>
                                          <a href="<?= base_url() ?>admin/tasks/change_status/<?= $task_details->task_id . '/in_progress' ?>"><?= lang('in_progress') ?></a>
                                       </li>
                                       <li>
                                          <a href="<?= base_url() ?>admin/tasks/change_status/<?= $task_details->task_id . '/completed' ?>"><?= lang('completed') ?></a>
                                       </li>
                                       <li>
                                          <a href="<?= base_url() ?>admin/tasks/change_status/<?= $task_details->task_id . '/deferred' ?>"><?= lang('deferred') ?></a>
                                       </li>
                                       <li>
                                          <a href="<?= base_url() ?>admin/tasks/change_status/<?= $task_details->task_id . '/waiting_for_someone' ?>"><?= lang('waiting_for_someone') ?></a>
                                       </li>
                                    </ul>
                                 </div>
                              </div> -->
                           </div>
                           <div class="form-group  col-sm-6">
                              <label class="control-label col-sm-4"><strong><?= lang('timer_status') ?>:</strong></label>
                              <div class="col-sm-8 mt">
                                 <?php if ($task_details->timer_status == 'on') { ?>
                                 <span class="label label-success"><?= lang('on') ?></span>
                                <!--  <a class="btn btn-xs btn-danger "
                                    href="<?= base_url() ?>task/tasks_timer/off/<?= $task_details->task_id ?>/details"><?= lang('stop_timer') ?> </a> -->
                                 <?php } else {
                                    ?>
                                 <span class="label label-danger"><?= lang('off') ?></span>
                                <!--  <a class="btn btn-xs btn-success"
                                    href="<?= base_url() ?>task/tasks_timer/on/<?= $task_details->task_id ?>/details"><?= lang('start_timer') ?> </a> -->
                                 <?php }
                                    ?>
                              </div>
                           </div>
                           <?php
                              if (!empty($task_details->project_id)):
                                  $project_info = $this->db->where('project_id', $task_details->project_id)->get('tbl_project')->row();
                                  $milestones_info = $this->db->where('milestones_id', $task_details->milestones_id)->get('tbl_milestones')->row();
                                  ?>
                           <div class="form-group  col-sm-6">
                              <label class="control-label col-sm-5"><strong><?= lang('project_name') ?>
                              :</strong></label>
                              <div class="col-sm-7 ">
                                 <p class="form-control-static"><?php if (!empty($project_info->project_name)) echo $project_info->project_name; ?></p>
                              </div>
                           </div>
                           <div class="form-group  col-sm-6">
                              <label class="control-label col-sm-4"><strong><?= lang('milestone') ?>
                              :</strong></label>
                              <div class="col-sm-8 ">
                                 <p class="form-control-static"><?php if (!empty($milestones_info->milestone_name)) echo $milestones_info->milestone_name; ?></p>
                              </div>
                           </div>
                           <?php endif ?>
                           <?php
                              if (!empty($task_details->opportunities_id)):
                                  $opportunity_info = $this->db->where('opportunities_id', $task_details->opportunities_id)->get('tbl_opportunities')->row();
                                  ?>
                           <div class="form-group  col-sm-10">
                              <label class="control-label col-sm-3 "><strong
                                 class="mr-sm"><?= lang('opportunity_name') ?></strong></label>
                              <div class="col-sm-8 " style="margin-left: -5px;">
                                 <p class="form-control-static"><?php if (!empty($opportunity_info->opportunity_name)) echo $opportunity_info->opportunity_name; ?></p>
                              </div>
                           </div>
                           <?php endif ?>
                           <?php
                              if (!empty($task_details->leads_id)):
                                  $leads_info = $this->db->where('leads_id', $task_details->leads_id)->get('tbl_leads')->row();
                                  ?>
                           <div class="form-group  col-sm-10">
                              <label class="control-label col-sm-3 "><strong
                                 class="mr-sm"><?= lang('leads_name') ?></strong></label>
                              <div class="col-sm-8 " style="margin-left: -5px;">
                                 <p class="form-control-static"><?php if (!empty($leads_info->lead_name)) echo $leads_info->lead_name; ?></p>
                              </div>
                           </div>
                           <?php endif ?>
                           <?php
                              if (!empty($task_details->goal_tracking_id)):
                                  $goal_tracking_info = $this->db->where('goal_tracking_id', $task_details->goal_tracking_id)->get('tbl_goal_tracking')->row();
                                  ?>
                           <div class="form-group  col-sm-10">
                              <label class="control-label col-sm-3 "><strong
                                 class="mr-sm"><?= lang('goal_tracking') ?></strong></label>
                              <div class="col-sm-8 " style="margin-left: -5px;">
                                 <p class="form-control-static"><?php if (!empty($goal_tracking_info->subject)) echo $goal_tracking_info->subject; ?></p>
                              </div>
                           </div>
                           <?php endif ?>
                           <div class="form-group  col-sm-6">
                              <label class="control-label col-sm-5"><strong><?= lang('start_date') ?>
                              :</strong></label>
                              <div class="col-sm-7 ">
                                 <p class="form-control-static"><?php
                                    if (!empty($task_details->task_start_date)) {
                                        echo strftime($task_details->task_start_date);
                                    }
                                    ?></p>
                              </div>
                           </div>
                           <div class="form-group  col-sm-6">
                              <?php
                                 $due_date = $task_details->due_date;
                                 $due_time = strtotime($due_date);
                                 $current_time = time();
                                 if ($current_time > $due_time) {
                                     $text = 'text-danger';
                                 } else {
                                     $text = null;
                                 }
                                 ?>
                              <label class="control-label col-sm-4"><strong
                                 class="<?= $text ?>"><?= lang('due_date') ?>
                              :</strong></label>
                              <div class="col-sm-8 ">
                                 <p class="form-control-static"><?php
                                    if (!empty($task_details->due_date)) {
                                        echo strftime($task_details->due_date);
                                    }
                                    ?></p>
                              </div>
                           </div>
                           <div class="form-group  col-sm-6">
                              <label class="control-label col-sm-5"><strong><?= lang('created_by') ?>
                              :</strong></label>
                              <div class="col-sm-7 ">
                                 <p class="form-control-static"><?php
                                    if (!empty($task_details->created_by)) {
                                        echo $this->db->where('user_id', $task_details->created_by)->get('tbl_account_details')->row()->fullname;
                                    }
                                    ?></p>
                              </div>
                           </div>
                           <div class="form-group  col-sm-6">
                              <label class="control-label col-sm-4"><strong><?= lang('created_date') ?>:</strong></label>
                              <div class="col-sm-8 ">
                                 <p class="form-control-static"><?php
                                    if (!empty($task_details->due_date)) {
                                        echo strftime($task_details->task_created_date);
                                    }
                                    ?></p>
                              </div>
                           </div>
                           <div class="form-group  col-sm-6">
                              <label class="control-label col-sm-5"><strong><?= lang('estimated_hour') ?>
                              :</strong></label>
                              <div class="col-sm-7 ">
                                 <p class="form-control-static">
                                    <strong><?php if (!empty($task_details->task_hour)) echo $task_details->task_hour; ?> <?= lang('hours') ?></strong>
                                 </p>
                              </div>
                           </div>
                           <div class="form-group  col-sm-6">
                              <label class="control-label col-sm-4"><strong><?= lang('participants') ?>
                              :</strong></label>
                              <div class="col-sm-8 ">
                              </div>
                           </div>
                           <div class="form-group  col-sm-10">
                              <label class="control-label col-sm-3 "><strong class="mr-sm"><?= lang('completed') ?>
                              :</strong></label>
                              <div class="col-sm-9 " style="margin-left: -5px;">
                                 <?php
                                    if ($task_details->task_progress < 49) {
                                        $progress = 'progress-bar-danger';
                                    } elseif ($task_details->task_progress > 50 && $task_details->task_progress < 99) {
                                        $progress = 'progress-bar-primary';
                                    } else {
                                        $progress = 'progress-bar-success';
                                    }
                                    ?>
                                 <span class="">
                                    <div class="mt progress progress-striped ">
                                       <div class="progress-bar <?= $progress ?> " data-toggle="tooltip"
                                          data-original-title="<?= $task_details->task_progress ?>%"
                                          style="width: <?= $task_details->task_progress ?>%"></div>
                                    </div>
                                 </span>
                              </div>
                           </div>
                           <div class="form-group col-sm-12">
                              <?php $init = $this->task_model->task_spent_time_by_id($task_details->task_id);
                               //$init = $seconds;
                                if($init == 0)
                                {
                                    $hours = '00';
                                    $minutes = '00';
                                    $seconds = '00';  
                                }
                                else
                                {
                                    $hours = gmdate("H", $init);
                                    $minutes = gmdate("i", $init);
                                    $seconds = gmdate("s", $init);      
                                }
                                echo "<div class='countdown'><div class='countdown-time'><ul class='clearfix' id='js-countDown'><li class='item'><i class='hour'>" . $hours . "</i><span>" . lang('hours') . "</span></li><li class='blank'>:</li><li class='item'><i class='minute'>" . $minutes . "</i><span>" . lang('minutes') . "</span></li><li class='blank'>:</li><li class='item'><i class='second'>" . $seconds . "</i><span>" . lang('seconds') . "</span></li></ul></div></div>"; ?>
                           </div>
                           <div class="col-sm-12">
                              <blockquote
                                 style="font-size: 12px; margin-top: 5px"><?php if (!empty($task_details->task_description)) echo $task_details->task_description; ?></blockquote>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Task Details tab End -->
                 <div class="tab-pane <?= $active == 4 ? 'active' : '' ?>" id="task_comments" style="position: relative;">
                  <div class="panel panel-custom">
                     <div class="panel-heading">
                        <h3 class="panel-title"><?= lang('comments') ?></h3>
                     </div>
                     <div class="panel-body chat" id="chat-box">
                        <form id="form_validation" action="<?php echo base_url() ?>task/save_comments" method="post" class="form-horizontal">
                           <input type="hidden" name="task_id" value="<?php
                              if (!empty($task_details->task_id)) {
                                  echo $task_details->task_id;
                              }
                              ?>" class="form-control">
                           <div class="form-group">
                              <div class="col-sm-12">
                                 <textarea class="form-control textarea"
                                    placeholder="<?= $task_details->task_name . ' ' . lang('comments') ?>" name="comment" style="height: 70px;"></textarea>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-sm-12">
                                 <div class="pull-right">
                                    <button type="submit" id="sbtn"
                                       class="btn btn-primary"><?= lang('post_comment') ?></button>
                                 </div>
                              </div>
                           </div>
                        </form>
                        <hr/>
                        <?php
                           if (!empty($comment_details)):foreach ($comment_details as $key => $v_comment):
                               $user_info = $this->db->where(array('user_id' => $v_comment->user_id))->get('tbl_user')->row();
                            //print_r($user_info); die;
                               if(!empty($user_info))
                               {                          
                               if ($user_info->user_role_id == 1) {
                                   $label = '<small style="font-size:10px;padding:2px;" class="label label-danger ">' . lang('admin') . '</small>';
                               } elseif($user_info->user_role_id == 3) {
                                   $label = '<small style="font-size:10px;padding:2px;" class="label label-primary">' . lang('staff') . '</small>';
                               } else {
                                   $label = '<small style="font-size:10px;padding:2px;" class="label label-success">' . lang('client') . '</small>';
                               }
                              }
                               ?>
                           <div class="col-sm-12 item ">
                           <img src="<?php if(!empty($user_info)){ echo base_url().$user_info->user_profile_img; } ?>" alt="user image"
                              class="img-circle"/>
                           <p class="message">
                              <?php
                                 $today = time();
                                 $comment_time = strtotime($v_comment->comment_datetime);
                                 ?>
                              <small class="text-muted pull-right"><i
                                 class="fa fa-clock-o"></i> <?= $this->task_model->get_time_different($today, $comment_time) ?> <?= lang('ago') ?>
                              <?php if ($v_comment->user_id == $this->session->userdata('user_id')) { ?>
                              <?= btn_delete('task/delete_comments/' . $v_comment->task_id . '/' . $v_comment->task_comment_id) ?>
                              <?php } ?></small>
                              <a href="#" class="name">
                              <?php if(!empty($user_info)) { echo ($user_info->user_full_name) . ' ' . $label; } ?>
                              </a>
                              <?php if (!empty($v_comment->comment)) echo $v_comment->comment; ?>
                           </p>
                        </div>
                        <!-- /.item -->
                        <?php endforeach; ?>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
               <!-- Task coments panel End -->
              <div class="tab-pane <?= $active == 5 ? 'active' : '' ?>" id="task_attachments"
                  style="position: relative;">
                  <div class="panel panel-custom">
                     <div class="panel-heading">
                        <h3 class="panel-title"><?= lang('attachment') ?></h3>
                     </div>
                     <div class="panel-body">
                        <form action="<?= base_url() ?>task/save_attachment/<?php if (!empty($add_files_info)) { echo $add_files_info->task_attachment_id; } ?>" enctype="multipart/form-data" method="post" id="form" class="form-horizontal">
                           <div class="form-group">
                              <label class="col-lg-3 control-label"><?= lang('file_title') ?> <span
                                 class="text-danger">*</span></label>
                              <div class="col-lg-6">
                                 <input name="title" class="form-control" value="<?php
                                    if (!empty($add_files_info)) {
                                        echo $add_files_info->title;
                                    }
                                    ?>" required placeholder="<?= lang('file_title') ?>"/>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-lg-3 control-label"><?= lang('description') ?></label>
                              <div class="col-lg-6">
                                 <textarea name="description" class="form-control"
                                    placeholder="<?= lang('description') ?>"><?php
                                    if (!empty($add_files_info)) {
                                        echo $add_files_info->description;
                                    }
                                    ?></textarea>
                              </div>
                           </div>
                           <?php if (empty($add_files_info)) { ?>
                              <div id="add_new">
                                 <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label"><?= lang('upload_file') ?></label>
                                    <div class="col-sm-6">
                                       <?php if (!empty($opportunity_files)):foreach ($opportunity_files as $v_files_image): ?>
                                       <span class="fileinput-new" style="display: none">Select file</span>
                                       <span class="fileinput-exists" style="display: block"><?= lang('change') ?></span>
                                       <input type="hidden" name="task_files[]" value="<?php echo $v_files_image->files ?>">
                                       <input type="file" name="task_files[]">
                                       </span>
                                       <span class="fileinput-filename"> <?php echo $v_files_image->file_name ?></span>
                                       <?php endforeach; ?>
                                       <?php else: ?>
                                       <input type="file" name="task_files[]">
                                       <?php endif; ?>
                                       <div id="msg_pdf" style="color: #e11221"></div>
                                    </div>
                                    <div class="col-sm-2">
                                       <strong><a href="javascript:void(0);" id="add_more" class="addCF"><i
                                          class="fa fa-plus"></i>&nbsp;<?= lang('add_more') ?>
                                       </a></strong>
                                    </div>
                                 </div>
                              </div>
                              <?php } ?>
                              <br/>
                              <input type="hidden" name="task_id" value="<?php
                                 if (!empty($task_details->task_id)) {
                                     echo $task_details->task_id;
                                 }
                                 ?>" class="form-control">
                              <div class="form-group">
                                 <div class="col-sm-3">
                                    <button type="submit"
                                       class="btn btn-primary"><?= lang('upload_file') ?></button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <!-- Task Attachment Panel Ends -->
                  <div class="tab-pane <?= $active == 6 ? 'active' : '' ?>" id="task_notes" style="position: relative;">
                     <div class="panel panel-custom">
                        <div class="panel-heading">
                           <h3 class="panel-title"><?= lang('notes') ?></h3>
                        </div>
                        <div class="panel-body">
                           <form action="<?= base_url() ?>task/save_tasks_notes/<?php
                              if (!empty($task_details)) {
                              echo $task_details->task_id;
                              }
                              ?>" enctype="multipart/form-data" method="post" id="form" class="form-horizontal">
                              <div class="form-group">
                                 <div class="col-lg-12">
                                    <textarea class="form-control textarea"
                                       name="tasks_notes"><?= $task_details->tasks_notes ?></textarea>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-sm-2">
                                    <button type="submit" id="sbtn"
                                       class="btn btn-primary"><?= lang('updates') ?></button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <!-- Task Notes Panel Ends -->
                  <div class="bg-white tab-pane <?= $active == 7 ? 'active' : '' ?>" id="timesheet" style="position: relative;">
                     <div class="">
                        <!-- Tabs within a box -->
                        <ul class="nav nav-tabs">
                           <li class="<?= $time_active == 1 ? 'active' : ''; ?>"><a href="#general"
                              data-toggle="tab"><?= lang('timesheet') ?></a>
                           </li>
                           <li class="<?= $time_active == 2 ? 'active' : ''; ?>"><a href="#contact"
                              data-toggle="tab"><?= lang('manual_entry') ?></a>
                           </li>
                        </ul>
                        <div class="tab-content bg-white">
                           <!-- ************** general *************-->
                           <div class="tab-pane <?= $time_active == 1 ? 'active' : ''; ?>" id="general">
                              <div class="table-responsive">
                                 <table id="table-tasks-timelog" class="table table-striped">
                                    <thead>
                                       <tr>
                                          <th><?= lang('user') ?></th>
                                          <th><?= lang('start_time') ?></th>
                                          <th><?= lang('stop_time') ?></th>
                                          <th><?= lang('task_name') ?></th>
                                          <th class="col-time"><?= lang('time_spend') ?></th>
                                          <th><?= lang('action') ?></th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (!empty($total_timer)) 
                                    {
                                       foreach ($total_timer as $v_tasks) {
                                       $task_info = $this->db->where(array('task_id' => $v_tasks->task_id))->get('tbl_task')->row();
                                       if (!empty($task_info)) 
                                       {
                                       ?>
                                          <tr>
                                             <td class="small">
                                                <a class="pull-left recect_task  ">
                                                <?php                    
                                                   $user_info = $this->db->where(array('user_id' => $v_tasks->user_id))->get('tbl_user')->row();
                                                   if (!empty($profile_info)) {
                                                       ?>
                                                    <img style="width: 30px;margin-left: 18px;
                                                   height: 29px;
                                                   border: 1px solid #aaa;"
                                                   src="<?= base_url() . $user_info->user_profile_img; ?>"
                                                   class="img-circle">
                                                <?php } ?>
                                                <?= ucfirst($user_info->user_full_name) ?>
                                                </a>
                                             </td>
                                             <td><span
                                                class="label label-success"><?= strftime(config_item('date_format') . ' %H:%M', $v_tasks->start_time) ?></span>
                                             </td>
                                             <td><span
                                                class="label label-danger"><?= strftime(config_item('date_format') . ' %H:%M', $v_tasks->end_time) ?></span>
                                             </td>
                                             <td>
                                                <a href="<?= base_url() ?>tasks/view_task_details/<?= $v_tasks->task_id ?>"
                                                   class="text-info small"><?= $task_info->task_name ?>
                                                   <?php
                                                      if (!empty($v_tasks->reason)) 
                                                      {
                                                          $edit_user_info = $this->db->where(array('user_id' => $v_tasks->edited_by))->get('tbl_user')->row();
                                                          echo '<i class="text-danger" data-html="true" data-toggle="tooltip" data-placement="top" title="Reason : ' . $v_tasks->reason . '<br>' . ' Edited By : ' . $edit_user_info->user_full_name . '">Edited</i>';
                                                      }
                                                      ?>
                                                </a>
                                                </td>
                                                <td>
                                                   <small
                                                      class="small text-muted"><?php
                                                      if($init == 0)
                                                      {
                                                          $hours = '00';
                                                          $minutes = '00';
                                                          $seconds = '00';  
                                                      }
                                                      else
                                                      {
                                                          $hours = gmdate("H", $init);
                                                          $minutes = gmdate("i", $init);
                                                          $seconds = gmdate("s", $init);      
                                                      }
                                                      echo "<strong>".$hours.' : '.$minutes.' : '.$seconds.'</strong>';
                                                      ?></small>
                                                </td>
                                                <td>
                                                   <?= btn_edit('task/taskDetails/' . $v_tasks->tasks_timer_id . '/7/edit') ?>
                                                   <?= btn_delete('task/update_tasks_timer/' . $v_tasks->tasks_timer_id . '/delete_task_timmer') ?>
                                                </td>
                                             </tr>
                                          <?php
                                          }
                                       }
                                    }
                                    ?>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           <div class="tab-pane <?= $time_active == 2 ? 'active' : ''; ?>" id="contact">
                              <form role="form" enctype="multipart/form-data" id="form"
                                 action="<?php echo base_url(); ?>task/update_tasks_timer/<?php
                                    if (!empty($tasks_timer_info)) {
                                        echo $tasks_timer_info->tasks_timer_id;
                                    }
                                    ?>" method="post" class="form-horizontal">
                                 <?php
                                    if (!empty($tasks_timer_info)) {
                                        $start_date = date('Y-m-d', $tasks_timer_info->start_time);
                                        $start_time = date('H:i:s:a', $tasks_timer_info->start_time);
                                        $end_date = date('Y-m-d', $tasks_timer_info->end_time);
                                        $end_time = date('H:i:s:a', $tasks_timer_info->end_time);
                                    } 
                                    else 
                                    {
                                        $start_date = '';
                                        $start_time = '';
                                        $end_date = '';
                                        $end_time = '';
                                    }
                                    ?>
                                 <?php 
                                 if (empty($tasks_timer_info->tasks_timer_id)) 
                                 { 
                                    ?>
                                    <div class="form-group margin">
                                       <div class="col-sm-12 center-block">
                                          <label class="control-label"><?= lang('select') . ' ' . lang('tasks') ?>
                                          <span
                                             class="required">*</span></label>
                                          <select class="form-control select_box" name="task_id"
                                             required="" style="width: 100%">
                                             <?php
                                                $all_tasks_info = $this->db->get('tbl_task')->result();
                                                if (!empty($all_tasks_info)):foreach ($all_tasks_info as $v_task_info):
                                                    ?>
                                             <option
                                                value="<?= $v_task_info->task_id ?>" <?= $v_task_info->task_id == $task_details->task_id ? 'selected' : null ?>><?= $v_task_info->task_name ?></option>
                                             <?php endforeach; ?>
                                             <?php endif; ?>
                                          </select>
                                       </div>
                                    </div>
                                 <?php 
                                 }
                                 else 
                                 { 
                                    ?>
                                    <input type="hidden" name="task_id"
                                    value="<?= $tasks_timer_info->task_id ?>">
                                    <?php 
                                 } 
                                 ?>
                                 <div class="form-group margin">
                                    <div class="col-sm-12">
                                       <label class="control-label"><?= lang('start_date') ?> </label>
                                       <div class="input-group">
                                          <input type="text" name="start_date"
                                             class="form-control datepicker"
                                             value="<?= $start_date ?>" >
                                          <div class="input-group-addon">
                                             <a href="#"><i class="fa fa-calendar"></i></a>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-12">
                                       <label class="control-label"><?= lang('start_time') ?></label>
                                       <div class="input-group">            
                                          <input type="text" required="" name="start_time" class="form-control timepicker2" value="<?php if($start_time == ''){ echo date('H:i'); }else{ echo $start_time; }  ?>" style="position: initial;" >
                                          <div class="input-group-addon">
                                             <a href="#"><i class="fa fa-clock-o"></i></a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group margin">
                                    <div class="col-sm-12">
                                       <label class="control-label"><?= lang('end_date') ?></label>
                                       <div class="input-group">
                                          <input type="text" name="end_date"
                                             class="form-control datepicker" value="<?= $end_date ?>">
                                          <div class="input-group-addon">
                                             <a href="#"><i class="fa fa-calendar"></i></a>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-12">
                                       <label class="control-label"><?= lang('end_time') ?></label>
                                       <div class="input-group">
                                          <input type="text" name="end_time"
                                             class="form-control timepicker2"
                                             value="<?php if($end_time == ''){ echo date('H:i'); }else{ echo $end_time; }  ?>">
                                          <div class="input-group-addon">
                                             <a href="#"><i class="fa fa-clock-o"></i></a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group margin">
                                    <div class="col-sm-12 center-block">
                                       <label class="control-label"><?= lang('edit_reason') ?><span
                                          class="required">*</span></label>
                                       <div>
                                          <textarea class="form-control" name="reason" required="" rows="6"><?php if (!empty($tasks_timer_info)){ echo $tasks_timer_info->reason; }?></textarea>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group" style="margin-top: 20px;">
                                    <div class="col-lg-6">
                                       <button type="submit"
                                          class="btn btn-sm btn-primary"><?= lang('updates') ?></button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Task Timesheet panel end -->                  
                  <div class="tab-pane <?= $active == 8 ? 'active' : '' ?>" id="activities" style="position: relative;">
                     <div class="panel panel-custom">
                        <div class="panel-heading">
                           <h3 class="panel-title"><?= lang('activities') ?>
                              <?php
                                 $role = $this->session->userdata('user_type');
                                 if ($role == 1) {
                                     ?>
                              <span class="btn-xs pull-right">
                              <a href="<?= base_url() ?>admin/tasks/claer_activities/opportunity/<?= $opportunity_details->opportunities_id ?>"><?= lang('clear') . ' ' . lang('activities') ?></a>
                              </span>
                              <?php } ?>
                           </h3>
                        </div>
                        <div class="panel-body " id="chat-box">
                           <div id="activity">
                              <ul class="list-group no-radius   m-t-n-xxs list-group-lg no-border">
                                 <?php
                                    if (!empty($activities_info)) 
                                    {
                                        foreach ($activities_info as $v_activities) 
                                        { 
                                             $user_info = $this->db->where(array('user_id' => $v_activities->user))->get('tbl_user')->row();
                                            ?>
                                 <li class="list-group-item">
                                    <a class="recect_task pull-left mr-sm">
                                    <?php if (!empty($user_info)) {
                                       ?>
                                    <img style="width: 30px;margin-left: 18px;
                                       height: 29px;
                                       border: 1px solid #aaa;"
                                       src="<?= base_url() . $user_info->user_profile_img; ?>"
                                       class="img-circle">
                                    <?php } ?>
                                    </a>
                                    <a class="clear">
                                    <small
                                       class="pull-right"><?= strftime(config_item('date_format') . " %H:%M:%S", strtotime($v_activities->activity_date)) ?></small>
                                    <strong class="block"><?= $user_info->user_full_name ?></strong>
                                    <small>
                                    <?php
                                       echo sprintf(lang($v_activities->activity) . ' <strong style="color:#000"><em>' . $v_activities->value1 . '</em>' . '<em>' . $v_activities->value2 . '</em></strong>');
                                       ?>
                                    </small>
                                    </a>
                                 </li>
                                 <?php
                                    }
                                    }
                                    ?>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Activity Tabs end -->
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
   <!-- /panel content -->
   </div>
   <!-- /Stacked Left -->
</section>
<!-- SELECT2-->
<script type="text/javascript">
   $(document).ready(function () {
       var maxAppend = 0;
       $("#add_more").click(function () 
       {
           if (maxAppend >= 4) 
           {
               alert("Maximum 5 File is allowed");
           } 
           else 
           {
               var add_new = $('<div class="form-group" style="margin-top: 10px"><label for="field-1" class="col-sm-3 control-label"><?= lang('upload_file') ?></label><div class="col-sm-6"><input type="file" name="task_files[]"></div></div>');
               maxAppend++;
               $("#add_new").append(add_new);
           }
       });
   
       $("#add_new").on('click', '.remCF', function () {
           $(this).parent().parent().parent().remove();
       });
   });
</script>
<script type="text/javascript">
   $(document).ready(function () {
       //$('#permission_user').hide();
       $("div.action").hide();
       $("input[name$='permission']").click(function () {
           $("#permission_user").removeClass('show');
           if ($(this).attr("value") == "0") {
               $("#permission_user").show();
           } else {
               $("#permission_user").hide();
           }
       });
   
       $("input[name$='assigned_to[]']").click(function () {
           var user_id = $(this).val();           
           $("#action_" + user_id).removeClass('show');
           if (this.checked) {
               $("#action_" + user_id).show();
           } else {
               $("#action_" + user_id).hide();
           }
   
       });
   });
</script>
 