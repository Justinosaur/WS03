<?= loadPartial("head"); ?>

<?= loadPartial("navbar"); ?>

<section class="flex justify-center items-center mt-20">
	<div class="bg-white p-8 rounded-lg shadow-md w-full md:w-96 mx-6">
		<h2 class="text-4xl text-center font-bold mb-4">Create Account</h2>

		<?php if (isset($errors) && count($errors)): ?>
			<div class="message bg-red-100 p-3 my-3">
				<ul class="list-disc list-inside">
					<?php foreach ($errors as $err): ?>
						<li><?= htmlspecialchars($err) ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>

		<form method="POST">
			<div class="mb-4">
				<input type="text" name="name" placeholder="Full Name" value="<?= htmlspecialchars($old['name'] ?? '') ?>"
					class="w-full px-4 py-2 border rounded focus:outline-none" required />
			</div>
			<div class="mb-4">
				<input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($old['email'] ?? '') ?>"
					class="w-full px-4 py-2 border rounded focus:outline-none" required />
			</div>
			<div class="mb-4">
				<input type="password" name="password" placeholder="Password"
					class="w-full px-4 py-2 border rounded focus:outline-none" required />
			</div>
			<div class="mb-4">
				<input type="password" name="password_confirm" placeholder="Confirm Password"
					class="w-full px-4 py-2 border rounded focus:outline-none" required />
			</div>

			<button class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none">
				Register
			</button>

			<a href="/auth/login" class="block text-center mt-2 text-sm text-gray-600">
				Already have an account? Login
			</a>
		</form>
	</div>
</section>

<?= loadPartial("footer"); ?>