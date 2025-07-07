Feature: Calculatrice binaire - Tests via formulaire HTML

Background:
  # Prérequis : le serveur local tourne à l'adresse http://localhost:8000/index.php
  # Et le formulaire contient les champs : nombre1, nombre2, operation (select), bouton "Calculer"
  # Et le résultat est affiché dans un élément avec la classe ".result"

Scenario: Addition via le formulaire
  When je remplis le formulaire avec 5 et 3 et l'opération "+"
  Then le résultat affiché doit contenir 8
  And je devrais voir le résultat binaire 1000

Scenario: Soustraction via le formulaire
  When je remplis le formulaire avec 9 et 4 et l'opération "-"
  Then le résultat affiché doit contenir 5
  And je devrais voir le résultat binaire 101

Scenario: Opération AND via le formulaire
  When je remplis le formulaire avec 6 et 3 et l'opération "AND"
  Then le résultat affiché doit contenir 2
  And je devrais voir le résultat binaire 10

Scenario: Opération OR via le formulaire
  When je remplis le formulaire avec 6 et 3 et l'opération "OR"
  Then le résultat affiché doit contenir 7
  And je devrais voir le résultat binaire 111

Scenario: Opération XOR via le formulaire
  When je remplis le formulaire avec 6 et 3 et l'opération "XOR"
  Then le résultat affiché doit contenir 5
  And je devrais voir le résultat binaire 101
