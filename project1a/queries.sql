-- Names of all actors in "Die Another Day"
SELECT CONCAT(first, ' ', last)
FROM MovieActor
INNER JOIN Actor ON MovieActor.aid = Actor.id
WHERE mid =
    (SELECT id FROM Movie
     WHERE title = 'Die Another Day');


-- Count of all actors who have acted in multiple movies
SELECT COUNT(*) FROM
    (SELECT aid FROM MovieActor
     GROUP BY aid
     HAVING COUNT(*) > 1) AS t1;

-- Title of movies that sell more than 1000000 tickets
SELECT title
FROM Movie
INNER JOIN Sales ON Movie.id = Sales.mid
WHERE ticketsSold > 1000000;

-- Rank each year by average IMDb score of movies in that year, in descending order
SELECT year, AVG(imdb) AS IMDb FROM Movie
INNER JOIN MovieRating ON Movie.id = MovieRating.mid
GROUP BY year
ORDER BY IMDb DESC;

-- Average tickets sold by genre
SELECT genre, AVG(ticketsSold)
FROM MovieGenre
INNER JOIN Sales ON MovieGenre.mid = Sales.mid
GROUP BY genre;
