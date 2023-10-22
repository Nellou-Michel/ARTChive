-- Table pour les utilisateurs
CREATE TABLE "User" (
    id_user SERIAL PRIMARY KEY,
    pseudo_user VARCHAR(255),
    name_user VARCHAR(255),
    lastname_user VARCHAR(255),
    password VARCHAR(255),
    is_private BOOLEAN,
    is_admin BOOLEAN
);

-- Table pour les médias
CREATE TABLE Media (
    id_media INT PRIMARY KEY,
    name_media VARCHAR(255),
    publication_date DATE,
    description VARCHAR(255),
    length INT,
    unite VARCHAR(255),
    FOREIGN KEY (id_author) REFERENCES Author(id_author),
    average_note DECIMAL(3, 2),
    file_path VARCHAR(255)
);

-- Table pour les livres
CREATE TABLE Book (
    id_media INT PRIMARY KEY,
    book_type VARCHAR(255),
    FOREIGN KEY (id_media) REFERENCES Media(id_media)
);

-- Table pour les films
CREATE TABLE Movie (
    id_media INT PRIMARY KEY,
    actors VARCHAR(500),
    movie_type VARCHAR(255),
    FOREIGN KEY (id_media) REFERENCES Media(id_media)
);

-- Table pour les jeux
CREATE TABLE Game (
    id_media INT PRIMARY KEY,
    FOREIGN KEY (id_media) REFERENCES Media(id_media)
);

-- Table pour les types de films
CREATE TABLE MovieType (
    movie_type VARCHAR(255) PRIMARY KEY
);

-- Table pour les types de livres
CREATE TABLE BookType (
    book_type VARCHAR(255) PRIMARY KEY
);

-- Table pour les genres
CREATE TABLE Genre (
    id_genre SERIAL PRIMARY KEY,
    genre VARCHAR(255),
    category VARCHAR(255)
);

-- Table pour les genres des médias
CREATE TABLE GenreMedia (
    id_genre INT,
    id_media INT,
    PRIMARY KEY (id_genre, id_media),
    FOREIGN KEY (id_media) REFERENCES Media(id_media)
);

-- Table pour les plates-formes de jeux
CREATE TABLE Platform (
    id_platform SERIAL PRIMARY KEY,
    name_platform VARCHAR(255)
);

-- Table pour les jeux jouables sur certaines plates-formes
CREATE TABLE PlayableOn (
    id_game INT,
    id_platform INT,
    PRIMARY KEY (id_game, id_platform),
    FOREIGN KEY (id_game) REFERENCES Game(id_media),
    FOREIGN KEY (id_platform) REFERENCES Platform(id_platform)
);
-- Table pour les auteurs
CREATE TABLE Author (
    id_author SERIAL PRIMARY KEY,
    name_author VARCHAR(255)
);


-- Table pour les amis des utilisateurs
CREATE TABLE Friend (
    id_user INT,
    id_friend INT,
    PRIMARY KEY (id_user, id_friend),
    FOREIGN KEY (id_user) REFERENCES "User"(id_user),
    FOREIGN KEY (id_friend) REFERENCES "User"(id_user)
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
    FOREIGN KEY (id_user) REFERENCES "User"(id_user),
    FOREIGN KEY (id_media) REFERENCES Media(id_media)
);
