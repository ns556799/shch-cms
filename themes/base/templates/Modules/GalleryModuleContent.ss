<% if Content %>
	<div class="typ">
		$Content
	</div>
<% end_if %>
<% if getUploadedImages(leaderboard) %>
	<div class="gals">
		<% loop getUploadedImages(leaderboard) %>
			<div class="gal">
				<a class="gal__img" href="/gallery/viewimage/$ID/$Title">
					<span class="gal__pos">{$Pos}</span>
					<img src="$UploadedImage.CroppedImage(165,165).URL" alt="$Description">
					<span class="gal__overlay"><em class="gal__count"><br>$VoteCount</em> Votes</span>
				</a>
				<p class="gal__cnt">
					<%-- with $Member %>
                        <strong>$FirstName $Surname</strong><br>
                    <% end_with --%>
					<strong>$Title</strong><br>
					<em>$VoteCount Votes</em><br>
					$Location
				</p>
			</div>
		<% end_loop %>
	</div>
<% end_if %>
<% if Content2 %>
	<div class="typ">
		$Content2
	</div>
<% end_if %>