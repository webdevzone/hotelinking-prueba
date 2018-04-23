<div class="promotionCodes view">
<h2><?php echo __('Promotion Code'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($promotionCode['PromotionCode']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($promotionCode['PromotionCode']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($promotionCode['PromotionCode']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Token'); ?></dt>
		<dd>
			<?php echo h($promotionCode['PromotionCode']['token']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Discount'); ?></dt>
		<dd>
			<?php echo h($promotionCode['PromotionCode']['discount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Redeemed'); ?></dt>
		<dd>
			<?php echo h($promotionCode['PromotionCode']['redeemed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($promotionCode['PromotionCode']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($promotionCode['PromotionCode']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Promotion Code'), array('action' => 'edit', $promotionCode['PromotionCode']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Promotion Code'), array('action' => 'delete', $promotionCode['PromotionCode']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $promotionCode['PromotionCode']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Promotion Codes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Promotion Code'), array('action' => 'add')); ?> </li>
	</ul>
</div>
