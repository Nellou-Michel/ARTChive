CREATE OR REPLACE PROCEDURAL LANGUAGE plpgsql;
DROP TABLE IF EXISTS Media;
DROP TABLE IF EXISTS MediaAuthor;


CREATE TABLE "user" (
    id_user SERIAL PRIMARY KEY,
    pseudo_user VARCHAR(255),
    name_user VARCHAR(255),
    lastname_user VARCHAR(255),
    password VARCHAR(255),
    is_private BOOLEAN,
    is_admin BOOLEAN
);

-- Table pour les auteurs
CREATE TABLE Author (
    id_author SERIAL PRIMARY KEY,
    name_author VARCHAR(255)
);


-- Table pour les medias
CREATE TABLE Media (
    id_media SERIAL PRIMARY KEY,
    name_media VARCHAR(255),
    id_author INT,
    publication_date DATE,
    description VARCHAR(5000),
    length INT,
    unite VARCHAR(255),
    average_note DECIMAL(3, 2),
    file_path VARCHAR(1000),
    FOREIGN KEY (id_author) REFERENCES Author(id_author)
);

-- Table pour la music
CREATE TABLE Music (
    id_media INT PRIMARY KEY,
    album VARCHAR(255),
    FOREIGN KEY (id_media) REFERENCES Media(id_media)
);

CREATE TABLE MovieType (
    movie_type VARCHAR(255) PRIMARY KEY
);

CREATE TABLE BookType (
    book_type VARCHAR(255) PRIMARY KEY
);

-- Table pour les livres
CREATE TABLE Book (
    id_media INT PRIMARY KEY,
    book_type VARCHAR(255),
    FOREIGN KEY (id_media) REFERENCES Media(id_media),
    FOREIGN KEY (book_type) REFERENCES BookType(book_type)
    --CONSTRAINT CHK_type_book CHECK type IN ('BD', 'roman', 'poesie', 'essai', 'conte', 'manuel', 'encyclopedie', 'guide', 'magazine', 'theatre', 'nouvelles', 'album')
);

-- Table pour les films
CREATE TABLE Movie (
    id_media INT PRIMARY KEY,
    actors VARCHAR(500),
    movie_type VARCHAR(255),
    FOREIGN KEY (id_media) REFERENCES Media(id_media),
    FOREIGN KEY (movie_type) REFERENCES MovieType(movie_type)
    --CONSTRAINT CHK_type_genre CHECK type IN ('long-metrage', 'documentaire', 'court-metrage', 'serie')
);

-- Table pour les jeux
CREATE TABLE Game (
    id_media INT PRIMARY KEY,
    FOREIGN KEY (id_media) REFERENCES Media(id_media)
);

-- Table pour les genres
CREATE TABLE Genre (
    id_genre SERIAL PRIMARY KEY,
    genre VARCHAR(255),
    category VARCHAR(255),
    CONSTRAINT CHK_category_genre CHECK (category IN ('Book', 'Movie', 'Game', 'Music'))
);

-- Table pour les genres des media
CREATE TABLE GenreMedia (
    id_genre INT,
    id_media INT,
    PRIMARY KEY (id_genre, id_media),
    FOREIGN KEY (id_media) REFERENCES Media(id_media)
    --CONSTRAINT CHK_genre_game CHECK genre IN ('combat', 'plateforme', 'tir', 'aventure', 'action-aventure', 
    --'rpg', 'reflexion', 'simulation', 'strategie', 'sport', 'course', 'rythme', 'moba')
);

-- Table pour les plates-formes de jeux
CREATE TABLE Platform (
    platform VARCHAR(255) PRIMARY KEY
);

CREATE TABLE PlayableOn (
    id_game INT,
    platform VARCHAR(255),
    PRIMARY KEY (id_game, platform),
    FOREIGN KEY (id_game) REFERENCES Game(id_media),
    FOREIGN KEY (platform) REFERENCES Platform(platform)
);



-- Table pour les amis des utilisateurs
CREATE TABLE Friend (
    id_user INT,
    id_friend INT,
    PRIMARY KEY (id_user, id_friend),
    FOREIGN KEY (id_user) REFERENCES "user"(id_user),
    FOREIGN KEY (id_friend) REFERENCES "user"(id_user),
    CONSTRAINT CHK_user_friend_diff CHECK (id_user != id_friend)
);

-- Table pour les posts
CREATE TABLE Post (
    id_post SERIAL PRIMARY KEY,
    title_post VARCHAR(255),
    description_post VARCHAR(255),
    note INT,
    date_post DATE,
    id_user INT,
    id_media INT,
    FOREIGN KEY (id_user) REFERENCES "user"(id_user),
    FOREIGN KEY (id_media) REFERENCES Media(id_media),
    CONSTRAINT CHK_note_range CHECK (note BETWEEN 0 AND 10)
);













-- Valeurs de bases
INSERT INTO MovieType (movie_type) VALUES
('Long Métrage'),
('Documentaire'),
('Court-métrage'),
('Série'),
('Animation');



INSERT INTO Genre (genre, category) VALUES ('Aventure', 'Game');
INSERT INTO Genre (genre, category) VALUES ('Stratégie', 'Game');
INSERT INTO Genre (genre, category) VALUES ('RPG', 'Game');

