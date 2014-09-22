<!-- simulation news -->
<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<div id="page_simulation">
				<div class="panel panel-default">
					<div class="panel-heading">
						Simulation News (Pickle)
					</div>
					<div class="panel-body">
						<form id="simulation_news" method="post">						
							<div class="form-group">							
								<label class="radio-inline">
									<input type="radio" value="option1" id="en" name="lang" />&nbsp;&nbsp;English
								</label>
								<label class="radio-inline">
									<input type="radio" value="option2" id="my" name="lang" />&nbsp;&nbsp;Melayu
								</label>
								<label class="radio-inline">
									<input type="radio" value="option3" id="id" name="lang" />&nbsp;&nbsp;Indonesia
								</label>
							</div>
							<div class="form-group">
								<textarea style="resize: none;" class="form-control" rows="15" placeholder="Insert your content ..."></textarea>
							</div>							
							<div class="form-group">
								<button class="btn btn-default" type="reset"><i class="fa fa-eraser"></i>&nbsp;&nbsp;Reset</button>
								<button class="btn btn-primary" type="submit"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Process</button>
							</div>
						</form>
					</div>
				</div>				
			</div>
		</div>
		<div class="col-lg-4">
			<div style="margin-bottom: 10px;">
				<span class="label label-success">Person</span>
				<span class="label label-danger">Location</span>
				<span class="label label-warning">Organzation</span>
				<span class="label label-info">Other</span>
				<span class="label label-primary">Title</span>	
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					Clean NER
				</div>
				<div id="cleansing" class="panel-body"><i>No Entitas</i></div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					Raw NER
				</div>
				<div id="raw" class="panel-body"><i>No Entitas</i></div>
			</div>
		</div>			
	</div>
</div>

