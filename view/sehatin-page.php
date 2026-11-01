<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Rekomendasi menu sehat Sehatin dengan informasi bahan, kalori, dan waktu memasak.">
    <title><?= htmlspecialchars($profile['pageTitle'], ENT_QUOTES, 'UTF-8') ?> &mdash; <?= htmlspecialchars($profile['name'], ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="icon" type="image/svg+xml" href="assets/Sehatin.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="font-sans bg-slate-50 text-slate-800 leading-relaxed text-[15px] antialiased">
    <header class="bg-white border-b border-slate-200"><div class="max-w-[1200px] mx-auto px-6 py-4 flex items-center justify-between">
        <a href="index.html#hero" class="flex items-center gap-3"><img src="assets/Sehatin.svg" alt="" class="w-10 h-10"><span class="text-xl font-bold tracking-tight text-slate-900"><?= htmlspecialchars($profile['name'], ENT_QUOTES, 'UTF-8') ?></span></a>
        <a href="index.html#agenda" class="text-sm font-semibold text-[#007789] hover:text-[#005a69]">Halaman utama</a>
    </div></header>
    <main><section class="py-16 sm:py-20 bg-white"><div class="max-w-[1200px] mx-auto px-6">
        <div class="text-center max-w-[700px] mx-auto mb-12 space-y-3"><span class="inline-flex items-center gap-1.5 text-xs font-bold px-3.5 py-1.5 rounded-full bg-teal-100 text-[#007789] uppercase tracking-wider"><?= htmlspecialchars($profile['label'], ENT_QUOTES, 'UTF-8') ?></span><h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight"><?= htmlspecialchars($profile['pageTitle'], ENT_QUOTES, 'UTF-8') ?></h1><p class="text-base text-slate-500 leading-relaxed"><?= htmlspecialchars($profile['description'], ENT_QUOTES, 'UTF-8') ?></p></div>
        <?php if ($programError !== ''): ?><p class="rounded-2xl border border-red-200 bg-red-50 p-6 text-center text-sm text-red-700" role="alert"><?= htmlspecialchars($programError, ENT_QUOTES, 'UTF-8') ?></p>
        <?php elseif (count($programs) === 0): ?><p class="rounded-2xl border border-slate-200 bg-slate-50 p-6 text-center text-sm text-slate-600" role="status">Belum ada menu untuk ditampilkan.</p>
        <?php else: ?><p class="mb-6 text-center text-sm text-emerald-700" role="status">Berhasil memuat <?= count($programs) ?> menu dari data Sehatin.</p><div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($programs as $index => $program): ?>
                <?php
                $name = htmlspecialchars((string) ($program['name'] ?? 'Menu Sehat'), ENT_QUOTES, 'UTF-8');
                $image = htmlspecialchars((string) ($program['image'] ?? ''), ENT_QUOTES, 'UTF-8');
                $cuisine = htmlspecialchars((string) ($program['cuisine'] ?? 'Menu'), ENT_QUOTES, 'UTF-8');
                $difficulty = (string) ($program['difficulty'] ?? '');
                $difficultyLabel = $difficulty === 'Easy' ? 'Mudah' : ($difficulty === 'Medium' ? 'Menengah' : 'Belum ditentukan');
                $badgeClass = $difficulty === 'Easy' ? 'bg-emerald-100 text-emerald-800' : ($difficulty === 'Medium' ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-700');
                $mealTypes = isset($program['mealType']) && is_array($program['mealType']) ? htmlspecialchars(implode(', ', $program['mealType']), ENT_QUOTES, 'UTF-8') : 'Menu sehat';
                $ingredients = isset($program['ingredients']) && is_array($program['ingredients']) ? array_slice($program['ingredients'], 0, 4) : [];
                $safeIngredients = array_map(static fn ($ingredient) => htmlspecialchars((string) $ingredient, ENT_QUOTES, 'UTF-8'), $ingredients);
                $totalTime = (int) ($program['prepTimeMinutes'] ?? 0) + (int) ($program['cookTimeMinutes'] ?? 0);
                ?>
                <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition-shadow hover:shadow-md"><?php if ($image !== ''): ?><img src="<?= $image ?>" alt="Foto <?= $name ?>" class="h-48 w-full object-cover" loading="lazy"><?php endif; ?><div class="space-y-3 p-6"><div class="flex items-center justify-between gap-3"><span class="text-xs font-bold uppercase tracking-wide text-[#007789]"><?= $cuisine ?> &bull; <?= $mealTypes ?></span><span class="shrink-0 rounded-full px-3 py-1 text-xs font-semibold <?= $badgeClass ?>"><?= htmlspecialchars($difficultyLabel, ENT_QUOTES, 'UTF-8') ?></span></div><h2 class="text-base font-bold text-slate-900"><?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?>. <?= $name ?></h2><p class="text-xs text-slate-500">Kalori: <?= (int) ($program['caloriesPerServing'] ?? 0) ?> kcal / sajian</p><p class="text-xs text-slate-500">Waktu memasak: <?= $totalTime ?> menit</p><p class="text-xs text-slate-500">Bahan: <?= implode(', ', $safeIngredients) ?></p></div></article>
            <?php endforeach; ?></div><?php endif; ?>
        <p class="mt-8 text-center text-xs text-slate-400">Sumber data: data program lokal Sehatin</p>
    </div></section></main>
    <footer class="bg-slate-900 text-slate-400 py-8"><div class="max-w-[1200px] mx-auto px-6 text-center text-xs">&copy; <?= date('Y') ?> <?= htmlspecialchars($profile['name'], ENT_QUOTES, 'UTF-8') ?></div></footer>
</body>
</html>
