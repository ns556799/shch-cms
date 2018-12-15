<% if Content %>
	<div class="typ">
		$Content
	</div>
<% end_if %>
<% loop getBlocks %>
	<% if First %>
		<div class="blocks">
	<% end_if %>
		<div class="block">
			<% if MainImage %>
				<a href="$Link">
					<img class="block__img" src="$MainImage.CroppedImage(110,110).URL" alt="$Name">
				</a>
			<% end_if %>
			<div class="block__cnt">
				<div class="typ">
					$Content
				</div>
				<% if SelectedPageLink %>
					<a href="$SelectedPageLink.Link">
						<% if CTAText %>$CTAText<% else %>Find out more<% end_if %>
					</a>
				<% end_if %>
			</div>
		</div>
	<% if Last %>
		</div>
	<% end_if %>
<% end_loop %>

<% if Content2 %>
	<div class="typ">
		$Content2
	</div>
<% end_if %>