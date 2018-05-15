
CREATE DATABASE finaldb;
CREATE TABLE finaldb.auth ( userid INT(3) AUTO_INCREMENT PRIMARY KEY ,
						username VARCHAR(60) , 
						password VARCHAR(60) , 
						firstName VARCHAR(60) , 
						lastName VARCHAR(60) , 
						email VARCHAR(60) , 
						phone VARCHAR(60)  ) ;

INSERT INTO auth 
(userid, username, password, firstName, lastName, email, phone) 
VALUES ('', 'BruceTheBatMan', 'password1', 'Bruce', 'Wayne', 'Bruce@email.com', '8185557891');

INSERT INTO auth 
(userid, username, password, firstName, lastName, email, phone) 
VALUES ('', 'ClarkTheSuperMan', 'password2', 'Clark', 'Kent', 'Clark@email.com', '8185551234');

INSERT INTO auth 
(userid, username, password, firstName, lastName, email, phone) 
VALUES ('', 'BarryTheFlash', 'password3', 'Barry', 'Allen', 'Barry@email.com', '8185556723');

