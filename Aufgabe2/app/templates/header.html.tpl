<header class="page-header fixed-panel">
	<div class="container">
		
		<!-- Logo -->
		<h1 class="logo">
			<a href="#about">Supero Un.Ltd</a>
		</h1>
		
		<!-- Main Menu -->
		<nav class="main-menu">
			<ul>
				<li> 
					<select style="clear: both;" name="held_selection" title="Helden Auswahl" onchange="location = '#' +this.options[this.selectedIndex].value;">
						<option value="">Helden Steckbriefe</option>
						<% for (var hero_id in heroes) { %>
						<% var hero = heroes[hero_id]; %>
						<% var disabled = (hero.has_info_page ? "" : "disabled"); %> 
						<% if (disabled) continue; %>
						<option value="<%= hero_id %>" <%=disabled%>><%= hero.name %></option>
						<% } %>
					</select>
				</li>
				<li> 
					<a href="#hereos">Helden</a>
				</li>
				<li>
					<a href="#prices">Preise</a>
				</li>
				<li>
					<a href="#order">Ordern</a>
				</li>
				<li>
					<a href="#faq">Faq</a>
				</li>
				<li>
					<a href="#impressum">Impressum</a>
				</li>
			</ul>
		</nav>
	<div>
</header>
