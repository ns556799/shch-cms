<nav class="nav-mains">
	<ul class="nav-main">
		<% loop $Menu(1) %>
			<li class="nav-main__item $LinkingMode">
				<a class="nav-main__link $LinkingMode" href="$Link"> $MenuTitle.XML </a>
			</li>
		<% end_loop %>
	</ul>
</nav>