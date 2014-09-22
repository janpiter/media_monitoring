<div class="container">     
	<div class="row">
        <div class="col-lg-12">		
        	<div class="page-header">
			  	<h2>
			  		Tasks <small>what we do</small>	
			  		<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#add-new"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Add Data</button>		  			
			  	</h2>			  	
			</div>		
			
			<table class="table table-striped table-hover" id="dataTables-example">
				<thead>
					<tr>						
						<th>Tasks</th>
						<th width="10%">Start Date</th>
						<th width="10%">Due Date</th>
						<th width="5%"></th>										
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>			
        </div>			
    </div>	 
</div>

<!-- create description -->
<div class="modal fade" id="add-new" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Task Registered</h4>
			</div>
			<div class="modal-body">
				<form action="" method="POST" role="form">
					<div class="form-group row">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label for="">Priority</label>
							<input type="text" class="form-control" id="" placeholder="Input field">	
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							
						</div>							
					</div>
				
					
				
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>

<div id="loading" class="alert alert-success"><i class="fa fa-refresh fa-spin"></i>&nbsp;Loading</div>

<script type="text/javascript">
	$(document).ready(function($) {
		$("#loading").hide();		

		
	});
</script>