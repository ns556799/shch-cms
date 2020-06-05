<div class="about-container">
  <div class="wrap">
    <div class="about-title">
      <h1>
        $Title
      </h1>
    </div>
    <div class="about-gallery">
      <div class="swiper-container js-about-gallery">
        <div class="swiper-wrapper">
          <% loop $GalleryImages %>
            <div class="swiper-slide">
              <div class="about-gallery__item" style="background-image: url('$URL')">

              </div>
            </div>
          <% end_loop %>
        </div>
      </div>
    </div>
    <div class="about-content__one typ">
      $Content
    </div>

    <div class="about-content__two typ">
      $Content2
    </div>
    <div class="about-services">
      <div class="about-services__title">
        <h3>
          Services
        </h3>
      </div>
      <div class="about-services__wrapper">
        <% loop $ServiceItems %>
          <div class="about-service__title">
           <strong>
             $Title
           </strong>
          </div>
          <div class="about-services__service">
            $Service
          </div>
        <% end_loop %>
      </div>
    </div>
  </div>
</div>
