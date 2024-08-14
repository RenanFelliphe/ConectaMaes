CREATE TABLE Usuario (
idUsuario bigint PRIMARY KEY,
nome varchar(100),
email varchar(256),
senha varchar(100),
dataNascimento date,
telefone bigint,
CEP bigint,
linkFtPerfil varchar(256),
decricao varchar(256)
);

CREATE TABLE Publicacao (
idPublicacao bigint PRIMARY KEY,
linkImagem varchar(256),
conteudo varchar(256),
relato boolean,
dtPublicacao date,
idUsuario bigint,
CONSTRAINT FK_usuario_publicacao FOREIGN KEY(idUsuario) REFERENCES Usuario(idUsuario)
);

CREATE TABLE Filho (
idFilho bigint PRIMARY KEY,
nomeFilho varchar(100),
dataNascimento date,
sexo varchar(25),
idUsuario bigint,
CONSTRAINT FK_usuario_filho FOREIGN KEY(idUsuario) REFERENCES Usuario(idUsuario)
);

CREATE TABLE Comentario (
idComentario bigint PRIMARY KEY,
dtComentario date,
conteudo varchar(256),
idUsuario bigint,
idPublicacao bigint,
CONSTRAINT FK_usuario_comentario FOREIGN KEY(idUsuario) REFERENCES Usuario(idUsuario),
CONSTRAINT FK_publicacao_comentario FOREIGN KEY(idPublicacao) REFERENCES Publicacao(idPublicacao)
);

CREATE TABLE Deficiencia (
idDeficiencia int PRIMARY KEY,
nomeDeficiencia varchar(100),
categoriaCID varchar(100),
descricao varchar(256)
);

CREATE TABLE seguirUsuario (
idSeguindo bigint,
idSeguidor bigint,
CONSTRAINT FK_seguindo_seguirUsuario FOREIGN KEY(idSeguindo) REFERENCES Usuario(idUsuario),
CONSTRAINT FK_seguidor_usuarioSeguidor FOREIGN KEY(idSeguidor) REFERENCES Usuario(idUsuario)
);

CREATE TABLE filhoDeficiencia (
idFilho bigint,
idDeficiencia int,
CONSTRAINT FK_filho_filhoDeficiencia FOREIGN KEY(idFilho) REFERENCES Filho(idFilho),
CONSTRAINT FK_deficiencia_filhoDeficiencia FOREIGN KEY(idDeficiencia) REFERENCES Deficiencia(idDeficiencia)
);

CREATE TABLE curtirPublicacao (
idUsuario bigint,
idPublicacao bigint,
CONSTRAINT FK_usuario_curtirPublicacao FOREIGN KEY(idUsuario) REFERENCES Usuario(idUsuario),
CONSTRAINT FK_publicacao_curtirPublicacao FOREIGN KEY(idPublicacao) REFERENCES Publicacao(idPublicacao)
);