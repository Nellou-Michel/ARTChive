CREATE TRIGGER Check_Media_Genre_Category 
BEFORE INSERT OR UPDATE ON GenreMedia 
FOR EACH ROW
declare
    media_type VARCHAR(255);
    category_genre VARCHAR(255);
BEGIN
    -- Obtenir le type du média associé
    SELECT
        CASE
            WHEN EXISTS (SELECT 1 FROM Book WHERE id_media = :NEW.id_media) THEN 'Book'
            WHEN EXISTS (SELECT 1 FROM Movie WHERE id_media = :NEW.id_media) THEN 'Movie'
            WHEN EXISTS (SELECT 1 FROM Game WHERE id_media = :NEW.id_media) THEN 'Game'
            WHEN EXISTS (SELECT 1 FROM Music WHERE id_media = :NEW.id_media) THEN 'Music'
            ELSE NULL
        END
    INTO media_type
    FROM dual;

    -- Obtenir la category du genre
    SELECT category INTO category_genre
    FROM Genre 
    WHERE id_genre = :NEW.id_genre;

    -- Vérifier si le genre correspond à la catégorie du média
    IF category IS NOT NULL THEN 
        IF media_type IS NOT NULL AND :NEW.category != media_type THEN
            RAISE_APPLICATION_ERROR(-20001, 'Le genre ne correspond pas à la catégorie du média.');
        END IF;
        EXCEPTION
            WHEN NO_DATA_FOUND THEN
                RAISE_APPLICATION_ERROR(-20002, 'Média introuvable.');
            WHEN OTHERS THEN
                RAISE;
    END IF;
    EXCEPTION
        WHEN NO_DATA_FOUND THEN
            RAISE_APPLICATION_ERROR(-20002, 'Genre introuvable.');
        WHEN OTHERS THEN
            RAISE;
END;

CREATE OR REPLACE TRIGGER Update_Media_Avg_Note
AFTER INSERT OR UPDATE ON Post
FOR EACH ROW
begin
  update Media
  set average_note = (
    select AVG(note)
      from Post
     where id_media= :new.id_media
  )
  where id_media = :new.id_media;
end;


CREATE OR REPLACE FUNCTION Get_Books_By_Genre_Type_Author_Date_Note(
    genre IN VARCHAR2 DEFAULT NULL,
    type IN VARCHAR2 DEFAULT NULL,
    author_name IN VARCHAR2 DEFAULT NULL,
    sort_by_date IN VARCHAR2 DEFAULT NULL,
    sort_by_note IN VARCHAR2 DEFAULT NULL
) RETURN SYS_REFCURSOR AS
    books SYS_REFCURSOR;
BEGIN
    OPEN books FOR
        SELECT b.*
        FROM Book b
        JOIN Media m ON b.id_media = m.id_media
        JOIN GenreMedia gm ON m.id_media = gm.id_media
        JOIN Genre g ON gm.id_genre = g.id_genre
        JOIN Author a ON a.id_author = m.id_author
        WHERE (genre IS NULL OR g.genre = genre)
            AND (type IS NULL OR b.type = type)
            AND (author_name IS NULL OR a.author_name = author_name)
        ORDER BY 
            CASE WHEN sort_by_date = 'asc' THEN m.publication_date END ASC,
            CASE WHEN sort_by_date = 'desc' THEN m.publication_date END DESC,
            CASE WHEN sort_by_note = 'asc' THEN m.average_note END ASC,
            CASE WHEN sort_by_note = 'desc' THEN m.average_note END DESC;
    RETURN books;
END;

CREATE OR REPLACE FUNCTION Get_Movies_By_Genre_Type_Author_Date_Note(
    genre IN VARCHAR2 DEFAULT NULL,
    type IN VARCHAR2 DEFAULT NULL,
    author_name IN VARCHAR2 DEFAULT NULL,
    sort_by_date IN VARCHAR2 DEFAULT NULL,
    sort_by_note IN VARCHAR2 DEFAULT NULL
) RETURN SYS_REFCURSOR AS
    movies SYS_REFCURSOR;
