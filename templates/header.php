<!DOCTYPE html>
<html>
  <head>
    <title><?php if(isset($isindex)): echo __SITESLOGAN__; else: post_data('title_clean'); endif; ?> | <?php echo __SITENAME__; ?></title>
    <meta charset="UTF-8">  
    <link rel="stylesheet" href="<?php echo __SITEPATH__; ?>/templates/default.css" type="text/css">
  </head>
  <body>
    <div class="wrap">
      <header>
        <h1 id="sitename"><a href="<?php echo __SITEPATH__; ?>/"><?php echo __SITENAME__; ?></a></h1>
        
        <!-- For now, hard-code your menu into `templates/header.php`, but we're working on a more elegant solution. -->
        
        <nav id="mainmenu">
          <ul>
            <li><a <?php if($url[0] == "index"): ?>class="current" <?php endif;?>href="<?php echo __SITEPATH__; ?>/">Blog</a></li>
            <li><a <?php if($url[0] == "about"): ?>class="current" <?php endif;?>href="<?php echo __SITEPATH__; ?>/about">About</a></li>
          </ul>
        </nav>
      </header>
      <div id="content">
