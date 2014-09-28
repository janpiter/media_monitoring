<body style="padding-top:5px;">

    <div class="container">
        <div class="col-sm-12">
            <h1>
                <i class="fa fa-line-chart"></i>&nbsp;&nbsp;IRC&nbsp;&nbsp;<span class="text-muted">Media Information System</span>
            </h1>
            <hr/>
        </div>
        <div class="col-sm-4">
            <div class="box">
                <div class="section-title">
                    <span class="small-title">PICTURES</span>
                    <a class="pull-right" href="#fakelink"><small>More</small></a>
                </div>
                <div id="bs-carousel-2" class="carousel slide no-margin" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $no = 0;
                        foreach ($data_news as $news) {
                            if ($no == 0) {
                                $active = 'class="item active"';
                            } else {
                                $active = 'class="item"';
                            }
                        ?>
                            <div <?php echo $active; ?>>
                                <img src="<?php echo $news->url; ?>" alt="Image slide" onerror="this.onerror=null;this.src='<?php echo ""; ?>';" style="max-height: 395px;min-height: 395px">
                                <div class="carousel-caption dark-bg" style="max-height: 395px;min-height: 395px;width:100%">
                                    <h4 class="text-left" style="padding: 0 10px;"><a href="#fakelink"><?php echo $news->title; ?></a></h4>
                                    <p class="text-muted text-left" style="padding:0 10px;"><small><small>Posted on <?php echo str_replace("+", " ", ucfirst($news->media)); ?>, <?php echo $this->mith_func->time_elapsed_string($news->pubDate, TRUE); ?></small></small></p>
                                    <p class="text-left" style="padding:0 10px;position:absolute;bottom:5px;"><small><?php echo $news->desc; ?></small></p>
                                </div>
                            </div>
                        <?php ++$no; } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="box">
                <div class="section-title">
                    <span class="small-title">LATEST NEWS</span>
                    <a class="pull-right" href="#fakelink"><small>More</small></a>
                </div>
                <ul class="list-group currency-rates widget-currency-ticker" style="height:180px !important">
                    <?php foreach ($data_news as $news) { ?>
                        <li class="list-group-item" style="height:auto;border:0;padding:0 0 5px 0;">
                            <h5 class="media-heading"><a href="#fakelink"><?php echo $news->title; ?></a></h5>
                            <p class="text-muted"><small><small>Posted on <?php echo str_replace("+", " ", ucfirst($news->media)); ?>,
                            <?php echo $this->mith_func->time_elapsed_string($news->pubDate, TRUE); ?></small></small></p>
                        </li>
                    <?php } ?>
                </ul>
                <br/>
                <div class="section-title">
                    <span class="small-title">TOP PERSONS</span>
                    <a class="pull-right" href="#fakelink"><small>More</small></a>
                </div>
                <button class="btn btn-primary btn-sm btn-perspective">Joko Widodo</button>
                <button class="btn btn-primary btn-sm btn-perspective">Susilo Bambang Yudhoyono</button>
                <button class="btn btn-primary btn-sm btn-perspective">Barack Obama</button>
                <button class="btn btn-primary btn-sm btn-perspective">Priyo Budi Santoso</button>
                <button class="btn btn-primary btn-sm btn-perspective">Annas Maamun</button>
                <button class="btn btn-primary btn-sm btn-perspective">Jusuf Kalla</button>
                <button class="btn btn-primary btn-sm btn-perspective">Tony Abbott</button>
                <button class="btn btn-primary btn-sm btn-perspective">Basuki Tjahaja Purnama</button>
                <button class="btn btn-primary btn-sm btn-perspective">Johan Budi Sapto Prabowo</button>
                <button class="btn btn-primary btn-sm btn-perspective">Benny K Harman</button>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="box">
                <div class="section-title">
                    <span class="small-title">MORRIS AREA</span>
                    <a class="pull-right" href="#fakelink"><small>More</small></a>
                </div>
                <div id="morris-area-example" style="height: 200px;"></div>
                <br/>
                <div class="section-title">
                    <span class="small-title">TRENDING TOPICS</span>
                    <a class="pull-right" href="#fakelink"><small>More</small></a>
                </div>
                <ul class="list-unstyled">
                    <li><h4 class="text-primary">Converter Kit</h4></li>
                    <li><h5 class="text-primary">Harga Mobil</h5></li>
                    <li><h6 class="text-primary">iPhone 6 Smartphones</h6></li>
                    <li><h6 class="text-primary">Meluncurkan Smartphone Murah</h6></li>
                    <li><h6 class="text-primary">New York</h6></li>
                    <li><h6 class="text-primary">Paripurna DPR</h6></li>
                </ul>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/plugins/morris-chart/raphael.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/plugins/morris-chart/morris.min.js') ?>"></script>
    <script language="javascript">
        /********************************* BEGIN EXAMPLE MORRIS AREA *********************************/
        Morris.Area({
            element: 'morris-area-example',
            data: [
                {y: '2006', a: 100, b: 90},
                {y: '2007', a: 75, b: 65},
                {y: '2008', a: 50, b: 40},
                {y: '2009', a: 75, b: 65},
                {y: '2010', a: 50, b: 40},
                {y: '2011', a: 75, b: 65},
                {y: '2012', a: 100, b: 90}
            ],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Series A', 'Series B'],
            resize: true,
            lineColors: ['#29AF8E', '#D770AD']
        });
        /********************************* END EXAMPLE MORRIS AREA *********************************/
    </script>
    <style type="text/css">
        .box {
            padding: 10px;
        }
        .box button {
            margin-bottom: 5px;
        }
        li.media {
            padding-top: 0 !important;
            margin-top: 0 !important;
        }
        .section-title {
            padding-bottom: 5px;
            margin-bottom: 10px;
            border-bottom: 1px dotted #EEEEEE;
        }
    </style>
