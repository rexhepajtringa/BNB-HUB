
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
CREATE TABLE user (    
    user_id int(11) NOT NULL AUTO_INCREMENT,    
    first_name varchar(254) NOT NULL,    
    last_name varchar(254) NOT NULL,    
    password varchar(254) NOT NULL,    
    phone_number varchar(10) NOT NULL,    
    email varchar(254) NOT NULL UNIQUE,    
    gender varchar(254) NOT NULL,    
    admin_check tinyint NOT NULL,    
    profile_pic varchar(254),
    session_check tinyint NOT NULL,    
    primary key (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `password`, `phone_number`, `email`, `gender`, `admin_check`,`profile_pic`, `session_check`) VALUES
(1, 'Etnik', 'Ballata', SHA2('Etnik1234!',256), '06980678065', 'etnikballata@gmail.com', 'male', 1, 'images/etnik.png', 0),
(2, 'Art', 'Dauti',  SHA2('Arti1234!', 256), '0417895204', 'artdauti@gmail.com', 'male', 0, 'images/art.png', 0),
(3, 'Roni', 'Koshi',  SHA2('Roni1234!', 256), '0542950394', 'koshi.roni@gmail.com', 'male', 0, 'images/roni.png', 0),
(4, 'Arb', 'Ballata',  SHA2('Arbi1234!', 256), '043553443', 'arbiballata@gmail.com', 'male', 0, 'images/arbi.png', 0),
(5, 'Edion', 'Bajraktari', SHA2('Edion1234!', 256), '049278456', 'edionbajraktari@gmail.com', 'male', 0, 'images/edion.png', 0);


CREATE TABLE listing (
    listing_id int(11) NOT NULL AUTO_INCREMENT,
    propertyName varchar(254) NOT NULL,
    city varchar(254) NOT NULL,
    country varchar(254) NOT NULL,
    address varchar(254) NOT NULL,
    summary varchar(5000) NOT NULL,
    accomodates int(10) NOT NULL,
    surface int(11) NOT NULL,
    bathrooms int(11) NOT NULL,
    bedrooms int(11) NOT NULL,
    beds int(11) NOT NULL,
    has_tv tinyint NOT NULL,
    has_heating tinyint NOT NULL,
    has_internet tinyint NOT NULL,
    has_ac tinyint NOT NULL,
    has_kitchen tinyint NOT NULL,
    pets_allowed enum('yes', 'no') NOT NULL,
    price int(11) NOT NULL,
    user_id int(11) NOT NULL,
    primary key (listing_id)    
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `listing` (`listing_id`, `propertyName`, `city`, `country`, `address`, `summary`, `accomodates`, `surface`, `bathrooms`, `bedrooms`, `beds`, `has_tv`, `has_heating`, `has_internet`, `has_ac`, `has_kitchen`, `pets_allowed`, `price`, `user_id`) VALUES
(1, 'Bern Apartment', 'Bern', 'Switzerland', 'Tscharnerstrasse 27', 'Cute apartment in the center of the capital city of Switzerland - Bern perfect host.', 2, 50, 1, 1, 1, 1, 1, 1, 0, 1, 'no', 150, 2),
(2, 'Central Atlanta', 'Atlanta', 'Georgia USA', '45A Walton St NW', 'Cozy apartment in the center of Atlanta neaar Mercedes Benz Stadium. Perfect PRivate room for couples.', 2, 30, 1, 1, 1, 0, 1, 1, 1, 1, 'yes', 70, 3),
(3, 'Prishtina Apartment', 'Prishtina', 'Kosova', 'Gustav Meyer 3', 'Nice apartment near city center, it also has a park next to it for a perfect place for relaxing.', 6, 110, 1, 3, 5, 0, 1, 0, 0, 1, 'yes', 30, 1),
(4, 'Private House in Gjakove', 'Gjakova', 'Kosova', 'Bashkim Idrizi 26', 'Nice private house near the center of Gjakova easy access to public transport', 8, 300, 1, 2, 3, 1, 1, 1, 1, 1, 'yes', 20, 4),
(5, 'Shared House in Gjakove', 'Gjakova', 'Kosova', 'Abdurrahim Buza 10', 'Nice apartment near city center, it also has a park next to it for a perfect place for relaxing.', 6, 110, 1, 3, 5, 1, 1, 1, 1, 1, 'yes', 60, 4),
(6, 'Luxury Villa in the Suburbs', 'Gjakova', 'Kosova', 'Moglice 7', 'Luxury home in the suburbs of Gjakova in a private neighborhood with a great view of Albanian Alps.', 15, 450, 4, 4, 8, 1, 1, 1, 1, 1, 'no', 600, 4),
(7, 'Private neighborhood apartment in Zürich', 'Zurich', 'Switzerland', 'Sunnewisstrasse 5, 8483', 'New apartment in a private neighborhood in the suburbs of Zurich with a beautifull view of the mountains.', 6, 150, 2, 3, 5, 1, 1, 1, 1, 1, 'no', 300, 2),
(8, 'Private Apartment CityCenter', 'Prishtina', 'Kosova', 'Dragodan', 'Cozy apartment in a hill west of Prishtina with a City view.', 3, 80, 1, 2, 2, 1, 1, 1, 1, 1, 'no', 95, 5),
(9, 'Seaside Pent House', 'Shengjin', 'Albania', '28 Nentori', 'Pent House in Albanian Reviera with the view of Adriatic Sea.', 5, 140, 1, 2, 3, 1, 1, 1, 1, 1, 'yes', 180, 5),
(10, 'Private Room Prishtina', 'Prishtina', 'Kosova', 'Rruga B', 'Private room in a Cozy Apartment with great access to public transport.', 2, 69, 1, 1, 1, 1, 1, 1, 0, 1, 'yes', 79, 5),
(11, 'Gjakova Apartment', 'Gjakova', 'Kosova', 'Anton Cetta', 'Apartment in Gjakova city center easy access to markets and public transport.', 5, 130, 2, 2, 4, 1, 1, 1, 1, 1, 'no', 50, 1);



CREATE TABLE images(
    image_id int(11) NOT NULL AUTO_INCREMENT,
    image varchar(255) NOT NULL,
    listing_id int(11),
    primary key (image_id)
)   ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `images`(`image_id`, `image`, `listing_id`) 
VALUES 
(1, 'images/atl1.jpg', 2), 
(2, 'images/atl2.jpeg', 2), 
(3, 'images/atl3.jpeg', 2), 
(4, 'images/atl4.jpeg', 2), 
(5, 'images/atl5.jpeg', 2), 
(6, 'images/bern1.jpeg', 1), 
(7, 'images/bern2.jpeg', 1), 
(8, 'images/bern3.jpeg', 1), 
(9, 'images/prishtina1.jpeg', 3), 
(10, 'images/prishtina2.jpeg', 3), 
(11, 'images/prishtina3.jpeg', 3), 
(12, 'images/prishtina4.jpeg', 3), 
(13, 'images/prishtina5.jpeg', 3),
(14, 'images/gjk10.JPG', 4),
(15, 'images/gjk11.JPG', 4),
(16, 'images/gjk12.JPG', 4),
(17, 'images/gjk13.JPG', 4),
(18, 'images/gjk14.JPG', 4),
(19, 'images/gjk15.JPG', 4),
(20, 'images/gjk20.JPG', 5),
(21, 'images/gjk21.JPG', 5),
(22, 'images/gjk22.JPG', 5),
(23, 'images/gjk23.JPG', 5),
(24, 'images/gjk30.JPG', 6),
(25, 'images/gjk31.JPG', 6),
(26, 'images/gjk32.JPG', 6),
(27, 'images/gjk33.JPG', 6),
(28, 'images/gjk34.JPG', 6),
(29, 'images/gjk35.JPG', 6),
(30, 'images/gjk36.JPG', 6),
(31, 'images/gjk37.JPG', 6),
(32, 'images/gjk38.JPG', 6),
(33, 'images/gjk39.JPG', 6),
(34, 'images/gjk39a.JPG', 6),
(35, 'images/gjk39b.JPG', 6),
(36, 'images/gjk39c.JPG', 6),
(37, 'images/zch1.JPG', 7),
(38, 'images/zch2.JPG', 7),
(39, 'images/zch3.JPG', 7),
(40, 'images/zch4.JPG', 7),
(41, 'images/pr10.JPG', 8),
(42, 'images/pr11.JPG', 8),
(43, 'images/pr12.JPG', 8),
(44, 'images/pr13.JPG', 8),
(45, 'images/pr14.JPG', 8),
(46, 'images/sh10.JPG', 9),
(47, 'images/sh11.PNG', 9),
(48, 'images/sh12.PNG', 9),
(49, 'images/sh13.PNG', 9),
(50, 'images/pr20.JPG', 10),
(51, 'images/pr21.JPG', 10),
(52, 'images/pr22.JPG', 10),
(53, 'images/gjk40.JPG', 11),
(54, 'images/gjk41.JPG', 11),
(55, 'images/gjk42.JPG', 11),
(56, 'images/gjk43.JPG', 11);


CREATE TABLE wishlist(
    wishlist_id int(11) NOT NULL AUTO_INCREMENT,
    listing_id int(11) NOT NULL,
    user_id int(11) NOT NULL,
    timestamp datetime NOT NULL,
    primary key (wishlist_id)
)   ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE bookings(
    booking_id int(11) NOT NULL AUTO_INCREMENT,
    book_date date NOT NULL,
    listing_id int(11) NOT NULL,
    user_id int(11) NOT NULL,
    primary key (booking_id)
)   ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE images 
ADD CONSTRAINT images_ibfk_1 
FOREIGN KEY (listing_id) REFERENCES listing(listing_id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE listing
ADD CONSTRAINT listing_ibfk_1
FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE ON UPDATE CASCADE; 

ALTER TABLE wishlist
ADD CONSTRAINT wishlist_ibfk_1
FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE ON UPDATE CASCADE; 

ALTER TABLE wishlist
ADD CONSTRAINT wishlist_ibfk_2
FOREIGN KEY (listing_id) REFERENCES listing(listing_id) ON DELETE CASCADE ON UPDATE CASCADE; 

ALTER TABLE bookings
ADD CONSTRAINT bookings_ibfk_1
FOREIGN KEY (listing_id) REFERENCES listing(listing_id) ON DELETE CASCADE ON UPDATE CASCADE; 

ALTER TABLE bookings
ADD CONSTRAINT bookings_ibfk_2
FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE ON UPDATE CASCADE; 






