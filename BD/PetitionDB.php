<?php
class PetitionDB
{
    private static $host     = "localhost";
    private static $dbname   = "petition";
    private static $username = "root";
    private static $password = "Fati1234fati";


    private static function connect()
    {
        try {
            $pdo = new PDO(
                "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8",
                self::$username,
                self::$password
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;

        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    
    public static function getAllPetitions()
    {
        $pdo = self::connect();
        $sql = "SELECT p.*,
                       (SELECT COUNT(*) FROM Signature s WHERE s.IDP = p.IDP) AS count_signatures
                FROM Petition p
                ORDER BY p.IDP DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   

    public static function getPetitionById($IDP)
    {
        $pdo = self::connect();
        $sql = "SELECT * FROM Petition WHERE IDP = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$IDP]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    

    public static function addPetition($titre, $description, $datePublic, $dateFinP, $porteurP, $email)
    {
        $pdo = self::connect();
        $sql = "INSERT INTO Petition (Titre, Description, DatePublic, DateFinP, PorteurP, Email)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titre, $description, $datePublic, $dateFinP, $porteurP, $email]);
    }

    
    public static function addSignature($IDP, $nom, $prenom, $pays, $date, $heure, $email)
    {
        $pdo = self::connect();
        $sql = "INSERT INTO Signature (IDP, Nom, Prenom, Pays, Date, Heure, Email)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$IDP, $nom, $prenom, $pays, $date, $heure, $email]);
    }

    
    public static function getLastSignatures($IDP, $limit = 5)
    {
        $pdo = self::connect();
        $sql = "SELECT * FROM Signature
                WHERE IDP = ?
                ORDER BY IDS DESC
                LIMIT $limit";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$IDP]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTopPetition()
{
    $pdo = self::connect();
   
    $sql = "SELECT p.*, COUNT(s.IDS) AS nb_signatures
            FROM Petition p
            LEFT JOIN Signature s ON p.IDP = s.IDP
            GROUP BY p.IDP
            ORDER BY nb_signatures DESC
            LIMIT 1";
    $stmt = $pdo->query($sql);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public static function getLastPetitionInfo()
{
    $pdo = self::connect();
  
    $sql = "SELECT IDP, Titre, DatePublic FROM Petition ORDER BY IDP DESC LIMIT 1";
    $stmt = $pdo->query($sql);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public static function updatePetition($IDP, $titre, $description, $datePublic, $dateFinP, $porteurP, $email)
{
    $pdo = self::connect();
    $sql = "UPDATE Petition 
            SET Titre = ?, Description = ?, DatePublic = ?, DateFinP = ?, PorteurP = ?, Email = ?
            WHERE IDP = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titre, $description, $datePublic, $dateFinP, $porteurP, $email, $IDP]);
}


public static function deletePetition($IDP)
{
    $pdo = self::connect();
    $sql = "DELETE FROM Petition WHERE IDP = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$IDP]);
}


public static function updateSignature($IDS, $nom, $prenom, $pays, $date, $heure, $email)
{
    $pdo = self::connect();
    $sql = "UPDATE Signature 
            SET Nom = ?, Prenom = ?, Pays = ?, Date = ?, Heure = ?, Email = ?
            WHERE IDS = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom, $pays, $date, $heure, $email, $IDS]);
}


public static function deleteSignature($IDS)
{
    $pdo = self::connect();
    $sql = "DELETE FROM Signature WHERE IDS = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$IDS]);
}


public static function getSignatureById($IDS)
{
    $pdo = self::connect();
    $sql = "SELECT * FROM Signature WHERE IDS = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$IDS]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}



public static function getSignaturesByPetition($IDP)
{
    $pdo = self::connect();
    $sql = "SELECT * FROM Signature WHERE IDP = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$IDP]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
