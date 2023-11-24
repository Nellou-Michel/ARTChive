 CREATE OR REPLACE FUNCTION func_Check_Media_Genre_Category()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS
$$
DECLARE
   media_type VARCHAR(255);
category_genre VARCHAR(255);
BEGIN
    SELECT
        CASE
            WHEN EXISTS (SELECT 1 FROM Book WHERE id_media = NEW.id_media) THEN 'Book'
            WHEN EXISTS (SELECT 1 FROM Movie WHERE id_media = NEW.id_media) THEN 'Movie'
            WHEN EXISTS (SELECT 1 FROM Game WHERE id_media = NEW.id_media) THEN 'Game'
            WHEN EXISTS (SELECT 1 FROM Music WHERE id_media = NEW.id_media) THEN 'Music'
            ELSE NULL
        END
    INTO media_type;

    SELECT category INTO category_genre
    FROM Genre 
    WHERE id_genre = NEW.id_genre;

    IF category_genre IS NULL THEN 
        RAISE EXCEPTION 'Genre introuvable.';
    END IF;

    RETURN NEW;
    EXCEPTION
        WHEN NO_DATA_FOUND THEN
            RAISE EXCEPTION 'Média introuvable.';
        WHEN OTHERS THEN
            RAISE;
END;
$$;
CREATE OR REPLACE TRIGGER Check_Media_Genre_Category 
BEFORE INSERT OR UPDATE ON GenreMedia 
FOR EACH ROW
EXECUTE PROCEDURE func_Check_Media_Genre_Category();

CREATE OR REPLACE FUNCTION func_Update_Media_Avg_Note()
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS
$$
begin
update Media
set average_note = (
    select AVG(note)
    from Post
    where id_media=new.id_media
)
where id_media =new.id_media;
end;
$$;
CREATE OR REPLACE TRIGGER Update_Media_Avg_Note
AFTER INSERT OR UPDATE ON Post
FOR EACH ROW
EXECUTE PROCEDURE func_Update_Media_Avg_Note();


CREATE OR REPLACE FUNCTION Get_Books_By_Genre_Type_Author_Date_Note(
    genre_media_list INT[] DEFAULT NULL,
    type VARCHAR DEFAULT NULL,
    author_name VARCHAR DEFAULT NULL,
    sort_by_title VARCHAR DEFAULT NULL,
    sort_by_date VARCHAR DEFAULT NULL,
    sort_by_note VARCHAR DEFAULT NULL
) RETURNS SETOF Media AS 
$$
BEGIN
    RETURN QUERY
    SELECT DISTINCT ON (m.id_media) m.*
    FROM Media m
    JOIN Book b ON b.id_media = m.id_media
    LEFT JOIN GenreMedia gm ON m.id_media = gm.id_media
    LEFT JOIN Author a ON a.id_author = m.id_author
    WHERE 
        (genre_media_list IS NULL OR ARRAY(SELECT unnest(genre_media_list)) IS NULL OR gm.id_genre = ANY(genre_media_list))
        AND (type IS NULL OR b.book_type = type)
        AND (author_name IS NULL OR a.name_author LIKE '%' || author_name || '%')
    ORDER BY 
        CASE WHEN sort_by_title = 'asc' THEN m.name_media END ASC,
        CASE WHEN sort_by_title = 'desc' THEN m.name_media END DESC,
        CASE WHEN sort_by_date = 'asc' THEN m.publication_date END ASC,
        CASE WHEN sort_by_date = 'desc' THEN m.publication_date END DESC,
        CASE WHEN sort_by_note = 'asc' THEN m.average_note END ASC,
        CASE WHEN sort_by_note = 'desc' THEN m.average_note END DESC,
        m.id_media;
