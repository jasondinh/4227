<?php


echo $this->Form->create('User', array(
'action' => 'checkout'
));

echo $this->Form->input('type', array(
'type' => 'select',
'options' => array('visa', 'master')
));
echo $this->Form->input('number', array(
'type' => 'text',
'label' => 'Card number'
));

echo $this->Form->input('expire', array(
'type' => 'text',
'label' => 'Expire date(MMYYYY)'
));
echo $this->Form->input('cvv', array(
'type' => 'text',
'label' => 'CVV'
));
echo $this->Form->end('Process');
