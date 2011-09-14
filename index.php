<?php

/*
 * This is where the magic happens. 
 */

/* Uncomment in development
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
*/

// Include the Markdown Converter
include_once "app/markdown.php";
// And the configutation
include_once "app/config.php";

if(isset($_GET['q'])){
  $url = $_GET['q'];
  $url = rtrim($url, '/');
} else {
  // URL not passed (homepage)
  $url = "index";
}
$url = explode('/', $url);

// debug: print_r($url);

if(isset($url[1]))
  $file = 'data/' . $url[0] . '/' . $url[1] . '.md';
else
  $file = NULL;
  
$pagepath = 'data/pages/' . $url[0] . '.md';

if($url[0] == "index"){
  // If it's the homepage
   function post_data($what, $file){
    $data = file_get_contents($file); // read the file
    $convert = explode("\n", $data); // create array separate by new line

    if($what == "title_clean"){
      print substr($convert[0], 2);
    } elseif($what == "title"){
      print Markdown($convert[0]);
    } elseif($what == "date"){
        print substr($convert[1], 8);
    } elseif($what == "content") {
      for ($i=3;$i<count($convert);$i++) {
        print Markdown($convert[$i]);
      }
    } elseif($what == "excerpt"){
      echo "<p>" . Markdown($convert[3]) . "</p>";
    }
  }
  function list_posts(){
    // path to data directory 
    $directory = "data/articles/";
 
    // get all the markdown files.
    $articles = glob($directory . "*.md");
    natsort($articles);
    $articles = array_reverse($articles, true);
     

    foreach($articles as $post){
      $post_slug = substr($post, 5);
      $post_slug = substr($post_slug, 0, -3);
?>

<article class="post">
  <div class="post-meta">
    <h1><a href="<?php echo $post_slug; ?>"><?php post_data('title_clean', $post); ?></a></h1>
    <div class="date"><?php post_data('date', $post); ?></div>
  </div>
  <div class="post-excerpt">
    <?php post_data('excerpt', $post); ?>
    <p class="read-more-link"><a href="<?php echo $post_slug; ?>">Read More &rarr;</a></p>
  </div>
</article>

<?php
    }

  }
  require 'templates/index.php';

} else {
  // If not homepage

  if(file_exists($file)){
    // If we can open the file
    $data = file_get_contents($file); // read the file
    $convert = explode("\n", $data); // create array separate by new line

    function post_data($what){
      global $convert;
      global $file;

      if($what == "title_clean"){
        print substr($convert[0], 2);
      } elseif($what == "title"){
        print Markdown($convert[0]);
      } elseif($what == "date"){
        print substr($convert[1], 8);
      } elseif($what == "content") {
        for ($i=2;$i<count($convert);$i++) {
          print Markdown($convert[$i]);
        }
      }
    }
 
    require 'templates/single.php';

  } elseif(file_exists($pagepath)){
    // If not a blog post, maybe a page?
    
    $data = file_get_contents($pagepath); // read the file
    $convert = explode("\n", $data); // create array separate by new line
    
    function post_data($what){
      global $convert;
      
      if($what == "title_clean"){
        print substr($convert[0], 2);
      } elseif($what == "title"){
        print Markdown($convert[0]);
      } elseif($what == "content") {
        for ($i=1;$i<count($convert);$i++) {
          print Markdown($convert[$i]);
        }
      }
    }
    
    require 'templates/page.php';
  
  } else {
    // Can't open file
    header('HTTP/1.0 404 Not Found'); //Send 404 to browser/crawlers
    readfile('templates/404.php'); // Load 404 template
  }
}
