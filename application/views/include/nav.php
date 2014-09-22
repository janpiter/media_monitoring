<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">NLP Research Monitoring</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-right">					
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Simulation"><i class="fa fa-desktop"></i>&nbsp;&nbsp;Simulation <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url("/simulation_news"); ?>">News</a></li>						
						<li class="dropdown-submenu">
							<a tabindex="-1" href="#">Sentiment</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo base_url("/sentiment_news"); ?>">News</a></li>
								<li><a href="<?php echo base_url("/sentiment_twitter"); ?>">Twitter</a></li>
								<li><a href="<?php echo base_url("/sentiment_facebook"); ?>">Facebook</a></li>	
							</ul>
						</li>									
						<li class="divider"></li>
						<li><a href="<?php echo base_url("/simulation_pickle"); ?>">News (Pikcle)</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Simulation"><i class="fa fa-database"></i>&nbsp;&nbsp;Management <b class="caret"></b></a>
					<ul class="dropdown-menu">						
						<li><a tabindex="-1" href="<?php echo base_url("/research"); ?>">Research</a></li>	
						<li><a href="<?php echo base_url("/bugs_tracker"); ?>">Bugs Tracker</a></li>
						<li><a href="<?php echo base_url("/tasks"); ?>">Tasks</a></li>
						<li><a href="#task">Changelog Research</a></li>	
						<li><a href="#task">Weekly Report</a></li>	
					</ul>
				</li>					
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Simulation"><i class="fa fa-wrench"></i>&nbsp;&nbsp;Tools <b class="caret"></b></a>
					<ul class="dropdown-menu">						
						<li><a href="<?php echo base_url("/news_tracker/cloud"); ?>">Tracker (Cloud)</a></li>
						<li><a href="<?php echo base_url("/news_tracker/production"); ?>">Tracker (Production)</a></li>
						<li class="divider"></li>
						<li><a href="">Clean Dictionary</a></li>
						<li><a href="#">OT Generator</a></li>							
					</ul>
				</li>
                <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Simulation"><i class="fa fa-gears"></i></a>
					<ul class="dropdown-menu">						
						<li><a href="#">Settings</a></li>
						<li><a href="<?php echo base_url("/auth/logout/"); ?>">Logout</a></li>							
					</ul>
				</li>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
