<div class="row">
	<div class="col text-center">
		<h1 class="mb-5">Promotion codes</h1>

		<?php
		echo $this->Html->link(__('Get YOUR promotion code'),
			['controller' => 'promotion_codes', 'action' => 'add', 'ext' => 'html'],
			[
				'escape' => false,
				'class' => 'btn btn-primary',
			]
		);
		?>
	</div>
</div>
