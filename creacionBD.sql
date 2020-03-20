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

-- Creamos una tabla para las recomendaciones de cada película
CREATE TABLE recomendaciones(
    idPelicula INT NOT NULL REFERENCES eventos(idPelicula),
    idRecomendacion INT NOT NULL,
    idRecomendada INT NOT NULL,
    PRIMARY KEY (idPelicula, idRecomendacion)
);