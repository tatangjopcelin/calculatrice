Créer la table calculs dans MySQL avec pour nom de la BD :calculatrice-binaire

CREATE TABLE calculs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre1 INT NOT NULL,
    nombre2 INT NOT NULL,
    operation VARCHAR(10) NOT NULL,
    resultat INT NOT NULL,
    resultat_binaire VARCHAR(64) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
