<?php require 'header.php'; ?>
      <article class="post page">
        <div class="post-meta">
          <?php post_data('title'); ?>
        </div>
        <div class="post-body">
          <?php post_data('content'); ?>
        </div>
      </article>
<?php require 'footer.php'; ?>
