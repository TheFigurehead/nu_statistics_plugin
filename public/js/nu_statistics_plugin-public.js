(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	console.log('Start Stat');

	$(window).on('unload', window_unfocused);
	$(window).on("focus", window_focused);
	$(window).on("blur", window_unfocused);
	setInterval(focus_check, 10);

	var start_focus_time = undefined;
	var last_user_interaction = undefined;

	function focus_check() {

		if (start_focus_time != undefined) {
			var curr_time = new Date();
			//Lets just put it for 4.5 minutes
			if((curr_time.getTime() - last_user_interaction.getTime()) > (270 * 1000)) {
				//No interaction in this tab for last 5 minutes. Probably idle.
				console.log("Left");
				window_unfocused();
			}
		}
	}

	function window_focused(eo) {
		last_user_interaction = new Date();
		if (start_focus_time == undefined) {
			start_focus_time = new Date();
		}
	}

	function window_unfocused(eo) {
		if (start_focus_time != undefined) {
			var stop_focus_time = new Date();
			var total_focus_time = stop_focus_time.getTime() - start_focus_time.getTime();
			start_focus_time = undefined;
			var message = {};
			message.type = "time_spent";
			message.domain = document.domain;
			message.time_spent = total_focus_time;
			message.start_time = start_focus_time;
			// chrome.extension.sendMessage("", message);

			console.log("Stat are: ", message);


			// jQuery.ajax({
			// 	type: 'POST',
			// 	url: nu_ajax.url,
			// 	async: false,
			// 	data: {
			// 		action: 'create',
			// 		type : 'time_spent',
			// 		domain : document.domain,
			// 		time_spent : total_focus_time,
			// 		post_id : nu_ajax.post_id,
			// 		start_time : new Date()
			// 	},
			// 	success: function(response){

			// 		console.log(JSON.parse(response));
			// 	}
			// })

		}
	}
	
	$(document).ready(function(){
		window.row_id;
		doStatRequest('create');
		window.setInterval(function(){
			doStatRequest('update');
		}, 10000);
	});

	var doStatRequest = function(type){
		var data = new Object;
		data.action = 'nu_statistics_request';
		data.type = type;
		switch (type) {
			case 'create':
					data.domain = document.domain;
					data.post_id = nu_ajax.post_id;
			  	break;
			case 'update':
					console.log("UPdating");
					data.row_id = window.row_id;
			  break;
		}

		jQuery.ajax({
			type: 'POST',
			url: nu_ajax.url,
			async: false,
			data: data,
			success: function(response){
				// console.log(type);
				if(type == 'create'){
					window.row_id = JSON.parse(response);
					console.log(window.row_id);
				}else if(response){
					console.log(JSON.parse(response));
				}
			}
		})
	};
	
})( jQuery );
