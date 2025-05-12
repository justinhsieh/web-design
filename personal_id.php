<?php include 'load_personal_id.php';?>
<?php include 'head.php';?>
  <!-- 自定義JS -->
  <script src="js/validate_personalID.js"></script>
</head>

<body>
  <?php include 'header.php';?>
  <!-- 個人檔案 -->
  <div class="container px-5 py-5">
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <h1>客戶基本資料</h1>
        <form action="save_user.php" method="post" class="form-horizontal" id="form-personalID">
          <div class="form-group py-2">
            <label for="name" class="form-label">姓名</label>
            <input type="text" name="name" class="form-control" placeholder="ex.王小明" value="<?= htmlspecialchars($user['name'] ?? '')?>" required />
          </div>
          <div class="form-group py-2">
            <label for="birth" class="form-label">出生</label>
            <input type="text" name="birth" placeholder="xxxx-xx-xx" class="form-control" value="<?= htmlspecialchars($user['birthdate'] ?? '')?>" pattern="^((?:19[2-9]\d{1})|(?:20[0-2][0-9]))\-((?:0?[1-9])|(?:1[0-2]))\-((?:0?[1-9])|(?:[1-2][0-9])|30|31)$" />
          </div>
          <div class="form-group py-2">
            <label for="account" class="form-label">帳號</label>
            <input type="text" name="account" placeholder="Account" class="form-control" value="<?= htmlspecialchars($user['username'] ?? '')?>" required/>
          </div>
          <div class="form-group py-2">
            <label for="password" class="form-label">密碼</label>
            <input type="password" name="password" placeholder="Password" class="form-control" minlength="6" required />
          </div>
          <div class="form-group py-2">
            <label for="phone_number" class="form-label">電話</label>
            <input type="text" name="phone_number" placeholder="09xx-xxxxxx" class="form-control" pattern="09[0-9]{2}-[0-9]{6}" value="<?= htmlspecialchars($user['phone'] ?? '')?>" required/>
          </div>
          <div class="form-group py-2">
            <label for="email" class="form-label">電子郵件</label>
            <input type="email" name="email" placeholder="example@gmail.com" class="form-control" value="<?= htmlspecialchars($user['email'] ?? '')?>" required/>
          </div>
          <div class="form-group py-2">
            <label for="location" class="form-label">地址</label>
            <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($user['address'] ?? '')?>" required/>
          </div>
          <div class="form-group py-2">
            <input type="submit" name="submit-personalID" class="btn btn-primary" value="儲存" />
          </div>
        </form>
      </div>
      <div class="col-2"></div>
    </div>
  </div>
  <?php include 'footer.php';?>
</body>

</html>
<?php $conn->close(); ?>