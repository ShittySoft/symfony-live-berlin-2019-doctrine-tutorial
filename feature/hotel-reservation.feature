Feature: People can book rooms in a hotel

  Background:
    Given the "Mercure Hotel Moa" has been registered
    And following rooms were registered in "Mercure Hotel Moa":
      | Room name | PAX |
      | 101       | 1   |
      | 102       | 2   |
      | 103       | 2   |
      | 104       | 4   |

  Scenario: A single guest will get the smallest available room
    When I "bob@example.com" books a room from 2019-05-05 to 2019-05-07 for 1 person
    Then room 101 should have been booked for "bob" for 2019-05-05 to 2019-05-07

