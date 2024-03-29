-- Création de la table ARTISTE
CREATE TABLE ARTISTE (
    artiste_id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(500),
    bio VARCHAR(500),
    photo VARCHAR(500)
);

-- Création de la table ALBUM
CREATE TABLE ALBUM (
    album_id INTEGER PRIMARY KEY AUTOINCREMENT,
    titre VARCHAR(500),
    annee INT,
    genre VARCHAR(500),
    pochette VARCHAR(500),
    artiste_id INT,
    FOREIGN KEY (artiste_id) REFERENCES ARTISTE(artiste_id)
);

-- Création de la table NOTE
CREATE TABLE NOTE (
    note_id INTEGER PRIMARY KEY AUTOINCREMENT,
    album_id INT,
    user_id INT,
    note INT,
    FOREIGN KEY (album_id) REFERENCES ALBUM(album_id),
    FOREIGN KEY (user_id) REFERENCES UTILISATEUR(user_id)
);

-- Création de la table GENRE
CREATE TABLE GENRE (
    id_genre INTEGER PRIMARY KEY AUTOINCREMENT,
    nom_genre VARCHAR(500)
);

-- Création de la table ALBUM_GENRE (liaison entre ALBUM et GENRE)
CREATE TABLE ALBUM_GENRE (
    album_id INT,
    id_genre INT,
    PRIMARY KEY (album_id, id_genre),
    FOREIGN KEY (album_id) REFERENCES ALBUM(album_id),
    FOREIGN KEY (id_genre) REFERENCES GENRE(id_genre)
);

-- Création de la table UTILISATEUR
CREATE TABLE UTILISATEUR (
    user_id INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(500) UNIQUE,
    password VARCHAR(500),
    email VARCHAR(500),
    isAdmin BOOLEAN
);

-- Création de la table PLAYLIST
CREATE TABLE PLAYLIST (
    playlist_id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INT,
    titre VARCHAR(500),
    FOREIGN KEY (user_id) REFERENCES UTILISATEUR(user_id)
);


-- Création de la table CHANSON

CREATE TABLE CHANSON (
    chanson_id INTEGER PRIMARY KEY AUTOINCREMENT,
    titre VARCHAR(500),
    duree INT,
    album_id INT,
    FOREIGN KEY (album_id) REFERENCES ALBUM(album_id)
);

-- Création de la table CHANSON_PLAYLIST (liaison entre CHANSON et PLAYLIST)
CREATE TABLE CHANSON_PLAYLIST (
    chanson_id INT,
    playlist_id INT,
    PRIMARY KEY (chanson_id, playlist_id),
    FOREIGN KEY (chanson_id) REFERENCES CHANSON(chanson_id),
    FOREIGN KEY (playlist_id) REFERENCES PLAYLIST(playlist_id)
);

-- Création de la table IMAGE_ARTISTE

CREATE TABLE IMAGE_ARTISTE (
    image_id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom_image VARCHAR(500) NOT NULL,
    artiste_id INT,
    FOREIGN KEY (artiste_id) REFERENCES ARTISTE(artiste_id)
);

CREATE TRIGGER update_note
AFTER INSERT ON NOTE
FOR EACH ROW
WHEN (SELECT COUNT(*) FROM NOTE WHERE album_id = NEW.album_id AND user_id = NEW.user_id) > 1
BEGIN
    DELETE FROM NOTE WHERE rowid = (
        SELECT rowid FROM NOTE WHERE album_id = NEW.album_id AND user_id = NEW.user_id LIMIT 1
    );
END;