<?php
App::import('Component', 'Email');
class ApiComponent extends EmailComponent {
  function send_email($subject, $body, $to, $from = null) {
    $this->smtpOptions = array(
         'port'=>'465', 
         'timeout'=>'30',
         'host' => 'ssl://smtp.gmail.com',
         'username'=>'wowrental2@gmail.com',
         'password'=>'bathanh123',
    );
    $this->delivery = 'smtp';
    $this->sendAs = 'text';
    
    if ($from) {
      $this->replyTo = $from;
    }
    
    $this->to = $to;
    $this->subject = $subject;
    $this->send($body);
  }
  
  function genRandomString() {
      $length = 10;
      $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
      $string = "";    
      for ($p = 0; $p < $length; $p++) {
          $string .= $characters[mt_rand(0, strlen($characters))];
      }
      return $string;
  }
}