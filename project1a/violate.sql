-- PRIMARY KEY VIOLATIONS

-- 1) Violates primary key constraint for Movie because inserts a duplicate movie id
INSERT INTO Movie VALUES (1000, '1000th Movie', 1000, 'PG', 'None');
-- Output: ERROR 1062 (23000): Duplicate entry '1000' for key 'PRIMARY'

-- 2) Violates primary key constraint for Actor because inserts a duplicate actor id
INSERT INTO Actor VALUES (1002, 'Some', 'Actor', 'M', '1960-10-10', NULL);
-- Output: ERROR 1062 (23000): Duplicate entry '1002' for key 'PRIMARY'

-- 3) Violates primary key constraint for Sales because inserts a sale with a duplicate movie id
INSERT INTO Sales VALUES (100, 1, 2);
-- Output: ERROR 1062 (23000): Duplicate entry '100' for key 'PRIMARY'

-- 4) Violates primary key constraint for Director because inserts a duplicate director id
INSERT INTO Director VALUES (1014, 'Some', 'Director', '1960-10-11', NULL);
-- Output: ERROR 1062 (23000): Duplicate entry '1014' for key 'PRIMARY'

-- 5) Violates primary key constraint for MovieRating because inserts a rating with a duplicate movie id
INSERT INTO MovieRating VALUES (100, 3, 4);
-- Output: ERROR 1062 (23000): Duplicate entry '100' for key 'PRIMARY'

-- 6) Violates primary key constraint for Review because inserts a review with a duplicate (name, movie id)
INSERT INTO Review VALUES
    ('Bob', '2008-01-01 00:00:01', 1, 5, 'It was great'),
    ('Bob', '2008-01-01 00:01:02', 1, 1, 'It was terrible');
-- Output: ERROR 1062 (23000): Duplicate entry 'Bob-1' for key 'PRIMARY'

-- FOREIGN KEY VIOLATIONS

-- 1) Violates foreign key constraint for MovieGenre for mid because it deletes an id from Movie that is still part of a tuple in MovieGenre
DELETE FROM Movie WHERE id = 1002;
-- Output: ERROR 1451 (23000): Cannot delete or update a parent row: a foreign key constraint fails (`TEST`.`MovieGenre`, CONSTRAINT `MovieGenre_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

-- 2) Violates foreign key constraint for MovieDirector for mid because it inserts a (movie, director) tuple for a movie id that does not exist (in Movie)
INSERT INTO MovieDirector VALUES (1001, 1019);
-- Output: ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

-- 3) Violates foreign key constraint for MovieDirector for did because it deletes an id from Director that is still part of a tuple in MovieDirector
DELETE FROM Director WHERE id = 1019;
-- Output: ERROR 1451 (23000): Cannot delete or update a parent row: a foreign key constraint fails (`TEST`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_2` FOREIGN KEY (`did`) REFERENCES `Director` (`id`))

-- 4) Violates foreign key constraint for MovieActor for mid because it inserts a (movie, actor, role) tuple for a movie id that does not exist (in Movie)
INSERT INTO MovieActor VALUES (1001, 180, 'Role1');
-- Output: ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

-- 5) Violates foreign key constraint for MovieActor for aid because it deletes an id from Actor that is still part of a tuple in MovieActor
DELETE FROM Actor WHERE id = 180;
-- Output: ERROR 1451 (23000): Cannot delete or update a parent row: a foreign key constraint fails (`TEST`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `Actor` (`id`))

-- 6) Violates foreign key constraint for MovieRating for mid because it inserts a (movie, rating1, rating2) for a movie id that does not exist (in Movie)
INSERT INTO MovieRating VALUES (1, 2, 3);
-- Output: ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieRating`, CONSTRAINT `MovieRating_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

-- CHECK VIOLATIONS

-- 1) Violates the CHECK(imdb >= 0 AND imdb <= 100) constraint in the MovieRating table by attempting to set the imdb rating for a movie to 101.
UPDATE MovieRating SET imdb = 101 WHERE mid = 272;

-- 2) Violates the CHECK(rot >= 0 AND rot <= 100) constraint in the MovieRating table by attempting to set the rot rating for a movie to -5.
UPDATE MovieRating SET rot = -5 WHERE mid = 272;

-- 3) Violates the CHECK(rating >= 0 AND rating <= 5) constraint in the Review table by attempting to insert a review with a rating of 7.
INSERT INTO Review VALUES ('Bob', '2008-01-01 00:00:01', 1000, 7, 'It was extraordinary');
