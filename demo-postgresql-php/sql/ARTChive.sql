CREATE OR REPLACE PROCEDURAL LANGUAGE plpgsql;
DROP TABLE IF EXISTS Media;
DROP TABLE IF EXISTS MediaAuthor;


CREATE TABLE "User" (
    id_user INT PRIMARY KEY,
    pseudo_user VARCHAR(255),
    name_user VARCHAR(255),
    lastname_user VARCHAR(255),
    password VARCHAR(255),
    is_private BOOLEAN,
    is_admin BOOLEAN
);

-- Table pour les auteurs
CREATE TABLE Author (
    id_author INT PRIMARY KEY,
    name_author VARCHAR(255)
);


-- Table pour les mÃ©dias
CREATE TABLE Media (
    id_media INT PRIMARY KEY,
    name_media VARCHAR(255),
    id_author INT,
    publication_date DATE,
    description VARCHAR(255),
    length INT,
    unite VARCHAR(255),
    average_note DECIMAL(3, 2),
    file_path VARCHAR(255),
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
    id_genre INT PRIMARY KEY,
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

-- Table pour les auteurs
CREATE TABLE Author (
    id_author INT PRIMARY KEY,
    name_author VARCHAR(255)
);


-- Table pour les amis des utilisateurs
CREATE TABLE Friend (
    id_user INT,
    id_friend INT,
    PRIMARY KEY (id_user, id_friend),
    FOREIGN KEY (id_user) REFERENCES "User"(id_user),
    FOREIGN KEY (id_friend) REFERENCES "User"(id_user),
    CONSTRAINT CHK_user_friend_diff CHECK (id_user != id_friend)
);

-- Table pour les posts
CREATE TABLE Post (
    id_post INT PRIMARY KEY,
    title_post VARCHAR(255),
    description_post VARCHAR(255),
    note INT,
    date_post DATE,
    id_user INT,
    id_media INT,
    FOREIGN KEY (id_user) REFERENCES "User"(id_user),
    FOREIGN KEY (id_media) REFERENCES Media(id_media),
    CONSTRAINT CHK_note_range CHECK (note BETWEEN 0 AND 10)
);