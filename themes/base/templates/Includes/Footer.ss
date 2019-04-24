<footer class="footer">
  <div class="wrap">

    <div class="footer-wrapper">
      <div class="footer-contact">
        <div class="footer-item__home">
          <img class="footer-icon__home" src="$ThemeDir/dist/static/img/home-solid.svg" alt="">
          <span>
      Sussex House <br>
      36 Prince's Rd <br>
      Cleethorpes <br>
      DN35 8AW
      </span>
        </div>

        <div class="footer-item__phone">
          <img class="footer-icon__phone" src="$ThemeDir/dist/static/img/phone-solid.svg" alt="">
          <a href="tel:$SiteConfig.AdminPhone">$SiteConfig.AdminPhone</a>
        </div>

        <div class="footer-item__mail">
          <img class="footer-icon__mail" src="$ThemeDir/dist/static/img/envelope-solid.svg" alt="">
          <a href="mailto:$SiteConfig.AdminEmail?Subject=More%20Information%20About%20Sussex%20House"
             target="_top">$SiteConfig.AdminEmail</a>
        </div>
        <div class="footer__copy">
          <p>&copy; $Now.Format(Y) $SiteConfig.Title</p>
        </div>
      </div>

      <div class="footer-award">
        <img src="$ThemeDir/dist/static/img/nelccgbronze.png" alt="">
      </div>
    </div>
  </div>
</footer>
