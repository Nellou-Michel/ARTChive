CREATE TABLE User (
    user_id INT PRIMARY KEY,
    user_pseudo VARCHAR(255),
    user_name VARCHAR(255),
    user_surname VARCHAR(255),
    password VARCHAR(255),
    is_private BOOLEAN,
    is_admin BOOLEAN
);

-- Table pour les médias
CREATE TABLE Media (
    media_id INT PRIMARY KEY,
    name_media VARCHAR(255),
    publication_date DATE,
    description VARCHAR(255),
    duree INT,
    unite VARCHAR(255)
);

-- Table pour les livres
CREATE TABLE Book (
    media_id INT PRIMARY KEY,
    type VARCHAR(255),
    FOREIGN KEY (media_id) REFERENCES Media(media_id),
    CONSTRAINT CHK_type_book CHECK type IN ('BD', 'roman', 'poesie', 'essai', 'conte', 'manuel', 'encyclopedie', 'guide', 'magazine', 'theatre', 'nouvelles', 'album')
);

-- Table pour les films
CREATE TABLE Movie (
    media_id INT PRIMARY KEY,
    acteurs VARCHAR(500),
    type VARCHAR(255),
    FOREIGN KEY (media_id) REFERENCES Media(media_id)
    CONSTRAINT CHK_type_genre CHECK type IN ('long-metrage', 'documentaire', 'court-metrage', 'serie')
);

-- Table pour les jeux
CREATE TABLE Game (
    media_id INT PRIMARY KEY,
    FOREIGN KEY (media_id) REFERENCES Media(media_id)
);

-- Table pour les genres des livres
CREATE TABLE GenreBook (
    book_id INT PRIMARY KEY,
    genre VARCHAR(255),
    FOREIGN KEY (book_id) REFERENCES Book(media_id)
);

-- Table pour les genres des films
CREATE TABLE GenreMovie (
    movie_id INT PRIMARY KEY,
    genre VARCHAR(255),
    FOREIGN KEY (movie_id) REFERENCES Movie(media_id)
);

-- Table pour les genres des jeux
CREATE TABLE GenreGame (
    game_id INT PRIMARY KEY,
    genre VARCHAR(255),
    FOREIGN KEY (game_id) REFERENCES Game(media_id)
    CONSTRAINT CHK_genre_game CHECK genre IN ('combat', 'plateforme', 'tir', 'aventure', 'action-aventure', 
    'rpg', 'reflexion', 'simulation', 'strategie', 'sport', 'course', 'rythme', 'moba')
);

-- Table pour les plates-formes de jeux
CREATE TABLE Platform (
    game_id INT PRIMARY KEY,
    platform VARCHAR(255),
    FOREIGN KEY (game_id) REFERENCES Game(media_id)
    CONSTRAINT CHK_platform CHECK plateform IN ('PC', 'Playstation', 'Nintendo', 'Xbox','Mobile', 'Retro')
);

-- Table pour les auteurs des médias
CREATE TABLE MediaAuthor (
    media_id INT PRIMARY KEY,
    author_id INT PRIMARY KEY,
    FOREIGN KEY (media_id) REFERENCES Media(media_id),
    FOREIGN KEY (author_id) REFERENCES Author(author_id)
);

-- Table pour les auteurs
CREATE TABLE Author (
    author_id INT PRIMARY KEY,
    author_name VARCHAR(255)
);

-- Table pour les amis des utilisateurs
CREATE TABLE Friend (
    user_id INT PRIMARY KEY,
    friend_id INT PRIMARY KEY,
    FOREIGN KEY (user_id) REFERENCES User(user_id),
    FOREIGN KEY (friend_id) REFERENCES User(user_id)
);

-- Table pour les images liées aux médias
CREATE TABLE Picture (
    id_media INT PRIMARY KEY,
    file_path VARCHAR(255) PRIMARY KEY,
    FOREIGN KEY (id_media) REFERENCES Media(media_id)
);

-- Table pour les posts
CREATE TABLE Post (
    id_post INT PRIMARY KEY,
    title_post VARCHAR(255),
    description_post VARCHAR(255),
    note INT,
    date_post DATE,
    id_auteur INT,
    id_media INT,
    FOREIGN KEY (id_auteur) REFERENCES User(user_id),
    FOREIGN KEY (id_media) REFERENCES Media(media_id)
    CONSTRAINT CHK_note_range CHECK (note BETWEEN 0 AND 10)
);