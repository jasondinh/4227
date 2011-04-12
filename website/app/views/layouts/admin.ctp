<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title_for_layout?></title>
<link href="/4227/website/css/reset.css" rel="stylesheet" type="text/css" />
<link href="/4227/website/css/stylesheet.css" rel="stylesheet" type="text/css" />
<?php echo $scripts_for_layout; ?>
</head>

<body>

<div id="wrapper">
<div id="header">
	<div id="logo">
    	<?php echo $this->Html->link('', array('controller' => 'users', 'action' => 'my_movies'));?>      
    	</div>
    
    <div id="categories">
    	
    </div>    
    <div id="top_panel">
      <?php
        if (isAdmin($this)) {
          $user = getEmployee($this);
      ?>
      <span class="welcome">Welcome</span> <a href="#" class="user"><?php echo $user['Employee']['username'];?></a>
      
      <?php echo $this->Html->link('Log out', array('controller' => 'employees', 'action' => 'logout'), array('id' => 'login_btn'));?>      
      <?php
        }
        else {
      ?>
      
      <span class="welcome">Welcome</span>
      <?php echo $this->Html->link('Log in', array('controller' => 'employee', 'action' => 'login'), array('id'=>'login_btn'));?>
      <?php    
        }
      ?>
    
    
    <ul id="dropdown_menu">
        <li><a href="#">About Us</a></li>
    </ul>
    </div>
    
      <div id="searchbox">
        <?php 
        
        echo $this->Form->create('Video', array(
         'action'  => 'search_title'
        ));
        echo $this->Form->input('search', array(
          'type' => 'text',
          'value' => '',
          'label' => '',
          'name' => 'keyword'
        ));
        
        echo $this->Form->end();
        		
        ?>
    	<!-- <input type="text" value="search" />  -->
    </div>
</div>

<div id="banner"></div>

<div id="breadcrumbs">Home</div>

<div id="content">
	<div id="maincontent">
		<h1>Title</h1>
		<div id="maincontentholder">
		
		<?php echo $content_for_layout ?>
    	</div>
        <div class="bottom"></div>
    </div>
    
    <div id="sidebar">
    
    <div id="most_viewed_panel">
    	<!-- <h1>Most viewed</h1>
    	        <ol>
    	         <li><a href="#">Inception</a></li>
    	        </ol> -->
    </div>
    
    <?php
      if (isAdmin($this)) {
    ?>
    <div id="user_panel">
    	<h1>User Panel</h1>
        <ul>
          <?php echo $this->Html->link('Profile', array('controller' => 'employees', 'action' => 'edit_profile'));?>
        </ul>
        <ul>
    	<?php echo $this->Html->link('Change password', array('controller' => 'users', 'action' => 'change_password'));?>      
        </ul>
        <ul>
          <?php echo $this->Html->link('My videos', array('controller' => 'users', 'action' => 'my_movies'));?>
        </ul>
        <ul>
          <?php echo $this->Html->link('History', array('controller' => 'users', 'action' => 'history'));?>
        </ul>
    </div>
    <?php
    }
    ?>
    </div>
</div>

<div id="copyright">All rights reserved.
</div>
</div>

</body>
</html>
