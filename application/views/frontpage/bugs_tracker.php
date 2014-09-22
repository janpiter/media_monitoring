<div class="container">     
	<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">       
        	<div class="page-header">
			  	<h2>
			  		Bugs Tracker <small>what is the problem</small>
			  		<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#add-new"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Add Data</button>
			  	</h2>			  	
			</div>	
			<table class="table table-striped table-hover" id="dataTables-example">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th>Issues</th>
						<th width="5%"></th>				
						<th width="2%"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($bugs as $b) { ?>
					<tr>
						<td><span class="label label-primary"><?php echo $b->date; ?></span></td>
						<td><?php echo $b->title; ?></td>
						<td><?php echo $b->status; ?></td>
						<td>
							<div class="btn-group pull-right">
								<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-gear"></i>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a class="edit-row" data-toggle="modal" data-id="<?php echo $b->bug_id; ?>">Edit</a></li>
									<li><a class="delete-row" data-toggle="modal" data-id="<?php echo $b->bug_id; ?>">Delete</a></li>
								</ul>
							</div>	
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
        </div>			
    </div>
</div>
 
<!-- create description -->
<div class="modal fade" id="add-new">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Bugs Registered</h4>
			</div>
			<form method="POST" role="form" data-action="<?php echo base_url()."bugs_tracker"; ?>">	
				<div class="modal-body">					
					<div class="form-group">
						<label for="title">Title</label>
						<input type="text" class="form-control" id="title" name="title" placeholder="Title" />
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea class="form-control" rows="5" id="description" name="description" placeholder="Description"></textarea>
					</div>							
					<div class="form-group row">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label for="research">Research</label>
							<select name="research" id="research" class="form-control" required="required">
								<option value="0" selected="selected" disabled="disabled">Research</option>
								<?php 
									foreach ($research as $r) { 
										echo '<option value="'.$r->r_id.'">'.$r->name.'</option>';
									} 
								?>
							</select>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label for="status">Status</label>
							<select name="status" id="status" class="form-control" required="required">
								<option value="-1" selected="selected" disabled="disabled">Status</option>
								<option value="0">No Status</option>
								<option value="1">Not Solved</option>
								<option value="2">In Progress</option>
								<option value="3">Solved</option>
							</select>
						</div>						
					</div>				
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" id="edit_id" value="" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Delete Research</h4>
			</div>
			<form action="<?php echo base_url() ?>bugs_tracker/delete" method="POST" role="form">		
				<div class="modal-body">
					Are you sure you want to delete this data?
					<input type="hidden" name="id" id="deleted_id" value="">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	$('.edit-row').click(function(e) {	
		$.ajax({
			type: 'POST',
			dataType : 'json',
			url: $("#add-new form").data('action') + "/get",
			data: 'id=' + $(this).data('id'),
			success: function(response) {
				console.log(response);
				$('input[id=edit_id]').val(response.bug_id);				
				$('input[id=title]').val(response.title);				
				$('textarea[id=description]').val(response.description);
				$("#research").val(response.r_id);
				$("#status").val(response.status);

				$('#add-new').modal('show');
			}
		});
	});
</script>