
<!-- Workbench -->
<div class="container axle-x">

	<div id="panel-tree" class="panel small resizable" id="navigationbar" data-size-factor="0.4">
		<?php 
		view_header('tree');
		?>
	</div>

	<div class="divider to-right"></div>

	<div class="container axle-y autosize">


		<div id="panel-content" class="panel wide autosize">
			<?php 
			view_header('content');
			?>
		</div>

		<div class="divider to-top" />

		<div id="panel-bottom" class="panel wide resizable" data-size-factor="0.3">
			<?php 
			view_header('bottom');
			?>
		</div>

	</div>

</div>
