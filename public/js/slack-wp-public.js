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
// 	const { WebClient, LogLevel } = require('@slack/web-api');
//
// // WebClient insantiates a client that can call API methods
// // When using Bolt, you can use either `app.client` or the `client` passed to listeners.
// 	const client = new WebClient({
// 		token: "xoxb-1645078640917-1633418109319-LT0xJSQhqWrLCYfspw5ws87k",
// 		// LogLevel can be imported and used to make debugging simpler
// 		logLevel: LogLevel.DEBUG
// 	});
// // You probably want to use a database to store any conversations information ;)
// 	let conversationsStore = {};
//
// 	async function populateConversationStore() {
// 		try {
// 			// Call the conversations.list method using the WebClient
// 			const result = await client.conversations.list();
//
// 			saveConversations(result.channels);
// 			console.log(result);
// 		}
// 		catch (error) {
// 			console.error(error);
// 		}
//
// 	}
//
// // Put conversations into the JavaScript object
// 	function saveConversations(conversationsArray) {
// 		let conversationId = '';
//
// 		conversationsArray.forEach(function(conversation){
// 			// Key conversation info on its unique ID
// 			conversationId = conversation["id"];
//
// 			// Store the entire conversation object (you may not need all of the info)
// 			conversationsStore[conversationId] = conversation;
// 		});
// 	}
//
// 	populateConversationStore();
})( jQuery );
//console.log('working');
