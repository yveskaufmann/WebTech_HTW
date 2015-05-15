<div id="about" class="content">	
	<div class="slogan clearfix">
		<div class="container">
			<h2>Wir haben auch den passenden Helden für Sie.</h2>
		</div>
	</div>

	<div class="container">

		<section>
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
					<h3 id="hereos">Unsere Helden</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

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
					<div>
			</article>


			<article id="prices">
				<h3>Preise</h3>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<table class="price-list">
					<thead>
						<tr>
							<th>Foto</th>
							<th>Name</th>
							<th>Preise/Stunde</th>
						</tr>
					</thead>
					<tbody>
						<% for (var hero_id in heroes) { %>
						<% var hero = heroes[hero_id]; %>
							<tr>
								<td><img src="<%=hero.image_url %>" alt="<%=hero.name %>"></td>
								<td><%=hero.name %></td>
								<td><%=hero.price_per_hour %> €</td>
							</tr>
						<% } %>
					</tbody>
				</table>
			</article>
			<article id="order" class="clearfix">
				<h3>Ordern/Kontakt</h3>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<form class="formLayout">
					
						<label for="hero_id">Held</label>
						<select name="hero_id">
								<option value="">Bitte wählen</option>
							<% for (var hero_id in heroes) { %>
							<% var hero = heroes[hero_id]; %>
								<option value="<%=hero_id %>"><%=hero.name %></option>
							<% } %>
						</select>
					
						<label for="requested_tasks">Gewünschte Arbeiten</label>
						<textarea name="requested_tasks"></textarea>
				
						<label for="user_email">Email</label>
						<input type="email" name="user_email"></input>
				
						<label for="special_requests">Sonderwünsche</label>
						<textarea name="special_requests"></textarea>
					
						<button type="reset">Eingaben zurücksetzen</button>
    				<button type="submit">Eingaben absenden</button>
				</form>
			</article>

			<article id="faq">
				<h3>Faq</h3>
				<p>
				Savant engine fluidity wristwatch motion
				</p>
				<p>
				Savant engine fluidity wristwatch motion stimulate computer sensory paranoid j-pop apophenia drone corrupted sunglasses wonton soup assault. Weathered shanty town rebar futurity long-chain hydrocarbons sub-orbital claymore mine assault nodality. Voodoo god silent weathered spook DIY narrative table. DIY vehicle chrome-ware bridge gang man apophenia lights 8-bit network kanji numinous.
				</p>
			</article>

			<article id="impressum">
				<h3>Impressum</h3>
				<p>
				Anbieterkennzeichung nach § 5 TMG (Telemediengesetz) 
				</p>
				<table border="0" cellspacing="4" cellpadding="0">
					<tr>
						<td>Anschrift:</td>
						<td>
							Supero Un Limited<br>
							Consumer Comunications / Supero Un.Ltd<br>
							Wilhelminenhofstraße 75A, 12459 Berlin<br>
							Telefon: (030) 5019 - 0<br>
							<a href="mailto:support@superoun.com">
								support@superoun.com
							</a><br>
						</td>
					</tr>
					<tr>
						<td>Allgemeine Geschäftsbedingungen:</td>
						<td>
							<a href="http://de.ejo.ch/wp-content/uploads/2010/03/affe.jpg" target="_blank">hier herunterladen</a>
						</td>
					</tr>
					<tr>
						<td>Geschäftsleitung:<td>
						<td>Max Mustermann</td> 
					</tr>
				</table>

				<h4>Haftungshinweis</h4>
				<p>Die Inhalte externer Links werden von uns nicht geprüft. Sie unterliegen der Haftung der jeweiligen Anbieter. Für die Richtigkeit, Vollständigkeit und Aktualität der bereit gestellten Informationen übernimmt der Anbieter keine Haftung.</p>
				<br>
				<h4>Datenschutzhinweise</h4>
				<p>Alle auf dieser Website genannten Personen widersprechen hiermit jeder kommerziellen Verwendung und Weitergabe ihrer Daten (vgl. § 28 Bundesdatenschutzgesetz). </p>

				<h4>Urheberrechtshinweise:</h4>
				<p>Alle auf dieser Website veröffentlichten Beiträge und Abbildungen sind urheberrechtlich geschützt. Jede vom Urheberrechtsgesetz nicht zugelassene Nutzung bedarf vorheriger schriftlicher Zustimmung der Anbieter. Dies gilt insbesondere für Vervielfältigung, Bearbeitung, Übersetzung, Einspeicherung, Verarbeitung bzw. Wiedergabe von Inhalten in Datenbanken oder anderen elektronischen Medien und Systemen.<p>


			</article>

			</div>
		</section>
	</div>
</div>