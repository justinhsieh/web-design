<?php include("db.php"); ?>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
$user_id = $_SESSION['id'];

// 處理取消訂單請求
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_order_id'])) {
    $cancel_order_id = intval($_POST['cancel_order_id']);

    // 確保該訂單是此會員的 & 尚未出貨
    $check_stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ? AND user_id = ? AND shipping_status = 'pending'");
    $check_stmt->bind_param("ii", $cancel_order_id, $user_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // 刪除明細
        $stmt_del_items = $conn->prepare("DELETE FROM order_items WHERE order_id = ?");
        $stmt_del_items->bind_param("i", $cancel_order_id);
        $stmt_del_items->execute();

        // 刪除主訂單
        $stmt_del_order = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
        $stmt_del_order->bind_param("i", $cancel_order_id);
        $stmt_del_order->execute();

        echo "<script>alert('訂單已取消');</script>";
    } else {
        echo "<script>alert('此訂單無法取消');</script>";
    }
}
?>
<?php include 'head.php';?>
    <!-- 自定義JS -->
    <script src="js/validate_personalID.js"></script>
    <script src="js/add.js"></script>
    <script src="js/edit.js"></script>
    <script src="js/CRUD.js"></script>
    <script src="js/cart_cnt.js"></script>
    <script>
        $(document).ready(function () {
            $(".drop_item").click(function () {
                $(".dropdown-toggle").html($(this).html());
                $(".drop_item").each(function () {
                    $(this).show();
                })
                $(this).hide();
            });
            
        });
    </script>
</head>
<body>
    <!-- 導覽列 -->
    <?php include 'header.php'; ?>
    <main>
        <div class="container">
            <h2 class="mb-4">我的訂單</h2>

            <?php
            $stmt = $conn->prepare("SELECT order_id, order_date, total_amount, payment_status, shipping_status
                                    FROM orders WHERE user_id = ? ORDER BY order_date DESC");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $orders = $stmt->get_result();

            if ($orders && $orders->num_rows > 0):
                while ($order = $orders->fetch_assoc()):
                    $order_id = $order['order_id'];
                    echo "<div class='card mb-4'>
                            <div class='card-header bg-primary text-white'>
                                訂單編號：{$order_id}&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;日期：{$order['order_date']}&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;金額：\${$order['total_amount']}
                                <div class='float-end'>
                                    付款狀態：<strong>{$order['payment_status']}</strong>&nbsp;&nbsp;&nbsp;
                                    出貨狀態：<strong>{$order['shipping_status']}</strong>
                                </div>
                            </div>
                            <div class='card-body p-0'>
                                <table class='table table-striped mb-0'>
                                    <thead>
                                        <tr class='text-center'>
                                            <th>商品名稱</th>
                                            <th>顏色</th>
                                            <th>單價</th>
                                            <th>數量</th>
                                            <th>小計</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                    // 查詢明細
                    $stmt_items = $conn->prepare("SELECT product_name, price, quantity, color, subtotal
                                                FROM order_items WHERE order_id = ?");
                    $stmt_items->bind_param("i", $order_id);
                    $stmt_items->execute();
                    $items = $stmt_items->get_result();

                    while ($item = $items->fetch_assoc()) {
                        echo "<tr class='text-center'>
                                <td>{$item['product_name']}</td>
                                <td>{$item['color']}</td>
                                <td>\${$item['price']}</td>
                                <td>{$item['quantity']}</td>
                                <td>\${$item['subtotal']}</td>
                            </tr>";
                    }

                    echo "  </tbody></table>";

                    // 若尚未出貨，可取消訂單
                    if ($order['shipping_status'] === 'pending') {
                        echo "<form method='POST' onsubmit='return confirm(\"確定要取消這筆訂單嗎？\");'>
                                <input type='hidden' name='cancel_order_id' value='{$order_id}'>
                                <div class='text-end p-3'>
                                    <button class='btn btn-danger btn-sm'>取消訂單</button>
                                </div>
                            </form>";
                    }

                    echo "</div></div>";
                endwhile;
            else:
                echo "<div class='alert alert-info text-center'>目前尚無訂單</div>";
            endif;
            ?>
        </div>
    </main>
  <?php include 'footer.php';?>
</body>

</html>
