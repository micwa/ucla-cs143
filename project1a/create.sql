CREATE TABLE Movie (
    id INT,
    title VARCHAR(100),
    year INT,
    rating VARCHAR(10),
    company VARCHAR(50),
    PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE Actor (
    id INT,
    last VARCHAR(20),
    first VARCHAR(20),
    sex VARCHAR(6),
    dob DATE,
    dod DATE,
    PRIMARY KEY (id)
 ) ENGINE = InnoDB;

CREATE TABLE Sales (
    mid INT,
    ticketsSold INT,
    totalIncome INT,
    PRIMARY KEY (mid)
 ) ENGINE = InnoDB;

CREATE TABLE Director (
    id INT,
    last VARCHAR(20),
    first VARCHAR(20),
    dob DATE,
    dod DATE,
    PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE MovieGenre (
    mid INT,
    genre VARCHAR(20)
) ENGINE = InnoDB;

CREATE TABLE MovieDirector (
    mid INT,
    did INT
) ENGINE = InnoDB;

CREATE TABLE MovieActor (
    mid INT,
    aid INT,
    role VARCHAR(50),
    PRIMARY KEY (mid, aid)
) ENGINE = InnoDB;

CREATE TABLE MovieRating (
    mid INT,
    imdb INT,
    rot INT,
    PRIMARY KEY (mid, imdb)
) ENGINE = InnoDB;

CREATE TABLE Review (
    name VARCHAR(20),
    time TIMESTAMP,
    mid INT,
    rating INT,
    comment VARCHAR(500),
    PRIMARY KEY (name, mid)
) ENGINE = InnoDB;

CREATE TABLE MaxPersonID (
    id INT
) ENGINE = InnoDB;

CREATE TABLE MaxMovieID (
    id INT
) ENGINE = InnoDB;
