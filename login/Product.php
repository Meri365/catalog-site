<?php
class Product {
    private $conn;
    private $user_id;

    public function __construct($conn, $user_id) {
        $this->conn = $conn;
        $this->user_id = $user_id;

        // Create table if not exists
        $this->conn->query("CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            name VARCHAR(100) NOT NULL,
            description TEXT,
            quantity INT NOT NULL,
            weight VARCHAR(50),
            color VARCHAR(50),
            price DECIMAL(10,2) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        ) ENGINE=InnoDB");
    }

    // Add a product
    public function add($data) {
        $errors = [];

        $name     = trim($data['product_name'] ?? '');
        $desc     = trim($data['description'] ?? '');
        $quantity = intval($data['quantity'] ?? 0);
        $weight   = trim($data['weight'] ?? '');
        $color    = trim($data['color'] ?? '');
        $price    = floatval($data['price'] ?? 0);

        if (!$name) $errors[] = "Product name is required.";
        if ($quantity <= 0) $errors[] = "Quantity must be greater than 0.";
        if ($price <= 0) $errors[] = "Price must be greater than 0.";

        if ($errors) return ['success' => false, 'message' => implode(" ", $errors)];

        $stmt = $this->conn->prepare("INSERT INTO products (user_id, name, description, quantity, weight, color, price) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ississd", $this->user_id, $name, $desc, $quantity, $weight, $color, $price);
        $result = $stmt->execute();
        $stmt->close();

        if ($result) return ['success' => true, 'message' => "Product added successfully!"];
        else return ['success' => false, 'message' => "Failed to add product. Please try again."];
    }

    // Get all products
    public function getAll() {
        $products = [];
        $stmt = $this->conn->prepare("SELECT name, description, quantity, weight, color, price FROM products WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->bind_param("i", $this->user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        $stmt->close();
        return $products;
    }

    public function getAllProducts() {
        $products = [];
        $stmt = $this->conn->prepare("SELECT name, description, quantity, weight, color, price FROM products ORDER BY created_at DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        $stmt->close();
        return $products;
    }
}
?>