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
    	<ul>
        <li>
        <?php echo $this->Html->link('Action', array('controller' => 'genres', 'action' => 'show_video', 1, 'admin' => false));?>
        </li>
        <li>
        <?php echo $this->Html->link('Adventure', array('controller' => 'genres', 'action' => 'show_video', 2, 'admin' => false));?>
        </li>
        <li>
        <?php echo $this->Html->link('Crime', array('controller' => 'genres', 'action' => 'show_video', 3, 'admin' => false));?>
        </li>
        <li>
        <?php echo $this->Html->link('Comedy', array('controller' => 'genres', 'action' => 'show_video', 4, 'admin' => false));?>
        </li>
        <li>
        <?php echo $this->Html->link('Drama', array('controller' => 'genres', 'action' => 'show_video', 5, 'admin' => false));?>
        </li>
        <li>
        <?php echo $this->Html->link('More...', array('controller' => 'genres', 'action' => 'show_all', 'admin' => false));?>
        </li>
      </ul>
    </div>    
    <div id="top_panel">
      <?php
        if (isLoggedIn($this)) {
          $user = getUser($this);
      ?>
      <span class="welcome">Welcome</span> <a href="#" class="user"><?php echo $user['User']['username'];?></a>
      
      <?php echo $this->Html->link('Log out', array('controller' => 'users', 'action' => 'logout', 'admin' => false), array('id' => 'login_btn'));?>      
      <?php
        }
        else {
      ?>
      
      <span class="welcome">Welcome</span>
      <?php echo $this->Html->link('Log in', array('controller' => 'users', 'action' => 'login', 'admin' => false), array('id'=>'login_btn'));?>
      <?php    
        }
      ?>
    
    
    <ul id="dropdown_menu">
        <?php
          if (!isLoggedIn($this)) {
            ?>
        <li><?php echo $this->Html->link('Register', array('controller' => 'users', 'action' => 'register', 'admin' => false));?>      </li>
        <?php
      }
        ?>
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
		<h1><?php echo $title; ?></h1>
		<div id="maincontentholder">
		
		<?php echo $content_for_layout ?>
    	</div>
        <div class="bottom"></div>
    </div>
    
    <div id="sidebar">
    
    <div id="most_viewed_panel">
      <h1>Most viewed</h1>
      <ul>
        <?php
        $i = 0;
        if (isset($top10) && $top10) {
          foreach ($top10 as $video) {
            echo '<li style="margin-left: 15px; margin-top:2px;">';
            $i++;
            echo $this->Html->link(' '.$i.'. '.$video['Video']['name'], array('controller'=>'videos', 'action' => 'show', $video['Video']['id']));
            echo '</li>';
          }
        }
        
        ?>
      </ul>
      
    </div>
    
    <?php
      if (isAdmin($this)) {
    ?>
    <div id="user_panel" class="admin_panel">
    	<h1>Admin Panel</h1>
        <ul>
          <?php
            echo $this->Html->link('Genres', array('controller' => 'genres', 'action' => 'index', 'admin' => true));
          ?>
          
        </ul>
        <ul>
          <?php
            echo $this->Html->link('Movies', array('controller' => 'videos', 'action' => 'index', 'admin' => true));
          ?>
          
        </ul>
        <ul>
          <?php
            echo $this->Html->link('Actors', array('controller' => 'actors', 'action' => 'index', 'admin' => true));
          ?>
          
        </ul>
        <ul>
          <?php
            echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'index', 'admin' => true));
          ?>
          
        </ul>
        <ul>
          <?php
            echo $this->Html->link('Reports', array('controller' => 'queues', 'action' => 'index', 'admin' => true));
          ?>
          
        </ul>
        <ul>
          <?php
            echo $this->Html->link('Comments', array('controller' => 'comments', 'action' => 'index', 'admin' => true));
          ?>
          
        </ul>
    </div>
    <?php
    }
    ?>
    
    <?php
      if (isLoggedIn($this)) {
    ?>
    <div id="user_panel">
    	<h1>User Panel</h1>
        <ul>
          <?php echo $this->Html->link('Profile', array('controller' => 'users', 'action' => 'edit_profile', 'admin' => false));?>
        </ul>
        <ul>
    	<?php echo $this->Html->link('Change password', array('controller' => 'users', 'action' => 'change_password', 'admin' => false));?>      
        </ul>
        <ul>
          <?php echo $this->Html->link('My videos', array('controller' => 'users', 'action' => 'my_movies', 'admin' => false));?>
        </ul>
        <ul>
          <?php echo $this->Html->link('History', array('controller' => 'users', 'action' => 'history', 'admin' => false));?>
        </ul>
        <ul>
          <?php echo $this->Html->link('Get help', array('controller' => 'users', 'action' => 'help', 'admin' => false));?>
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
