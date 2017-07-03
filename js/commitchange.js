(function() {
	if(document.getElementById('commitchange-script')) return;
	var npo = 4371;
	var script = document.createElement('script');
	var first = document.getElementsByTagName('script')[0];
	script.setAttribute('data-npo-id', npo);
	script.id = 'commitchange-script';
	script.src = 'https://commitchange.com/js/donate-button.v2.js';
	first.parentNode.insertBefore(script, first);
})();
