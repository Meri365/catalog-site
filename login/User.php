<?php
class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    //Register
    public function register($data) {
        $errors = [];

        $name     = trim($data['name'] ?? '');
        $surname  = trim($data['surname'] ?? '');
        $email    = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';
        $confirm  = $data['confirm_password'] ?? '';
        $gender   = $data['gender'] ?? '';

        // Required fields
        if (!$name || !$surname || !$email || !$password || !$confirm || !$gender) {
            $errors[] = "All fields are required.";
        }

        // Name & surname validation
        if (!preg_match("/^[a-zA-ZԱ-Ֆա-ֆ'-]+$/u", $name)) $errors[] = "Name can contain only letters.";
        if (!preg_match("/^[a-zA-ZԱ-Ֆա-ֆ'-]+$/u", $surname)) $errors[] = "Surname can contain only letters.";

        // Email validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";

        // Password match
        if ($password !== $confirm) $errors[] = "Passwords do not match.";

        // Check if email already exists
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) $errors[] = "Email already registered.";
        $stmt->close();

        if ($errors) {
            return ['success' => false, 'errors' => $errors];
        }

        // Hash password
        $hashedPassword = md5($password);

        // Insert user
        $stmt = $this->conn->prepare("INSERT INTO users (name, surname, email, password, gender) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $surname, $email, $hashedPassword, $gender);

        if ($stmt->execute()) {
            $stmt->close();
            return ['success' => true, 'message' => "Registration successful!"];
        } else {
            $stmt->close();
            return ['success' => false, 'errors' => ["Failed to register. Please try again."]];
        }
    }
    
    // Login method
    public function login($email, $password) {
        $errors = [];

        $email = trim($email);
        $password = trim($password);

        if (!$email || !$password) $errors[] = "All fields are required.";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";

        if ($errors) {
            return ['success' => false, 'errors' => $errors];
        }

        // Use md5 for now (but better: password_hash in production)
        $hashedPassword = md5($password);

        $stmt = $this->conn->prepare("SELECT id, name FROM users WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $hashedPassword);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            $stmt->close();
            return ['success' => true];
        } else {
            $stmt->close();
            return ['success' => false, 'errors' => ["Invalid email or password"]];
        }
    }
}
?>