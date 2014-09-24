			

<!--
===========================================================
BEGIN PAGE
===========================================================
-->
<div class="wrapper">

    <?php $this->load->view('backend/top-nav'); ?>
    <?php $this->load->view('backend/nav'); ?>

    <!-- BEGIN PAGE CONTENT -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- Begin page heading -->
            <h1 class="page-heading">DASHBOARD [UPDATED] <small>Sub heading here</small></h1>
            <!-- End page heading -->

            <!-- BEGIN EXAMPLE ALERT -->
            <div class="alert alert-success alert-block square fade in alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><strong>Welcome!</strong></p>
                <p>You probably here cause wanna know how is <a class="alert-link" href="#fakelink">Sentir UI kits template</a>, or you have purchased it. But whatever! I just wanna 
                    say thank you for viewing or purchasing my work.
                    This is the new dashboard page, hope it more usable for your awesome projects. 
                    And let me know your feedback! <i class="fa fa-smile-o"></i></p>
            </div>
            <!-- END EXAMPLE ALERT -->


            <div class="row">
                <div class="col-lg-3">

                    <!-- BEGIN TODAY VISITOR TILES -->
                    <div class="panel panel-danger panel-square panel-no-border text-center">
                        <div class="panel-heading">
                            <h3 class="panel-title">TODAY MEDIA</h3>
                        </div>
                        <div class="panel-body">
                            <h1 class="bolded tiles-number text-danger"><?php echo $total_media; ?></h1>
                            <p class="text-muted"><small>TOP MEDIA <strong><?php echo $top_media; ?></strong></small></p>
                            <p class="text-muted"><small>TOTAL REACH <strong><?php echo $top_percent."%"; ?></strong></small></p>
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel panel-success panel-block-color -->
                    <!-- END TODAY VISITOR TILES -->

                </div><!-- /.col-sm-6 -->
                <div class="col-lg-3">

                    <!-- BEGIN TODAY VISITOR TILES -->
                    <div class="panel panel-warning panel-square panel-no-border text-center">
                        <div class="panel-heading">
                            <h3 class="panel-title">TODAY NEWS</h3>
                        </div>
                        <div class="panel-body">
                            <h1 class="bolded tiles-number text-warning"><?php echo $total_news; ?></h1>
                            <p class="text-muted"><small>LAST NEWS <strong><?php echo $last_news; ?></strong></small></p>
                            <p class="text-muted"><small>LAST MEDIA <strong><?php echo $last_media; ?></strong></small></p>
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel panel-success panel-block-color -->
                    <!-- END TODAY VISITOR TILES -->

                </div><!-- /.col-sm-6 -->
                <div class="col-lg-6">

                    <!-- BEGIN WEATHER WIDGET 2 -->
                    <div class="panel panel-info panel-square panel-no-border">
                        <div class="panel-heading">
                            <h3 class="panel-title white-text">YOGYAKARTA CITY, ID</h3>
                        </div>
                        <div class="panel-body bg-info">
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="weather-widget horizontal">
                                        <div class="row">
                                            <div class="col-xs-6 text-center">
                                                <canvas id="partly-cloudy-day" width="115" height="115"></canvas>
                                            </div><!-- /.col-xs-6 -->
                                            <div class="col-xs-6">
                                                <h2 class="bolded degrees white-text">32<i class="wi-degrees"></i></h2>
                                                <p class="white-text">Partly cloudy</p>
                                                <p class="white-text">15km/h - 37%</p>
                                            </div><!-- /.col-xs-6 -->
                                        </div><!-- /.row -->
                                    </div><!-- /.weather-widget -->
                                </div>
                                <div class="col-sm-5">
                                    <div class="row">
                                        <div class="col-xs-4 text-center">
                                            <h4 class="white-text">SAT</h4>
                                            <canvas id="cloudy" width="35" height="35"></canvas>
                                            <h4 class="bolded white-text">30<i class="wi-degrees"></i></h4>
                                        </div><!-- /.col-xs-4 -->
                                        <div class="col-xs-4 text-center">
                                            <h4 class="white-text">SUN</h4>
                                            <canvas id="wind" width="35" height="35"></canvas>
                                            <h4 class="bolded white-text">28<i class="wi-degrees"></i></h4>
                                        </div><!-- /.col-xs-4 -->
                                        <div class="col-xs-4 text-center">
                                            <h4 class="white-text">MON</h4>
                                            <canvas id="clear-day" width="35" height="35"></canvas>
                                            <h4 class="bolded white-text">33<i class="wi-degrees"></i></h4>
                                        </div><!-- /.col-xs-4 -->
                                    </div><!-- /.row -->
                                </div>
                            </div><!-- /.row -->
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel panel-success panel-block-color -->
                    <!-- END WEATHER WIDGET 2 -->

                </div><!-- /.col-sm-6 -->
            </div><!-- /.row -->


            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">

                    <!-- BEGIN PERCENTAGE MONITOR -->
                    <div class="panel panel-default panel-square panel-no-border text-center">
                        <div class="panel-heading">
                            <h3 class="panel-title">PERCENTAGE MONITOR</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-4 text-center">
                                    <h4 class="small-heading">Sales</h4>
                                    <span class="chart chart-widget-pie widget-easy-pie-1" data-percent="45">
                                        <span class="percent"></span>
                                    </span>
                                </div><!-- /.col-sm-4 -->
                                <div class="col-sm-4 text-center">
                                    <h4 class="small-heading">Visitor</h4>
                                    <span class="chart chart-widget-pie widget-easy-pie-2" data-percent="85">
                                        <span class="percent"></span>
                                    </span>
                                </div><!-- /.col-sm-4 -->
                                <div class="col-sm-4 text-center">
                                    <h4 class="small-heading">Reach</h4>
                                    <span class="chart chart-widget-pie widget-easy-pie-3" data-percent="25">
                                        <span class="percent"></span>
                                    </span>
                                </div><!-- /.col-sm-4 -->
                            </div><!-- /.row -->
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel panel-success panel-block-color -->
                    <!-- END PERCENTAGE MONITOR -->

                    <!-- BEGIN HEADLINE NEWS TILES -->
                    <div class="the-box no-border bg-warning full">
                        <div id="tiles-slide-4" class="owl-carousel tiles-carousel-color-2">
                            <div class="item full">
                                <div class="des">
                                    <h4 class="bolded"><a href="#fakelink">Awesome life story title</a></h4>
                                    <p class="small">02 MAY, 2014</p>
                                    <p class="small">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
                                    <button class="btn btn-warning btn-sm">Read more</button>
                                </div>
                            </div><!-- /.item full -->
                            <div class="item full">
                                <div class="des">
                                    <h4 class="bolded"><a href="#fakelink">Awesome life story title</a></h4>
                                    <p class="small">01 MAY, 2014</p>
                                    <p class="small">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
                                    <button class="btn btn-warning btn-sm">Read more</button>
                                </div>
                            </div><!-- /.item full -->
                            <div class="item full">
                                <div class="des">
                                    <h4 class="bolded"><a href="#fakelink">Awesome life story title</a></h4>
                                    <p class="small">29 APRIL, 2014</p>
                                    <p class="small">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
                                    <button class="btn btn-warning btn-sm">Read more</button>
                                </div>
                            </div><!-- /.item full -->
                        </div><!-- /#tiles-slide-2 -->
                    </div><!-- /.the-box no-border full -->
                    <!-- END HEADLINE NEWS TILES -->

                </div><!-- /.col-lg-6 col-md-12 col-sm-12 -->
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="the-box no-border full">
                        <button class="btn btn-block btn-primary btn-square" id="w-newsticker-next"><i class="fa fa-chevron-up"></i></button>
                        <ul class="widget-newsticker media-list">
                            <li class="media">
                                <a class="pull-left" href="#fakelink">
                                    <img class="media-object" src="<?php echo base_url('assets/img/photo/small/img-1.jpg') ?>" alt="Image">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#fakelink">Duis autem vel eum iriure dolor in hendrerit in vulputate</a></h4>
                                    <p class="text-muted"><small>Posted on August 17, 2014</small></p>
                                    <p>
                                        Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut...
                                    </p>
                                </div>
                            </li>
                            <li class="media">
                                <a class="pull-left" href="#fakelink">
                                    <img class="media-object" src="assets/img/photo/small/img-2.jpg" alt="Image">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#fakelink">Lorem ipsum dolor sit amet, consectetuer</a></h4>
                                    <p class="text-muted"><small>Posted on August 17, 2014</small></p>
                                    <p>
                                        Ut wisi enim ad minim veniam, quis nostrud exerci tation...
                                    </p>
                                </div>
                            </li>
                            <li class="media">
                                <a class="pull-left" href="#fakelink">
                                    <img class="media-object" src="assets/img/photo/small/img-3.jpg" alt="Image">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#fakelink">Ut wisi enim ad minim veniam</a></h4>
                                    <p class="text-muted"><small>Posted on August 17, 2014</small></p>
                                    <p>
                                        Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper...
                                    </p>
                                </div>
                            </li>
                            <li class="media">
                                <a class="pull-left" href="#fakelink">
                                    <img class="media-object" src="assets/img/photo/small/img-4.jpg" alt="Image">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#fakelink">Typi non habent</a></h4>
                                    <p class="text-muted"><small>Posted on August 17, 2014</small></p>
                                    <p>
                                        Ut wisi enim ad minim veniam, quis nostrud exerci...
                                    </p>
                                </div>
                            </li>
                            <li class="media">
                                <a class="pull-left" href="#fakelink">
                                    <img class="media-object" src="assets/img/photo/small/img-5.jpg" alt="Image">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#fakelink">Claritas est etiam processus</a></h4>
                                    <p class="text-muted"><small>Posted on August 17, 2014</small></p>
                                    <p>
                                        Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit...
                                    </p>
                                </div>
                            </li>
                            <li class="media">
                                <a class="pull-left" href="#fakelink">
                                    <img class="media-object" src="assets/img/photo/small/img-6.jpg" alt="Image">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#fakelink">Eodem modo typi, qui nunc nobis</a></h4>
                                    <p class="text-muted"><small>Posted on August 17, 2014</small></p>
                                    <p>
                                        Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper...
                                    </p>
                                </div>
                            </li>
                        </ul>
                        <button class="btn btn-block btn-primary btn-square" id="w-newsticker-prev"><i class="fa fa-chevron-down"></i></button>
                    </div><!-- /.the-box no-border -->

                </div><!-- /.col-lg-5 col-md-12 col-sm-12 -->
            </div><!-- /.row -->




            <div class="row">
                <div class="col-sm-12 col-md-8">

                    <!-- BEGIN SERVER STATUS WIDGET -->
                    <div class="panel panel-success panel-square panel-no-border">
                        <div class="panel-heading lg">
                            <div class="right-content">
                                <button class="btn btn-success to-collapse" data-toggle="collapse" data-target="#panel-chart-widget-1"><i class="fa fa-chevron-up"></i></button>
                            </div>
                            <h3 class="panel-title"><strong>YOUR SERVER STATUS</strong></h3>
                        </div>
                        <div id="panel-chart-widget-1" class="collapse in">
                            <div class="the-box no-border full bg-success no-margin">
                                <div id="realtime-chart-widget">
                                    <div id="realtime-chart-container-widget"></div>
                                </div><!-- /.realtime-chart -->
                            </div><!-- /.the-box .no-border -->
                            <div class="the-box no-border">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-xs-6 text-center">
                                                <h4 class="small-heading">Kernel memory</h4>
                                                <span class="chart chart-widget-pie widget-easy-pie-1" data-percent="45">
                                                    <span class="percent"></span>
                                                </span>
                                            </div><!-- /.col-xs-6 -->
                                            <div class="col-xs-6 text-center">
                                                <h4 class="small-heading">Physical memory</h4>
                                                <span class="chart chart-widget-pie widget-easy-pie-2" data-percent="85">
                                                    <span class="percent"></span>
                                                </span>
                                            </div><!-- /.col-xs-6 -->
                                        </div><!-- /.row -->
                                        <hr />
                                        <button class="btn btn-block btn-danger"><i class="fa fa-cogs"></i> Resource monitor</button>
                                    </div><!-- /.col-sm-6 -->
                                    <div class="col-sm-6">
                                        <h4 class="small-heading">System status</h4>
                                        <p class="small">Handles - <span class="text-danger">80%</span></p>
                                        <div class="progress no-rounded progress-xs">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            </div><!-- /.progress-bar .progress-bar-danger -->
                                        </div><!-- /.progress .no-rounded -->
                                        <p class="small">Threads - <span class="text-warning">65%</span></p>
                                        <div class="progress no-rounded progress-xs">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                            </div><!-- /.progress-bar .progress-bar-warning -->
                                        </div><!-- /.progress .no-rounded -->
                                        <p class="small">Proccess - <span class="text-success">40%</span></p>
                                        <div class="progress no-rounded progress-xs">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            </div><!-- /.progress-bar .progress-bar-success -->
                                        </div><!-- /.progress .no-rounded -->
                                        <p class="small">Cached - <span class="text-info">70%</span></p>
                                        <div class="progress no-rounded progress-xs">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                            </div><!-- /.progress-bar .progress-bar-info -->
                                        </div><!-- /.progress .no-rounded -->
                                    </div><!-- /.col-sm-6 -->
                                </div><!-- /.row -->
                            </div><!-- /.the-box .no-border -->
                        </div><!-- /#panel-chart-widget-1 -->
                    </div><!-- /.the-box .no-border -->
                    <!-- END SERVER STATUS WIDGET -->

                </div><!-- /.col-sm-12 col-md-8 -->

                <div class="col-sm-12 col-md-4">

                    <!-- BEGIN PROFILE CARD  -->
                    <div class="the-box no-border full card-info">
                        <div class="the-box no-border text-center no-margin">
                            <h4 class="bolded">Brenda Fuller</h4>
                            <img src="assets/img/avatar/avatar-15.jpg" class="social-avatar has-margin has-light-shadow img-circle" alt="Avatar">
                            <p class="text-info">@brendafuller</p>
                            <p class="text-muted">Project manager</p>
                            <p class="bordered"><i class="fa fa-map-marker"></i> <strong>San Francisco, CA</strong></p>
                            <p class="text-muted">
                                Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                            </p>											
                            <p class="social-icon">
                                <a href="#fakelink"><i class="fa fa-facebook icon-xs icon-circle icon-facebook"></i></a>
                                <a href="#fakelink"><i class="fa fa-twitter icon-xs icon-circle icon-twitter"></i></a>
                                <a href="#fakelink"><i class="fa fa-dribbble icon-xs icon-circle icon-dribbble"></i></a>
                                <a href="#fakelink"><i class="fa fa-google-plus icon-xs icon-circle icon-google-plus"></i></a>
                            </p>
                        </div><!-- /.the-box .no-border .bg-info .no-margin -->
                        <button class="btn btn-primary btn-block btn-lg btn-square"><i class="fa fa-user"></i> Follow</button>
                    </div><!-- /.the-box -->
                    <!-- END PROFILE CARD  -->
                </div>
            </div>




        </div><!-- /.container-fluid -->



        <!-- BEGIN FOOTER -->
        <footer>
            &copy; 2014 <a href="#fakelink">MIS IRC</a><br />					
        </footer>
        <!-- END FOOTER -->


    </div><!-- /.page-content -->
</div><!-- /.wrapper -->
<!-- END PAGE CONTENT -->



<!-- BEGIN BACK TO TOP BUTTON -->
<div id="back-top">
    <a href="#top"><i class="fa fa-chevron-up"></i></a>
</div>
<!-- END BACK TO TOP -->


<!--
===========================================================
END PAGE
===========================================================
-->