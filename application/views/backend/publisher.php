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
                <li><a href="<?php echo base_url('/backend/dashboard'); ?>"><i class="fa fa-home"></i></a></li>
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
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="datatable-publisher">
                        <thead class="the-box dark full">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Media Type</th>
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
                                    <td><?php echo $obj->publisher_name; ?></td>
                                    <td><?php echo $this->mith_func->getMediaTypeList()[$obj->media_type]; ?></td>
                                    <td class="text-right"><?php echo $this->mith_func->time_elapsed_string($obj->created); ?></td>									
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-cogs"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right" role="menu">	
                                                <li>
                                                    <a data-target="#edit" role="button" data-toggle="modal" title="Edit Data"
                                                       id="edit_<?php echo $obj->publisher_id; ?>"
                                                       name="edit_<?php echo $obj->publisher_id; ?>" href="">
                                                        Edit Data</a>
                                                </li>
                                                <li>
                                                    <a data-target="#delete" role="button" data-toggle="modal" title="Delete Data"
                                                       onclick="$('input[name=deleted_id]').val(<?php echo $obj->publisher_id; ?>)"
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
        $('#datatable-publisher').dataTable({
            "columns": [
                null,
                null,
                null,
                null,
                {"orderable": false}
            ]
        });

        // $(".tooltip-examples button").tooltip();
        window.setTimeout(function () {
            $(".alert").alert('close');
        }, <?php echo $this->config->item('timeout_message'); ?>);

<?php foreach ($objList as $obj) { ?>
            $("#edit_<?php echo $obj->publisher_id; ?>").click(function () {
                $('input[name=edit_publisher_id]').val('<?php echo $obj->publisher_id; ?>');
                $('input[name=edit_publisher_name]').val('<?php echo $obj->publisher_name; ?>');
                $('select[name=edit_media_type]').val('<?php echo $obj->media_type; ?>');
            });
<?php } ?>
    });
</script>


<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Publisher Registered</h4>
            </div>
            <form role="form" action="<?php echo base_url('backend/publisher/add') ?>" method="post">
                <div class="modal-body">																			
                    <div class="form-group">
                        <label>Publisher</label>
                        <input type="text" name="publisher_name" class="form-control has-feedback" autofocus required />
                        <!-- <span class="fa fa-male form-control-feedback"></span> -->				
                    </div>
                    <div class="form-group">
                        <label>Media Type</label>
                        <select name="media_type" class="form-control" tabindex="2" required >
                            <option value="" disabled selected>-- Choosen Media Type --</option>
                            <!-- choosen -->
                            <?php
                            foreach ($this->mith_func->getMediaTypeList() as $k => $v) {
                                echo '<option value="' . $k . '">' . $v . '</option>';
                            }
                            ?>
                        </select>
                        <!-- <span class="fa fa-cogs form-control-feedback"></span> -->
                    </div>														  						
                </div>
                <div class="modal-footer">					
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Publisher Registered</h4>
            </div>
            <form role="form" action="<?php echo base_url('backend/publisher/edit') ?>" method="post">
                <div class="modal-body">																			
                    <div class="form-group">
                        <label>Publisher</label>
                        <input type="text" id="edit_publisher_name" name="edit_publisher_name" class="form-control has-feedback" autofocus required />
                        <input type="hidden" name="edit_publisher_id" value="">
                        <!-- <span class="fa fa-male form-control-feedback"></span> -->				
                    </div>
                    <div class="form-group">
                        <label>Media Type</label>
                        <select id="edit_media_type" name="edit_media_type" class="form-control" tabindex="2" required >
                            <option value="" disabled selected>-- Choosen Media Type --</option>
                            <!-- choosen -->
                            <?php
                            foreach ($this->mith_func->getMediaTypeList() as $k => $v) {
                                echo '<option value="' . $k . '">' . $v . '</option>';
                            }
                            ?>
                        </select>
                        <!-- <span class="fa fa-cogs form-control-feedback"></span> -->
                    </div>														  						
                </div>
                <div class="modal-footer">					
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form role="form" action="<?php echo base_url('backend/publisher/delete'); ?>" method="post" id="form_delete">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Delete Publisher</h4>
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