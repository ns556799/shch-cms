<% if Content %>
	<div class="typ">
		$Content
	</div>
<% end_if %>
<div class="infos">
	<% loop getListItems %>
		<div class="info">
			<div class="info__img">
				<% if MainImage || AltMainImage %>
					<% if MainImage %><img src="$MainImage.URL" class="info__img-primary"><% end_if %>
					<% if AltMainImage %><img src="$AltMainImage.URL" class="info__img-alt"><% end_if %>
				<% else %>
					<img src="$ThemeDir/images/tokens/token_165x165.jpg" class="info__img-primary">
				<% end_if %>
			</div>
			<div class="info__content">
				<h4 class="info__title">$Title</h4>
				<p>$Content</p>
			</div>
		</div>
	<% end_loop %>
</div>
<% if Content2 %>
	<div class="typ">
		$Content2
	</div>
<% end_if %>