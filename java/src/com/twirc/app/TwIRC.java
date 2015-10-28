package com.twirc.app;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.Socket;
import java.net.UnknownHostException;

public class TwIRC {
	private static final String NEWLINE = "\r\n";
	private static final String HOST = "irc.twitch.tv";
	private static final int PORT = 6667;
	
	public static void main(String[] args) throws UnknownHostException, IOException {
		String nick, pass, channel;
		nick = "";
		pass = "";
		channel = "#";

		/* Open the connection to the server */
		try (Socket socket = new Socket(HOST, PORT)) {
			/* Create the input and output streams for reading and writing */
			BufferedReader in = new BufferedReader(new InputStreamReader(socket.getInputStream()));
			BufferedWriter out = new BufferedWriter(new OutputStreamWriter(socket.getOutputStream()));

			/* Write authentication information */
			out.write(
				"PASS " + pass + NEWLINE + 
				"NICK " + nick + NEWLINE + 
				"JOIN " + channel + NEWLINE
			);
			out.flush();

			/* Read input indefinitely */
			String buffer;
			while ((buffer = in.readLine()) != null) {
				/* Take care of the PING event */
				if (buffer.contains("PING")) {
					out.write(buffer.replace("PING", "PONG"));
					out.flush();
				}
				
				System.out.println(buffer);
			}
		}
	}
}
