<?php
session_start();
require_once 'php/db.php';

if (!isset($_SESSION['user_id'])) {
    echo "Non connecté";
        exit;
        }

        $user_id = $_SESSION['user_id'];

        $query = $pdo->prepare("SELECT solde FROM users WHERE id = ?");
        $query->execute([$user_id]);
        $user = $query->fetch();

        if ($user) {
            $solde = number_format($user['solde'], 0, ',', ' ') . ' FCFA';
            } else {
                $solde = "Erreur";
                }
                ?>

                <style>
                    .solde-container {
                            display: flex;
                                    align-items: center;
                                            background: #f0f4f8;
                                                    border-radius: 20px;
                                                            padding: 6px 12px;
                                                                    font-weight: 600;
                                                                            font-size: 14px;
                                                                                    color: #333;
                                                                                            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                                                                                                    gap: 10px;
                                                                                                        }

                                                                                                            .solde-text {
                                                                                                                    color: #007bff;
                                                                                                                        }

                                                                                                                            .depot-btn {
                                                                                                                                    background-color: #28a745;
                                                                                                                                            color: white;
                                                                                                                                                    border: none;
                                                                                                                                                            border-radius: 50%;
                                                                                                                                                                    width: 26px;
                                                                                                                                                                            height: 26px;
                                                                                                                                                                                    display: flex;
                                                                                                                                                                                            align-items: center;
                                                                                                                                                                                                    justify-content: center;
                                                                                                                                                                                                            font-size: 18px;
                                                                                                                                                                                                                    text-decoration: none;
                                                                                                                                                                                                                            transition: background 0.3s;
                                                                                                                                                                                                                                }

                                                                                                                                                                                                                                    .depot-btn:hover {
                                                                                                                                                                                                                                            background-color: #218838;
                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                </style>

                                                                                                                                                                                                                                                <div class="solde-container">
                                                                                                                                                                                                                                                    <span>Solde: <span class="solde-text"><?php echo $solde; ?></span></span>
                                                                                                                                                                                                                                                        <a href="depot.php" class="depot-btn" title="Faire un dépôt">+</a>
                                                                                                                                                                                                                                                        </div>