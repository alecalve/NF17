﻿-- On a crée une table tLieu à la place de la vue
-- pour faire un héritage par référence
BEGIN TRANSACTION;
CREATE TYPE typePeriode AS ENUM('matin', 'après-midi', 'soirée', 'nuit');
CREATE TYPE typePrevision AS ENUM('précipitations', 'vent', 'température', 'autre');
CREATE TYPE typePrecipitation AS ENUM('pluie', 'grêle', 'neige', 'météorites');
CREATE TYPE typeDirection AS ENUM ('N', 'S', 'O', 'E');

CREATE TABLE tRegion (
    nom VARCHAR NOT NULL,
    PRIMARY KEY(nom)
);

CREATE TABLE tDepartement (
    nom VARCHAR NOT NULL,
    fkRegion VARCHAR NOT NULL REFERENCES tRegion(nom),
    numero VARCHAR(3) NOT NULL, --On passe d'integer à varchar pour prendre ne compte la Corse (2A et 2B)
    PRIMARY KEY(nom)    
);

CREATE TABLE tLieu (
    nom VARCHAR NOT NULL,
    couverture BOOL NOT NULL,
    PRIMARY KEY(nom)
);

CREATE TABLE tVille (
    fkLieu VARCHAR NOT NULL REFERENCES tLieu(nom) ON DELETE CASCADE ON UPDATE CASCADE,
    fkDepartement VARCHAR NOT NULL REFERENCES tDepartement(nom),
    PRIMARY KEY(fkLieu)
);

CREATE TABLE tMassif (
    fkLieu VARCHAR NOT NULL REFERENCES tLieu(nom) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(fkLieu)
);

CREATE TABLE tjMassifDepartement (
    massif VARCHAR NOT NULL REFERENCES tMassif(fkLieu) ON DELETE CASCADE ON UPDATE CASCADE,
    departement VARCHAR NOT NULL REFERENCES tDepartement(nom),
    PRIMARY KEY(massif, departement)
);

CREATE TABLE tCapteur (
    id VARCHAR NOT NULL,
    typeCapteur typePrevision,
    PRIMARY KEY(id)
);

CREATE TABLE tBulletin (
    dateBulletin DATE NOT NULL,
    periode typePeriode NOT NULL,
    lieu VARCHAR NOT NULL REFERENCES tLieu(nom),
    PRIMARY KEY(dateBulletin, periode, lieu)
);

CREATE TABLE tPrevision (
    id SERIAL UNIQUE NOT NULL,
    datePrevision DATE NOT NULL,
    periode typePeriode NOT NULL,
    nom VARCHAR NOT NULL,
    description TEXT,
    hauteur FLOAT,
    typePrecipitation typePrecipitation,
    temp INTEGER,
    ressenti INTEGER,
    force FLOAT,
    direction typeDirection,
    typePrevision typePrevision,
    FOREIGN KEY (datePrevision, periode, nom) REFERENCES tBulletin(dateBulletin, periode, lieu),
    PRIMARY KEY (id) -- pas besoin des autres clés
);

CREATE TABLE tAffectation (
    nom VARCHAR NOT NULL,
    id VARCHAR NOT NULL REFERENCES tCapteur(id),
    dateDebut DATE NOT NULL,
    dateFin DATE NOT NULL,
    CHECK (dateDebut <= dateFin),
    PRIMARY KEY (nom, id, dateDebut) -- La date de debut suffit comme clé, pas besoin de la fin
);

CREATE VIEW vPreviDepVille AS
    SELECT P.*, V.fkDepartement AS lieu
    FROM tPrevision P
    INNER JOIN tVille V ON V.fkLieu = P.nom;
    
CREATE VIEW vPreviDepMassif AS
    SELECT P.*, departement AS lieu
    FROM tPrevision P
    INNER JOIN tjMassifDepartement TJ ON TJ.massif = P.nom;
    
CREATE VIEW vPreviRegVille AS
    SELECT P.*, fkRegion AS lieu
    FROM tPrevision P
    INNER JOIN tjMassifDepartement TJ ON TJ.massif = P.nom
    INNER JOIN tDepartement D ON D.nom = TJ.departement;

CREATE VIEW vPreviRegMassif AS
    SELECT P.*, fkRegion AS lieu
    FROM tPrevision P
    INNER JOIN tVille V ON V.fkLieu = P.nom
    INNER JOIN tDepartement D ON D.nom = V.fkDepartement;

COMMIT;

