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
								<td>
									<a href="#<%=hero_id %>">
										<img src="<%=hero.image_url %>" alt="<%=hero.name %>">
									</a>		
								</td>
								<td><%=hero.name %></td>
								<td><%=hero.price_per_hour %> €</td>
							</tr>
						<% } %>
					</tbody>
				</table>
			</article>
			<article id="order" class="clearfix">
				<h3>Ordern</h3>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<form class="formLayout">
						<fieldset>
	      			<legend>Helden Ordern</legend>
							<label for="hero_id">Held</label>
							<select name="hero_id" required>
									<option value="">Bitte wählen</option>
								<% for (var hero_id in heroes) { %>
								<% var hero = heroes[hero_id]; %>
									<option value="<%=hero_id %>"><%=hero.name %></option>
								<% } %>
							</select>
						
							<label for="requested_tasks">Gewünschte Arbeiten</label>
							<textarea name="requested_tasks" required></textarea>
					
							<label for="user_email">Email</label>
							<input type="email" name="user_email" required></input>
					
							<label for="special_requests">Sonderwünsche</label>
							<textarea name="special_requests"></textarea>
							<div class="buttons">
								<button type="reset">Eingaben zurücksetzen</button>
	    					<button type="submit">Eingaben absenden</button>
	    				</div>
    				</fieldset>
				</form>
			</article>

			<article id="faq">
				<h3>Faq</h3>
				<ol class="faq">
					<li>
						<p>Savant engine fluidity wristwatch motion ?</p>
						
						<p>
						Savant engine fluidity wristwatch motion stimulate computer sensory paranoid j-pop apophenia drone corrupted sunglasses wonton soup assault. Weathered shanty town rebar futurity long-chain hydrocarbons sub-orbital claymore mine assault nodality. Voodoo god silent weathered spook DIY narrative table. DIY vehicle chrome-ware bridge gang man apophenia lights 8-bit network kanji numinous.
						</p>
					</li>
					<li>
						<p>long-chain hydrocarbons ?</p>
						<p>
						Savant engine fluidity wristwatch motion stimulate computer sensory paranoid j-pop apophenia drone corrupted sunglasses wonton soup assault. Weathered shanty town rebar futurity long-chain hydrocarbons sub-orbital claymore mine assault nodality. Voodoo god silent weathered spook DIY narrative table. DIY vehicle chrome-ware bridge gang man apophenia lights 8-bit network kanji numinous.
						</p>
					</li>
				</ol>
			</article>

			<article id="impressum">
				<h3>Impressum</h3>
				<p>
				Anbieterkennzeichung nach § 5 TMG (Telemediengesetz) 
				</p>
				<table class="impressum" border="0" cellspacing="4" cellpadding="0">
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
						<td>Geschäftsleitung:</td>
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

			<!-- Scrapped from http://marvel.com/characters -->
			</article>
			<article>
		    <h3 id="thor">
		        <a>Thor</a> 
		    </h3>
		    <p>
		     	As the Norse God of thunder and lightning, Thor wields one of the greatest weapons ever made, the enchanted hammer Mjolnir.
		    While others have described Thor as an over-muscled, oafish imbecile, he's quite smart and compassionate.  He's self-assured, and he would never, ever stop fighting for a worthwhile cause.
		    </p>
		                     
		   	<h4>Character Info</h4>           
	      
	      <div><strong>Real Name</strong> <p>Thor Odinson</p></div> 
	      
	      <div><strong>Height</strong> <p>6'6"; (Blake) 5’9" </p></div>
	      
	      <div><strong>Weight</strong> <p>640 lbs; (Blake) 150 lbs.</p></div>
	      
	      <div><strong>Powers</strong> <p>As the son of Odin and Gaea, Thor's strength, endurance and resistance to injury are greater than the vast majority of his superhuman race. He is extremely long-lived (though not completely immune to aging), immune to conventional disease and highly resistant to injury. His flesh and bones are several times denser than a human's.As Lord of Asgard, Thor possessed the Odinforce, which enabled him to tap into the near-infinite resources of cosmic and mystical energies, enhancing all of his abilities. With the vast magical power of the Odinforce, Thor was even able to dent Captain America’s virtually indestructible shield with Mjolnir.Thor complete powers, Click here for complete list of Thor's powers</p></div>
	      
	      <div><strong>Abilities</strong> <p><span>Thor is trained in the arts of war, being a superbly skilled warrior, highly proficient in hand-to-hand combat, swordsmanship and hammer throwing.</span></p></div>
	      
	      <div><strong>Group Affililations </strong>
		     <p><span>Gods of Asgard, Avengers; formerly Queen’s Vengeance, Godpack, Thor Corps</span></p></div>
    	</article>

    	<article>
		    <h3 id="spiderman">
		        <a>SPIDER-MAN</a> 
		    </h3>
		    <p>
		     Bitten by a radioactive spider, high school student Peter Parker gained the speed, strength and powers of a spider. Adopting the name Spider-Man, Peter hoped to start a career using his new abilities. Taught that with great power comes great responsibility, Spidey has vowed to use his powers to help people.
		    </p>
		                     
		   	<h4>Character Info</h4>           
	      
	      <div><strong>Real Name</strong> <p>Peter Benjamin Parker</p></div> 
	      
	      <div><strong>Height</strong> <p> 5'10"</p></div>
	      
	      <div><strong>Weight</strong> <p>167 lbs.</p></div>
	      
	      <div><strong>Powers</strong> <p>Peter can cling to most surfaces, has superhuman strength (able to lift 10 tons optimally) and is roughly 15 times more agile than a regular human. The combination of his acrobatic leaps and web-slinging enables him to travel rapidly from place to place. His spider-sense provides an early warning detection system linked with his superhuman kinesthetics, enabling him the ability to evade most any injury, provided he doesn't cognitively override the autonomic reflexes. Note: his power enhancements through his transformation by the Queen and after battling Morlun - including his organic web glands and stingers - have been undone after Spider-Man's deal with Mephisto.</p></div>
	      
	      <div><strong>Abilities</strong> <p><span> Peter is an accomplished scientist, inventor and photographer.</span></p></div>
	      
	      <div><strong>Group Affililations </strong>
		     <p><span>Avengers, formerly the Secret Defenders, "New Fantastic Four", the Outlaws</span></p></div>
    	</article>

    	<article>
		    <h3 id="hulk">
		        <a>HULK</a> 
		    </h3>
		    <p>
		    Caught in a gamma bomb explosion while trying to save the life of a teenager, Dr. Bruce Banner was transformed into the incredibly powerful creature called the Hulk. An all too often misunderstood hero, the angrier the Hulk gets, the stronger the Hulk gets.
		    </p>
		                     
		   	<h4>Character Info</h4>           
	      
	      <div><strong>Real Name</strong> <p>Robert Bruce Banner</p></div> 
	      
	      <div><strong>Height</strong> <p>5' 9½" (Banner); 6'6" (gray Hulk); 7' – 8' (green/savageHulk); 7'6" (green/Professor Hulk)</p></div>
	      
	      <div><strong>Weight</strong> <p>128 lbs. (Banner); 900 lbs. (gray Hulk); 1,040 – 1,400 lbs.(green/savage Hulk); 1,150 lbs. (green/Professor Hulk)</p></div>
	      
	      <div><strong>Powers</strong> <p>The Hulk possesses an incredible level of superhuman physical ability. His capacity for physical strength is potentially limitless due to the fact that the Hulk's strength increases proportionally with his level of great emotional stress, anger in particular. The Hulk uses his superhumanly strong leg muscles to leap great distances. The Hulk has been known to cover hundreds of miles in a single bound and once leaped almost into orbit around the Earth. The Hulk can also use his superhumanly leg muscles to run at super speeds, although his legs have limitless strength he does not have limitless speed and once he reaches a certain speed his legs become too strong and destroy the ground giving him no friction to run on, therefore he jumps to travel. The Hulk can slam his hands together creating a shock wave, this shock wave can deafen people, send objects flying and extinguish fires. His thunderclap has been compared to hurricanes and sonic booms. The Hulk has shown a high resistance to physical damage nearly regardless of the cause, and has also shown resistance to extreme temperatures, mind control, nuclear explosions, poisons, and all diseases. In addition to the regeneration of limbs, vital organs, and damaged or destroyed areas of tissue at an amazing rate. The Hulk also has superhuman endurance.The Hulk's body also has a gland that makes an "oxygenated per fluorocarbon emulsion", which creates pressure in the Hulk's lungs and effectively lets him breathe underwater and move quickly between varying depths without concerns about decompression or nitrogen narcosis.</p></div>
	      
	      <div><strong>Abilities</strong> <p><span>Dr. Bruce Banner is a genius in nuclear physics, possessing a mind so brilliant that it cannot be measured on any known intelligence test. When Banner is the Hulk, Banner's consciousness is buried within the Hulk's, and can influence the Hulk's behavior only to a very limited extent.</span></p></div>
	      
	      <div><strong>Group Affililations </strong>
		     <p><span>Formerly Avengers, Defenders, Fantastic Four, Pantheon, Horsemen of Apocalypse, Warbound</span></p></div>
    	</article>
			</div>
		</section>
	</div>
</div>