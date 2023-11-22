-- CREATE TRIGGER Check_Media_Genre_Category 
-- BEFORE INSERT OR UPDATE ON GenreMedia 
-- FOR EACH ROW
-- declare
--     media_type VARCHAR(255);
--     category_genre VARCHAR(255);
-- BEGIN
--     -- Obtenir le type du média associé
--     SELECT
--         CASE
--             WHEN EXISTS (SELECT 1 FROM Book WHERE id_media = :NEW.id_media) THEN 'Book'
--             WHEN EXISTS (SELECT 1 FROM Movie WHERE id_media = :NEW.id_media) THEN 'Movie'
--             WHEN EXISTS (SELECT 1 FROM Game WHERE id_media = :NEW.id_media) THEN 'Game'
--             WHEN EXISTS (SELECT 1 FROM Music WHERE id_media = :NEW.id_media) THEN 'Music'
--             ELSE NULL
--         END
--     INTO media_type
--     FROM dual;

--     -- Obtenir la category du genre
--     SELECT category INTO category_genre
--     FROM Genre 
--     WHERE id_genre = :NEW.id_genre;

--     -- Vérifier si le genre correspond à la catégorie du média
--     IF category IS NOT NULL THEN 
--         IF media_type IS NOT NULL AND :NEW.category != media_type THEN
--             RAISE_APPLICATION_ERROR(-20001, 'Le genre ne correspond pas à la catégorie du média.');
--         END IF;
--         EXCEPTION
--             WHEN NO_DATA_FOUND THEN
--                 RAISE_APPLICATION_ERROR(-20002, 'Média introuvable.');
--             WHEN OTHERS THEN
--                 RAISE;
--     END IF;
--     EXCEPTION
--         WHEN NO_DATA_FOUND THEN
--             RAISE_APPLICATION_ERROR(-20002, 'Genre introuvable.');
--         WHEN OTHERS THEN
--             RAISE;
-- END;

-- CREATE OR REPLACE TRIGGER Update_Media_Avg_Note
-- AFTER INSERT OR UPDATE ON Post
-- FOR EACH ROW
-- begin
--   update Media
--   set average_note = (
--     select AVG(note)
--       from Post
--      where id_media= :new.id_media
--   )
--   where id_media = :new.id_media;
-- end;


-- CREATE OR REPLACE FUNCTION Get_Books_By_Genre_Type_Author_Date_Note(
--     genre IN VARCHAR2 DEFAULT NULL,
--     type IN VARCHAR2 DEFAULT NULL,
--     author_name IN VARCHAR2 DEFAULT NULL,
--     sort_by_date IN VARCHAR2 DEFAULT NULL,
--     sort_by_note IN VARCHAR2 DEFAULT NULL
-- ) RETURN SYS_REFCURSOR AS
--     books SYS_REFCURSOR;
-- BEGIN
--     OPEN books FOR
--         SELECT b.*
--         FROM Book b
--         JOIN Media m ON b.id_media = m.id_media
--         JOIN GenreMedia gm ON m.id_media = gm.id_media
--         JOIN Genre g ON gm.id_genre = g.id_genre
--         JOIN Author a ON a.id_author = m.id_author
--         WHERE (genre IS NULL OR g.genre = genre)
--             AND (type IS NULL OR b.type = type)
--             AND (author_name IS NULL OR a.author_name = author_name)
--         ORDER BY 
--             CASE WHEN sort_by_date = 'asc' THEN m.publication_date END ASC,
--             CASE WHEN sort_by_date = 'desc' THEN m.publication_date END DESC,
--             CASE WHEN sort_by_note = 'asc' THEN m.average_note END ASC,
--             CASE WHEN sort_by_note = 'desc' THEN m.average_note END DESC;
--     RETURN books;
-- END;

