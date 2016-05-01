CREATE TABLE Movie (
    id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    year INT NOT NULL,
    rating VARCHAR(10),
    company VARCHAR(50),
    -- Each movie is uniquely identified by an id
    PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE Actor (
    id INT NOT NULL,
    last VARCHAR(20) NOT NULL,
    first VARCHAR(20) NOT NULL,
    sex VARCHAR(6) NOT NULL,
    dob DATE NOT NULL,
    dod DATE,
    -- Each actor is uniquely identified by an id
    PRIMARY KEY (id)
 ) ENGINE = InnoDB;

CREATE TABLE Sales (
    mid INT NOT NULL,
    ticketsSold INT,
    totalIncome INT,
    -- Each sale for a particular movie is specified by the movie id
    PRIMARY KEY (mid)
 ) ENGINE = InnoDB;

CREATE TABLE Director (
    id INT NOT NULL,
    last VARCHAR(20) NOT NULL,
    first VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    dod DATE,
    -- Each director is uniquely identified by an id
    PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE MovieGenre (
    mid INT NOT NULL,
    genre VARCHAR(20) NOT NULL,
    -- Every tuple references a particular movie by movie id
    FOREIGN KEY (mid) REFERENCES Movie(id)
) ENGINE = InnoDB;

CREATE TABLE MovieDirector (
    mid INT NOT NULL,
    did INT NOT NULL,
    -- Every tuple references a particular movie by movie id
    FOREIGN KEY (mid) REFERENCES Movie(id),
    -- Every tuple references a particular director by director id
    FOREIGN KEY (did) REFERENCES Director(id)
) ENGINE = InnoDB;

CREATE TABLE MovieActor (
    mid INT NOT NULL,
    aid INT NOT NULL,
    role VARCHAR(50) NOT NULL,
    -- Every tuple references a particular movie by movie id
    FOREIGN KEY (mid) REFERENCES Movie(id),
    -- Every tuple references a particular actor by actor id
    FOREIGN KEY (aid) REFERENCES Actor(id)
) ENGINE = InnoDB;

CREATE TABLE MovieRating (
    mid INT NOT NULL,
    imdb INT,
    rot INT,
    -- Each rating has to be for a particular movie
    PRIMARY KEY (mid),
    -- Every tuple references a particular movie by movie id
    FOREIGN KEY (mid) REFERENCES Movie(id),
    -- imdb rating has to be between 0 to 100
    CHECK(imdb >= 0 AND imdb <= 100),
    -- rotten tomatoes rating has to be between 0 to 100
    CHECK(rot >= 0 AND rot <= 100)
) ENGINE = InnoDB;

CREATE TABLE Review (
    name VARCHAR(20) NOT NULL,
    time TIMESTAMP NOT NULL,
    mid INT NOT NULL,
    rating INT,
    comment VARCHAR(500),
    -- rating must be out of 5
    CHECK(rating >= 0 AND rating <= 5)
) ENGINE = InnoDB;

CREATE TABLE MaxPersonID (
    id INT
) ENGINE = InnoDB;

CREATE TABLE MaxMovieID (
    id INT
) ENGINE = InnoDB;
