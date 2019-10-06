# Hotel-Database-System

Hotel Database Information Retrieval System for use by internal employees. 

An [Entity Relationship Diagram](#entity-relationship) and a [Relational Diagram](#relational-diagram) was generated for this database management system. This project was completed in a team of three for MSCI 346: Database Systems final project.

Technologies used include SQL, PHP, HTML, CSS, Brackets. 

## Application Functionality

#### 1. **[Update Booking](#update-booking)**
#### 2. **[Hotel Availability](#hotel-availability)**
#### 3. **[Employee Stats](#employee-stats)**
#### 4. **[Event Booking](#event-booking)**
#### 5. **[Edit Guest Info](#edit-guest-info)**

<p float="center">
The user first enters their booking ID.
  <img src="images/hotel-database-project.png"/>
</p>

## Application Functionality Details

<a name= "update-booking"></a>

#### 1. Update Booking
This query demonstrates updating the database information. The update booking query allows individuals to make changes to guest bookings. Employees must enter a guest booking ID to modify the number of individuals in the room. This change is then reflected in the database. 

<p float="center">
The user first enters their booking ID.
  <img src="images/updateBooking.png"/>
</p>

<p float="center">
The user is then taken to a pre-populated screen where they can adjust the number of individuals in the room.
  <img src="images/updateBookingInfo.png"  />
</p>

<p float="center">
After submission, they are either taken to a success or error screen. The success screen includes their booking ID.
  <img src="images/updateBookingSuccess.png"  />
</p>

[Back to Top](#top)

<a name= "hotel-availability"></a>

#### 2. Check Hotel Availability
This query demonstrates the use of nested query and an aggregate function (count). The check hotel availability query allows front desk staff to select a hotel chain, a desired hotel and dates. The user then will be given a list of the types and number of rooms available.  

<p float="center">
  The user first selects their desired hotel and the time intervals for their stay.
  <img src="images/hotelAvailability.jpg"  />
</p>

<p float="center">
  A list is then shown with the number of available rooms for each room type during that time interval.
  <img src="images/hotelAvailabilityList.jpg"  />
</p>

[Back to Top](#top)

<a name= "employee-stats"></a>

#### 3. Employee Statistics
This query demonstrates the use of aggregate functions (avg, max, min) and natural join. The employee statistics query was created for upper management to view employee salary and average hours worked per week. The query allows the user to select a chain, then select a hotel and finally an employee type. 

<p float="center">
  The user first selects their desired hotel chain.
  <img src="images/employeeStatsHome.jpg"  />
</p>

<p float="center">
  The next screen is prepopulated with the different hotels within that chain.
  <img src="images/employeeStatsPopulated.jpg"  />
</p>

<p float="center">
  The employee statistics are then shown for the chosen hotel and employee type. The user may select all types of employees if they desire.
  <img src="images/employeeStatsList.jpg"  />
</p>

[Back to Top](#top)

<a name= "event-booking"></a>

#### 4. Event Booking For Large Groups
This query demonstrates the use of group by and having. The event booking for large groups query is utilized to check which hotels are able hold an event based on the count of the room capacities when planning large scale events. The Party size is entered, and a list of possible hotels is generated that have enough room capacity to accommodate guests. 

<p float="center">
  The user enters the number of people in the group.
  <img src="images/eventInquiry.png"  />
</p>

<p float="center">
  A list of hotels is then generated that support the group size.
  <img src="images/eventInquiryListing.png"  />
</p>

[Back to Top](#top)

<a name= "edit-guest-info"></a>

#### 5. Edit Guest Information
This query demonstrates insert, update and delete of an entity. The edit guest information query allows individuals to make changes to guest information stored in the database. Attributes that may be updated include name, city, street, postal code and phone number. A guest may also be added to the database or deleted from the database. 

<p float="center">
  The first screen provides users with different guest management requests.
  <img src="images/editGuestHome.png"  />
</p>

<p float="center">
  If the user selects sign up, a sign up form is shown for population.
  <img src="images/editGuestSignUp.png"  />
</p>

[Back to Top](#top)

<a name= "entity-relatonship"></a>

## Entity Relationship
<p float="center">
  <img src="images/Final ER Diagram.png" />
</p>

[Back to Top](#top)

<a name= "relational-diagram"></a>

## Relational Diagrams
<p float="center">
  <img src="images/Final Relational Diagram.png" />
</p>

[Back to Top](#top)
