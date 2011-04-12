<?php


if (isset($error)) {
  echo "<div id='error'>$error</div>";
}

echo $this->Form->create('User', array(
'action' => 'checkout'
));

echo $this->Form->input('card_name', array(
'type' => 'text',
'label' => 'Card holder name'
));
echo $this->Form->input('type', array(
'type' => 'select',
'options' => array('Visa' => 'Visa', 'MasterCard' => 'MasterCard', 'Discover' => 'Discover', 'Amex' => 'Amex'),
'label' => 'Card type'
));
echo $this->Form->input('number', array(
'type' => 'text',
'label' => 'Card number'
));

echo $this->Form->input('amount', array(
  'type' => 'hidden',
  'value' => 50
));

echo '<div class="input select"><label for="UserExpireMonth">Expire date</label><select name="data[User][expire_month]" id="UserExpireMonth">
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</select>';
echo '<select name="data[User][expire_year]" id="UserExpireYear">';

for ($i = 2012; $i < 2025; $i++) {
  echo '<option value="'.$i.'">'.$i.'</option>';
}
echo '</select>';

echo '</div>';

echo $this->Form->input('cvv', array(
'type' => 'text',
'label' => 'CVV'
));
echo $this->Form->end('Process');
