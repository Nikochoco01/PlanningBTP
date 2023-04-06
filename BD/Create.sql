SET SQL_SAFE_UPDATES = 0;

drop table if exists Affected;
drop table if exists GoTo;
drop table if exists UsedEquipment;
drop table if exists HaveLicense;
drop table if exists Expense;
drop table if exists WorkTime;
drop table if exists Vehicle;
drop table if exists Login;
drop table if exists Event;
drop table if exists Picture;
drop table if exists User;
drop table if exists Worksite;
drop table if exists Equipment;
drop table if exists DriverLicense;

CREATE TABLE DriverLicense(
   driverLicenseName VARCHAR(255),
   driverLicenseMaxPassenger INT,
   constraint PK_DriverLicense PRIMARY KEY(driverLicenseName)
);

CREATE TABLE Equipment(
   equipmentId int auto_increment,
   equipmentName VARCHAR(255),
   equipmentTotalQuantity INT,
   equipmentAvailableQuantity INT,
   constraint PK_Equipment PRIMARY KEY(equipmentId)
);

CREATE TABLE Worksite(
   worksiteId INT auto_increment,
   worksiteAddress VARCHAR(255),
   worksiteName VARCHAR(255),
   constraint PK_Worksite PRIMARY KEY(worksiteId)
);

CREATE TABLE Event(
   eventId INT auto_increment,
   eventDescription VARCHAR(255),
   eventStartDate DATE,
   eventEndDate DATE,
   eventStartTime TIME,
   eventEndTime TIME,
   worksiteId INT NOT NULL,
   constraint PK_Event PRIMARY KEY(eventId),
   constraint FK_Event_Worksite FOREIGN KEY(worksiteId) REFERENCES Worksite(worksiteId)
);

CREATE TABLE User(
   userId INT auto_increment,
   userFirstName VARCHAR(255),
   userLastName VARCHAR(255),
   userMail VARCHAR(255),
   userPhone VARCHAR(255),
   pictureId int unsigned,
   userPosition VARCHAR(255),
   constraint PK_User PRIMARY KEY(userId)
);

CREATE TABLE Picture(
   pictureId int unsigned,
   userId INT not null,
   pictureName VARCHAR(255),
   pictureSize int,
   pictureType VARCHAR(255),
   pictureBin longblob,
   constraint PK_Picture PRIMARY KEY(pictureId),
   constraint FK_Picture_User FOREIGN KEY (userId) REFERENCES User(userId)
);

CREATE TABLE Login(
   userId INT not null,
   loginUsername VARCHAR(255),
   loginUserPassword VARCHAR(255),
   constraint PK_Login PRIMARY KEY(userId),
   constraint FK_Login_User FOREIGN KEY(userId) REFERENCES User(userId)
);

CREATE TABLE Vehicle(
   vehicleId INT not null auto_increment,
   vehicleLicensePlate VARCHAR(12) unique,
   vehicleModel VARCHAR(255),
   vehicleDriverLicense VARCHAR(255),
   vehicleMaxPassenger VARCHAR(255),
   vehicleDisponibility VARCHAR(255),
   constraint PK_Vehicle PRIMARY KEY(vehicleId),
   constraint FK_Vehicle_DriverLicense FOREIGN KEY(vehicleDriverLicense) REFERENCES DriverLicense(driverLicenseName)
);

CREATE TABLE WorkTime(
   userId INT,
   workTimeDay int,
   workTimeMonth int,
   workTimeWeek int,
   workTimeYear int,
   workTimeTotalHours VARCHAR(255),
   constraint PK_WorkTime PRIMARY KEY(userId, workTimeMonth, workTimeWeek, workTimeYear, workTimeDay),
   constraint FK_WorkTime_User FOREIGN KEY(userId) REFERENCES User(userId)
);

CREATE TABLE Expense(
   expenseId INT auto_increment,
   expenseDate DATE not null,
   expenseAmount float,
   expenseDescription VARCHAR(255),
   userId INT NOT NULL,
   eventId INT NOT NULL,
   worksiteId INT NOT NULL,
   constraint PK_Expense PRIMARY KEY(expenseId),
   constraint FK_Expense_User FOREIGN KEY(userId) REFERENCES User(userId),
   constraint FK_Expense_Event FOREIGN KEY(eventId) REFERENCES Event(eventId),
   constraint FK_Expense_Worksite FOREIGN KEY(worksiteId) REFERENCES Worksite(worksiteId)
);

