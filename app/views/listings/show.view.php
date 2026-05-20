<?= loadPartial("head"); ?>
<?= loadPartial("navbar"); ?>

<section class="container mx-auto p-4 mt-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-3xl font-bold mb-4"><?= htmlspecialchars($listing->title) ?></h1>
        <div class="mb-4 text-gray-700">
            <strong>Company:</strong> <?= htmlspecialchars($listing->company) ?>
        </div>
        <div class="mb-4">
            <strong>Location:</strong> <?= htmlspecialchars($listing->city ?: $listing->state ?: $listing->address) ?>
        </div>
        <div class="mb-4">
            <strong>Salary:</strong> $<?= htmlspecialchars(number_format((float)$listing->salary, 2)) ?>
        </div>
        <div class="mb-4">
            <strong>Requirements:</strong>
            <div class="mt-2 text-gray-800"><?= nl2br(htmlspecialchars($listing->requirements)) ?></div>
        </div>
        <div class="mb-4">
            <strong>Benefits:</strong>
            <div class="mt-2 text-gray-800"><?= nl2br(htmlspecialchars($listing->benefits)) ?></div>
        </div>
        <div class="mb-4">
            <strong>How to apply:</strong>
            <div class="mt-2 text-gray-800">Email: <?= htmlspecialchars($listing->email) ?> | Phone: <?= htmlspecialchars($listing->phone) ?></div>
        </div>
        <a href="/listings" class="inline-block mt-4 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded">Back to listings</a>
    </div>
</section>

<?= loadPartial("footer"); ?>