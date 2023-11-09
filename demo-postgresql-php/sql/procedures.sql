CREATE TRIGGER check_media_genre_category 
BEFORE INSERT OR UPDATE ON GenreMedia 
FOR EACH ROW
declare
    media_type VARCHAR(255);
    category_genre VARCHR(255);
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