-- CREATE OR REPLACE FUNCTION Get_Movies_By_Genre_Type_Author_Date_Note(
--     genre IN VARCHAR2 DEFAULT NULL,
--     type IN VARCHAR2 DEFAULT NULL,
--     author_name IN VARCHAR2 DEFAULT NULL,
--     sort_by_date IN VARCHAR2 DEFAULT NULL,
--     sort_by_note IN VARCHAR2 DEFAULT NULL
-- ) RETURN SYS_REFCURSOR AS
--     movies SYS_REFCURSOR;
-- BEGIN
--     OPEN books FOR
--         SELECT mov.*
--         FROM Movie mov
--         JOIN Media m ON mov.id_media = m.id_media
--         JOIN GenreMedia gm ON m.id_media = gm.id_media
--         JOIN Genre g ON gm.id_genre = g.id_genre
--         JOIN Author a ON a.id_author = m.id_author
--         WHERE (genre IS NULL OR g.genre = genre)
--             AND (type IS NULL OR mov.type = type) 
--             AND (author_name IS NULL OR a.author_name LIKE '%' || author_name || '%')
--         ORDER BY 
--             CASE WHEN sort_by_date = 'asc' THEN m.publication_date END ASC,
--             CASE WHEN sort_by_date = 'desc' THEN m.publication_date END DESC,
--             CASE WHEN sort_by_note = 'asc' THEN m.average_note END ASC,
--             CASE WHEN sort_by_note = 'desc' THEN m.average_note END DESC;
--     RETURN movies;
-- END;


-- CREATE OR REPLACE FUNCTION Get_Games_By_Genre_Platform_Author_Date_Note(
--     genre IN VARCHAR2 DEFAULT NULL,
--     platform IN VARCHAR2 DEFAULT NULL,
--     author_name IN VARCHAR2 DEFAULT NULL,
--     sort_by_date IN VARCHAR2 DEFAULT NULL,
--     sort_by_note IN VARCHAR2 DEFAULT NULL
-- ) RETURN SYS_REFCURSOR AS
--     games SYS_REFCURSOR;
-- BEGIN
--     OPEN games FOR
--         SELECT game.*
--         FROM Game game
--         JOIN Media m ON game.id_media = m.id_media
--         JOIN GenreMedia gm ON m.id_media = gm.id_media
--         JOIN Genre g ON gm.id_genre = g.id_genre
--         JOIN PlayableOn po ON po.id_game = game.id_media
--         JOIN Author a ON a.id_author = m.id_author
--         WHERE (genre IS NULL OR g.genre = genre)
--             AND (platform IS NULL OR po.platform = platform) 
--             AND (author_name IS NULL OR a.author_name LIKE '%' || author_name || '%')
--         ORDER BY 
--             CASE WHEN sort_by_date = 'asc' THEN m.publication_date END ASC,
--             CASE WHEN sort_by_date = 'desc' THEN m.publication_date END DESC,
--             CASE WHEN sort_by_note = 'asc' THEN m.average_note END ASC,
--             CASE WHEN sort_by_note = 'desc' THEN m.average_note END DESC;
--     RETURN games;
-- END;


-- CREATE OR REPLACE FUNCTION Get_Musics_By_Genre_Album_Author_Date_Note(
--     genre IN VARCHAR2 DEFAULT NULL,
--     album IN VARCHAR2 DEFAULT NULL,
--     author_name IN VARCHAR2 DEFAULT NULL,
--     sort_by_date IN VARCHAR2 DEFAULT NULL,
--     sort_by_note IN VARCHAR2 DEFAULT NULL
-- ) RETURN SYS_REFCURSOR AS
--     musics SYS_REFCURSOR;
-- BEGIN
--     OPEN musics FOR
--         SELECT mus.*
--         FROM Music mus
--         JOIN Media m ON mus.id_media = m.id_media
--         JOIN GenreMedia gm ON m.id_media = gm.id_media
--         JOIN Genre g ON gm.id_genre = g.id_genre
--         JOIN Author a ON a.id_author = m.id_author
--         WHERE (genre IS NULL OR g.genre = genre)
--             AND (album IS NULL OR mus.album LIKE '%' || album || '%') 
--             AND (author_name IS NULL OR a.author_name LIKE '%' || author_name || '%')
--         ORDER BY 
--             CASE WHEN sort_by_date = 'asc' THEN m.publication_date END ASC,
--             CASE WHEN sort_by_date = 'desc' THEN m.publication_date END DESC,
--             CASE WHEN sort_by_note = 'asc' THEN m.average_note END ASC,
--             CASE WHEN sort_by_note = 'desc' THEN m.average_note END DESC;
--     RETURN musics;
-- END;



