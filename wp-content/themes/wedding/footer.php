      </section>

      <?php if ( !is_front_page() ) : ?>
        <footer class="footer">
          <p>
            &copy; <?php echo date("Y"); ?> Danielle Hendrix &amp; Jacob Dubail. All rights reserved. Photo credit: <a href="http://andrialindquistblog.com/">Andria Lindquist</a>
          </p>
        </footer>
      <?php endif; ?>

    </div>

  </div>

<?php if ( is_front_page() ) : ?>
  <footer class="footer">
    <p>
      &copy; <?php echo date("Y"); ?> Danielle Hendrix &amp; Jacob Dubail. All rights reserved. Photo credit: <a href="http://andrialindquistblog.com/">Andria Lindquist</a>
    </p>
  </footer>
<?php endif; ?>

<?php wp_footer(); ?>

<script>

  var _gaq=[['_setAccount','UA-7871373-6'],['_trackPageview']];
  (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
  g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
  s.parentNode.insertBefore(g,s)}(document,'script'));

</script>

</body>
</html>