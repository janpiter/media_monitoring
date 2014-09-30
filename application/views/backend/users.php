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
            <h1 class="page-heading">USER MANAGEMENTS&nbsp;&nbsp;<small>controling permission</small></h1>
            <!-- End page heading -->

            <!-- Begin breadcrumb -->
            <ol class="breadcrumb default square rsaquo sm">
                <li><a href="<?php echo base_url('/backend/dashboard'); ?>"><i class="fa fa-home"></i></a></li>
                <li>User Management</li>
                <li class="active">Users</li>
            </ol>
            <!-- End breadcrumb -->

            <!-- BEGIN DATA TABLE -->
            <div class="the-box">

                <?php if ($this->tank_auth->is_admin() or $this->tank_auth->is_super_admin()) { ?>
                    <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;Add Data</button>
                    <br/><br/>
                <?php } ?>

                <?php echo $this->session->flashdata('msg'); ?>

                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="datatable-example">
                        <thead class="the-box dark full">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Last Login</th>
                                <th class="text-center">Action</th>									
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($users as $u) {
                                if ($u->group_id == 1) {
                                    continue;
                                }
                                ?>
                                <tr class="gradeA">
                                    <td><?php echo ++$no; ?></td>
                                    <td><?php echo $u->name; ?></td>
                                    <td><?php echo $u->username; ?></td>
                                    <td><?php echo $u->email; ?></td>
                                    <td class="text-right"><?php echo $this->mith_func->time_elapsed_string($u->last_login); ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-cogs"></i>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">												
                                                <li><a href="#" class="edit-row" data-id="<?php echo $u->id; ?>">Edit Data</a></li>
                                                <li><a href="#" class="delete-row" data-id="<?php echo $u->id; ?>">Delete Data</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#" class="reset-row" data-id="<?php echo $u->id; ?>">Reset Password</a></li>
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

<!--
===========================================================
END PAGE
===========================================================
-->

<script type="text/javascript">
	$(document).ready(function () {
		
		$("#form_add").validate({
            rules: {
                personname: {
                    required: true,
					minlength: 3,
                    maxlength: 100
                },
                username: {
					required: true,
					minlength: 3,
                    maxlength: 100
				},
				password: {
					required: true,
					minlength: 6,
                    maxlength: 100
				},
				confirm_password: {
					required: true,
					equalTo: "#password",
					minlength: 6,
                    maxlength: 100
				},
				email: {
					required: true,
					email: true
				},
				user_level: {
					required: true
				}
            },
            messages: {        
                personname: {
                    required: "Please enter a valid name.",
                    minlength: "Name must be at least 3 characters in length.",
                    maxlength: "Name must be less than 100 characters in length."
                },
				username: {
                    required: "Please enter a valid name.",
                    minlength: "Name must be at least 3 characters in length.",
                    maxlength: "Name must be less than 100 characters in length."
                },
				password: {
                    required: "Please enter a valid name.",
                    minlength: "Name must be at least 6 characters in length.",
                    maxlength: "Name must be less than 100 characters in length."
                },
				confirm_password: {
                    required: "Please enter a valid name.",
                    minlength: "Name must be at least 6 characters in length.",
                    maxlength: "Name must be less than 100 characters in length."
                },
				email: {
					required: "Please enter a valid email address",
				},
				user_level: {
                    required: "Please select data."
                },
            }
        });
		
		$('.edit-row').click(function (e) {
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: '<?php echo base_url('/backend/user/get'); ?>',
				data: 'id=' + $(this).data('id'),
				success: function (response) {
					console.log(response);
					$('input[id=edit_id]').val(response.id);
					$('input[name=personname]').val(response.name);
					$('input[name=username]').val(response.username);
					$('input[name=email]').val(response.email);
					$('select[name=user_level]').val(response.group_id);

					$('.password').hide();
					$('input[name=password]').prop('disabled', true);
					$('.confirm_password').hide();
					$('input[name=confirm_password]').prop('disabled', true);

					$('#myModal form').attr('action', '<?php echo base_url('/backend/user/edit') ?>'); //this fails silently
					$('#myModal form').get(0).setAttribute('action', '<?php echo base_url('/backend/user/edit') ?>'); //this works

					$('#myModal').modal('show');
				}
			})
		});
		$('.reset-row').click(function (e) {

			$('input[id=edit_id]').val($(this).data('id'));

			$('.personname').hide();
			$('input[name=personname]').prop('disabled', true);
			$('.username').hide();
			$('input[name=username]').prop('disabled', true);
			$('.email').hide();
			$('input[name=email]').prop('disabled', true);
			$('.user_level').hide();
			$('select[name=user_level]').prop('disabled', true);
			$('.confirm_password').hide();
			$('input[name=confirm_password]').prop('disabled', true);

			$('#myModal form').attr('action', '<?php echo base_url('/backend/user/force_reset') ?>'); //this fails silently
			$('#myModal form').get(0).setAttribute('action', '<?php echo base_url('/backend/user/force_reset') ?>'); //this works

			$('#myModal').modal('show');
		});

		$('.delete-row').click(function (e) {
			$('input[id=deleted_id]').val($(this).data('id'));
			$('#delete').modal('show');
		});
		
		 window.setTimeout(function () { $(".alert").alert('close'); }, <?php echo $this->config->item('timeout_message'); ?>);

	});
</script>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">User Registered</h4>
            </div>
            <form role="form" action="<?php echo base_url('auth/register') ?>" method="post" id="form_add">
                <div class="modal-body">																			
                    <div class="form-group personname">
                        <label>Full name</label>
                        <input type="text" name="personname" id="personname" class="form-control has-feedback" autofocus />
                        <!-- <span class="fa fa-male form-control-feedback"></span> -->				
                    </div>
                    <div class="form-group username">
                        <label>Username</label>
                        <input type="username" name="username" id="username" class="form-control has-feedback" />
                        <!-- <span class="fa fa-user form-control-feedback"></span> -->								
                    </div>
                    <div class="form-group email">
                        <label>Email address</label>
                        <input type="email" name="email" id="email" class="form-control has-feedback" />
                        <!-- <span class="fa fa-envelope form-control-feedback"></span> -->
                    </div>							
                    <div class="form-group password">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control has-feedback" />
                        <!-- <span class="fa fa-lock form-control-feedback"></span> -->
                    </div>
                    <div class="form-group confirm_password">
                        <label>Retype Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control has-feedback" />
                        <!-- <span class="fa fa-unlock form-control-feedback"></span> -->
                    </div>
                    <div class="form-group user_level">
                        <label>Permission</label>
                        <select name="user_level" id="user_level" class="form-control">
                            <option value="" disabled selected>Choosen Role</option>
                            <option value="1">Super Administrator</option>
                            <option value="2">Administrator</option>
                            <option value="3">Manager</option>
                            <option value="4">Operator</option>									
                        </select>
                        <!-- <span class="fa fa-cogs form-control-feedback"></span> -->
                    </div>															  						
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="edit_id" name="id" value="" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="register" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="delete" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete User</h4>
            </div>
            <form action="<?php echo base_url('/backend/user/delete'); ?>" method="post">
                <div class="modal-body">
                    <p>Are you sure you want to delete this data?</p>
                    <input type="hidden" name="id" id="deleted_id" value="" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" >Delete</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->