(function(window) {
	var baseTitle = window.document.title;
	var updateTitle = function(event) {
		var hash = window.	location.hash;
		var title = window.document.title;
		var dashPos = title.indexOf('|');

		if ( dashPos >= 0  ) {
			title = title.slice(dashPos + 2);
		} 
		console.info(hash);
		if(hash != '') {
			var hashes =  {
				'#about': '',
				'#hereos': 'Helden | ',
				'#prices': 'Preise | ',
				'#order' : 'Helden ordern | ',
				'#faq'   : 'Oft gestellte Fragen | ',
				'#impressum': 'Impressum | ',
				'#hulk': 'Heldensteckbrief Hulk | ',
				'#spiderman': 'Heldensteckbrief Hulk | ',
				'#thor': 'Heldensteckbrief Thor | '	
			};

			title = hashes[hash] + baseTitle;
		}

		window.document.title = title;
	}
	window.addEventListener("hashchange", updateTitle, false);
}).call(null, this);