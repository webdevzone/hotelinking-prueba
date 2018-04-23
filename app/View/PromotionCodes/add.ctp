<div class="promotionCodes form">
<?php echo $this->Form->create('PromotionCode'); ?>
	<fieldset>
		<legend><?php echo __('Add Promotion Code'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('title');
		echo $this->Form->input('token');
		echo $this->Form->input('discount');
		echo $this->Form->input('redeemed');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Promotion Codes'), array('action' => 'index')); ?></li>
	</ul>
</div>