END;
$$ 
LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION Get_Movies_By_Genre_Type_Author_Date_Note(
    genre_media_list INT[] DEFAULT NULL,
    type VARCHAR DEFAULT NULL,
    author_name VARCHAR DEFAULT NULL,
    sort_by_title VARCHAR DEFAULT NULL,
    sort_by_date VARCHAR DEFAULT NULL,
    sort_by_note VARCHAR DEFAULT NULL
 ) RETURNS SETOF Media AS
	 $$
 BEGIN
     RETURN QUERY
	 SELECT DISTINCT ON (m.id_media) m.*
	 FROM Media m
	 JOIN Movie mov ON mov.id_media = m.id_media
	 LEFT JOIN GenreMedia gm ON m.id_media = gm.id_media
	 LEFT JOIN Author a ON a.id_author = m.id_author
	 WHERE 
        (genre_media_list IS NULL OR ARRAY(SELECT unnest(genre_media_list)) IS NULL OR gm.id_genre = ANY(genre_media_list))
		 AND (type IS NULL OR mov.movie_type = type) 
		 AND (author_name IS NULL OR a.name_author LIKE '%' || author_name || '%')
	 ORDER BY 
        m.id_media,
        CASE WHEN sort_by_title = 'asc' THEN m.name_media END ASC,
        CASE WHEN sort_by_title = 'desc' THEN m.name_media END DESC,
		CASE WHEN sort_by_date = 'asc' THEN m.publication_date END ASC,
		CASE WHEN sort_by_date = 'desc' THEN m.publication_date END DESC,
		CASE WHEN sort_by_note = 'asc' THEN m.average_note END ASC,
		CASE WHEN sort_by_note = 'desc' THEN m.average_note END DESC;
 END;
 $$
 LANGUAGE PLPGSQL;


CREATE OR REPLACE FUNCTION Get_Games_By_Genre_Platform_Author_Date_Note(
    genre_media_list INT[] DEFAULT NULL,
    platform_game VARCHAR[] DEFAULT NULL,
    author_name VARCHAR DEFAULT NULL,
    sort_by_title VARCHAR DEFAULT NULL,
    sort_by_date VARCHAR DEFAULT NULL,
    sort_by_note VARCHAR DEFAULT NULL
) RETURNS SETOF Media AS
$$
BEGIN
    RETURN QUERY
    SELECT DISTINCT ON (m.id_media) m.*
    FROM Media m
    JOIN Game game ON game.id_media = m.id_media
    LEFT JOIN GenreMedia gm ON m.id_media = gm.id_media
    LEFT JOIN Genre g ON gm.id_genre = g.id_genre
    LEFT JOIN PlayableOn po ON po.id_game = game.id_media
    LEFT JOIN Author a ON a.id_author = m.id_author
    WHERE (genre_media_list IS NULL OR ARRAY(SELECT unnest(genre_media_list)) IS NULL OR gm.id_genre = ANY(genre_media_list))
        AND (platform_game IS NULL OR ARRAY(SELECT unnest(platform_game)) IS NULL OR po.platform = ANY(platform_game))
        AND (author_name IS NULL OR a.name_author LIKE '%' || author_name || '%')
    ORDER BY 
        m.id_media,
        CASE WHEN sort_by_title = 'asc' THEN m.name_media END ASC,
        CASE WHEN sort_by_title = 'desc' THEN m.name_media END DESC,
        CASE WHEN sort_by_date = 'asc' THEN m.publication_date END ASC,
        CASE WHEN sort_by_date = 'desc' THEN m.publication_date END DESC,
        CASE WHEN sort_by_note = 'asc' THEN m.average_note END ASC,
        CASE WHEN sort_by_note = 'desc' THEN m.average_note END DESC;
END;
$$
LANGUAGE PLPGSQL;


CREATE OR REPLACE FUNCTION Get_Musics_By_Genre_Album_Author_Date_Note(
    genre_media_list INT[] DEFAULT NULL,
    album_music VARCHAR DEFAULT NULL,
    author_name VARCHAR DEFAULT NULL,
    sort_by_title VARCHAR DEFAULT NULL,
    sort_by_date VARCHAR DEFAULT NULL,
    sort_by_note VARCHAR DEFAULT NULL
) RETURNS SETOF Media AS
$$
BEGIN
    RETURN QUERY
        SELECT DISTINCT ON (m.id_media) m.*
        FROM Media m
        JOIN Music mus ON mus.id_media = m.id_media
        LEFT JOIN GenreMedia gm ON m.id_media = gm.id_media
        LEFT JOIN Genre g ON gm.id_genre = g.id_genre
        LEFT JOIN Author a ON a.id_author = m.id_author
        WHERE 
            (genre_media_list IS NULL OR ARRAY(SELECT unnest(genre_media_list)) IS NULL OR gm.id_genre = ANY(genre_media_list))
            AND (album_music IS NULL OR mus.album LIKE '%' || album_music || '%') 
            AND (author_name IS NULL OR a.name_author LIKE '%' || author_name || '%')
        ORDER BY
			m.id_media,
            CASE WHEN sort_by_title = 'asc' THEN m.name_media END ASC,
            CASE WHEN sort_by_title = 'desc' THEN m.name_media END DESC,
            CASE WHEN sort_by_date = 'asc' THEN m.publication_date END ASC,
            CASE WHEN sort_by_date = 'desc' THEN m.publication_date END DESC,
            CASE WHEN sort_by_note = 'asc' THEN m.average_note END ASC,
            CASE WHEN sort_by_note = 'desc' THEN m.average_note END DESC;
