<?php
/**
 * Diagnostic Tool - Cek & Fix masalah gambar/storage di server
 * Akses: https://sebonglagoi.com/storage_check.php
 */
error_reporting(E_ALL);
ini_set('display_errors', 0);

$basePath = realpath(__DIR__ . '/..');
$publicPath = __DIR__;
$storagePath = $basePath . '/storage/app/public';
$symlinkPath = $publicPath . '/storage';

$results = [];

// 1. Cek symlink
$symlinkExists = is_link($symlinkPath);
$symlinkTarget = $symlinkExists ? readlink($symlinkPath) : null;
$symlinkWorks  = $symlinkExists && is_dir($symlinkPath);

// 2. Cek permission storage
$storageWritable = is_writable($storagePath);
$storageExists   = is_dir($storagePath);

// 3. Cek upload_max_filesize
$uploadMax  = ini_get('upload_max_filesize');
$postMax    = ini_get('post_max_size');
$phpVersion = phpversion();

// 4. Cek folder upload tersedia
$uploadFolders = ['produk', 'galeri', 'wisata', 'artikel', 'slider', 'umkm', 'dokumen'];
$folderStatus  = [];
foreach ($uploadFolders as $folder) {
    $path = $storagePath . '/' . $folder;
    $folderStatus[$folder] = [
        'exists'   => is_dir($path),
        'writable' => is_dir($path) && is_writable($path),
    ];
    if (!is_dir($path)) {
        @mkdir($path, 0755, true);
        $folderStatus[$folder]['created'] = is_dir($path);
    }
}

// 5. Coba tulis file test
$testFile = $storagePath . '/test_write_' . time() . '.txt';
$writeOk  = false;
if ($storageExists) {
    $writeOk = @file_put_contents($testFile, 'test') !== false;
    if ($writeOk) @unlink($testFile);
}

// 6. Buat symlink otomatis kalau belum ada
$symlinkFixed = false;
if (!$symlinkWorks && !$symlinkExists) {
    $symlinkFixed = @symlink($storagePath, $symlinkPath);
}

