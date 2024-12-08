<!DOCTYPE html>
<html>
<head>
  <title>Lọc Key</title>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .container {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 30px;
      width: 600px;
      max-width: 90%;
      text-align: center;
    }

    h1 {
      color: #333;
      margin-bottom: 20px;
      font-size: 28px;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
      color: #555;
      text-align: left;
    }

    textarea {
      width: calc(100% - 20px);
      height: 200px;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 16px;
      resize: vertical;
    }

    button {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      font-size: 18px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #0056b3;
    }

    #result {
      margin-top: 20px;
      font-weight: bold;
      white-space: pre-wrap;
      word-wrap: break-word;
      color: #28a745;
      text-align: left;
      font-size: 16px;
    }

    #result.error {
        color: #dc3545;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Điền List Key Tại Đây</h1>

    <form method="post">
      <label for="inputString">Nội dung:</label>
      <textarea name="inputString" id="inputString" required></textarea>
      <button type="submit">Lọc</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $inputString = $_POST["inputString"];

      // Xử lý dữ liệu input (Loại bỏ khoảng trắng thừa)
      $inputString = preg_replace('/\s+/', ' ', $inputString);

      $matches = array();
      preg_match_all('/([A-Z0-9]{5}-){4}[A-Z0-9]{5}/', $inputString, $matches);

      $result = "";
      if (isset($matches[0])) {
        foreach ($matches[0] as $match) {
          $result .= $match . "<br>";
        }
      }

      // Trường hợp không có kết quả khớp
      if (empty($result)) {
        $result = "Không tìm thấy chuỗi phù hợp.";
        echo "<div id='result' class='error'>$result</div>";
      } else {
          echo "<div id='result'>$result</div>";
      }
    }
    ?>
  </div>
</body>
</html>
