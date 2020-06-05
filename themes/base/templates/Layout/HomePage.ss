<div class="banner-container js-banner">
  <div class="swiper-container">
    <div class="swiper-wrapper">
      <% loop $BannerImages %>
        <div class="swiper-slide">
          <div class="banner-slide" style="background-image: url('$URL')"></div>
        </div>
      <% end_loop %>
    </div>
  </div>
</div>

<div gy="wrap">
  <div gy="g">
    <div gy="c">
      <div class="homepage-copy">
        $Content
      </div>
    </div>
  </div>
</div>


