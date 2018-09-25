# ns-messages
This is a very basic way to display custom messages at the domain level on the Netsapiens platform. It was written in a hurry during Hurricane Florence because we had a need to display messages that our support team could all share. There are definitely better and cleaner ways to do this but we only needed it temporarily and this was the fastest way to do it. I'm not planning on making improvements to it, but feel free to ask me if you have any questions. 

# Requirements
This was created for and tested on v38.1 only. I make no guarantees that it will work on any other versions, or that it will work at all. 

It works by pulling the name of the domain from the logo image URL, searching the php file for a matching domain and message, and then adding a new div element to display the message. If Netsapiens changes anything in regards to the logo image, CSS, etc, then this will likely break. 

# Details
The domain name can be retrieved from header-logo img URL. If this ever stops working it will be because something here changed. This works by grabbing the header-logo URL and parsing out the elements from the URL. 

Example header-logo URL:
```html
<div id="header-logo">
	<img src="https://nms.example.com/ns-api/?object=image&action=read&filename=portal_main_top_left.png&server=nms.example.com&territory=Territory1&domain=Domain1" />
</div>
```

## How the Script Displays a Message
1. Extract the src URL (example above)
2. Split in to array based on the "=" sign; the domain name is the last element in the array
3. Create a new element that will be added to the page with a message
4. Take that last array item and match it to a list of messages
5. Put the message on the page

# Usage
1. Upload messages.php to your nms server at /var/www/html. Set your permissions so that apache can read it.
   1. I put the file directly on the server. It needs to be hosted on the server that your portal is hosted on. If your portal is hosted on multiple servers then you need to add the file to all of them. I don't know if the `PORTAL_PHP_FOOT_INCLUDE_PHP` UI config (set in step 3) supports hosting the file elsewhere so you only need one copy. I didn't have time to test it so I just did it this way. 
2. Modify the switch portion (step 4) of the php file to add in messages you need to display.
3. Add the UI Config `PORTAL_PHP_FOOT_INCLUDE_PHP` to your NMS server with a value of `/var/www/html/messages.php`. It's important that you add limitations on this UI config so that it doesn't display for your end users as well. We set ours to be limited to the `Super User` role.
   1. You should never put something in this file that you don't want an end-user to see because there's nothing stopping them from just viewing the source code on this file. Again, there are better ways to do this than how I did it.
4. Test and verify. Sometimes this override takes a while to start loading due to caching so I recommend using an incognito window or different browser than you normally use to test it. 

# Example
```javascript
switch(domain) {
	case 'Demo':
		message_text = "This is an example of messages.php";
		break;

	default:
		break;
```
![Demo](https://i.imgur.com/jDtYooP.png)
