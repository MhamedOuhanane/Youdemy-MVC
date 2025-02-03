-- les tables utiliser dans la base de donnée pour le "PostgreSQL"

CREATE TABLE roles(
    id_role serial PRIMARY KEY,
    role varchar(50) NOT NULL
);

CREATE TYPE status_user AS ENUM('Active', 'Suspendu');
CREATE TABLE users(
	id_user serial PRIMARY KEY,
    username varchar(225) NOT NULL,
    email varchar(225) NOT NULL,
    ville varchar(225) NOT NULL,
	telephone varchar(13) NOT NULL,
    image bytea NULL,
    password varchar(225) NOT NULL,
	status status_user DEFAULT 'Suspendu',
    id_role int NOT NULL,
    FOREIGN KEY (id_role) REFERENCES roles(id_role) ON DELETE CASCADE
);

CREATE TABLE catalogues(
    id_catalogue serial PRIMARY KEY,
    catalogue_titre varchar(225) NOT NULL,
    catalogue_contenu varchar(225) NOT NULL,
    catalogue_image bytea NOT NULL
);

CREATE TYPE status_cours as ENUM('En Attente', 'Publicé', 'Refusé');
CREATE TABLE cours(
    id_cour serial PRIMARY KEY,
    cours_titre varchar(225) NOT NULL,
    description text NOT NULL,
    cours_contenu bytea  NOT NULL,
	imageCours bytea NOT  NULL,
	status status_cours DEFAULT 'En Attente',
	createDate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_user int NOT NULL,
    id_catalogue int NOT NULL,
    FOREIGN KEY (id_catalogue) REFERENCES catalogues(id_catalogue) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE
);
CREATE TABLE tags(
    id_tag serial PRIMARY KEY,
    tag_Titre varchar(225) NOT NULL
);


CREATE TABLE tagCours(
    id_tag int NOT NULL,
    id_cour int NOT NULL,
    FOREIGN KEY (id_cour) REFERENCES cours(id_cour) on DELETE CASCADE,
    FOREIGN KEY (id_tag) REFERENCES tags(id_tag) on DELETE CASCADE
);


CREATE TABLE inscriptionCours(
    id_inscription serial PRIMARY KEY,
    date_inscret timestamp DEFAULT CURRENT_TIMESTAMP,
    id_user int NOT null,
    id_cour int NOT null, 
    FOREIGN KEY (id_cour) REFERENCES cours(id_cour) on DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES users(id_user) on DELETE CASCADE
);

CREATE VIEW listecours AS 
SELECT c.* ,g.catalogue_titre, g.catalogue_contenu, u.username, u.email, u.image, t.*
FROM cours c
JOIN catalogues g ON c.id_catalogue = g.id_catalogue
JOIN users u ON u.id_user = c.id_user 
LEFT JOIN tagcours tc ON tc.id_cour = c.id_cour
left JOIN tags t ON t.id_tag = tc.id_tag;

CREATE VIEW listeInscriptionCours AS
SELECT u.id_user, u.username, u.email, u.image,
		ic.id_inscription, ic.date_inscret,
        c.id_cour, c.cours_titre, cg.id_catalogue, cg.catalogue_titre,
        c.id_user as id_enseign
FROM users u
JOIN inscriptioncours ic ON ic.id_user = u.id_user
JOIN cours c ON c.id_cour = ic.id_cour
JOIN catalogues cg ON cg.id_catalogue = c.id_catalogue;

DROP VIEW listecours;
CREATE VIEW listecours AS 
SELECT c.* ,g.catalogue_titre, g.catalogue_contenu, u.username, u.email, u.image, t.*
FROM cours c
JOIN catalogues g ON c.id_catalogue = g.id_catalogue
JOIN users u ON u.id_user = c.id_user 
LEFT JOIN tagcours tc ON tc.id_cour = c.id_cour
left JOIN tags t ON t.id_tag = tc.id_tag;