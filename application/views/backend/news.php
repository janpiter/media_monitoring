<div class="wrapper">
    <?php $this->load->view('backend/top-nav'); ?>
    <?php $this->load->view('backend/nav'); ?>

    <!-- BEGIN PAGE CONTENT -->
    <div class="page-content">
        <div class="container-fluid">
            <!-- Begin page heading -->
            <h1 class="page-heading"><?php echo $page_title; ?>&nbsp;&nbsp;<small><?php echo $page_desc; ?></small></h1>
            <!-- End page heading -->
            <!-- Begin breadcrumb -->
            <ol class="breadcrumb default square rsaquo sm">
                <li><a href="/backend/dashboard"><i class="fa fa-home"></i></a></li>
                <li>Data Management</li>
                <li class="active"><?php echo $page_title; ?></li>
            </ol>
            <!-- End breadcrumb -->
            <!-- BEGIN DATA TABLE -->
            <div class="the-box">
                <button type="button" data-toggle="modal" data-target="#add" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;Add Data</button>
                <br/><br/>
                <!-- MESSAGE -->
                <?php if (isset($message_sys)) { ?>
                    <div class="alert alert-<?php echo $class; ?> alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $message_sys; ?>
                    </div>
                <?php } ?>
                <?php foreach ($error as $v) { ?>
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $v; ?>
                    </div>
                <?php } ?>
                <!-- END MESSAGE -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="datatable-newss">
                        <thead class="the-box dark full">
                            <tr>
                                <th>#</th>
                                <th>News Title</th>
                                <th>Publish Date</th>
                                <th>Program</th>
                                <th>Publisher</th>                                
                                <th class="text-center">Action</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($objList as $obj) {
                                ?>
                                <tr class="gradeA">
                                    <td><?php echo ++$no; ?></td>
                                    <td><?php echo ucwords($obj->news_title); ?></td>
                                    <td><?php echo ucwords($obj->news_date); ?></td>
                                    <td><?php echo ucwords($obj->program_name); ?></td>
                                    <td><?php echo ucwords($obj->publisher_name); ?></td>
                                    <td class="text-right"><?php echo $this->mith_func->time_elapsed_string($obj->created); ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" title="Action Menu">
                                                <i class="fa fa-cogs"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right" role="menu">												
                                                <li>
                                                    <a data-target="#edit" role="button" data-toggle="modal" title="Edit Data"
                                                       id="edit_<?php echo $obj->news_id; ?>"
                                                       name="edit_<?php echo $obj->news_id; ?>" href="">
                                                        Edit Data</a>
                                                </li>
                                                <li>
                                                    <a data-target="#delete" role="button" data-toggle="modal" title="Delete Data"
                                                       onclick="$('input[name=deleted_id]').val(<?php echo $obj->news_id; ?>)"
                                                       href="">
                                                        Delete Data</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>									
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div><!-- /.table-responsive -->
            </div><!-- /.the-box .default -->
            <!-- END DATA TABLE -->
        </div><!-- /.container-fluid -->				
    </div><!-- /.page-content -->
</div><!-- /.wrapper -->
<!-- END PAGE CONTENT -->

<!-- BEGIN BACK TO TOP BUTTON -->
<div id="back-top">
    <a href="#top"><i class="fa fa-chevron-up"></i></a>
</div>
<!-- END BACK TO TOP -->

<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable-newss').dataTable({
            "columns": [
                null,
                null,
                null,                
                {"orderable": false}
            ]
        });
        
        $(".tooltip-examples button").tooltip();
        window.setTimeout(function () {
            $(".alert").alert('close');
        }, <?php echo $this->config->item('timeout_message'); ?>);
    });
</script>

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form role="form" action="<?php echo base_url('backend/news/delete'); ?>" method="post" id="form_delete">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Delete Program</h4>
                </div>
                <div class="modal-body">
                    <p class="error-text"><?php echo $this->lang->line('MESSAGE_DELETE_CONFIRM'); ?></p>                                
                    <input type="hidden" name="deleted_id" value="">                                
                </div>
                <div class="modal-footer">
                    <button class="btn" type="button" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    <button class="btn btn-danger">Delete</button>                     
                </div>
            </div><!-- /.modal-content -->
        </form> 
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->