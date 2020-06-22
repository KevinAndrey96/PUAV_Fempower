<footer class="footer">
  <?php
  if (!empty($_SESSION)) {
    ?>
    <!-- Cookie Consent by https://www.TermsFeed.com -->
    <script type="text/javascript" src="//www.termsfeed.com/public/cookie-consent/3.0.0/cookie-consent.js"></script>
    <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function () {
        cookieconsent.run({"notice_banner_type": "interstitial", "consent_type": "express", "palette": "light", "language": "es", "website_name": "https://www.fempower.com.co/"});
      });
    </script>
    <noscript>Cookie Consent by <a href="https://www.TermsFeed.com/cookie-consent/">Cookie Consent by TermsFeed</a></noscript>
    <!-- End Cookie Consent -->
    <?php
  }
  ?>
  <script type="text/javascript">

    function session_checking()
    {
      $.post("session.php", function (data) {
        if (data == "-1")
        {
          //alert("Su sesión ha expirado!");
          header("Location: logout.php");
        }
      });
    }
    var validateSession = setInterval(session_checking, 1000);

  </script>
</footer>
