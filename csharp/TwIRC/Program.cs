using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Net.Sockets;
using System.IO;

namespace TwIRC 
{
    class Program 
    {
        const string NEWLINE = "\r\n";
        const string HOST = "irc.twitch.tv";
        const int PORT = 6667;

        static void Main(string[] args) 
        {
            string user, pass, channel;
            user = "";
            pass = "";
            channel = "";
            
            /* Create a client object */
            using (TcpClient socket = new TcpClient())
            {
                /* Open the connection to the server */
                socket.Connect(HOST, PORT);

                /* Create the input and output streams for reading and writing */
                StreamReader input = new StreamReader(socket.GetStream());
                StreamWriter output = new StreamWriter(socket.GetStream());

                /* Write authentication information */
                output.Write(
                    "PASS " + pass + NEWLINE +
                    "NICK " + user + NEWLINE +
                    "JOIN " + channel + NEWLINE
                );
                output.Flush();

                /* Read input indefinitely */
                String buffer;
                while ((buffer = input.ReadLine()) != null)
                {
                    Console.WriteLine(buffer);
                }
            }
        }
    }
}