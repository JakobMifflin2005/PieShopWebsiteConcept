<?php
class AuthPDO {
    private $pdo;
    public function __construct()
    {
        try {
            $dsn = "mysql:host=localhost;dbname=restaurant;port=8889";
            $db_username = "root";
            $db_password = "root";
            $this->pdo = new PDO ($dsn, $db_username, $db_password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    } catch (PDOException $e) {
        die("Database connection failed: ". $e->getMessage());
   
}
    }
    public function getConnection() {
        return $this->pdo;
    }
    public function register($username, $password, $confirm) {
        if (empty($username) || empty($password) || empty($confirm)) {
            return "All fields are required";
        }
        if ($password != $confirm) {
            return "Passwords do not match";
        }
        if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password))  {
            return "Password must be 8+ characters, include letters and numbers";
        }
        try {
            $username = str_replace(' ', '', $username);
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stnt = $this->pdo->prepare("INSERT INTO users (name, password) VALUES (?, ?)");
            $stnt->execute([$username, $hash]);
            return true;
        } catch (PDOException $e) 
        {
            if ($e->errorInfo[1] == 1062) {
                return "Error: Username is already taken.";
            }
            return "Error: ".$e->getMessage();
        }
        }
        public function login($username, $password) {
            $statement = $this->pdo->prepare("SELECT * FROM users WHERE name = ?");
            $statement->execute([$username]);
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            return $user && password_verify($password, $user["password"]);
        }
        public function showData($username) {
            $stmt = $this->pdo->prepare("SELECT id, name, password FROM users WHERE name = ?");
            $stmt->execute([$username]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function changeUsername($username) {
            try {
                $username = str_replace(' ', '', $username);
                session_start();
                $oldUsername = $_SESSION["user"];
                if ($username == $oldUsername) {
                    return "New username can't be your Username";
                }
                $stmt = $this->pdo->prepare("UPDATE users SET name = ? WHERE name = ?");
                $stmt->execute([$username, $oldUsername]);
                return true;
        } catch (PDOException $e)  {
            if ($e->getCode() == 23000 ) {
                return "Error: Username is already taken.";
            }
            return "Error: ".$e->getMessage();
        }
    }
    public function changePassword($currentPassword, $password, $confirm) {
        try {
        session_start();
        $username = $_SESSION["user"];
        $stmt = $this->pdo->prepare("SELECT password FROM users WHERE name = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            return "Error Finding User";
        }
        if ($password != $confirm) {
            return "Error: New Password and Confirm Password do not match";
        }
        $hashedPassword = $user["password"];
        if (!password_verify($currentPassword, $hashedPassword)) {
            return "Error: Current Password is incorrect";
        }
        if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password))  {
            return "Password must be 8+ characters, include letters and numbers";
        }
        $newHashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $updateStmt = $this->pdo->prepare("UPDATE users SET password = ? WHERE name = ?");
        $updateStmt->execute([$newHashedPassword, $username]);
        return true;
    } catch (PDOException $e) {
        return "Error" . $e->getMessage();
    }
}
public function deleteAccount($password, $confirm) {
    try {
    session_start();
    $username = $_SESSION["user"];
    $stmt = $this->pdo->prepare("SELECT password FROM users WHERE name = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            return "Error Finding User";
        }
        if ($password != $confirm) {
            return "Error: Password and Confirm Password do not match";
        }
        $hashedPassword = $user["password"];
        if (!password_verify($password, $hashedPassword)) {
            return "Error: Current Password is incorrect";
        }
        $updateStmt = $this->pdo->prepare("DELETE FROM users WHERE name = ?");
        $updateStmt->execute([$username]);
        return true;
} catch (PDOException $e) {
    return "Error" . $e->getMessage();
}
}
}












