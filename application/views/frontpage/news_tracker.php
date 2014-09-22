<script type="text/javascript">
	$(function() {
		var height = $(document).height() - 100;		
		$("#xframe").attr("height", height);	
	});	
</script>
<div class="container">
	<div class="row">
		<div class="col-lg-12">	
			<?php if(isset($page) and $page == "production") { ?>
				<iframe heigth="0" id="xframe" src="http://192.168.10.245:2014/" width="100%" frameborder="0" scrolling="no" style="overflow-y: scroll; overflow-x:hidden;"></iframe>
			<?php } else { ?>
				<iframe heigth="0" id="xframe" src="http://103.18.244.158:1989/" width="100%" frameborder="0" scrolling="no" style="overflow-y: scroll; overflow-x:hidden;"></iframe>
			<?php } ?>
		</div>
	</div>
</div>