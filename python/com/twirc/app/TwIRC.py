import socket

NEWLINE = '\r\n'

HOST = 'irc.twitch.tv'
PORT = 6667

nick = ''
pwrd = ''
channel = '#'

# Open the connection to the server
socket = socket.socket()
socket.connect((HOST, PORT))

# Send authentication information
socket.send(
    'PASS ' + pwrd + NEWLINE +
    'NICK ' + nick + NEWLINE +
    'JOIN ' + channel + NEWLINE
)

# Read input indefinitely
while True:
    buf = socket.recv(1024).rstrip()
    
    # Take care of the PING event
    if "PING" in buf:
        socket.send(buf.replace("PING", "PONG"))
    
    print buf
