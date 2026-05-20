<?= loadPartial("head"); ?>

<?= loadPartial("navbar"); ?>

<section class="flex justify-center items-center mt-20">
	<div class="bg-white p-8 rounded-lg shadow-md w-full md:w-96 mx-6">
		<h2 class="text-4xl text-center font-bold mb-4">Login</h2>

		<?php if (isset($error) && $error): ?>
			<div class="message bg-red-100 p-3 my-3"><?= htmlspecialchars($error) ?></div>
		<?php endif; ?>

		<form method="POST">
			<div class="mb-4">
				<input type="email" name="email" placeholder="Email"
					class="w-full px-4 py-2 border rounded focus:outline-none" required />
			</div>
			<div class="mb-4">
				<input type="password" name="password" placeholder="Password"
					class="w-full px-4 py-2 border rounded focus:outline-none" required />
			</div>

			<button
                type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 my-3 rounded focus:outline-none"
            >
				Login
			</button>

			<a href="/auth/register" class="block text-center mt-2 text-sm text-gray-600">
				Don't have an account? Register
			</a>
		</form>
	</div>
</section>

<?= loadPartial("footer"); ?>