END;
$$
LANGUAGE PLPGSQL;



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
            --Générer une exception personnalisée si media_category n'est pas géré
            RAISE EXCEPTION 'Catégorie de média non gérée : %', media_category;
    END CASE;

     --Étape 3: Insérer les genres du média
    FOREACH genre_id IN ARRAY media_genre_ids
    LOOP
        INSERT INTO GenreMedia (id_genre, id_media) VALUES (genre_id, media_id);
    END LOOP;

     --Étape 4: Si c'est un jeu, insérer les plateformes jouables
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

   --LIVRES
SELECT CreateNewMedia(
            'Le Seigneur des Anneaux',  -- Nom du média
            '1954-07-29',               -- Date de publication
            'Un chef-d''œuvre de la littérature fantastique.',  -- Description
            120,                        -- Durée (en minutes, ajustez selon vos besoins)
            'minutes',                  -- Unité de la durée
            'J.R.R. Tolkien',           -- Nom de l'auteur
            9.5,                        -- Note moyenne
            'https://imgs.search.brave.com/kvSyb7qnNyAFspmQETAV8ID-8x3GbDT2oVq599IFO9c/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9jZG4u/Y3VsdHVyYS5jb20v/Y2RuLWNnaS9pbWFn/ZS93aWR0aD0yMTAv/bWVkaWEvcGltL1RJ/VEVMSVZFLzY4Xzk3/ODI4NDIyODIxNThf/MV83NS5qcGc',   -- Chemin de l'image
            ARRAY[1, 6, 12],             -- Genres du livre (Action, Aventure, Fantasy)
            'Book',                     -- Catégorie du média
            'Roman',                    -- Type spécifique de média (ici, un roman)
            NULL,                       -- Acteurs (n'est pas applicable ici)
            NULL,                       -- Album (n'est pas applicable ici)
            NULL                        -- Plateformes jouables (n'est pas applicable ici)
    );

SELECT CreateNewMedia(
            'Harry Potter à l école des sorciers',
            '1997-06-26',
            'Premier livre de la série Harry Potter.',
            309,
            'minutes',
            'J.K. Rowling',
            9.0,
            'https://imgs.search.brave.com/gJYdOqS10SuBedXqBLhuMjjQKFOE7OEBi3FEAEkAjvY/rs:fit:500:0:0/g:ce/aHR0cHM6Ly93d3cu/YmFiZWxpby5jb20v/Y291di9DVlRfMTAy/MzBfNjcxMTYyLmpw/Zw',
            ARRAY[1, 6, 9],
            'Book',
            'Poésie',
            NULL,
            NULL,
            NULL
    );

SELECT CreateNewMedia(
            '1984',
            '1949-06-08',
            'Un roman d anticipation dystopique.',
            328,
            'pages',
            'George Orwell',
            8.5,
            'https://imgs.search.brave.com/z7zP_9zUvXh6Izd2jplstDDmuKlvgLqu9dJ2DpohZO0/rs:fit:500:0:0/g:ce/aHR0cHM6Ly93d3cu/YmFiZWxpby5jb20v/Y291di9DVlRfMTk4/NF82MTc1LmpwZw   ',
            ARRAY[2, 7, 10],
            'Book',
            'Nouvelle',
            NULL,
            NULL,
            NULL
    );

SELECT CreateNewMedia(
            'Le Hobbit',
            '1937-09-21',
            'Une aventure épique de fantasy.',
            310,
            'pages',
            'J.R.R. Tolkien',
            9.2,
            'https://imgs.search.brave.com/ISdW16XocgzhWK_J9meyNqh1A6gNOj0T43tCN0tjetc/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9pbWFn/ZXMuZXBhZ2luZS5m/ci84MjIvOTc4MjI1/MzE4MzgyMl8xXzc1/LmpwZw',
            ARRAY[1, 6, 12],
            'Book',
            'BD',
            NULL,
            NULL,
            NULL
    );

SELECT CreateNewMedia(
            'Crime et Châtiment',
            '1866-12-22',
            'Un chef-d œuvre de la littérature russe.',
            545,
            'pages',
            'Fiodor Dostoïevski',
            8.8,
            'https://imgs.search.brave.com/glTWEzO3mNe3BoDiPhMVRCqhRukqlx4L8z4rl-R0NFw/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9wcm9k/dWN0cy1pbWFnZXMu/ZGktc3RhdGljLmNv/bS9pbWFnZS9mZWRv/ci1kb3N0b2lldnNr/aS1jcmltZS1ldC1j/aGF0aW1lbnQvOTc4/MjI1MzA4MjUwNy0y/MDB4MzAzLTEuanBn',
            ARRAY[3, 8, 11],
            'Book',
            'Manga',
            NULL,
            NULL,
            NULL
    );

SELECT CreateNewMedia(
            'Le Parrain',
            '1969-03-10',
            'Un roman policier qui a inspiré le célèbre film.',
            448,
            'pages',
            'Mario Puzo',
            9.1,
            'https://imgs.search.brave.com/-2kqEePYpzEyvdh9vRzV8LSbDD8_sg7913weNZDEsBQ/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9pbWFn/ZXMtbmEuc3NsLWlt/YWdlcy1hbWF6b24u/Y29tL2ltYWdlcy9J/LzQxMktLUktDS0FM/LmpwZw',
            ARRAY[2, 6, 8],
            'Book',
            'BD',
            NULL,
            NULL,
            NULL
    );

    --FILM
 SELECT CreateNewMedia(
                'Inception',
                '2010-07-08',
                'Un film de science-fiction sur les rêves.',
                148,
                'minutes',
                'Christopher Nolan',
                9.3,
                'https://imgs.search.brave.com/2yHOIgKlrnVufeg-kjJ-vz2TZF-bFJjAsyWscwLjMDM/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9raW5l/cG9saXMuYmUvZnIv/c2l0ZXMva2luZXBv/bGlzLmJlLmZyL2Zp/bGVzL3N0eWxlcy9r/aW5lcG9saXNfZmls/dGVyX21vdmllX3Bv/c3Rlci9wdWJsaWMv/cG9zdGVycy9JbmNl/cHRpb25fcG9zdGVy/LmpwZw',
                ARRAY[2, 7, 10],
                'Movie',
                'Animation',
                'Leonardo DiCaprio, Ellen Page, Tom Hardy',
                NULL,
                NULL
    );

 SELECT CreateNewMedia(
                'The Dark Knight',
                '2008-07-14',
                'Un film de super-héros sombre et captivant.',
                152,
                'minutes',
                'Christopher Nolan',
                9.5,
                'https://imgs.search.brave.com/9jEC8JDuv_22P4o0RdXDQT0IjK76j_VY_D3d2p4un-U/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9tLm1l/ZGlhLWFtYXpvbi5j/b20vaW1hZ2VzL0kv/ODFyR0NtMFB5SEwu/anBn',
                ARRAY[1, 6, 9],
                'Movie',
                'Long Métrage',
                'Christian Bale, Heath Ledger, Aaron Eckhart',
                NULL,
                NULL
        );

 SELECT CreateNewMedia(
                'Pulp Fiction',
                '1994-10-14',
                'Une œuvre culte du réalisateur Quentin Tarantino.',
                154,
                'minutes',
                'Quentin Tarantino',
                9.0,
                'https://imgs.search.brave.com/gRpfFBEoqNYkT7vasvhVWlOvyo-CwacYszqdHN5CFlk/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9tLm1l/ZGlhLWFtYXpvbi5j/b20vaW1hZ2VzL0kv/NzFtbGdFN25VZEwu/anBn',
                ARRAY[3, 8, 11],
                'Movie',
                'Documentaire',
                'John Travolta, Uma Thurman, Samuel L. Jackson',
                NULL,
                NULL
        );

 SELECT CreateNewMedia(
                'The Shawshank Redemption',
                '1994-09-23',
                'Un homme innocent se bat pour sa liberté dans une prison corrompue.',
                142,
                'minutes',
                'Frank Darabont',
                9.7,
                'https://imgs.search.brave.com/2qSyceu44kSBqzaTdfv17HVgVtYrnJHa5KBkuXWFN0s/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9tLm1l/ZGlhLWFtYXpvbi5j/b20vaW1hZ2VzL0kv/NzFBendnTFQyV0wu/anBn',
                ARRAY[1, 3, 8],
                'Movie',
                'Court-métrage',
                'Tim Robbins, Morgan Freeman, Bob Gunton',
                NULL,
                NULL
        );

    --JEUX
 SELECT CreateNewMedia(
                'The Legend of Zelda: Breath of the Wild',
                '2017-03-03',
                'Action-RPG épique',
                50,
                'heures',
                'Shigeru Miyamoto',
                9.5,
                'https://imgs.search.brave.com/kJWWAWlt0xSvX5byYkQEXTrkRIrixizmgBlbP_qlGm0/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9tLm1l/ZGlhLWFtYXpvbi5j/b20vaW1hZ2VzL0kv/NTFhVjlvVHVhTUwu/anBn',
                ARRAY[1, 6], -- Genres: Aventure, Action
                'Game',
                'Action-Adventure',
                NULL, -- Pas d'acteurs pour un jeu
                NULL, -- Pas d'album pour un jeu
                ARRAY['Nintendo Switch'] -- Plateformes
        );

 SELECT CreateNewMedia(
                'The Witcher 3: Wild Hunt',
                '2015-05-19',
                'RPG d action en monde ouvert',
                100,
                'heures',
                'J.R.R. Tolkien',
                9.8,
                'https://imgs.search.brave.com/iHOFFf5hGw75bE61vstgmBw0CLkQuuzEdopwVfTKmCA/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9pLmpl/dXhhY3R1cy5jb20v/ZGF0YXMvamV1eC90/L2gvdGhlLXdpdGNo/ZXItMy10cmFxdWUt/c2F1dmFnZS9wL3Ro/ZS13aXRjaGVyLTMt/dHJhcXVlLXNhLTUz/OTE4ZjcwMDI4YjEu/anBn',
                ARRAY[7, 8], -- Genres: RPG, Aventure
                'Game',
                'Action-RPG',
                NULL, -- Pas d'acteurs pour un jeu
                NULL, -- Pas d'album pour un jeu
                ARRAY['PC', 'PlayStation 4', 'Xbox One', 'Nintendo Switch'] -- Plateformes
        );

 SELECT CreateNewMedia(
                'Super Mario Odyssey',
                '2017-10-27',
                'Plateforme en 3D',
                15,
                'heures',
                'Shigeru Miyamoto',
                9.7,
                'https://imgs.search.brave.com/vCryXw5qW6tTCUEfO2nEv9TxZEhQwKX0_N1jrdbh7wA/rs:fit:500:0:0/g:ce/aHR0cHM6Ly93d3cu/bmludGVuZG8tbWFz/dGVyLmNvbS9maWNo/aWVycy9maWNoZXNf/bWluL3N1cGVyLW1h/cmlvLW9keXNzZXkt/NTE3NS5qcGc',
                ARRAY[1, 2], -- Genres: Action, Plateforme
                'Game',
                'Plateforme',
                NULL, -- Pas d'acteurs pour un jeu
                NULL, -- Pas d'album pour un jeu
                ARRAY['Nintendo Switch'] -- Plateformes
        );

 SELECT CreateNewMedia(
                'Cyberpunk 2077',
                '2020-12-10',
                'RPG d action en monde ouvert',
                60,
                'heures',
                'Hideo Kojima',
                8.2,
                'https://imgs.search.brave.com/JtYI1J8RPNR55W_ddZvPcwlOYTxs01i6xiwe9aX_7bQ/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9pbWFn/ZS5hcGkucGxheXN0/YXRpb24uY29tL3Z1/bGNhbi9hcC9ybmQv/MjAyMTExLzMwMTMv/YnhTajRqTzBLQnFV/Z0FiSDN6dU5qQ2pl/LmpwZw',
                ARRAY[1, 4], -- Genres: Action, RPG
                'Game',
                'Action-RPG',
                NULL, -- Pas d'acteurs pour un jeu
                NULL, -- Pas d'album pour un jeu
                ARRAY['PC', 'PlayStation 4', 'Xbox One'] -- Plateformes
        );

    --MUSIC
 SELECT CreateNewMedia(
                'Bohemian Rhapsody',
                '1975-10-31',
                'Chanson emblématique de Queen',
                5,
                'minutes',
                'Freddie Mercury',
                9.8,
                'https://imgs.search.brave.com/gMvu_H4qmAMvpTd7_gMnybA6hXwHFfzD033xlb2p4kA/rs:fit:500:0:0/g:ce/aHR0cHM6Ly93d3cu/dWRpc2NvdmVybXVz/aWMuY29tL3dwLWNv/bnRlbnQvcGx1Z2lu/cy93cC15b3V0dWJl/LWx5dGUvbHl0ZUNh/Y2hlLnBocD9vcmln/VGh1bWJVcmw9aHR0/cHM6Ly9pLnl0aW1n/LmNvbS92aS9mSjly/VXpJTWNaUS8wLmpw/Zw',
                ARRAY[1, 2], -- Genres: Pop, Rock
                'Music',
                'A Night at the Opera', -- Album
                NULL, -- Pas d'acteurs pour un morceau de musique
                NULL, -- Pas de type pour un morceau de musique
                NULL -- Pas de plateformes pour un morceau de musique
        );

 SELECT CreateNewMedia(
                'Shape of You',
                '2017-01-06',
                'Chanson pop de Ed Sheeran',
                4,
                'minutes',
                'Ed Sheeran',
                8.5,
                'https://imgs.search.brave.com/RDhuTrUw4M4oxZKsLuYOcK7RC3gvmrKrGVoCviqxpfg/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9tLm1l/ZGlhLWFtYXpvbi5j/b20vaW1hZ2VzL0kv/QjFUbFBTWTViS1Mu/anBn',
                ARRAY[1], -- Genre: Pop
                'Music',
                '÷ (Divide)', -- Album
                NULL, -- Pas d'acteurs pour un morceau de musique
                NULL, -- Pas de type pour un morceau de musique
                NULL -- Pas de plateformes pour un morceau de musique
        );

 SELECT CreateNewMedia(
                'Smooth Criminal',
                '1987-10-14',
                'Chanson de Michael Jackson',
                4,
                'minutes',
                'Michael Jackson',
                9.6,
                'https://imgs.search.brave.com/m7U0uxsIjcQnhFKScxEX43IKUWBEwrPv2ad61Ot0quQ/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9tLm1l/ZGlhLWFtYXpvbi5j/b20vaW1hZ2VzL0kv/NDFNVkgxYno0Ykwu/anBn',
                ARRAY[1, 2], -- Genres: Pop, Rock
                'Music',
                'Bad', -- Album
                NULL, -- Pas d'acteurs pour un morceau de musique
                NULL, -- Pas de type pour un morceau de musique
                NULL -- Pas de plateformes pour un morceau de musique
        );

 SELECT CreateNewMedia(
                'Stairway to Heaven',
                '1971-11-08',
                'Chanson emblématique de Led Zeppelin',
                8,
                'minutes',
                'Robert Plant',
                9.7,
                'https://imgs.search.brave.com/xgwn2AQtFPi-SxoFiVB-E6Gw-Qy2Qm72clJxwIVMaGo/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9hdXJh/bGNyYXZlLmNvbS93/cC1jb250ZW50L3Bs/dWdpbnMvd3AteW91/dHViZS1seXRlL2x5/dGVDYWNoZS5waHA_/b3JpZ1RodW1iVXJs/PWh0dHBzOi8vaS55/dGltZy5jb20vdmkv/UWtGM294emlVSTQv/MC5qcGc',
                ARRAY[2], -- Genre: Rock
                'Music',
                'Led Zeppelin IV', -- Album
                NULL, -- Pas d'acteurs pour un morceau de musique
                NULL, -- Pas de type pour un morceau de musique
                NULL -- Pas de plateformes pour un morceau de musique
        );

