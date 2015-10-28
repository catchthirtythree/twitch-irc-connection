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
	@fwrite($socket, 
		"PASS {$pass}{$NEWLINE}" .
		"NICK {$nick}{$NEWLINE}" .
		"JOIN {$channel}{$NEWLINE}"
	);
	
	# Read input indefinitely
	while (!feof($socket)) {
		$buffer = fgets($socket, 1024) . "<br>";
		
		# Taking care of the PING event
		if (strpos($buffer, "PING") !== false) {
			@fwrite($socket, str_replace("PING", "PONG", $buffer));
		}
		
		echo $buffer . "<br>";
		
		# Push current output to browser
		ob_flush();
        flush();
	}
	
	# Clean the output buffer and turn off output buffering
	ob_end_clean();