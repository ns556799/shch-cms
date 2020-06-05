
<div gy="wrap">
  <div class="facilities-wrapper">
    <div class="facilities__title">
      <h1> $Title </h1>
    </div>
    <div class="facilities__content">
      $Content
    </div>
  </div>
  <div class="tabItems js-tabs">
    <div class="tabItem__container">
      <% loop $FacilityItems %>
        <div class="tabItem__title <% if $Pos = 1 %>-first<% end_if %>" data-id="$ID">
          $Title
        </div>
      <% end_loop %>
    </div>
    <div class="tabContent__container">
      <% loop $FacilityItems %>
        <div class="tabItem__content <% if $Pos = 1 %>-first<% end_if %>" data-id="$ID">
          $Content
        </div>
      <% end_loop %>
    </div>
  </div>
  <div class="facilities-slider js-facilities-slider">
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <% loop $FacilityImages %>
          <div class="swiper-slide">
            <div class="facilities-img" style="background-image: url('$CroppedImage(1920,1080).URL')">
            </div>
          </div>
        <% end_loop %>
      </div>
      <div class="swiper-pagination"></div>

      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-scrollbar"></div>
    </div>
  </div>
</div>
