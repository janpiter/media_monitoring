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
                    <table class="table table-striped table-hover" id="datatable-persons">
                        <thead class="the-box dark full">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
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
                                    <td>
                                        <img alt="Avatar" class="ava img-circle" src="<?php echo base_url('assets/data/persons/'.$obj->person_image); ?>">
                                        <?php echo ucwords($obj->person_name); ?>
                                    </td>
                                    <td class="text-right"><?php echo $this->mith_func->time_elapsed_string($obj->created); ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" title="Action Menu">
                                                <i class="fa fa-cogs"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right" role="menu">												
                                                <li>
                                                    <a data-target="#edit" role="button" data-toggle="modal" title="Edit Data"
                                                       id="edit_<?php echo $obj->person_id; ?>"
                                                       name="edit_<?php echo $obj->person_id; ?>" href="">
                                                        Edit Data</a>
                                                </li>
                                                <li>
                                                    <a data-target="#delete" role="button" data-toggle="modal" title="Delete Data"
                                                       onclick="$('input[name=deleted_id]').val(<?php echo $obj->person_id; ?>)"
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
        $('#datatable-persons').dataTable({
            "columns": [
                null,
                null,
                null,                
                {"orderable": false}
            ]
        });
        
        $("#form_add").validate({
            rules: {
                person_name: {
                    required: true,
                    minlength: 1,
                    maxlength: 100
                }
            },
            messages: {
                person_name: {
                    required: "Please enter a valid name.",
                    minlength: "Name must be at least 3 characters in length.",
                    maxlength: "Name must be less than 100 characters in length."
                }
            }
        });
        
        $("#form_edit").validate({
            rules: {
                edit_person_name: {
                    required: true,
                    minlength: 1,
                    maxlength: 100
                }
            },
            messages: {
                edit_person_name: {
                    required: "Please enter a valid name.",
                    minlength: "Name must be at least 3 characters in length.",
                    maxlength: "Name must be less than 100 characters in length."
                }
            }
        });
        
        $(".tooltip-examples button").tooltip();
        window.setTimeout(function () {
            $(".alert").alert('close');
        }, <?php echo $this->config->item('timeout_message'); ?>);
        
//        $('input[type=file]').bootstrapFileInput();
//        $('.file-inputs').bootstrapFileInput();

        <?php foreach ($objList as $obj) { ?>
            $("#edit_<?php echo $obj->person_id; ?>").click(function () {
                $('input[name=edit_person_id]').val('<?php echo $obj->person_id; ?>');
                $('input[name=edit_person_name]').val('<?php echo $obj->person_name; ?>');
                
                var img = '<?php echo $obj->person_image; ?>';
                var images = "<?php echo base_url('assets/img/no_image.png'); ?>";
                if(img != ""){
                    images = "<?php echo base_url('assets/data/persons'); ?>";
                    images = images +"/"+img;
                }

                var div = document.getElementById('edit_image_thumb');
                div.innerHTML = '<img  src="'+images+'"/>';   
            });
        <?php } ?>
    });
</script>

<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form role="form" action="<?php echo base_url('backend/person/add') ?>" method="post" id="form_add" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add New Person</h4>
                </div>
                <div class="modal-body">																			
                    <div class="form-group">
                        <label>Person name</label>
                        <input type="text" id="person_name" name="person_name" class="form-control has-feedback" autofocus />
                    </div>
                    <div class="form-group">
                        <label>Person Image</label>
                        <input id="image_pic" name="image_pic" type="file" data-bfi-disabled class="input-file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="register" class="btn btn-primary">Save Data</button>
                </div>            
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form role="form" action="<?php echo base_url('backend/person/edit'); ?>" method="post" id="form_edit" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Edit Person</h4>
                </div>
                <div class="modal-body">                                
                    <div class="form-group">
                        <label>Person name</label>
                        <input type="text" id="edit_person_name" name="edit_person_name" class="form-control has-feedback" autofocus />
                        <input type="hidden" name="edit_person_id" value="">
                    </div>
                    <div class="thumbnail" style="float: left;">
                        <div class="thumb_edit" id="edit_image_thumb" name="edit_image_thumb"></div>                        
                    </div>                     
                    <div style="clear: both;" /></div>
                    <input id="edit_image_pic" name="edit_image_pic" type="file" data-bfi-disabled class="input-file">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save data</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form role="form" action="<?php echo base_url('backend/person/delete'); ?>" method="post" id="form_delete">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Delete Person</h4>
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