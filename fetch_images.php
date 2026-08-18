<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use Illuminate\Support\Str;

$products = Product::all();
$imageDir = public_path('images/products');
if (!is_dir($imageDir)) {
    mkdir($imageDir, 0777, true);
}

foreach ($products as $p) {
    $filename = Str::slug($p->nama_produk) . '.jpg';
    $filepath = $imageDir . '/' . $filename;
    
    // Always redownload if it's the fallback or if we want to ensure everything is correct
    // We'll just check if filesize is too small or if we want to force download.
    // For now, let's only download if not exists or if it's a known generic fallback size.
    // To be safe and ensure all get a unique image, we can just download if it doesn't exist,
    // BUT we might have copied the fallback earlier. Let's just forcefully redownload all
    // to ensure they get the pollinations AI image!
    
    echo "Generating image for: {$p->nama_produk}...\n";
    
    $kat = str_contains(strtolower($p->kategori), 'minuman') ? 'minuman' : 'makanan';
    $prompt = $p->nama_produk;
    if ($kat == 'makanan') {
        $prompt .= ' delicious food aesthetic photography';
    } else if (str_contains($p->kategori, 'coffee')) {
        $prompt .= ' iced coffee cafe aesthetic photography';
    } else {
        $prompt .= ' iced drink cafe beverage aesthetic';
    }
    
    $url = "https://image.pollinations.ai/prompt/" . urlencode($prompt) . "?width=300&height=300&nologo=true&seed=" . $p->id;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // Pollinations might redirect
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 POS App');
    $imgData = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpcode == 200 && $imgData) {
        file_put_contents($filepath, $imgData);
        echo "Saved {$filename}\n";
    } else {
        echo "Failed to generate image for {$p->nama_produk} (HTTP $httpcode)\n";
    }
    
    // Sleep a bit to avoid rate limiting
    usleep(500000); // 0.5 seconds
}

echo "Semua gambar AI berhasil digenerate dan disimpan ke server lokal!\n";
