<div class="rounded-lg shadow-md bg-white h-full">
    <div class="flex flex-col p-4 h-full">
        <h2 class="text-xl font-semibold"><?= htmlspecialchars($job->title) ?></h2>
        <p class="text-gray-700 text-lg mt-2"><?= nl2br(htmlspecialchars($job->description)) ?></p>
        <ul class="my-4 bg-gray-100 p-4 rounded">
            <li class="mb-2"><strong>Salary:</strong> $<?= htmlspecialchars(number_format((float)$job->salary, 2)) ?></li>
            <li class="mb-2"><strong>Location:</strong> <?= htmlspecialchars($job->city ?: $job->state ?: $job->address) ?></li>
            <li class="mb-2"><strong>Tags:</strong> <?= htmlspecialchars($job->tags) ?></li>
        </ul>
        <div class="mt-auto flex justify-end">
            <a href="/listings/<?= htmlspecialchars($job->id) ?>"
                class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
                Details
            </a>
        </div>
    </div>
</div>
