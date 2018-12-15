<% if getModulesFolder %>
	<% with getModulesFolder %>
		<% loop AllChildren %>
			<section class="module $CustomClassName.LowerCase $ModuleClasses.LowerCase" <% if ModuleBackground %>
			         style="background-color:{$ModuleBackground}"<% end_if %>>
				<div class="wrap">$RenderModule</div>
			</section>
		<% end_loop %>
	<% end_with %>
<% end_if %>