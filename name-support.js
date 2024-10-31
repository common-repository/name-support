jQuery(function($) {
	var titlewrap = $('#titlewrap'),
	title = titlewrap.find('#title'),
	names = title.val().split(/,\s*/);

	titlewrap.empty().append('<div class="namediv"><label for="last-name" id="last-name-prompt-text" class="name-prompt-text" style="visibility: hidden;" class="hide-if-no-js">Last Name</label><input class="name" type="text" autocomplete="off" id="last-name" value="" tabindex="1" size="30" name="last_name"></div> <div class="namediv"><label for="first-name" id="first-name-prompt-text" class="name-prompt-text" style="visibility: hidden;" class="hide-if-no-js">First Name</label><input class="name" type="text" autocomplete="off" id="first-name" value="" tabindex="1" size="30" name="first_name"></div>');
	
	titlewrap.find('#last-name').val(names[0]);
	titlewrap.find('#first-name').val(names[1]);
	
	if ( typeof wptitlehint === 'function' ) {
		wptitlehint('first-name');
		wptitlehint('last-name');
	}
});