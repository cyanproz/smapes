<?php
class SimpleAuth {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // 🔐 Login
    public function login($username, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'fullname' => $user['fullname'],
                'email' => $user['email'],
                'location_id' => $user['location_id'],
                'created_at' => $user['created_at'],
                'updated_at' => $user['updated_at'],
                'smapes_coins' => $user['smapes_coins'],
            ];
            return true;
        }
        return false;
    }

    // 🚪 Logout
    public function logout() {
        unset($_SESSION['user']);
        session_unset();
        session_destroy();
    }

    // ✅ Check login
    public function isLoggedIn() {
        return isset($_SESSION['user']);
    }

    // 🙋‍♂️ Current user
    public function getUser() {
        return $_SESSION['user'] ?? null;
    }

    // 🧂 Register with duplicate checks
    public function register($username, $fullname, $email, $password) {
        // 🔍 Check if username already exists
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            return ["success" => false, "message" => "Username already exists."];
        }

        // 🔍 Check if fullname already exists
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE fullname = ? LIMIT 1");
        $stmt->execute([$fullname]);
        if ($stmt->fetch()) {
            return ["success" => false, "message" => "Full name already exists."];
        }

        // ✅ Insert new user
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, fullname, email, password) VALUES (?, ?, ?, ?)");
        $ok = $stmt->execute([$username, $fullname, $email, $hashed]);

        if ($ok) {
            return ["success" => true, "message" => "Registration successful."];
        }
        return ["success" => false, "message" => "Registration failed due to a database error."];
    }

    // 🗑️ Delete account
    public function deleteAccount($userId) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
            $success = $stmt->execute([$userId]);
            if ($success) {
                $this->logout();
            }
            return $success;
        } catch (PDOException $e) {
            return false;
        }
    }
}

$auth = new SimpleAuth($pdo);
?>
