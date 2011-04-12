<?php
class AppController extends Controller {
  
  function beforeFilter() {
    $this->set('funny', 'funny');
  }
}