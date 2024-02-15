-- Insertions dans la table ARTISTE
INSERT INTO ARTISTE (nom, bio, photo) VALUES 
    ('Superdrag', 'Description de Superdrag', 'Superdrag-Stereo_360_Sound.jpg'),
    ('16 Horsepower', 'Description de 16 Horsepower', '220px-Folklore_hp.jpg'),
    ('Ryan Adams', 'Description de Ryan Adams', '220px-RyanAdamsHeartbreaker.jpg'),
    ('Whiskeytown', 'Description de Whiskeytown', '220px-WhiskeytownPneumonia.jpg'),
    ('Jesse Malin', 'Description de Jesse Malin', 'The_Fine_Art_of_Self_Destruction.jpg'),
    ('The Finger', 'Description de The Finger', null),
    ('Joan Baez', 'Description de Joan Baez', '220px-DarkChords.jpg'),
    ('Willie Nelson', 'Description de Willie Nelson', '220px-Songbird_Willie_Nelson.jpg'),
    ('Cowboy Junkies', 'Description de Cowboy Junkies', '220px-Trinityrevisited.jpg'),
    ('Alabama Shakes', 'Description de Alabama Shakes', '220px-Alabama_Shakes_-_Sound_%26_Color_album_cover.jpg'),
    ('Terry Allen (country singer)', 'Description de Terry Allen', 'Terry_Allen_Lubbock%28on_everything%29.jpg'),
    ('X', 'Description de X', 'XSeeHowWeAre.jpg'),
    ('Dave Alvin', 'Description de Dave Alvin', null);


-- Insertions dans la table ALBUM
INSERT INTO ALBUM (titre, annee, genre, pochette, artiste_id) VALUES 
    ('Stereo 360 Sound', 1998, 'Rock, Punk', 'Superdrag-Stereo_360_Sound.jpg', 1),
    ('Folklore', 2002, 'Alternative country, neofolk', '220px-Folklore_hp.jpg', 2),
    ('Heartbreaker', 2000, 'Alternative country, country', '220px-RyanAdamsHeartbreaker.jpg', 3),
    ('Pneumonia', 2001, 'Alternative country', '220px-WhiskeytownPneumonia.jpg', 4),
    ('The Fine Art of Self Destruction', 2002, null, 'The_Fine_Art_of_Self_Destruction.jpg', 5),
    ('We Are Fuck You', 2003, null, null, 6),
    ('Dark Chords on a Big Guitar', 2003, 'Folk', '220px-DarkChords.jpg', 7),
    ('Songbird', 2006, 'Alternative country', '220px-Songbird_Willie_Nelson.jpg', 8),
    ('Trinity Revisited', 2007, 'Country rock, Alternative country', '220px-Trinityrevisited.jpg', 9),
    ('Sound & Color', 2015, 'Blues rock, roots rock, soul, Southern rock, garage rock, Americana', '220px-Alabama_Shakes_-_Sound_%26_Color_album_cover.jpg', 10),
    ('Lubbock', 1979, 'Country', 'Terry_Allen_Lubbock%28on_everything%29.jpg', 11),
    ('Juarez', 1975, 'Country', 'TerryAllen_Juarez.jpg', 12),
    ('Pedal Steal', 1985, 'Country', 'Terry_Allen_Pedal_Steal.jpg', 13),
    ('Human Remains', 1996, 'Country', 'Terry_Allen_Human_Remains.jpg', 14),
    ('See How We Are', 1987, 'Alternative rock, alternative country', 'XSeeHowWeAre.jpg', 15),
    ('Eleven Eleven', 2011, 'Folk rock, country rock', null, 16);


-- Insertions dans la table NOTE
INSERT INTO NOTE (album_id, user_id, note) VALUES 
    (1, 1, 4),
    (2, 1, 5),
    (3, 2, 4),
    (4, 2, 3),
    (5, 3, 4),
    (6, 3, 2),
    (7, 4, 3),
    (8, 4, 5),
    (9, 5, 4),
    (10, 5, 5),
    (11, 6, 4),
    (12, 6, 3),
    (13, 7, 4),
    (14, 7, 4),
    (15, 8, 5),
    (16, 8, 4);


-- Insertions dans la table GENRE
INSERT INTO GENRE (nom_genre) VALUES 
    ('Rock'),
    ('Punk'),
    ('Alternative country'),
    ('Neofolk'),
    ('Country'),
    ('Pop rock'),
    ('Folk'),
    ('Blues rock'),
    ('Roots rock'),
    ('Soul'),
    ('Southern rock'),
    ('Garage rock'),
    ('Americana'),
    ('Heavy metal'),
    ('Hard rock'),
    ('Alternative rock');