CREATE TABLE HaveLicense(
   userId INT,
   driverLicenseName VARCHAR(255),
   constraint PK_HaveLicense PRIMARY KEY(userId, driverLicenseName),
   constraint FK_HaveLicense_User FOREIGN KEY(userId) REFERENCES User(userId),
   constraint FK_HaveLicense_DriverLicense FOREIGN KEY(driverLicenseName) REFERENCES DriverLicense(driverLicenseName)
);

CREATE TABLE UsedEquipment(
   eventId INT,
   equipmentId INT,
   equipmentName VARCHAR(255),
   Quantity INT,
   constraint PK_UsedEquipment PRIMARY KEY(eventId, equipmentName),
   constraint FK_UsedEquipment_Event FOREIGN KEY(eventId) REFERENCES Event(eventId),
   constraint FK_UsedEquipment_Equipment FOREIGN KEY(equipmentId) REFERENCES Equipment(equipmentId)
);

CREATE TABLE GoTo(
   vehicleId int,
   eventId INT,
   constraint PK_GoTo PRIMARY KEY(vehicleId, eventId),
   constraint FK_GoTo_Vehicle FOREIGN KEY(vehicleId) REFERENCES Vehicle(vehicleId),
   constraint FK_GoTo_Event FOREIGN KEY(eventId) REFERENCES Event(eventId)
);

CREATE TABLE Affected(
   userId INT,
   eventId INT,
   constraint PK_Affected PRIMARY KEY(userId, eventId),
   constraint FK_Affected_User FOREIGN KEY(userId) REFERENCES User(userId),
   FOREIGN KEY(eventId) REFERENCES Event(eventId)
);

drop procedure if exists Inscription;
delimiter $
CREATE procedure Inscription(IN userFirstName varchar(255),
IN userLastName varchar(255),
IN userMail varchar(255),
IN userPhone varchar(255),
IN pictureId varchar(255),
IN userPostion varchar(255))
BEGIN
declare id int default 0;
	insert into User values (0, userFirstName, userLastName, userMail, userPhone, pictureId, userPostion);
    set id = (select userId from User u where u.userFirstName = userFirstName and u.userLastName = userLastName and u.userMail = userMail);
    update User set pictureId = id where userId = id;
    insert into Login values (id, concat((select replace(userFirstName, " ", "-")),".", (select replace((select userLastName from User u where u.userFirstName = userFirstName and u.userLastName = userLastName and u.userMail = userMail), " ", "-"))), sha1("1234"));
END
$
delimiter ;

drop procedure if exists AffectTools;
delimiter $
CREATE procedure AffectTools (IN eventId INT, IN materialId INT , IN name varchar(255), IN quantity INT)
BEGIN
DECLARE availableTools INT;

SELECT equipmentAvailableQuantity INTO availableTools
FROM Equipment e
WHERE name = e.equipmentName;

IF Quantity > availableTools
THEN
ROLLBACK;
ELSE

INSERT INTO UsedEquipment VALUES(eventId, materialId, name, quantity);

UPDATE Equipment e
SET equipmentAvailableQuantity = equipmentAvailableQuantity - quantity
WHERE name = e.equipmentName;

END IF;
END;
$
delimiter ;

drop procedure if exists FreeTools;
delimiter $
CREATE procedure FreeTools()
BEGIN

UPDATE Equipment e
SET equipmentAvailableQuantity = equipmentAvailableQuantity + IFNULL(
																	(select SUM(Quantity) from UsedEquipment u 
																		join Event ee on u.eventId = ee.eventId 
                                                                        where ee.eventEndDate = date(now()) AND e.equipmentName = u.equipmentName), 0)
where equipmentTotalQuantity >= equipmentAvailableQuantity + IFNULL(
																	(select SUM(Quantity) from UsedEquipment u 
																		join Event ee on u.eventId = ee.eventId 
                                                                        where ee.eventEndDate = date(now()) AND e.equipmentName = u.equipmentName), 0);

END
$