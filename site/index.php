<?php
session_start();
include __DIR__.'/db/db.php';

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

// Lấy ID từ URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Lấy thông tin người dùng từ cơ sở dữ liệu
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Tính tuổi
    $dob = new DateTime($user['dob']);
    $today = new DateTime('today');
    $age = $today->diff($dob)->y;
} else {
    echo "<h4>Ban dung that la dinh cua chop :v </h4>";
    echo"<span>FLAG : VKU{H4ck3r_L0rd_Nh3}</span>";
    exit();
}

$stmt->close();
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>User Profile</title>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full">
            <div class="flex items-center space-x-4">
                <!-- Avatar -->
                <img src="<?php echo $user['avatar']; ?>" alt="Avatar" class="w-16 h-16 rounded-full">
                <div>
                    <h1 class="text-2xl font-bold"><?php echo $user['full_name']; ?></h1>
                    <p class="text-gray-500">Username: <?php echo $user['username']; ?></p>
                </div>
            </div>
            <div class="mt-6">
                <p class="text-gray-700"><strong>Date of Birth:</strong> <?php echo date('d-m-Y', strtotime($user['dob'])); ?></p>
                <p class="text-gray-700"><strong>Age:</strong> <?php echo $age; ?> years</p>
                <p class="text-gray-700"><strong>Address:</strong> <?php echo $user['address']; ?></p>
                <p class="text-gray-700"><strong>Phone:</strong> <?php echo $user['phone']; ?></p>
            </div>
            <div class="mt-8">
                <a href="logout.php" class="text-blue-500 hover:underline">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>
