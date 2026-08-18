<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use Illuminate\Support\Str;

$products = Product::all();
$imageDir = public_path('images/products');

foreach ($products as $p) {
    $filename = Str::slug($p->nama_produk) . '.jpg';
    $filepath = $imageDir . '/' . $filename;
    
    // Check if the current file is a fallback (we know fallback sizes: 808407, 836904, 698920)
    // or if it just failed before. We'll force update ALL of them to be sure.
    echo "Fetching Bing image for: {$p->nama_produk}...\n";
    
    $query = $p->nama_produk;
    $query = str_ireplace(['hot', 'ice', 'barat', 'add'], '', $query);
    $query = trim($query);
    if (str_contains(strtolower($p->kategori), 'makanan')) {
        $query .= ' food';
    } else {
        $query .= ' drink';
    }
    
    $url = "https://tse1.mm.bing.net/th?q=" . urlencode($query . " aesthetic high quality") . "&w=400&h=400&c=7&rs=1&p=0";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
    $imgData = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpcode == 200 && $imgData && strlen($imgData) > 1000) {
        file_put_contents($filepath, $imgData);
        echo "Saved {$filename} (Size: " . strlen($imgData) . ")\n";
    } else {
        echo "Failed to get Bing image for {$p->nama_produk}\n";
    }
    
    usleep(200000); // 0.2s delay
}
echo "Done fetching Bing images!\n";
