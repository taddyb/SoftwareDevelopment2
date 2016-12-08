drop database if exists limbo_db;
create database limbo_db;
use limbo_db;
create table if not exists stuff (
  id int not null auto_increment primary key,
  location_id int not null,
  description text not null,
  create_date datetime not null,
  update_date datetime not null,
  room text,
  owner text,
  finder text,
  status set("found", "lost", "claimed")
);
explain stuff; 
create table if not exists locations (
  id int auto_increment primary key,
  create_date datetime not null,
  update_date datetime not null,
  name text not null
);
explain locations;
insert into locations
(name, create_date, update_date)
 values
	('Dining Hall', now(), now()),
	('Marian Hall', now(), now()),
	('Foy Townhouses', now(), now()),
	('Leo Hall', now(), now()),
	('Student Center', now(), now()),
	('St. Ann''s Hermitage', now(), now()),
	('Lowell-Thomas Communications Center', now(), now()),
	('Champagnat Hall', now(), now()),
	('Hancock Center', now(), now()),
	('Sheahan Hall', now(), now()),
	('Our Lady Seat of Wisdom Chapel', now(), now()),
	('Lower West Cedar Townhouses', now(), now()),
	('Dyson Center', now(), now()),
	('Rotunda', now(), now()),
	('Fontaine Hall', now(), now()),
	('Byrne House', now(), now()),
	('Fontaine Annex', now(), now()),
	('Cannavino Library', now(), now()),
	('Fulton Street Townhouses', now(), now()),
	('Midrise Hall', now(), now()),
	('New Fulton Townhouses', now(), now()),
	('Gartland Commons', now(), now()),
	('Donnelly Hall', now(), now()),
	('Greystone Hall', now(), now()),
	('Kirk House', now(), now()),
	('Longview Park', now(), now()),
	('Lower Townhouses', now(), now()),
	('Marist Boathouse', now(), now()),
	('Kieran Gatehouse', now(), now()),
	('McCann Center', now(), now()),
	('New Townhouses', now(), now()),
	('St. Peter''s', now(), now()),
	('Science and Applied Health Building', now(), now()),
	('Steel Plant Studios and Gallery', now(), now()),
	('Cornell Boathouse', now(), now()),
	('Upper West Cedar Townhouses', now(), now());
insert into stuff
(location_id, description, create_date, update_date, room, owner, finder, status)
values
    (1, 'White knapsack', '2012-11-23 08:58:12', '2012-11-23 08:58:12', '101','none', 'George Clooney', "lost"),
    (3, 'Long Machete', '2015-06-17 17:04:04', '2015-06-17 17:04:04', 'none', 'Tarzan', 'Jane', "found" ),
    (6, 'Turtle', '2016-05-06 21:54:14', '2016-05-09 10:00:37', '305', 'Donald Trump', 'Michael Moore', "found"),
    (5, 'Bazooka', '2011-01-11 00:00:00', '2011-03-29 09:31:00', '206', 'Daniel Craig', 'Phillip Jonesez', "found"),
    (12, 'Pizza', '2016-11-11 13:45:08', '2016-11-11 13:45:08', '003', 'Tarzan', 'Jane', "lost"),
    (8, 'Sweater', '2016-12-12 23:59:59', '2016-12-12 23:59:59', '104', 'none', 'Larry David', "lost");
create table if not exists users (
user_id int unsigned not null auto_increment,
username text(20) not null, 
first_name varchar(20) not null,
last_name varchar(40) not null,
email varchar(60) not null,
pass char(40) not null,
reg_date datetime not null,
primary key (user_id),
unique(email)
);
explain users;
insert into users
(username, first_name, last_name, email, pass, reg_date)
values
    ('admin',  'Casimer', 'DeCusatis', 'admin@admin.com', '85648c0b3f34913c36d9521e76c3ebf7',  now());
insert into users
(username, first_name, last_name, email, pass, reg_date)
values
    ('test',  'asd', 'red', 'admin@gmail.com', 'gaze11e',  now());