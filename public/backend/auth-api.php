<?php
require __DIR__ . "/../site-config.php";
require __DIR__ . "/db.php";
require __DIR__ . "/auth.php";

$auth = new SimpleAuth($pdo);
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 🧍‍♂️ Register
    if (isset($_POST['register'])) {
        $username = trim($_POST['username'] ?? '');
        $fullname = trim($_POST['fullname'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (!$username || !$fullname || !$email || !$password) {
            echo json_encode(["success" => false, "message" => "All fields are required."]);
            exit;
        }

        if ($auth->register($username, $fullname, $email, $password)) {
            echo json_encode(["success" => true, "message" => "Registration successful."]);
        } else {
            echo json_encode(["success" => false, "message" => "Registration failed. Username, fullname, or email might already exist."]);
        }
        exit;
    }

    // ✅ Check if username exists
    if (isset($_POST['check-username'])) {
        $username = trim($_POST['username'] ?? '');
        if (!$username) {
            echo json_encode(["success" => false, "message" => "Username not provided."]);
            exit;
        }

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $exists = $stmt->fetchColumn() > 0;

        echo json_encode(["success" => true, "exists" => $exists]);
        exit;
    }

    // ✅ Check if fullname exists
    if (isset($_POST['check-fullname'])) {
        $fullname = trim($_POST['fullname'] ?? '');
        if (!$fullname) {
            echo json_encode(["success" => false, "message" => "Full name not provided."]);
            exit;
        }

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE fullname = ?");
        $stmt->execute([$fullname]);
        $exists = $stmt->fetchColumn() > 0;

        echo json_encode(["success" => true, "exists" => $exists]);
        exit;
    }

    // ✅ Check if email exists
    if (isset($_POST['check-email'])) {
        $email = trim($_POST['email'] ?? '');
        if (!$email) {
            echo json_encode(["success" => false, "message" => "Email not provided."]);
            exit;
        }

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $exists = $stmt->fetchColumn() > 0;

        echo json_encode(["success" => true, "exists" => $exists]);
        exit;
    }

    // 🚪 Logout
    if (isset($_POST['logout'])) {
        $auth->logout();
        echo json_encode(["success" => true, "message" => "Logged out successfully."]);
        exit;
    }

    // 🔐 Login
    if (isset($_POST['username'], $_POST['password'])) {
        if ($auth->login($_POST['username'], $_POST['password'])) {
            echo json_encode(["success" => true, "message" => "Login successful."]);
        } else {
            echo json_encode(["success" => false, "message" => "Invalid username or password."]);
        }
        exit;
    }

    // 🗑️ Delete Account
    if (isset($_POST['delete-account'])) {
        if (!$auth->isLoggedIn()) {
            echo json_encode(["success" => false, "message" => "You must be logged in to delete your account."]);
            exit;
        }

        $user = $auth->getUser();
        if ($auth->deleteAccount($user['id'])) {
            echo json_encode(["success" => true, "message" => "Account deleted successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to delete account."]);
        }
        exit;
    }

    echo json_encode(["success" => false, "message" => "Invalid POST data."]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode([
        "loggedIn" => $auth->isLoggedIn(),
        "user" => $auth->getUser()
    ]);
    exit;
}

http_response_code(405);
echo json_encode(["success" => false, "message" => "Method not allowed."]);
?>
