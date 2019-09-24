Feature: A user can log in and logout

  Scenario: a user can register with a valid email and password
    Given there are no registered users
    When a user registers with the website
    Then the user can log into the website

  Scenario: A user can log into the website
    Given there is a registered user
    Then the user can log into the website

  Scenario: Different users can log into to the website
    Given "bob" is a registered user
    And "alice" is a registered user
    When "bob" logs into the website
    Then "bob" should be logged in

  Scenario: A user cannot log into the website
    Given there is a registered user
    Then the user cannot log into the website with a non-matching password

