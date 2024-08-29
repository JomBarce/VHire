DROP DATABASE IF EXISTS Vhire_Booking;

CREATE DATABASE Vhire_Booking;

USE Vhire_Booking;

CREATE TABLE Customer(
    CustomerID INT AUTO_INCREMENT,
    FirstName VARCHAR(50) NOT NULL,
    MiddleName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    ContactNumber CHAR(11) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Username VARCHAR(50) NOT NULL,
    Password VARCHAR(50) NOT NULL,
    DateOfBirth DATE NOT NULL,
    ProfilePicture VARCHAR(255) NOT NULL,
    PRIMARY KEY (CustomerID)
);

CREATE TABLE Driver(
    DriverID INT AUTO_INCREMENT,
    LicenseNumber CHAR(11) NOT NULL,
    FirstName VARCHAR(50) NOT NULL,
    MiddleName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    ContactNumber CHAR(11) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Username VARCHAR(50) NOT NULL,
    Password VARCHAR(50) NOT NULL,
    DateOfBirth DATE NOT NULL,
    ProfilePicture VARCHAR(255) NOT NULL,
    PRIMARY KEY (DriverID)
);

CREATE TABLE Vhire(
    VehicleID INT AUTO_INCREMENT,
    PlateNumber CHAR(8) NOT NULL,
    Brand VARCHAR(50) NOT NULL,
    Model VARCHAR(50) NOT NULL,
    Capacity INT NOT NULL,
    Weight DECIMAL(6,2) NOT NULL,
    Status ENUM('In-Use','Available') DEFAULT 'Available',
    PRIMARY KEY (VehicleID)
);

CREATE TABLE Admin(
    AdminID INT AUTO_INCREMENT,
    FirstName VARCHAR(50) NOT NULL,
    MiddleName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    ContactNumber CHAR(11) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Username VARCHAR(50) NOT NULL,
    Password VARCHAR(50) NOT NULL,
    DateOfBirth DATE NOT NULL,
    AdminType ENUM('SuperAdmin','Admin') DEFAULT 'Admin',
    PRIMARY KEY (AdminID)
);

CREATE TABLE Terminal(
    TerminalID INT AUTO_INCREMENT,
    AdminID INT NOT NULL,
    LocationName VARCHAR(300) NOT NULL,
    City VARCHAR(100) NOT NULL,
    PRIMARY KEY (TerminalID),
    CONSTRAINT Terminal_FK FOREIGN KEY (AdminID) REFERENCES Admin (AdminID)
);

CREATE TABLE Route(
    RouteID INT AUTO_INCREMENT,
    OriginalTerminalID INT NOT NULL,
    DestinationTerminalID INT NOT NULL,
    Fare DECIMAL(6,2) NOT NULL,
    PRIMARY KEY (RouteID),
    CONSTRAINT Route_FK1 FOREIGN KEY (OriginalTerminalID) REFERENCES Terminal (TerminalID),
    CONSTRAINT Route_FK2 FOREIGN KEY (DestinationTerminalID) REFERENCES Terminal (TerminalID)
);

CREATE TABLE Trip(
    TripID INT AUTO_INCREMENT,
    VehicleID INT NOT NULL,
    RouteID INT NOT NULL,
    AvailableSeats INT NOT NULL,
    EstimatedTimeDeparture DATETIME NOT NULL,
    EstimatedTimeArrival DATETIME NOT NULL,
    Status ENUM('Upcoming','Ongoing','Arrived') DEFAULT 'Upcoming',
    PRIMARY KEY (TripID),
    CONSTRAINT Trip_FK1 FOREIGN KEY (VehicleID) REFERENCES Vhire (VehicleID),
    CONSTRAINT Trip_FK2 FOREIGN KEY (RouteID) REFERENCES Route (RouteID),
    DriverID INT NOT NULL
);

CREATE TABLE Reservations(
    ReservationID INT AUTO_INCREMENT,
    CustomerID INT NOT NULL,
    TripID INT NOT NULL,
    Quantity INT NOT NULL,
    BookedDate DATETIME NOT NULL,
    R_Status ENUM('Accepted','Cancelled','Pending') DEFAULT 'Pending',
    ConfirmationDate DATETIME NOT NULL,
    TotalFare DECIMAL(6,2) NOT NULL,
    PRIMARY KEY (ReservationID),
    CONSTRAINT Reservation_FK1 FOREIGN KEY (CustomerID) REFERENCES Customer (CustomerID),
    CONSTRAINT Reservation_FK2 FOREIGN KEY (TripID) REFERENCES Trip (TripID)
);