-- Insertions dans la table ALBUM_GENRE
INSERT INTO ALBUM_GENRE (album_id, id_genre) VALUES 
    (1, 1), (1, 2),
    (2, 3), (2, 4),
    (3, 3), (3, 5),
    (4, 1), (4, 3), (4, 6),
    (5, 3),
    (8, 3),
    (9, 3),
    (10, 6), (10, 7), (10, 8), (10, 9), (10, 10), (10, 11),
    (11, 1), (11, 3),
    (13, 12), (13, 13),
    (14, 5),
    (15, 14),
    (16, 15), (16, 16);    


-- Insertions dans la table PLAYLIST
INSERT INTO PLAYLIST (user_id, titre) VALUES 
    (1, 'Ma playlist Rock'),
    (2, 'Playlist Chill'),
    (3, 'Playlist Country'),
    (4, 'Mes coups de cœur'),
    (5, 'Roadtrip Mix'),
    (6, 'Indie Vibes'),
    (7, 'Funky Jams'),
    (8, 'Best of 80s');                


-- Insertions de chansons fictives dans la table CHANSON 
INSERT INTO CHANSON (titre, duree, album_id) VALUES 
    ('Feeling the Vibe', 180, 1),
    ('Stereo Dreams', 210, 1),
    ('Rock Revolution', 195, 1),
    
    ('Desert Wind', 220, 2),
    ('Folklore Tales', 190, 2),
    ('Whispers in the Canyon', 205, 2),
    
    ('Heartbreak Lullaby', 195, 3),
    ('Wandering Souls', 200, 3),
    ('Lonely Streets', 185, 3),
    
    ('Pneumonia Blues', 190, 4),
    ('Endless Highway', 180, 4),
    ('Forgotten Melody', 210, 4),
    
    ('The Art of Self Destruction', 200, 5),
    ('Lost in the Echoes', 195, 5),
    ('Broken Dreams', 220, 5),
    
    ('We Are the Finger', 180, 6),
    ('Rebellion Anthem', 205, 6),
    ('The Underground', 190, 6),
    
    ('Dark Guitar Serenade', 210, 7),
    ('Midnight Echoes', 185, 7),
    ('We Are Not Alone', 200, 7),
    
    ('Love Is Hell', 180, 8),
    ('Haunted Memories', 195, 8),
    ('Eternal Flames', 220, 8),
    
    ('Folklore of the South', 200, 9),
    ('Country Roads', 190, 9),
    ('Soulful Sunset', 205, 9),
    
    ('Sound Waves', 210, 10),
    ('Colorful Harmony', 185, 10),
    ('Rhythmic Soul', 200, 10),
    
    ('Lubbock Nights', 180, 11),
    ('Desert Rose', 195, 11),
    ('Steel Pedal Waltz', 220, 11),
    
    ('Juarez Journey', 200, 12),
    ('Cactus Serenade', 190, 12),
    ('Desert Dreams', 205, 12),
    
    ('Pedal Steel Reflections', 210, 13),
    ('Twilight Ballad', 185, 13),
    ('Highway Hymn', 200, 13),
    
    ('Echoes of Human Remains', 180, 14),
    ('Lost Soul Waltz', 195, 14),
    ('Eternal Requiem', 220, 14),
    
    ('See How We Shine', 200, 15),
    ('Revolutionary Road', 185, 15),
    ('Melodic Echo', 200, 15),
    
    ('Eleven Eleven Overture', 180, 16),
    ('Highway Dreams', 195, 16),
    ('Sunset Serenade', 220, 16);


INSERT INTO IMAGE_ARTISTE (nom_image, artiste_id) VALUES 
    ('Superdrag.jpeg', 1),
    ('16_Horsepower.jpeg', 2),
    ('Ryan_Adams.jpeg', 3),
    ('Whiskeytown.jpeg', 4),
    ('Jesse_Malin.jpeg', 5),
    ('The_Finger.jpeg', 6),
    ('Joan_Baez.jpeg', 7),
    ('Willie_Nelson.jpeg', 8),
    ('cowboy_junkies.jpeg', 9),
    ('Alabama_shakes.jpeg', 10),
    ('Terry_Allen.jpeg', 11),
    ('X.jpeg', 12),
    ('Dave_Alvin.jpeg', 13);

INSERT INTO UTILISATEUR(user_id,username, password, email, isAdmin) VALUES
    (1, 'user1', 'password1', 'ybarache@icloud.com',1);