CREATE OR REPLACE FUNCTION CreateNewMedia(
    media_name VARCHAR(255),
    media_publication_date DATE,
    media_description VARCHAR(255),
    media_length INT,
    media_unite VARCHAR(255),
    media_author_idname VARCHAR(255),
    media_average_note DECIMAL(3, 2),
    media_file_path VARCHAR(255),
    media_genre_ids INT[],
    media_category VARCHAR(255),
    media_type VARCHAR(255),
    media_actors VARCHAR(500),
    media_album VARCHAR (255),
    media_platforms VARCHAR[]
)
RETURNS VOID AS $$
DECLARE
    media_id INT;
    genre_id INT;
    platform VARCHAR;
    author_id INT;
BEGIN

  -- Étape 1: Vérifier si l'auteur existe déjà
    SELECT id_author INTO author_id FROM Author WHERE name_author = media_author_idname;

    -- Étape 2: Si l'auteur n'existe pas, insérer le nouvel auteur
    IF author_id IS NULL THEN
        INSERT INTO Author (name_author) VALUES (media_author_idname)
        RETURNING id_author INTO author_id;
    END IF;

    -- Étape 1: Insérer le média
    INSERT INTO Media (name_media, publication_date, description, length, unite, id_author, average_note, file_path)
    VALUES (media_name, media_publication_date, media_description, media_length, media_unite, author_id, media_average_note, media_file_path)
    RETURNING id_media INTO media_id;

    -- Étape 2: Insérer le type spécifique de média (livre, film, jeu)
    CASE media_category
        WHEN 'Book' THEN
            INSERT INTO Book (id_media, book_type) VALUES (media_id, media_type);
        WHEN 'Movie' THEN
            INSERT INTO Movie (id_media, movie_type, actors) VALUES (media_id, media_type, media_actors);
        WHEN 'Game' THEN
            INSERT INTO Game (id_media) VALUES (media_id);
        WHEN 'Music' THEN
            INSERT INTO Music (id_media, album) VALUES (media_id, media_album);
        ELSE
           -- Générer une exception personnalisée si media_category n'est pas géré
            RAISE EXCEPTION 'Catégorie de média non gérée : %', media_category;
    END CASE;

    -- Étape 3: Insérer les genres du média
    FOREACH genre_id IN ARRAY media_genre_ids
    LOOP
        INSERT INTO GenreMedia (id_genre, id_media) VALUES (genre_id, media_id);
    END LOOP;

    -- Étape 4: Si c'est un jeu, insérer les plateformes jouables
    IF media_category = 'Game' THEN
        FOREACH platform IN ARRAY media_platforms
        LOOP
            INSERT INTO PlayableOn (id_game, platform) VALUES (media_id, platform);
        END LOOP;
    END IF;
END;
$$ LANGUAGE plpgsql;



CREATE OR REPLACE FUNCTION DeleteMedia(
    media_id INT,
    media_category VARCHAR(255)
)
RETURNS VOID AS $$
BEGIN
    -- Étape 1: Supprimer les entrées de la table GenreMedia
    DELETE FROM GenreMedia WHERE id_media = media_id;

    -- Étape 2: Si c'est un jeu, supprimer les entrées de la table PlayableOn
    IF media_category = 'Game' THEN
        DELETE FROM PlayableOn WHERE id_game = media_id;
    END IF;

    -- Étape 3: Supprimer les entrées spécifiques au type de média (Book, Movie, Game)
    CASE media_category
        WHEN 'Book' THEN
            DELETE FROM Book WHERE id_media = media_id;
        WHEN 'Movie' THEN
            DELETE FROM Movie WHERE id_media = media_id;
        WHEN 'Game' THEN
            DELETE FROM Game WHERE id_media = media_id;
        WHEN 'Music' THEN
            DELETE FROM Music WHERE id_media = media_id;
    END CASE;

    -- Étape 4: Supprimer l'entrée de la table Media
    DELETE FROM Media WHERE id_media = media_id;

END;
$$ LANGUAGE plpgsql;
