
<!-- Workbench -->
<div class="container axle-x">

	<div id="panel-tree" class="panel small resizable" id="navigationbar" data-size-factor="0.2">
		<?php 
		view_header('tree');
		?>
	</div>

	<div class="divider to-right"></div>

	<div class="container axle-x autosize">

		<div id="panel-content" class="panel wide autosize">
			<?php 
			view_header('content');
			?>
		</div>

		<div class="divider to-left" />

		<div id="panel-side" class="panel small resizable" data-size-factor="0.25">
			<?php 
			view_header('side');
			?>
		</div>
		
	</div>



</div>
