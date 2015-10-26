<?php
	$NEWLINE = "\r\n";
	$HOST = "irc.twitch.tv";
	$PORT = 6667;
	
	$nick = '';
	$pass = '';
	$channel = '#';
	
	# Open the connection to the server
	$socket = @fsockopen($HOST, $PORT);
	
	# Write authentication information
	@fwrite($socket, "PASS {$pass}{$NEWLINE}");
	@fwrite($socket, "NICK {$nick}{$NEWLINE}");
	@fwrite($socket, "JOIN {$channel}{$NEWLINE}");
	
	# Read input indefinitely
	while (!feof($socket)) {
		echo fgets($socket, 1024) . "<br>";
		
		# Push current output to browser
		ob_flush();
        flush();
	}
	
	# Clean the output buffer and turn off output buffering
	ob_end_clean();