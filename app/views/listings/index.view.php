<?= loadPartial("head"); ?>

<?= loadPartial("navbar"); ?>

<!-- Job Listings -->
<section>
    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">Jobs</div>

        <?php
            $kw = $keywords ?? ($_GET['keywords'] ?? '');
            $loc = $location ?? ($_GET['location'] ?? '');
        ?>

        <form method="GET" action="/listings" class="mb-4 flex flex-col md:flex-row gap-2 items-center justify-center">
            <input type="text" name="keywords" placeholder="Keywords" value="<?= htmlspecialchars($kw) ?>"
                class="px-4 py-2 border rounded w-full md:w-1/3" />
            <input type="text" name="location" placeholder="Location" value="<?= htmlspecialchars($loc) ?>"
                class="px-4 py-2 border rounded w-full md:w-1/3" />
            <div class="flex gap-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
                <a href="/listings" class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded">Clear</a>
            </div>
        </form>
        <?php if (empty($listings)): ?>
            <div class="text-center p-6">No job listings found.</div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 items-stretch">
                <?php foreach ($listings as $job): ?>
                    <?php loadPartial('job-card', ['job' => $job]); ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
</section>

<?= loadPartial("footer"); ?>