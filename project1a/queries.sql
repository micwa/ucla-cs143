/*SELECT CONCAT(first,' ',last)
FROM MovieActor
INNER JOIN Actor on MovieActor.aid=Actor.id
WHERE mid = (SELECT id FROM Movie WHERE title = 'Die Another Day');
*/

/*SELECT count(*) FROM (SELECT aid FROM MovieActor GROUP BY aid HAVING COUNT(mid) > 1) as t1;
*/

/*SELECT title
FROM Movie
INNER JOIN Sales on Movie.id=Sales.mid
WHERE ticketsSold > 1000000;
*/

SELECT genre, avg(ticketsSold)
FROM MovieGenre
INNER JOIN Sales ON MovieGenre.mid=Sales.mid
GROUP BY genre;
