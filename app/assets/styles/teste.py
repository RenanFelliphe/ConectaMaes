#Criação de um socket:
import socket
s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

#Conexão ao servidor:
s.connect(("servidor.com", 80))

#Envio e recebimento de dados:
s.sendall(b"GET / HTTP/1.1\r\nHost: servidor.com\r\n\r\n")
resposta = s.recv(1024)
print(resposta)

#Fechamento do socket:
s.close()


#Criação de um socket:
import socket
s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)

#Conexão ao servidor:
s.sendto(b"Mensagem", ("servidor.com", 12345))

#Envio e recebimento de dados:
data, addr = s.recvfrom(1024)
print(f"Recebido de {addr}: {data}")

#Fechamento do socket:
s.close()
