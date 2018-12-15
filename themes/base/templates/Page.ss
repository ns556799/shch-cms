<!DOCTYPE html>
<html class="no-js">
<head>
	<% include HTMLHead %>
</head>
<body class="ss-$ClassName.LowerCase<% if $isDebugMode %> -debug<% end_if %>">
	<% include Header %>
	$Layout
	<% include Footer %>
	<% include Scripts %>
$renderCookie
</body>
</html>
