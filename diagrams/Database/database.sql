drop table PICTURES_TRIP CASCADE CONSTRAINTS
/

drop table PICTURES_TRIP_CARD CASCADE CONSTRAINTS
/

drop table TYPES_OF_CITY CASCADE CONSTRAINTS
/

drop table CATEGORIES
/

drop table SAVED_FLIGHTS CASCADE CONSTRAINTS
/

drop table USERS
/

drop table FLIGHTS
/

drop table CITIES
/

CREATE TABLE USERS
(
    id         INT PRIMARY KEY,
    first_name VARCHAR2(30),
    last_name  VARCHAR2(30),
    username   VARCHAR2(30),
    email      VARCHAR2(30),
    password   VARCHAR2(30)
);
/

CREATE TABLE CITIES
(
    id          INT PRIMARY KEY,
    name        varchar2(30),
    description varchar2(1024),
    coin        varchar2(30),
    electricity varchar2(30),
    visa        varchar2(30)
);
/

CREATE TABLE PICTURES_TRIP
(
    id      INT PRIMARY KEY,
    city_id INT,
    path    varchar2(256),

    CONSTRAINT fk_pictures_trip_city_id FOREIGN KEY (city_id) REFERENCES CITIES (id)
);
/

CREATE TABLE PICTURES_TRIP_CARD
(
    id      INT PRIMARY KEY,
    city_id INT,
    path    varchar2(256),

    CONSTRAINT fk_pictures_trip_card_city_id FOREIGN KEY (city_id) REFERENCES CITIES (id)
);
/

CREATE TABLE CATEGORIES
(
    id   INT PRIMARY KEY,
    name varchar2(30)
);
/

CREATE TABLE TYPES_OF_CITY
(
    id          INT PRIMARY KEY,
    city_id     INT,
    category_id INT,

    CONSTRAINT fk_types_of_city_city_id FOREIGN KEY (city_id) REFERENCES CITIES (id),
    CONSTRAINT fk_types_of_city_category_id FOREIGN KEY (category_id) REFERENCES CATEGORIES (id)
);
/

CREATE TABLE FLIGHTS
(
    id                INT PRIMARY KEY,
    departure_city_id INT,
    arrive_city_id    INT,
    departure_date    DATE,
    arrive_date       DATE,
    price             INT,

    CONSTRAINT fk_flights_departure_city_id FOREIGN KEY (departure_city_id) REFERENCES CITIES (id),
    CONSTRAINT fk_flights_arrive_city_id FOREIGN KEY (arrive_city_id) REFERENCES CITIES (id)
);
/

CREATE TABLE SAVED_FLIGHTS
(
    id        INT PRIMARY KEY,
    user_id   INT,
    flight_id INT,

    CONSTRAINT fk_saved_flights_user_id FOREIGN KEY (user_id) REFERENCES USERS (id),
    CONSTRAINT fk_saved_flights_flight_id FOREIGN KEY (flight_id) REFERENCES FLIGHTS (id)
);
/