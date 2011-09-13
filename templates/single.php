<?php require 'header.php'; ?>
      <article class="post single">
        <div class="post-meta">
          <?php post_data('title'); ?>
          <div class="date"><?php post_data('date'); ?></div>
        </div>
        <div class="post-body">
          <?php post_data('content'); ?>
        </div>
      </article>

      <div id="disqus_thread"></div>
      <script type="text/javascript">
          var disqus_shortname = 'alexblackie';
          var disqus_developer = true;
          (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
          (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
          })();
      </script>


<?php require 'footer.php'; ?>
