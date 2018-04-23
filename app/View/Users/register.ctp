<?php
$requiredSign = '<span class="required text-danger">*</span>';

?>

<div class="row">
    <div class="col">
        <?php
            echo $this->Session->flash('auth');

            echo $this->Form->create('User', [
                'inputDefaults' => [
                    'div' => 'form-group row',
                    'class' => 'form-control',
                    'error' => ['attributes' => ['wrap' => 'div', 'class' => 'offset-md-3 invalid-feedback']],
                    'required' => false,
                ],
            ]);
        ?>
        <h2><?php echo __('New user registration'); ?></h2>
        <p><?php echo __('Please fill the form below.'); ?></p>
        <?php
            echo $this->Form->input('User.first_name', array(
                'label' => ['text' => __('First Name').$requiredSign, 'class' => 'col-md-3 col-form-label'],
                'placeholder' => __('Enter Your First name'),
                'type' => 'text',
                'between' => '<div class="col">',
                'after' => '</div>',
                'class' => ($this->Form->isFieldError('first_name'))? 'is-invalid form-control': 'form-control',
            ));
            echo $this->Form->input('User.last_name', array(
                'label' => ['text' => __('Surname').$requiredSign, 'class' => 'col-md-3 col-form-label'],
                'type' => 'text',
                'placeholder' => __('Enter Your surname'),
                'between' => '<div class="col">',
                'after' => '</div>',
                'class' => ($this->Form->isFieldError('last_name'))? 'is-invalid form-control': 'form-control',
            ));
            echo $this->Form->input('User.email', array(
                'label' => ['text' => __('E-mail').$requiredSign, 'class' => 'col-md-3 col-form-label'],
                'type' => 'text',
                'class' => ($this->Form->isFieldError('email'))? 'is-invalid form-control': 'form-control',
                'placeholder' => __('Enter Your Email *'),
                'between' => '<div class="col">',
                'after' => '</div>',
            ));

            echo $this->Form->input('User.password', array(
                'label' => array('text' => __('Password').$requiredSign, 'class' => 'col-md-3 col-form-label'),
                'type' => 'password',
                'between' => '<div class="col">',
                'after' => '</div>',
                'class' => ($this->Form->isFieldError('password'))? 'is-invalid form-control': 'form-control',
            ));
            echo $this->Form->input('User._password', array(
                'label' => array('text' => __('Confirm password').$requiredSign, 'class' => 'col-md-3 col-form-label'),
                'type' => 'password',
                'between' => '<div class="col">',
                'after' => '</div>',
                'class' => ($this->Form->isFieldError('_password'))? 'is-invalid form-control': 'form-control',
            ));

            echo '<div class="form-group row">';
            echo '<div class="col-md-3 control-label">&nbsp;</div>';
            echo '<div class="col">';
            echo $this->Form->input('agree_tos', [
                'label' => ['text' => '&nbsp;'.__('Agree').' <a href="#" class="btnToc" data-toggle="modal" data-target="#sectionToc">'.__('to TOS').'</a>', 'class' => 'form-check-label'],
                'type' => 'checkbox',
                'div' => 'form-check',
                'required' => false,
                'escape' => false,
                'error' => ['attributes' => ['wrap' => 'div', 'class' => 'invalid-feedback']],
                'data-errormessage-value-missing' => __("You must agree to TOS before creating account."),
                'class' => ($this->Form->isFieldError('agree_tos'))? 'is-invalid form-check-input': 'form-check-input',
            ]);

            echo '</div></div>';


/*
        <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> */

            echo $this->Form->input(__('Sign in'), array(
                'label' => array('text' => '&nbsp;', 'class' => 'col-md-3 col-form-label'),
                'type' => 'button',
                'between' => '<div class="col">',
                'after' => '</div>',
                'class' => 'btn btn-info saveForm',
            ));
            echo $this->Form->end();
        ?>
    </div>
</div>


<!-- Modal -->
<div class="modal" tabindex="-1" role="dialog" id="sectionToc" aria-labelledby="mySectionTOS" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= __('TOS') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                echo '<div class="text-muted">';
                echo __('here comes some TOS text later');
                echo '<br /><br />';
                echo '</div>';
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