-- Pour les films
INSERT INTO Genre (genre, category) VALUES ('Action', 'Movie');
INSERT INTO Genre (genre, category) VALUES ('Biographie', 'Movie');
INSERT INTO Genre (genre, category) VALUES ('Guerre', 'Movie');
INSERT INTO Genre (genre, category) VALUES ('Historique', 'Movie');
INSERT INTO Genre (genre, category) VALUES ('Animation pour adultes', 'Movie');
INSERT INTO Genre (genre, category) VALUES ('Aventure', 'Movie');
INSERT INTO Genre (genre, category) VALUES ('Comédie', 'Movie');
INSERT INTO Genre (genre, category) VALUES ('Drame', 'Movie');
INSERT INTO Genre (genre, category) VALUES ('Horreur', 'Movie');
INSERT INTO Genre (genre, category) VALUES ('Science-fiction', 'Movie');
INSERT INTO Genre (genre, category) VALUES ('Fantasy', 'Movie');
INSERT INTO Genre (genre, category) VALUES ('Mystère', 'Movie');
INSERT INTO Genre (genre, category) VALUES ('Thriller', 'Movie');
INSERT INTO Genre (genre, category) VALUES ('Crime', 'Movie');
INSERT INTO Genre (genre, category) VALUES ('Romance', 'Movie');
INSERT INTO Genre (genre, category) VALUES ('Drame', 'Movie');
INSERT INTO Genre (genre, category) VALUES ('Science-fiction', 'Movie');
INSERT INTO Genre (genre, category) VALUES ('Comédie', 'Movie');

-- Pour la musique
INSERT INTO Genre (genre, category) VALUES ('Pop', 'Music');
INSERT INTO Genre (genre, category) VALUES ( 'Rock', 'Music');
INSERT INTO Genre (genre, category) VALUES ( 'Jazz', 'Music');
INSERT INTO Genre (genre, category) VALUES ( 'Classique', 'Music');

-- Pour les livres
INSERT INTO Genre (genre, category) VALUES ( 'Science-fiction', 'Book');
INSERT INTO Genre (genre, category) VALUES ( 'Romance', 'Book');
INSERT INTO Genre (genre, category) VALUES ( 'Mystère', 'Book');
INSERT INTO Genre (genre, category) VALUES ( 'Horreur', 'Book');
INSERT INTO Genre (genre, category) VALUES ( 'Fantasy', 'Book');
INSERT INTO Genre (genre, category) VALUES ( 'Drame', 'Book');
INSERT INTO Genre (genre, category) VALUES ( 'Aventure', 'Book');
INSERT INTO Genre (genre, category) VALUES ( 'Science', 'Book');
INSERT INTO Genre (genre, category) VALUES ( 'Thriller', 'Book');
INSERT INTO Genre (genre, category) VALUES ( 'Historique', 'Book');
INSERT INTO Genre (genre, category) VALUES ( 'Humour', 'Book');
INSERT INTO Genre (genre, category) VALUES ( 'Éducatif', 'Book');
INSERT INTO Genre (genre, category) VALUES ( 'Art', 'Book');
INSERT INTO Genre (genre, category) VALUES ( 'Jeunesse', 'Book');
INSERT INTO Genre (genre, category) VALUES ( 'Cuisine', 'Book');

INSERT INTO BookType (book_type) VALUES
                                     ('Roman'),
                                     ('Nouvelle'),
                                     ('BD'),
                                     ('Manga'),
                                     ('Essai'),
                                     ('Poésie'),
                                     ('Theatre');




-- Auteurs de livres
INSERT INTO Author (name_author) VALUES ('J.K. Rowling'), ('Stephen King'), ('George R.R. Martin'), ('Agatha Christie'), ('J.R.R. Tolkien');

-- Acteurs de films
INSERT INTO Author (name_author) VALUES ('Leonardo DiCaprio'), ('Meryl Streep'), ('Denzel Washington'), ('Scarlett Johansson'), ('Tom Hanks');

-- Musiciens
INSERT INTO Author (name_author) VALUES ('Beyoncé'), ('Ed Sheeran'), ('Taylor Swift'), ('Kendrick Lamar'), ('Adele');

-- Créateurs de jeux vidéo
INSERT INTO Author (name_author) VALUES ('Shigeru Miyamoto'), ('Hideo Kojima'), ('Gabe Newell'), ('Tim Schafer'), ('Jade Raymond');


-- Plateformes de jeux
INSERT INTO Platform (platform) VALUES
    ('PlayStation 5'),
    ('Xbox Series X'),
    ('Nintendo Switch'),
    ('PlayStation 4'),
    ('Xbox One'),
    ('PC'),
    ('Nintendo Wii U'),
    ('PlayStation 3'),
    ('Xbox 360'),
    ('Nintendo Wii'),
    ('Nintendo DS'),
    ('PlayStation 2'),
    ('Xbox'),
    ('GameCube'),
    ('PlayStation Portable (PSP)'),
    ('Nintendo 3DS'),
    ('PlayStation Vita'),
    ('Game Boy Advance'),
    ('Sega Genesis'),
    ('Super Nintendo Entertainment System (SNES)');
