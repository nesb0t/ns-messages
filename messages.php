<?php

	/** 
	 * 
	 * Netsapiens Domain Messages by Brent Nesbit
	 *
	 * This doesn't really need to be a PHP file but I created it as one just to make it easier in the future.
	 * See the README for additional details. This is a VERY rough way to do this and was written during an emergency.
	 * 
	 **/

?>

<script>
if (document.getElementById('domain-message')) {	// Check to see if the "domain-message" element exists. If it does, attach our domain message. If it doesn't, we aren't looking at a domain. 
	showMessage();
}

function showMessage() {
	// Step 1:
	var header = document.getElementById('header-logo').getElementsByTagName('img')[0].src;		// Extract the img src URL from header-logo

	// Step 2:
	var head_split = header.split("=");     // Step 2a: Take the URL and parse to an array, splitting between each of the "=" from the URL
	var domain = head_split[head_split.length -1].trim();		// Step 2b: Get the last element of array by taking array length and subtracting 1. This is the domain name. Remove whitespace.

	// Step 3: Create a new element to add to the page
	var message = document.createElement('div');    // Create a new element to add to the canvas
	message.classList.add('alert', 'alert-danger', 'alert-dismissible');		// Add some default css styling
	message.style.cssText = "position: relative; width: 300px; text-align: center; font-weight: bold; font-size: 14px; padding: 7px 15px; margin: 10px auto 12px auto; z-index: 9999; visibility: visible;";	// Add custom css styling

	// Step 4: Match the domain name to a message, and create that message if we have one. Leave it blank if we don't.
	var message_text = '';		// Variable to hold the message text

	switch(domain) {			// Match a domain name to a message. Add more messages here.
		case 'ExampleDomainName1':
			message_text = "Example domain message";                // Set the message text
			break;

		case 'ExampleDomainName2':
			message_text = "Another example message";
			break;

		default:
			break;
	}

	// Step 5: Add our message to the page
	if (message_text.length > 0) {				// See if we found a message. Don't add the banner if we didn't.
		var close_message = '<a href="#" class="close" data-dismiss="alert" aria-label="close" style="right: -10px; opacity: .6;">&times;</a>';		// Add a close button to the alert.

		message.innerHTML = close_message + message_text;		// Add text to the new element

		var fixed_container = document.getElementsByClassName('fixed-container');	// fixed-container is the parent element to where our message will be displayed. Locate it so we can attach to it. 

		fixed_container[0].appendChild(message);	// Add the element to the page
	}

}

</script>
