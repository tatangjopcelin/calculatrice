Feature: Calculs binaires

  Scenario: Addition de deux entiers
    Given je saisis 5 et 3
    When je choisis l'opération "+"
    Then le résultat binaire doit être "1000"
    And le résultat décimal doit être 8

  Scenario: Soustraction
    Given je saisis 10 et 4
    When je choisis l'opération "-"
    Then le résultat binaire doit être "110"
    And le résultat décimal doit être 6

  Scenario: Opération logique AND
    Given je saisis 6 et 3
    When je choisis l'opération "AND"
    Then le résultat binaire doit être "10"
    And le résultat décimal doit être 2

      Scenario: Opération logique OR
    Given je saisis 6 et 3
    When je choisis l'opération "OR"
    Then le résultat binaire doit être "111"
    And le résultat décimal doit être 7

  Scenario: Opération logique XOR
    Given je saisis 6 et 3
    When je choisis l'opération "XOR"
    Then le résultat binaire doit être "101"
    And le résultat décimal doit être 5

  Scenario: Division entière
    Given je saisis 8 et 2
    When je choisis l'opération "/"
    Then le résultat binaire doit être "100"
    And le résultat décimal doit être 4

      Scenario: Multiplication
    Given je saisis 4 et 3
    When je choisis l'opération "*"
    Then le résultat binaire doit être "1100"
    And le résultat décimal doit être 12

    


