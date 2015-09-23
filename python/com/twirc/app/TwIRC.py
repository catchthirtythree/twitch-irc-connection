import socket

NEWLINE = '\r\n'

HOST = 'irc.twitch.tv'
PORT = 6667

nick = 'twchy'
pwrd = 'oauth:xqdfzyuqerfhf3a8ogga8mprc8h85a'
owner = 'SNeeaaky'
channel = '#jendenise'

# Open the connection to the server
irc = socket.socket()
irc.connect()

# Send authentication information
irc.send('PASS ' + pwrd + NEWLINE)
irc.send('NICK ' + nick + NEWLINE)
irc.send('JOIN ' + channel + NEWLINE)

# Read input indefinitely
while True:
    print irc.recv(1024).rstrip()