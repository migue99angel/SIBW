-- Creamos una tabla para las películas
CREATE TABLE eventos(
  idPelicula INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100),
  director VARCHAR(100),
  fecha DATE,
  review TEXT,
  portada VARCHAR(100),
  enlace VARCHAR(100)
);

-- Creamos una tabla para los premios de cada película
CREATE TABLE premios(
    idPelicula INT NOT NULL REFERENCES eventos(idPelicula),
    idPremio INT NOT NULL,
    premio VARCHAR(150),
    PRIMARY KEY (idPelicula, idPremio)
);

-- Creamos una tabla para las críticas de cada película
CREATE TABLE criticas(
    idPelicula INT NOT NULL REFERENCES eventos(idPelicula),
    idCritica INT NOT NULL,
    redactor VARCHAR(50),
    critica TEXT,
    PRIMARY KEY (idPelicula, idCritica)
);

-- Creamos una tabla para las escenas de cada película
CREATE TABLE escenas(
    idPelicula INT NOT NULL REFERENCES eventos(idPelicula),
    idEscena INT NOT NULL,
    escena VARCHAR(100),
    descripcion VARCHAR(100),
    PRIMARY KEY (idPelicula, idEscena)
);

-- Creamos la tabla para los comentarios de cada película
CREATE TABLE comentarios(
    idPelicula INT NOT NULL REFERENCES eventos(idPelicula),
    idComentario INT NOT NULL,
    idUsuario  INT NOT NULL REFERENCES usuarios(idUsuario),
    nombre VARCHAR(50),
    comentario TEXT,
    fecha DATE,
    moderado BOOLEAN,
    PRIMARY KEY (idPelicula, idComentario)
);

-- Creamos la tabla para la galeria de cada evento
CREATE TABLE actores(
    idPelicula INT NOT NULL REFERENCES eventos(idPelicula),
    idActor VARCHAR(100),
    fotoActor VARCHAR(100),
    nombreActor VARCHAR(100),
    PRIMARY KEY (idPelicula,idActor)
);

--Creo la tabla para las palabras prohibidas
CREATE TABLE censura(
    idPalabra INT AUTO_INCREMENT PRIMARY KEY,
    palabra VARCHAR(50)
);


--Creo la tabla para los usuarios
CREATE TABLE usuarios(
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(50) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone INT,
    rol VARCHAR(20) NOT NULL
);