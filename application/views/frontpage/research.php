<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">		
			<div class="page-header">
			  	<h2>
			  		Research <small>what we research</small>
			  		<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#add-new"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Add Data</button>
			  	</h2>			  	
			</div>
			<table class="table table-striped table-hover" id="dataTables-example">
				<thead>
					<tr>						
						<th>Research</th>
						<th>Description</th>
						<th></th>
					</tr>
				</thead>
				<tbody>					
					<?php foreach ($research as $r) { ?>
					<tr>						
						<td width="25%"><?php echo $r->name; ?></td>
						<td><?php echo ((isset($r->description) and !empty($r->description)) ? $r->description : '- no description -'); ?></td>
						<td>							
							<div class="btn-group pull-right">
								<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-gear"></i>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a class="edit-row" data-toggle="modal" data-id="<?php echo $r->r_id; ?>">Edit</a></li>
									<li><a class="delete-row" data-toggle="modal" data-id="<?php echo $r->r_id; ?>">Delete</a></li>
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

<div class="modal fade" id="add-new">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Research Registration</h4>
			</div>
			<form method="POST" role="form" data-action="<?php echo base_url()."research"; ?>">	
				<div class="modal-body">						
					<div class="form-group">
						<label for="">Research Name</label>
						<input type="text" class="form-control" name="research_name" id="research_name" placeholder="Research Name">
					</div>					
					<div class="form-group">
						<label for="">Description</label>
						<textarea class="form-control" name="description" id="description" placeholder="Description" rows="5"></textarea>
					</div>				
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" id="edit_id" value="" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal-delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Delete Research</h4>
			</div>
			<form action="<?php echo base_url() ?>research/delete" method="POST" role="form">		
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
				$('input[id=edit_id]').val(response.r_id);
				$('input[id=research_name]').val(response.name);
				$('textarea[id=description]').val(response.description);
								
				$('#add-new').modal('show');
			}
		});
	});
</script>