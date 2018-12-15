<% if Content %>
	<div class="typ">
		$Content
	</div>
<% end_if %>
<div class="docs">
	<% loop getListItems %>
		<div class="doc">
			<% if MainImage %>
				<a href="$Link">
					<img src="$MainImage.CroppedImage(165,240).URL" class="doc__img">
				</a>
			<% end_if %>
			<h5 class="doc__title">$Title</h5>
			$ShortDescription
			<p><a href="$Link">Read more</a></p>
		</div>
	<% end_loop %>
</div>
<% if Content2 %>
	<div class="typ">
		$Content2
	</div>
<% end_if %>