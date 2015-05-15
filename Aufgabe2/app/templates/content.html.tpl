<div class="content">	
	<div class="slogan clearfix">
		<div class="container">
			<h2>Wir haben auch den passenden Helden für Sie.</h2>
		</div>
	</div>

	<div class="container">

		<section name="home">
			
			<article>
				<h3>Über uns</h3>
				<p>
				Savant engine fluidity wristwatch motion stimulate computer sensory paranoid j-pop apophenia drone corrupted sunglasses wonton soup assault. Weathered shanty town rebar futurity long-chain hydrocarbons sub-orbital claymore mine assault nodality. Voodoo god silent weathered spook DIY narrative table. DIY vehicle chrome-ware bridge gang man apophenia lights 8-bit network kanji numinous.
				</p>
				<p>
				Savant engine fluidity wristwatch motion stimulate computer sensory paranoid j-pop apophenia drone corrupted sunglasses wonton soup assault. Weathered shanty town rebar futurity long-chain hydrocarbons sub-orbital claymore mine assault nodality. Voodoo god silent weathered spook DIY narrative table. DIY vehicle chrome-ware bridge gang man apophenia lights 8-bit network kanji numinous.
				</p>
			</article>
			
			<article>
				<h3>Unsere Helden</h3>

				<div class="hero-gallery">
					<% for (var hero_id in heroes) { %>
					<% var hero = heroes[hero_id]; %>
					<div class="hero-gallery-item">
						<figure>
							<a href="#<%= hero_id %> ">
								<div class="hero-gallery-item-border"></div>
								<img src="<%=hero.image_url %>" alt="<%=hero.name %>">
							</a>
							<figcaption>
								<h5><%=hero.name %></h5>
							</figcaption>
						</figure>
						</div>
						<% } %>
					</div>
			</article>
		
		</section>
	</div>
</div>