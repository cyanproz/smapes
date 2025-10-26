<?php
// app/coins-functions.php

class Coins
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Get the current coin balance for a user.
     */
    public function getBalance(int $userId): int
    {
        $stmt = $this->pdo->prepare("
            SELECT COALESCE(SUM(amount_coins), 0) AS balance 
            FROM transactions 
            WHERE user_id = :user_id
        ");
        $stmt->execute([':user_id' => $userId]);
        $balance = (int)$stmt->fetchColumn();
        return $balance;
    }

    /**
     * Add or subtract coins for a user.
     * Negative $amountCoins means spending.
     * Throws exception if spending more than balance.
     */
    public function change(
        int $userId,
        int $amountCoins,
        ?int $refId = null,
        string $type = 'adjust',   // <-- added this optional parameter
        ?string $description = null
    ): void
    {
        if ($amountCoins < 0) {
            $currentBalance = $this->getBalance($userId);
            if ($currentBalance + $amountCoins < 0) {
                throw new Exception("Insufficient coins for user $userId");
            }
        }

        $stmt = $this->pdo->prepare("
            INSERT INTO transactions (user_id, type, amount_coins, ref_id, description)
            VALUES (:user_id, :type, :amount_coins, :ref_id, :description)
        ");

        // auto-set type if 'adjust'
        if ($type === 'adjust') {
            $type = $amountCoins >= 0 ? 'add' : 'spend';
        }

        $stmt->execute([
            ':user_id' => $userId,
            ':type' => $type,
            ':amount_coins' => $amountCoins,
            ':ref_id' => $refId,
            ':description' => $description
        ]);
    }
}
