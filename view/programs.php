<?php
$escape = static fn ($value): string => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
$editing = $editing ?? null;
$message = $_SESSION['program_message'] ?? '';
unset($_SESSION['program_message']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Sehatin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #f1f5f9; color: #172033; font: 15px Poppins, sans-serif; }
        main { max-width: 1050px; margin: 40px auto; padding: 0 20px; }
        h1 { margin-bottom: 4px; } .muted { color: #64748b; margin-top: 0; }
        .panel { background: white; border: 1px solid #e2e8f0; border-radius: 14px; padding: 22px; margin: 20px 0; box-shadow: 0 4px 16px #0f172a0a; }
        label { display: block; font-weight: 600; margin: 12px 0 5px; }
        input, textarea { width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font: inherit; }
        textarea { min-height: 90px; resize: vertical; }
        button, .button { display: inline-block; border: 0; border-radius: 8px; padding: 9px 14px; color: white; background: #087e8b; font: inherit; font-weight: 600; text-decoration: none; cursor: pointer; }
        .secondary { background: #64748b; } .danger { background: #dc3545; } .actions { display: flex; gap: 8px; align-items: center; }
        .notice { padding: 12px 14px; border-radius: 8px; background: #dcfce7; color: #166534; }
        .error { padding: 12px 14px; border-radius: 8px; background: #fee2e2; color: #991b1b; }
        table { width: 100%; border-collapse: collapse; } th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e2e8f0; vertical-align: top; } th { background: #f8fafc; }
        @media (max-width: 650px) { .table-wrap { overflow-x: auto; } td { min-width: 130px; } }
    </style>
</head>
<body>
<main>
    <a class="button secondary" href="index.php">Kembali ke Sehatin</a>
    <h1>Program Sehatin</h1>
    <p class="muted">Kelola program yang tersimpan di database.</p>

    <?php if ($message !== '') { ?><p class="notice" role="status"><?= $escape($message) ?></p><?php } ?>
    <?php if (! empty($programError)) { ?><p class="error" role="alert"><?= $escape($programError) ?></p><?php } ?>

    <section class="panel" id="form">
        <h2><?= $editing ? 'Edit Program' : 'Tambah Program' ?></h2>
        <form method="post" action="index.php?action=programs">
            <input type="hidden" name="csrf_token" value="<?= $escape($_SESSION['csrf_token']) ?>">
            <input type="hidden" name="operation" value="<?= $editing ? 'update' : 'create' ?>">
            <?php if ($editing) { ?><input type="hidden" name="id" value="<?= (int) $editing['id'] ?>"><?php } ?>
            <label for="nama">Nama Program</label>
            <input id="nama" name="nama" maxlength="255" required value="<?= $escape($editing['nama'] ?? '') ?>">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" required><?= $escape($editing['deskripsi'] ?? '') ?></textarea>
            <p><button type="submit"><?= $editing ? 'Simpan Perubahan' : 'Simpan Program' ?></button>
                <?php if ($editing) { ?> <a class="button secondary" href="index.php?action=programs">Batal</a><?php } ?></p>
        </form>
    </section>

    <section class="panel">
        <h2>Daftar Program</h2>
        <?php if ($programs === []) { ?><p class="muted">Belum ada program. Tambahkan program melalui formulir di atas.</p>
        <?php } else { ?><div class="table-wrap"><table>
            <thead><tr><th>No</th><th>Nama Program</th><th>Deskripsi</th><th>Aksi</th></tr></thead>
            <tbody><?php foreach ($programs as $index => $program) { ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $escape($program['nama']) ?></td>
                    <td><?= nl2br($escape($program['deskripsi'])) ?></td>
                    <td><div class="actions">
                        <a class="button" href="index.php?action=programs&amp;edit=<?= (int) $program['id'] ?>#form">Edit</a>
                        <form method="post" action="index.php?action=programs" onsubmit="return confirm('Hapus program ini?')">
                            <input type="hidden" name="csrf_token" value="<?= $escape($_SESSION['csrf_token']) ?>">
                            <input type="hidden" name="operation" value="delete">
                            <input type="hidden" name="id" value="<?= (int) $program['id'] ?>">
                            <button class="danger" type="submit">Hapus</button>
                        </form>
                    </div></td>
                </tr>
            <?php } ?></tbody>
        </table></div><?php } ?>
    </section>
</main>
</body>
</html>
