<div class="team-hero" style="background-image: url('$MainImage.URL')">

</div>

<div class="team-container" gy="g">
  <div class="wrap">
    <div class="team-container__wrapper">
      <div class="team-title" gy="g">
        <h2>$Title</h2>
      </div>
      <div class="team-content" gy="g">
        $Content
      </div>
    </div>

    <div class="team-member__wrapper js-team-member" gy="g">

      <% loop $TeamMembers %>
        <div gy="cs-6 cm-4">
          <div class="team-member-item" data-id="$ID">
            <img src="$MainImage.URL" alt="$MainImage.Name">
            <div class="team-member-item__content">
              <div class="team-member-item__title">
                $Title
              </div>
              <div class="team-member-item__position">
                $Position
              </div>
              <div class="team-member-item__main-content">
                $Content
              </div>
            </div>
          </div>
        </div>
      <% end_loop %>

    </div>
  </div>
</div>



<%--
<% loop $TeamMembers %>

  $Title
  <img src="$MainImage.URL" alt="$MainImage.Name">

<% end_loop %>
--%>
