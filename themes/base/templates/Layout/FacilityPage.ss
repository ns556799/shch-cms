<div gy="wrap">
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
</div>
