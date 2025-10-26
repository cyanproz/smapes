<?php
// app/store-functions.php

require_once __DIR__ . '/coins-functions.php';

class Store
{
    private PDO $pdo;
    private Coins $coins;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->coins = new Coins($pdo); // initialize Coins helper
    }

    /**
     * Public getter for Coins instance
     */
    public function getCoins(): Coins
    {
        return $this->coins;
    }

    // ----- Product-related -----
    public function getAllProducts() {}
    public function getProductById(int $productId) {}
    public function updateProductStock(int $productId, int $newStock) {}

    // ----- Store item prices -----
    public function getStoreItemPricesInSession(bool $forceRefresh = false): array
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!$forceRefresh && isset($_SESSION['store_items']) && is_array($_SESSION['store_items'])) {
            return $_SESSION['store_items'];
        }

        $sql = "SELECT id, slug, name, price_cash, price_coins, stock, is_active FROM store_items WHERE is_active = 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $byId = [];
        foreach ($items as $it) {
            $byId[(int)$it['id']] = [
                'id' => (int)$it['id'],
                'slug' => $it['slug'],
                'name' => $it['name'],
                'description' => $it['description'],
                'price_cash' => (float)$it['price_cash'],
                'price_coins' => (int)$it['price_coins'],
                'stock' => (int)$it['stock'],
                'is_active' => (int)$it['is_active']
            ];
        }

        $_SESSION['store_items'] = $byId;
        return $byId;
    }

    // ----- Purchase-related -----
    public function calculatePurchase(array $items): array
    {
        $totalCash = 0.0;
        $totalCoins = 0;

        $storeItems = $this->getStoreItemPricesInSession();

        foreach ($items as &$item) {
            if (!isset($item['item_id'], $item['quantity'])) {
                throw new InvalidArgumentException("Each item must include 'item_id' and 'quantity'");
            }

            $id = (int)$item['item_id'];
            $quantity = (int)$item['quantity'];

            if (!isset($storeItems[$id])) {
                throw new InvalidArgumentException("Item ID {$id} not found in store.");
            }

            $priceCash = (float)$storeItems[$id]['price_cash'];
            $priceCoins = (int)$storeItems[$id]['price_coins'];

            $item['price_cash'] = $priceCash;
            $item['price_coins'] = $priceCoins;
            $item['subtotal_cash'] = $priceCash * $quantity;
            $item['subtotal_coins'] = $priceCoins * $quantity;

            $totalCash += $item['subtotal_cash'];
            $totalCoins += $item['subtotal_coins'];
        }
        unset($item);

        return [
            'items' => $items,
            'total_cash' => $totalCash,
            'total_coins' => $totalCoins
        ];
    }

    public function createPurchase(int $userId, float $totalCash, int $totalCoins = 0, string $status = 'pending'): int
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO purchases (user_id, total_cash, total_coins, status, created_at)
            VALUES (:user_id, :total_cash, :total_coins, :status, NOW())
        ");
        $stmt->execute([
            ':user_id' => $userId,
            ':total_cash' => $totalCash,
            ':total_coins' => $totalCoins,
            ':status' => $status
        ]);

        return (int)$this->pdo->lastInsertId();
    }

    public function addPurchaseItems(int $purchaseId, array $items): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO purchase_items 
            (purchase_id, item_id, quantity, price_cash, price_coins, subtotal_cash, subtotal_coins)
            VALUES 
            (:purchase_id, :item_id, :quantity, :price_cash, :price_coins, :subtotal_cash, :subtotal_coins)
        ");

        foreach ($items as $item) {
            $stmt->execute([
                ':purchase_id'    => $purchaseId,
                ':item_id'        => $item['item_id'],
                ':quantity'       => (int)$item['quantity'],
                ':price_cash'     => (float)$item['price_cash'],
                ':price_coins'    => (int)$item['price_coins'],
                ':subtotal_cash'  => (int)$item['quantity'] * (float)$item['price_cash'],
                ':subtotal_coins' => (int)$item['quantity'] * (int)$item['price_coins']
            ]);
        }
    }

    public function createFullPurchase(int $userId, array $items): int
    {
        // Step 1: Calculate totals
        $calculated = $this->calculatePurchase($items);
        $totalCash = $calculated['total_cash'];
        $totalCoins = $calculated['total_coins'];

        // Step 2: Begin transaction
        $this->pdo->beginTransaction();

        try {
            // Step 3: Create purchase record
            $purchaseId = $this->createPurchase($userId, $totalCash, $totalCoins, 'paid');

            // Step 4: Add purchase items
            $this->addPurchaseItems($purchaseId, $calculated['items']);

            // Step 5: Deduct coins if any
            if ($totalCoins > 0) {
                $this->coins->change(
                    $userId,          // user ID
                    -$totalCoins,     // negative because spending coins
                    $purchaseId,      // refId (must be int)
                    'purchase',       // transaction type
                    "Purchase #$purchaseId" // description
                );
            }

            // Step 6: Commit all
            $this->pdo->commit();

            // Step 7: Return purchase ID
            return $purchaseId;

        } catch (PDOException $e) {
            // Rollback if anything fails
            $this->pdo->rollBack();
            error_log('Create Full Purchase Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function addPurchaseItem(int $purchaseId, int $productId, int $quantity, float $price) {}
    public function getPurchaseItems(int $purchaseId) {}
}
