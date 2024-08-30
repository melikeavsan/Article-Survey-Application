<?php
// Veritabanı bağlantısı için ayarlar
$servername = "localhost";
$username = "kullanici_adi";
$password = "parola";
$dbname = "veritabani_adi";

// Bağlantı oluşturma
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if (!$conn) {
    die("Bağlantı başarısız: " . mysqli_connect_error());
}

// Form gönderilince
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = $_POST['response'];

    $sql = "INSERT INTO anket_sonuclari (cevap) VALUES ('$response')";

    if (mysqli_query($conn, $sql)) {
        echo "Anketiniz başarılı şekilde kaydedildi! <br>";
    } else {
        echo "Hata: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Anket sonuçlarını göster
$sql = "SELECT cevap, COUNT(*) as sayi FROM anket_sonuclari GROUP BY cevap";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<h2>Anket Sonuçları</h2>";
    echo "<table border='1'><tr><th>Cevap</th><th>Sayı</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["cevap"]. "</td><td>" . $row["sayi"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Henüz anket sonucu yok.";
}

// Veritabanı bağlantısını kapat
mysqli_close($conn);
?>
