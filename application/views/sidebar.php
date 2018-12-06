<aside id="aside">

  <nav id="sideNav">
     <!-- MAIN MENU -->
     <ul class="nav nav-list">

    <?php                
    foreach ($getAllTabAsPerRole as $value) 
    {
      if($value->userView == '1')
      {

          if($value->child_status == '0' && $value->child_id == '0')
          {
          ?>
              <li class="<?php echo ($this->uri->segment(2)== $value->controller_name)?'active':''?>">
              <a href="<?php echo base_url(); ?><?php echo $value->controller_name; ?>">
              <i class="<?php echo $value->tab_icone_class; ?>"></i>
              <span><?php echo $value->tabname; ?></span>
              </a>
              </li>
              <?php
          }
          else
          {

            if($value->child_status == '1' && $value->child_id == '0')
            {
          ?>
              <li class="<?php echo ($this->uri->segment(1)== $value->controller_name)?'active':''?>">
              <a href="#">
              <i class="fa fa-menu-arrow pull-right"></i>
              <i class="<?php echo $value->tab_icone_class; ?>"></i> <span><?php echo $value->tabname; ?></span>
              </a> 
                <ul> 
                <?php $sub_memu_res = $this->home_model->getSubmenuById($value->tab_id);
                foreach ($sub_memu_res as $sub_val) 
                {
                ?>                           
                  <li class="<?php echo ($this->uri->segment(1).'/'.$this->uri->segment(2)== $sub_val->controller_name)?'active':''?>"><a href="<?php echo base_url().$sub_val->controller_name; ?>"><?php echo $sub_val->tabname; ?></a></li>
                <?php
                }
                ?>     
                </ul>                            
              </li>
          <?php
            }
          }
      }
    }   
    ?>
    </ul>   
  </nav>
  <span id="asidebg">          
  </span>
</aside>       
 <header id="header"> 
    <button id="mobileMenuBtn"></button>   
    <span class="logo pull-left">  
    <h2 style="color: #fff; font-size: 24px;" >CRM Sense</h2>
    </span>
  
    <nav>
       <!-- OPTIONS LIST -->
       <ul class="nav pull-right">
          <!-- USER OPTIONS -->
         
          <ul class="nav pull-right">
            <!-- USER OPTIONS -->
            <li class="dropdown pull-left">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
              <?php
                $web_admin = $this->session->userdata('web_admin'); 
                $session = $this->session->all_userdata();
                if($web_admin->user_profile_img == '')
                {
                   if(isset($session['login_profile_img']) && $session['login_profile_img'] != '')
                  {
                    ?>
                     <img class="user-avatar" alt="" src="<?php echo base_url().$session['login_profile_img'];?>" height="34" /> 
                    
                    <?php
                  }
                  else
                  {
                  ?>
                      <img class="user-avatar" alt="" src="<?php echo base_url();?>webroot/images/noavatar.jpg" height="34" /> 
                  <?php
                  }

                }
                else
                {
                  if(isset($session['login_profile_img']) && $session['login_profile_img'] != '')
                  {
                    ?>
                     <img class="user-avatar" alt="" src="<?php echo base_url().$session['login_profile_img'];?>" height="34" /> 
                    
                    <?php
                  }
                  else
                  {
                  ?>
                     <img class="user-avatar" alt="" src="<?php echo base_url().$session[0]->user_profile_img;?>" height="34" /> 
                  <?php
                  }
                }
              ?>

                <span class="user-name">
                  <span class="hidden-xs"><?php if(isset($session['login_user_name']) && $session['login_user_name'] != ''){ echo $session['login_user_name']; }else{ echo $web_admin->user_full_name; } ?><i class="fa fa-angle-down"></i>
                  </span>
                </span>
              </a>
              <ul class="dropdown-menu hold-on-click">                
                <!-- <li>
                <a href="#"><i class="fa fa-envelope"></i> Inbox
                    <span class="pull-right label label-default">0</span>
                  </a>
                </li> -->
                <li><!-- settings -->
                   <a href="<?php echo base_url();?>login/profile"><i class="fa fa-cogs"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><!-- logout -->
                    <a href="<?php echo base_url();?>login/logout"><i class="fa fa-power-off"></i> Log Out</a>
                </li>
              </ul>
            </li>
       </ul>
       <!-- /OPTIONS LIST -->
    </nav>
 </header>
 <!-- /HEADER -->