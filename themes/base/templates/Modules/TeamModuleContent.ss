<% if Content %>
	<div class="typ">
		$Content
	</div>
<% end_if %>
<% if getTeamMembers %>
	<div class="teams">
		<% loop getTeamMembers %>
			<div class="team">
				<%--a href="$UploadedImage.URL" target="_blank"><img src="$UploadedImage.SetRatioSize(390,390).URL" alt="" class="img-responsive"></a--%>
				<% if MainImage %>
					<a href="$Link" class="team__img"><img src="$MainImage.CroppedImage(165,165).URL" alt=""></a>
				<% else %>
					<a href="$Link" class="team__img"><img src="$ThemeDir/img/token/token-165x165.jpg" alt=""></a>
				<% end_if %>

				<p class="team__cnt">
					<strong>$FirstName $Surname</strong><br/>
					$JobTitle<br/>
					<% if getTagList(TagRegion) %><em>$getTagList(TagRegion, ", ")</em><br/><% end_if %>
					<% if getTagList(TagTeam) %><em>$getTagList(TagTeam, ", ")</em><br/><% end_if %>
					<a href="$Link">View profile</a>
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