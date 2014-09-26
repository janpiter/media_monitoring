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
                <li><a href="<?php echo base_url('backend/dashboard'); ?>"><i class="fa fa-home"></i></a></li>
                <li class="active"><?php echo $page_title; ?></li>
                <!-- <li class="active">Log</li> -->
            </ol>
            <!-- End breadcrumb -->
            <!-- BEGIN DATA TABLE -->
            <div class="the-box">
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
                    <table class="table table-striped table-hover" id="datatable-logs">
                        <thead class="the-box dark full">
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Activity</th>
                                <th>Created</th>
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
                                    <td><?php echo ucwords($obj->username); ?></td>
                                    <td><?php echo $obj->detail; ?></td>
                                    <td class="text-right"><?php echo $this->mith_func->time_elapsed_string($obj->created); ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" title="Action Menu">
                                                <i class="fa fa-cogs"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right" role="menu">										
                                                <li>
                                                    <a data-target="#delete" role="button" data-toggle="modal" title="Delete Data"
                                                       onclick="$('input[name=deleted_id]').val(<?php echo $obj->history_id; ?>)"
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
        $('#datatable-logs').dataTable({
            "columns": [
                null,
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

<!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form role="form" action="<?php echo base_url('backend/log/delete'); ?>" method="post" id="form_delete">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Delete Log</h4>
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