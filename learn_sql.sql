CREATE DATABASE IF NOT EXISTS learn_sql;

USE learn_sql;

CREATE TABLE IF NOT EXISTS Orders (
  OrderID INT AUTO_INCREMENT PRIMARY KEY,
  CustomerID INT,
  EmployeeID INT,
  OrderDate VARCHAR(100),
  ShipperID INT
);

CREATE TABLE IF NOT EXISTS Customers (
  CustomerID INT AUTO_INCREMENT PRIMARY KEY,
  CustomerName VARCHAR(100),
  ContactName	 VARCHAR(100),
  Address VARCHAR(100),
  City VARCHAR(100), 
  PostalCode VARCHAR(100),
  Country VARCHAR(100)
);


SELECT Customers.CustomerName, Orders.OrderID
FROM Customers
LEFT JOIN Orders ON Customers.CustomerID = Orders.CustomerID
ORDER BY Customers.CustomerName;

SELECT Customers.CustomerName, Orders.OrderID
FROM Customers
RIGHT JOIN Orders ON Customers.CustomerID = Orders.CustomerID
ORDER BY Customers.CustomerName;