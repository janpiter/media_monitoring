<!-- BEGIN SIDEBAR LEFT -->
<div class="sidebar-left sidebar-nicescroller">
    <ul class="sidebar-menu">
        <?php if ($this->tank_auth->is_admin() or $this->tank_auth->is_super_admin()) { ?>
            <li>
                <a href="<?php echo base_url('backend/dashboard') ?>">
                    <i class="fa fa-dashboard icon-sidebar"></i>
                    Dashboard
                    <!-- <span class="label label-success span-sidebar">UPDATED</span> -->
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('backend/user') ?>">
                    <i class="fa fa-users icon-sidebar"></i>
                    User Management                         
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('backend/log') ?>">
                    <i class="fa fa-history icon-sidebar"></i>
                    Activity Log						
                </a>
            </li>
        <?php } ?>
        <li class="static">OPERATOR MENU</li>
        <li>
            <a href="#fakelink">
                <i class="fa fa-database icon-sidebar"></i>
                <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                Data Management							
            </a>
            <ul class="submenu">
                <li><a href="<?php echo base_url('backend/news') ?>">News</a></li>
                <li><a href="<?php echo base_url('backend/publisher') ?>">Publishers</a></li>
                <li><a href="<?php echo base_url('backend/program') ?>">Programs</a></li>
                <li><a href="<?php echo base_url('backend/topic') ?>">Topics</a></li>
                <li><a href="<?php echo base_url('backend/sub_topic') ?>">Sub Topics</a></li>
                <li><a href="<?php echo base_url('backend/person') ?>">Persons</a></li>
                <li><a href="<?php echo base_url('backend/person_title') ?>">Person Titles</a></li>
                <li><a href="<?php echo base_url('backend/organization') ?>">Organizations</a></li>                
            </ul>
        </li>
        <li>
            <a href="front-end.html">
                <i class="fa fa-newspaper-o icon-sidebar"></i>
                News Scoring							
            </a>
        </li>				
        <li class="static">REPORTING</li>
        <!-- <li class="text-content">
            <div class="switch">
                <div class="onoffswitch blank">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="alertme" checked>
                    <label class="onoffswitch-label" for="alertme">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            Alert me when system down
        </li>
        <li class="text-content">
            <div class="switch">
                <div class="onoffswitch blank">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="autoupdate">
                    <label class="onoffswitch-label" for="autoupdate">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            Automatic update
        </li>
        <li class="text-content">
            <div class="switch">
                <div class="onoffswitch blank">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="dailyreport">
                    <label class="onoffswitch-label" for="dailyreport">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            Daily task report
        </li>
        <li class="text-content">
            <div class="switch">
                <div class="onoffswitch blank">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="remembercomputer" checked>
                    <label class="onoffswitch-label" for="remembercomputer">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            Remember this computer
        </li> -->
    </ul>
</div><!-- /.sidebar-left -->
<!-- END SIDEBAR LEFT -->			