// =========== OUTPUT ===========
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Storage Diagnostic - sebonglagoi.com</title>
    <style>
        body { font-family: monospace; padding: 20px; background: #0f172a; color: #e2e8f0; }
        h1 { color: #38bdf8; border-bottom: 1px solid #334155; padding-bottom: 10px; }
        h2 { color: #94a3b8; font-size: 14px; margin-top: 20px; text-transform: uppercase; letter-spacing: 1px; }
        .ok   { color: #4ade80; font-weight: bold; }
        .fail { color: #f87171; font-weight: bold; }
        .warn { color: #fbbf24; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        td, th { padding: 8px 12px; border: 1px solid #334155; text-align: left; }
        th { background: #1e293b; color: #94a3b8; }
        tr:hover { background: #1e293b; }
        .box { background: #1e293b; border: 1px solid #334155; border-radius: 8px; padding: 16px; margin: 10px 0; }
        .cmd { background: #0f172a; border: 1px solid #475569; padding: 8px 12px; border-radius: 4px; color: #7dd3fc; margin: 4px 0; }
        .big { font-size: 24px; }
    </style>
</head>
<body>
<h1>🔍 Storage Diagnostic Tool — sebonglagoi.com</h1>

<div class="box">
    <h2>1. PHP Environment</h2>
    <table>
        <tr><th>Setting</th><th>Value</th><th>Status</th></tr>
        <tr>
            <td>PHP Version</td>
            <td><?= $phpVersion ?></td>
            <td class="ok">✅ OK</td>
        </tr>
        <tr>
            <td>upload_max_filesize</td>
            <td><?= $uploadMax ?></td>
            <td class="<?= intval($uploadMax) >= 2 ? 'ok' : 'fail' ?>"><?= intval($uploadMax) >= 2 ? '✅ OK' : '❌ Terlalu kecil (min 2M)' ?></td>
        </tr>
        <tr>
            <td>post_max_size</td>
            <td><?= $postMax ?></td>
            <td class="<?= intval($postMax) >= 8 ? 'ok' : 'warn' ?>"><?= intval($postMax) >= 8 ? '✅ OK' : '⚠️ Perlu dinaikkan' ?></td>
        </tr>
    </table>
</div>

<div class="box">
    <h2>2. Storage Symlink (public/storage → storage/app/public)</h2>
    <table>
        <tr><th>Check</th><th>Result</th></tr>
        <tr>
            <td>Symlink path</td>
            <td><?= $symlinkPath ?></td>
        </tr>
        <tr>
            <td>Symlink exists?</td>
            <td class="<?= $symlinkExists ? 'ok' : 'fail' ?>"><?= $symlinkExists ? '✅ Ya' : '❌ TIDAK ADA' ?></td>
        </tr>
        <tr>
            <td>Symlink berfungsi (accessible)?</td>
            <td class="<?= $symlinkWorks ? 'ok' : 'fail' ?>"><?= $symlinkWorks ? '✅ Ya' : '❌ TIDAK BERFUNGSI' ?></td>
        </tr>
        <?php if ($symlinkFixed): ?>
        <tr>
            <td>Auto-fix symlink</td>
            <td class="ok">✅ Berhasil dibuat otomatis!</td>
        </tr>
        <?php elseif (!$symlinkWorks && $symlinkExists): ?>
        <tr>
            <td>Auto-fix</td>
            <td class="fail">❌ Symlink rusak, perlu manual fix via SSH</td>
        </tr>
        <?php endif; ?>
    </table>
    
    <?php if (!$symlinkWorks && !$symlinkFixed): ?>
    <div style="margin-top:10px; padding:10px; background:#450a0a; border-radius:6px;">
        <span class="fail">❌ MASALAH UTAMA DITEMUKAN: Symlink tidak ada/rusak!</span><br>
        Jalankan perintah ini via SSH atau Terminal cPanel:
        <div class="cmd">php artisan storage:link --force</div>
    </div>
    <?php endif; ?>
</div>

<div class="box">
    <h2>3. Storage Directory & Write Permission</h2>
    <table>
        <tr><th>Check</th><th>Result</th></tr>
        <tr>
            <td>Path</td>
            <td><?= $storagePath ?></td>
        </tr>
        <tr>
            <td>Directory ada?</td>
            <td class="<?= $storageExists ? 'ok' : 'fail' ?>"><?= $storageExists ? '✅ Ya' : '❌ Tidak ada!' ?></td>
        </tr>
        <tr>
            <td>Bisa ditulis (writable)?</td>
            <td class="<?= $storageWritable ? 'ok' : 'fail' ?>"><?= $storageWritable ? '✅ Ya' : '❌ TIDAK — Ini penyebab gambar tidak tersimpan!' ?></td>
        </tr>
        <tr>
            <td>Test tulis file?</td>
            <td class="<?= $writeOk ? 'ok' : 'fail' ?>"><?= $writeOk ? '✅ Berhasil' : '❌ GAGAL — Permission denied!' ?></td>
        </tr>
    </table>
    
    <?php if (!$storageWritable): ?>
    <div style="margin-top:10px; padding:10px; background:#450a0a; border-radius:6px;">
        <span class="fail">❌ Storage tidak bisa ditulis! Gambar tidak akan tersimpan.</span><br>
        Fix di cPanel File Manager: Klik kanan folder <b>storage</b> → <b>Change Permissions</b> → set <b>755</b> atau <b>775</b>
    </div>
    <?php endif; ?>
</div>

<div class="box">
    <h2>4. Upload Folders</h2>
    <table>
        <tr><th>Folder</th><th>Ada?</th><th>Writable?</th></tr>
        <?php foreach ($folderStatus as $folder => $status): ?>
        <tr>
            <td>storage/app/public/<?= $folder ?></td>
            <td class="<?= $status['exists'] ? 'ok' : 'warn' ?>"><?= $status['exists'] ? '✅' : (isset($status['created']) && $status['created'] ? '✅ Dibuat otomatis' : '❌') ?></td>
            <td class="<?= $status['writable'] ? 'ok' : 'fail' ?>"><?= $status['writable'] ? '✅' : '❌' ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<div class="box">
    <h2>5. Kesimpulan & Solusi</h2>
    <?php
    $problems = 0;
    if (!$symlinkWorks && !$symlinkFixed) { $problems++; echo '<p class="fail">❌ Symlink <code>public/storage</code> tidak ada. Jalankan: <code>php artisan storage:link --force</code></p>'; }
    if (!$storageWritable) { $problems++; echo '<p class="fail">❌ Permission storage tidak writable. Fix di cPanel: chmod 755 pada folder storage/</p>'; }
    if ($problems === 0): ?>
        <p class="ok big">🎉 Semua OK! Storage berfungsi dengan benar.</p>
        <p>Jika gambar masih tidak muncul, coba hapus cache:</p>
        <div class="cmd">https://sebonglagoi.com/deploy.php?action=cache</div>
    <?php else: ?>
        <p class="warn">⚠️ Ditemukan <?= $problems ?> masalah. Ikuti solusi di atas.</p>
    <?php endif; ?>
</div>

</body>
</html>
