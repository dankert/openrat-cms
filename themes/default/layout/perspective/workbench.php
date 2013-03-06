
<!-- Workbench -->
<div class="container axle-x">

	<div class="bar small resizable" id="navigationbar" data-size-factor="0.2">
		<?php 
		view_header('tree');
		?>
	</div>

	<div class="divider to-right"></div>

	<div class="container axle-y autosize">

		<div class="container axle-x autosize">

			<div class="bar wide autosize">
				<?php 
				view_header('content');
				?>
			</div>

			<div class="divider to-left" />

			<div class="bar small resizable" data-size-factor="0.25">
				<?php 
				view_header('side');
				?>
			</div>
			
		</div>


		<div class="divider to-top" />

		<div class="bar wide resizable" data-size-factor="0.25">
			<?php 
			view_header('bottom');
			?>
		</div>

	</div>

</div>
