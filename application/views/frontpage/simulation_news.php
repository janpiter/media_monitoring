<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<div id="page_simulation">
				<div class="panel panel-default">
					<div class="panel-heading">
						Simulation News
					</div>
					<div class="panel-body">
						<form id="simulation_news" method="post" data-action="http://localhost:9000/simulation_news">						
							<div class="form-group">					
								<label class="radio-inline">
									<input type="radio" value="en" id="en" name="lang" />&nbsp;&nbsp;English
								</label>
								<label class="radio-inline">
									<input type="radio" value="my" id="my" name="lang" />&nbsp;&nbsp;Melayu
								</label>
								<label class="radio-inline">
									<input type="radio" value="id" id="id" name="lang" />&nbsp;&nbsp;Indonesia
								</label>
							</div>													
							<div class="form-group">
								<input type="text" name="title" class="form-control" value="" required="required" placeholder="Insert your title ..." />
							</div>
							<div class="form-group">
								<textarea style="resize: none;" class="form-control" rows="15" placeholder="Insert your content ..." name="content"></textarea>
							</div>		
							<div class="form-group">
								<button class="btn btn-default" type="reset"><i class="fa fa-eraser"></i>&nbsp;&nbsp;Reset</button>
								<button class="btn btn-primary" type="submit"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Process</button>
							</div>
						</form>						
					</div>
				</div>
			</div>	

			<br/>
			<h4 class="page-header">Summary (Single Content Summarization)</h4>
			<div class="well-white">
				<div id="summary"><i>- no conclusion -</i></div>
			</div>
		
		
			<h4 class="page-header">Statements</h4>
			<div class="well-white" style="background-color: white;">
				<div id="statements"><i>- no statement -</i></div>				
			</div>		
		</div>
		<div class="col-lg-4">
			<br/>
			<!-- <h4 class="page-header">Language Detector</h4>
			<div id="lang_detect" class="panel-body"><i>- no language -</i></div> -->
			
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
				<div id="cleansing" class="panel-body"><i>- no entitas -</i></div>
			</div>				
			<div class="panel panel-default">
				<div class="panel-heading">
					Raw NER
				</div>
				<div id="raw" class="panel-body"><i>- no entitas -</i></div>
			</div>			
		</div>			
	</div>	
</div>

<!-- simulation news -->
<script type="text/javascript">
	$(document).ready(function() {

		$("#page_simulation").show();

		$('#simulation_news').submit(function(e) {
			var lang = {'id': 'Indonesia', 'en': 'Inggris', 'my': 'Melayu'}
			var post_data = $(this).serialize();
			var action = $(this).data('action');
			
			$.ajax({
				url: action,
				type: 'POST',
				data: post_data,
				dataType: 'json',
				success: function(data, textStatus, jqXHR) {
					// # language detector
					// $('#lang_detect').html(lang[data.lang_detector]);

					// # clean ner					
					clean_ner = '';					
					$.each(data.clean_ner, function(i, v) {						
						$.each(v, function(ix, vx) {							
							clean_ner += get_label(i, this);
						});
					});					
					$('#cleansing').html(clean_ner);

					// # raw ner
					raw_ner = '';					
					$.each(data.raw_ner, function(i, v) {						
						$.each(v, function(ix, vx) {							
							raw_ner += get_label(i, this);
						});
					});					
					$('#raw').html(raw_ner);

					// # summary
					$('#summary').html(data.summary);

					// # statments
					statements = '';
					$.each(data.statements, function(i, v) {						
						statements += '<blockquote class="blockquote-'+ v.sentiment +'">';
						statements += '<p>'+ v.desc +'</p>';
						statements += '<footer><i>'+ v.person +'</i></footer>';
						statements += '</blockquote> ';			
					});
					$('#statements').html(statements);

					$("#page_simulation").hide();
				},
				error: function(jqXHR, textStatus, errorThrown) {
					alert('error');
				}
			});
			
			e.preventDefault(); //STOP default action			
		});

		function get_label(type, realname) {
			result = '<span class="label label-default">'+realname+'</span> ';
			if(type == 'Person'){ result = '<span class="label label-success">' + realname + '</span> '; }
			else if(type == 'Location'){ result = '<span class="label label-danger">' + realname + '</span> '; }
			else if(type == 'Organization'){ result = '<span class="label label-warning">' + realname + '</span> '; }
			else if(type == 'Title'){ result = '<span class="label label-primary">' + realname + '</span> '; }
			else if(type == 'Others'){ result = '<span class="label label-info">' + realname + '</span> '; }
			return result;
		}
	});
</script>
