var TT = TT || {};

$.noty.defaults.theme = 'relax';
$.noty.defaults.layout = 'topCenter';
$.noty.defaults.type = 'information';
$.noty.defaults.timeout = 10000;
$.noty.defaults.dismissQueue = true;

TT.notifications = {
	store: function( notification ) {
		localStorage.setItem('storedNotification', notification );
	},
	load: function() {
		var storedNotification = localStorage.getItem('storedNotification');
		if ( storedNotification ) {
			noty({text: storedNotification, dismissQueue: true});
			localStorage.removeItem('storedNotification');
		}
	}
};

TT.exception = function( e ) {
	"use strict";
	console.error( e.message );
	noty({ text: e.message, type: 'error' });
};

TT.call = function( method, opt ) {
	"use strict";

	var deferred = $.Deferred();

	TT.api.client( method, opt )
		.done( function( response ) {
			if ( response.message ) {
				var message = response.message;
				if ( response.thumb ) {
					message = message + '<br><img src="' + response.thumb + '">';
				}
				if ( response.url ) {
					message = '<a href="' + response.url + '">' + message + '</a>';
				}
				noty({text: message});
				response.notification_message = message;
			}
			deferred.resolve( response );
		} )
		.fail( function( error ) {
			TT.exception( error );
			deferred.reject( error );
		});

	return deferred.promise();
};

TT.notifications.load();

$('#logout').on('submit', function(event){
	event.preventDefault();
	TT.call('User/logout')
	.done(function( response ) {
		TT.notifications.store( response.notification_message );
		location.href = '/';
	});
});