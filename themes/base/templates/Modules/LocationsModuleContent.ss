<% if isLoggedIn %>
	<% with getUploadImagesPage %>
		<div class="anchored">
			<a href="$Link" id="upload_entry">Submit your entry</a>
		</div>
	<% end_with %>
<% else %>
	<% with getMemberProfilePage %>
		<div class="anchored">
			<a href="$Link" id="upload-entry">Submit your entry</a>
		</div>
	<% end_with %>
<% end_if %>
<div id="map" style="height:530px; width:100%"></div>
<script>
	//<% if ShowImageLocations %>
	var images = [
		//<% loop getUploadedImage %>
			["$Title",$Lat,$Lng, "$UploadedImage.CroppedImage(150,160).URL",$ID]/*<% if not Last %>*/, /*<% end_if %>*/
			//<% end_loop %>
	]
	//<% end_if %>
	//<% if ShowOfficeLocations %>
	var offices = [
		//<% loop getOfficesGlobal %>
			["$Name",$Lat, $Lng]/*<% if not Last %>*/, /*<% end_if %>*/
			//<% end_loop %>
	]
	//<% end_if %>
</script>