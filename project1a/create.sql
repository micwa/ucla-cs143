CREATE TABLE Movie (
    id INT,
    title VARCHAR(100),
    year INT,
    rating VARCHAR(10),
    company VARCHAR(50),
    -- Each movie is uniquely identified by an id
    PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE Actor (
    id INT,
    last VARCHAR(20),
    first VARCHAR(20),
    sex VARCHAR(6),
    dob DATE,
    dod DATE,
    -- Each actor is uniquely identified by an id
    PRIMARY KEY (id)
 ) ENGINE = InnoDB;

CREATE TABLE Sales (
    mid INT,
    ticketsSold INT,
    totalIncome INT,
    -- Each sale for a particular movie is specified by the movie id
    PRIMARY KEY (mid)
 ) ENGINE = InnoDB;

CREATE TABLE Director (
    id INT,
    last VARCHAR(20),
    first VARCHAR(20),
    dob DATE,
    dod DATE,
    -- Each director is uniquely identified by an id
    PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE MovieGenre (
    mid INT,
    genre VARCHAR(20),
    -- Every tuple references a particular movie by movie id
    FOREIGN KEY (mid) REFERENCES Movie(id)
) ENGINE = InnoDB;

CREATE TABLE MovieDirector (
    mid INT,
    did INT,
    -- Every tuple references a particular movie by movie id
    FOREIGN KEY (mid) REFERENCES Movie(id),
    -- Every tuple references a particular director by director id
    FOREIGN KEY (did) REFERENCES Director(id)
) ENGINE = InnoDB;

CREATE TABLE MovieActor (
    mid INT,
    aid INT,
    role VARCHAR(50),
    -- Every tuple references a particular movie by movie id
    FOREIGN KEY (mid) REFERENCES Movie(id),
    -- Every tuple references a particular actor by actor id
    FOREIGN KEY (aid) REFERENCES Actor(id)
) ENGINE = InnoDB;

CREATE TABLE MovieRating (
    mid INT,
    imdb INT,
    rot INT,
    -- Each rating has to be for a particular movie
    PRIMARY KEY (mid),
    -- Every tuple references a particular movie by movie id
    FOREIGN KEY (mid) REFERENCES Movie(id),
    -- imdb has to be between 0 to 100
    CHECK(imdb >= 0 AND imdb <= 100),
    -- rot has to be between 0 to 100
    CHECK(rot >= 0 AND rot <= 100)
) ENGINE = InnoDB;

CREATE TABLE Review (
    name VARCHAR(20),
    time TIMESTAMP,
    mid INT,
    rating INT,
    comment VARCHAR(500),
    -- There is one review per movie per user
    PRIMARY KEY (name, mid),
    -- rating must be out of 5
    CHECK(rating >= 0 AND rating <= 5)
) ENGINE = InnoDB;

CREATE TABLE MaxPersonID (
    id INT
) ENGINE = InnoDB;

CREATE TABLE MaxMovieID (
    id INT
) ENGINE = InnoDB;
