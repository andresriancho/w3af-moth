<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>AJAX Contact Form</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<script type="text/javascript" src="js/functionAddEvent.js"></script>
	<script type="text/javascript" src="js/contact.js"></script>
	<script type="text/javascript" src="js/xmlHttp.js"></script>
	<style type='text/css' media='screen,projection'>
	<!--
	body { margin:20px auto;width:600px;padding:20px;border:1px solid #ccc;background:#fff;font-family:georgia,times,serif; }
	fieldset { border:0;margin:0;padding:0; }
	label { display:block; }
	input.text,textarea { width:300px;font:12px/12px 'courier new',courier,monospace;color:#333;padding:3px;margin:1px 0;border:1px solid #ccc; }
	input.submit { padding:2px 5px;font:bold 12px/12px verdana,arial,sans-serif; }
	
	-->
	</style>
</head>
<body>
	<h2>AJAX Contact Form</h2>
	<p id="loadBar" style="display:none;">
		<strong>Sending Email via slick AJAX. Hold on just a sec&#8230;</strong>
		<img src="img/loading.gif" alt="Loading..." title="Sending Email" />
	</p>
	<p id="emailSuccess" style="display:none;">
		<strong style="color:green;">Success! Your Email has been sent.</strong>
	</p>
	<div id="contactFormArea">
		<form action="scripts/contact.php" method="post" id="cForm">
			<fieldset>
				<label for="posName">Name:</label>
				<input class="text" type="text" size="25" name="posName" id="posName" />
				<label for="posEmail">Email:</label>
				<input class="text" type="text" size="25" name="posEmail" id="posEmail" />
				<label for="posRegard">Regarding:</label>
				<input class="text" type="text" size="25" name="posRegard" id="posRegard" />
				<label for="posText">Message:</label>
				<textarea cols="50" rows="5" name="posText" id="posText"></textarea>
				<label for="selfCC">
					<input type="checkbox" name="selfCC" id="selfCC" value="send" /> Send CC to self
				</label>
				<label>
					<input class="submit" type="submit" name="sendContactEmail" id="sendContactEmail" value=" Send Email " />
				</label>
			</fieldset>
		</form>
	</div>
	<div class='note'>
		<p>Note: Please excuse the huge lack of documentation. However, this is a pre-release due to the <strong>very large amount</strong> 
		of requests I've been getting for a copy of this script. This is still <strong>very beta</strong> and I have plans on making 
		this a much more developer friendly and easier to install script. My true desire in the end is to make this as much plug 'n play 
		as possible. With that said, 
		please do not make foul remarks or complain about the unfriendliness of putting it together.</p>
		<p>On a slightly more positive note, I believe there is enough information for any intermediate to expert developer to get this 
		going. Heck, even those seeking to learn ajax for the first time shouldn't have too hard of a time figuring out the ins and outs 
		of what's going on in this ajax contact form. Just read line by line and follow function to function, it will all come together.</p>
		<p>For those wanting to at least know 'some' information on what they can do right away... take all the contents you received 
		in this zip file and upload it to a subdirectory of your website in the same manner of which it was unzipped (keep directory structure the same).</p>
		<p>Open up <em>scripts/contact.php</em> &amp; <em>scripts/xmlHttpRequest.php</em>. Change the four variables in each accordingly, 
		then upload back to server</p>
		<p>Then, go ahead and access <strong>this page</strong> on your site: http://www.example.com/path/to/ajax/index.php and try it out.</p>
		
</body>
</html>