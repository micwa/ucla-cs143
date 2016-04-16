-- Violates primary key for Movie because inserts duplicate id

INSERT 
--Output:

-- Violates primary key for Actor because inserts duplicate id

--Output:

-- Violates primary key for Sales because inserts duplicate id

--Output:

-- Violates primary key for Director because inserts duplicate id

--Output:

-- Violates primary key for MovieActor because inserts duplicate id

--Output:

-- Violates primary key for MovieRating because inserts duplicate id

--Output:

-- Violates foreign key for MovieGenre for mid because it deletes id from Movie and mid still exists in MovieGenre

--Output:

-- Violates foreign key for MovieDirector for mid because it deletes id from Movie and mid still exists in MovieGenre

--Output:

-- Violates foreign key for MovieDirector for did because it deletes id from Movie 

--Output:

-- Violates foreign key for MovieActor for ___ because it deletes id from Movie 

--Output:

-- Violates foreign key for MovieRating for ___ because it deletes id from Movie 

--Output:


--Output:

--Output:

--Output:

--Output:


DELETE UPDATE


