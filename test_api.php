<!DOCTYPE html>
<html>
<head>
    <title>测试API页面</title>
</head>
<body>
    <h1>测试API</h1>
    
    <form method="POST" action="">
        <label for="api_url">API地址:</label>
        <input type="text" id="api_url" name="api_url" placeholder="输入API地址" required><br><br>
        
        <label for="http_method">请求方式:</label>
        <select id="http_method" name="http_method">
            <option value="GET">GET</option>
            <option value="POST">POST</option>
            <option value="PUT">PUT</option>
            <option value="DELETE">DELETE</option>
        </select><br><br>
        
        <label for="request_data">请求数据(JSON格式):</label><br>
        <textarea id="request_data" name="request_data" rows="4" cols="50"></textarea><br><br>
        
        <input type="submit" value="发送请求">
    </form>
    
    <?php
    // 检查是否有表单提交
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 获取表单数据
        $apiUrl = $_POST['api_url'];
        $httpMethod = $_POST['http_method'];
        $requestData = $_POST['request_data'];
        
        // 创建curl句柄
        $ch = curl_init();
        
        // 设置请求URL
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        
        // 设置请求方式
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $httpMethod);
        
        // 如果有请求数据，则设置请求体内容
        if (!empty($requestData)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);
        }
        
        // 执行API请求
        $response = curl_exec($ch);
        
        // 关闭curl句柄
        curl_close($ch);
        
        // 显示API响应
        echo "<h2>API响应:</h2>";
        echo "<pre>" . htmlentities($response) . "</pre>";
    }
    ?>
</body>
</html>
