Project 1B
==========

All project criteria were met.

Input pages:
    - add_actor_director.php (I1):
        - Add an actor/director to the database (Actor, Director)
    - add_movie.php (I2):
        - Add a movie to the database (Movie)
        - Allows you to associate the added movie with a rating (MovieRating),
          sales information (Sales), and one or more genres (MovieGenre)
    - add_review.php (I3):
        - Add a review to a movie (Review)
    - add_movie_actor.php (I4):
        - Add a (movie, actor) relation (MovieActor)
    - add_movie_director.php (I5):
        - Add a (movie, director) relation (MovieDirector)

Two browsing pages:
    - show_actor_info.php (B1):
        - Displays info about a specific actor
        - Displays all the movies s/he has acted in, with links to those movies
    - show_movie_info.php (B2):
        - Displays info about a specific movie, include movie ratings and sales
        - Displays the cast, with links to each actor's page
        - Displays the average user score, and user reviews in reverse chronological order;
          also has a link (to I3) to submit a review for the movie

One search page:
    - search.php (S1):
        - Search for actors/movies by keyword

Contributors
============

Michael Wang
    - search.php
    - show_actor_info.php
    - add_movie_actor.php, add_movie_director.php
    - add_actor_director.php

Lauren Yeung
    - show_movie_info.php
    - add_review.php
    - add_movie.php

Improvements for Team Setting
=============================

For better collaboration, team members are advised to share approaches to using
sql functions. Many of the queries and techniques to accessing databases were
very similar in style among the php files. The best thing to do would be
writing out files that are more isolated first; for example, show_movie_info
needed the database to have reviews before it could show any results.
Incremental programming, along with splitting "similar difficulty" files
between partners, is the best approach. 