BEGIN
    OPEN books FOR
        SELECT mov.*
        FROM Movie mov
        JOIN Media m ON mov.id_media = m.id_media
        JOIN GenreMedia gm ON m.id_media = gm.id_media
        JOIN Genre g ON gm.id_genre = g.id_genre
        JOIN Author a ON a.id_author = m.id_author
        WHERE (genre IS NULL OR g.genre = genre)
            AND (type IS NULL OR mov.type = type) 
            AND (author_name IS NULL OR a.author_name LIKE '%' || author_name || '%')
        ORDER BY 
            CASE WHEN sort_by_date = 'asc' THEN m.publication_date END ASC,
            CASE WHEN sort_by_date = 'desc' THEN m.publication_date END DESC,
            CASE WHEN sort_by_note = 'asc' THEN m.average_note END ASC,
            CASE WHEN sort_by_note = 'desc' THEN m.average_note END DESC;
    RETURN movies;
END;


CREATE OR REPLACE FUNCTION Get_Games_By_Genre_Platform_Author_Date_Note(
    genre IN VARCHAR2 DEFAULT NULL,
    platform IN VARCHAR2 DEFAULT NULL,
    author_name IN VARCHAR2 DEFAULT NULL,
    sort_by_date IN VARCHAR2 DEFAULT NULL,
    sort_by_note IN VARCHAR2 DEFAULT NULL
) RETURN SYS_REFCURSOR AS
    games SYS_REFCURSOR;
BEGIN
    OPEN games FOR
        SELECT game.*
        FROM Game game
        JOIN Media m ON game.id_media = m.id_media
        JOIN GenreMedia gm ON m.id_media = gm.id_media
        JOIN Genre g ON gm.id_genre = g.id_genre
        JOIN PlayableOn po ON po.id_game = game.id_media
        JOIN Author a ON a.id_author = m.id_author
        WHERE (genre IS NULL OR g.genre = genre)
            AND (platform IS NULL OR po.platform = platform) 
            AND (author_name IS NULL OR a.author_name LIKE '%' || author_name || '%')
        ORDER BY 
            CASE WHEN sort_by_date = 'asc' THEN m.publication_date END ASC,
            CASE WHEN sort_by_date = 'desc' THEN m.publication_date END DESC,
            CASE WHEN sort_by_note = 'asc' THEN m.average_note END ASC,
            CASE WHEN sort_by_note = 'desc' THEN m.average_note END DESC;
    RETURN games;
END;


CREATE OR REPLACE FUNCTION Get_Musics_By_Genre_Album_Author_Date_Note(
    genre IN VARCHAR2 DEFAULT NULL,
    album IN VARCHAR2 DEFAULT NULL,
    author_name IN VARCHAR2 DEFAULT NULL,
    sort_by_date IN VARCHAR2 DEFAULT NULL,
    sort_by_note IN VARCHAR2 DEFAULT NULL
) RETURN SYS_REFCURSOR AS
    musics SYS_REFCURSOR;
BEGIN
    OPEN musics FOR
        SELECT mus.*
        FROM Music mus
        JOIN Media m ON mus.id_media = m.id_media
        JOIN GenreMedia gm ON m.id_media = gm.id_media
        JOIN Genre g ON gm.id_genre = g.id_genre
        JOIN Author a ON a.id_author = m.id_author
        WHERE (genre IS NULL OR g.genre = genre)
            AND (album IS NULL OR mus.album LIKE '%' || album || '%') 
            AND (author_name IS NULL OR a.author_name LIKE '%' || author_name || '%')
        ORDER BY 
            CASE WHEN sort_by_date = 'asc' THEN m.publication_date END ASC,
            CASE WHEN sort_by_date = 'desc' THEN m.publication_date END DESC,
            CASE WHEN sort_by_note = 'asc' THEN m.average_note END ASC,
            CASE WHEN sort_by_note = 'desc' THEN m.average_note END DESC;
    RETURN musics;
END;


CREATE OF REPLACE FUNCTION Create_Film(
    author_name
    title
    description
    size
    acteur
    type
    genre
) RETURN film;
BEGIN 
    OPEN film FOR
        INSERT INTO media VALUES(author_name .......);
        INSERT INTO film VALUES(id_media, acteurs);
ENDs