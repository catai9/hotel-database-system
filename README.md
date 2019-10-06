# Hotel-Database-System

Hotel Database Information Retrieval System for use by internal employees.

## **Entity Relationship & Relational Diagrams**

<p float="center">
  <img src="/Final ER Diagram.png" width="400" height="400" />
  <img src="/Final Relational Diagram.png" width="450" height="400"/>
</p>

## **Application Functionality**

#### Update Booking
---------------------------------
This query demonstrates updating the database information. The update booking query allows individuals to make changes to guest bookings. Employees must enter a guest booking ID to modify the number of individuals in the room. This change is then reflected in the database. 

#### Check Hotel Availability
---------------------------------
This query demonstrates the use of nested query and an aggregate function (count). The check hotel availability query allows front desk staff to select a hotel chain, a desired hotel and dates. The user then will be given a list of the types and number of rooms available.  

#### Employee Statistics
---------------------------------
This query demonstrates the use of aggregate functions (avg, max, min) and natural join. The employee statistics query was created for upper management to view employee salary and average hours worked per week. The query allows the user to select a chain, then select a hotel and finally an employee type. 

#### Even Booking For Large Groups
---------------------------------
This query demonstrates the use of group by and having. The event booking for large groups query is utilized to check which hotels are able hold an event based on the count of the room capacities when planning large scale events. The Party size is entered, and a list of possible hotels is generated that have enough room capacity to accommodate guests. 

#### Edit Guest Information
---------------------------
This query demonstrates insert, update and delete of an entity. The edit guest information query allows individuals to make changes to guest information stored in the database. Attributes that may be updated include name, city, street, postal code and phone number. A guest may also be added to the database or deleted from the database. 
