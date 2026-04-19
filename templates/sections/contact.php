<?php
declare(strict_types=1);

use Tubaishat\Support\Icon;

$title_parts = explode($contact['title_highlight'], $contact['title_plain'], 2);
$form = $contact['form'];
$fields = $form['fields'];
?>
<section id="contact" aria-labelledby="contact-heading" class="py-16 sm:py-20 bg-linear-to-b from-primary/50 to-dark/50 relative">
	<div class="pointer-events-none absolute bottom-16 sm:bottom-20 right-20 sm:right-40 w-72 sm:w-96 h-72 sm:h-96 bg-secondary opacity-5 rounded-full blur-3xl -z-10" aria-hidden="true"></div>

	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<header class="text-center mb-12 sm:mb-16">
			<h2 id="contact-heading" class="text-3xl sm:text-4xl md:text-5xl font-bold inline-block"><?= htmlspecialchars($title_parts[0] ?? '', ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?><span class="text-secondary"><?= htmlspecialchars($contact['title_highlight'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></span><?= htmlspecialchars($title_parts[1] ?? '', ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></h2>
			<div class="w-16 sm:w-20 h-1 bg-linear-to-r from-secondary to-accent mx-auto mt-3 sm:mt-4" aria-hidden="true"></div>
			<p class="mx-auto mt-6 max-w-2xl text-base sm:text-lg text-gray-300">
				<?= htmlspecialchars($contact['intro'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>
			</p>
		</header>

		<div class="grid grid-cols-1 lg:grid-cols-[1fr_1.2fr] gap-6 lg:gap-8">
			<article aria-labelledby="contact-channels-heading" class="bg-dark/40 backdrop-blur-xs border border-secondary/20 rounded-xl p-6 sm:p-8 shadow-xl">
				<h3 id="contact-channels-heading" class="text-xl sm:text-2xl font-bold text-secondary mb-6"><?= htmlspecialchars($contact['channels_heading'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></h3>
				<address class="flex flex-col gap-4 not-italic">
					<?php foreach ($contact['contact_items'] as $item):
						$key = $item['key'];
						$display_key = $item['display_key'] ?? $key;
						$value = $contact_info[$key];
						$display = $contact_info[$display_key];
						$is_email = ($key === 'email');
						$is_phone = ($key === 'phone');
						$is_external = in_array($key, ['github', 'linkedin', 'instagram'], true);
						$href = null;
						if ($is_email) {
							$href = 'mailto:' . $value;
						} elseif ($is_phone) {
							$href = 'tel:' . $value;
						} elseif ($is_external) {
							$href = $value;
						}
					?>
						<?php if ($href !== null): ?>
							<a href="<?= htmlspecialchars($href, ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>"
							   class="group flex items-start gap-4 rounded-lg border border-secondary/10 bg-dark/50 hover:bg-dark/70 hover:border-secondary/40 p-4 transition-all duration-300"
							   <?php if ($is_external): ?>target="_blank" rel="noopener noreferrer me"<?php endif; ?>>
								<div class="shrink-0 inline-flex items-center justify-center rounded-xl border border-secondary/30 bg-dark p-3 text-secondary group-hover:bg-secondary/20 transition-all duration-300 group-hover:scale-110">
									<?= Icon::render($item['icon'], 'text-lg') ?>
								</div>
								<div class="min-w-0 flex-1">
									<div class="text-xs text-gray-400"><?= htmlspecialchars($item['type'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></div>
									<div class="text-sm text-light truncate"><?= htmlspecialchars($display, ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></div>
								</div>
							</a>
						<?php else: ?>
							<div class="flex items-start gap-4 rounded-lg border border-secondary/10 bg-dark/50 p-4">
								<div class="shrink-0 inline-flex items-center justify-center rounded-xl border border-secondary/30 bg-dark p-3 text-secondary">
									<?= Icon::render($item['icon'], 'text-lg') ?>
								</div>
								<div class="min-w-0 flex-1">
									<div class="text-xs text-gray-400"><?= htmlspecialchars($item['type'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></div>
									<div class="text-sm text-light"><?= htmlspecialchars($display, ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></div>
								</div>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</address>
			</article>

			<article aria-labelledby="contact-form-heading" class="bg-dark/40 backdrop-blur-xs border border-secondary/20 rounded-xl p-6 sm:p-8 shadow-xl">
				<h3 id="contact-form-heading" class="text-xl sm:text-2xl font-bold text-secondary mb-2"><?= htmlspecialchars($contact['form_heading'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></h3>
				<p class="text-sm text-gray-400 mb-6"><?= htmlspecialchars($contact['form_subtitle'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></p>

				<form id="contactForm" action="/contact" method="post" novalidate autocomplete="on" class="space-y-5">
					<input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf_token, ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>">

					<div class="absolute w-px h-px overflow-hidden" inert>
						<label for="contact-website">Website (leave empty):</label>
						<input type="text" id="contact-website" name="website" tabindex="-1" autocomplete="off">
					</div>

					<div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
						<div>
							<label for="contact-name" class="block text-sm font-medium text-light mb-1.5">
								<?= htmlspecialchars($fields['name']['label'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?> <span class="text-secondary" aria-hidden="true">*</span>
							</label>
							<input type="text"
							       id="contact-name"
							       name="name"
							       required
							       maxlength="<?= (int) $fields['name']['maxlength'] ?>"
							       autocomplete="name"
							       placeholder="<?= htmlspecialchars($fields['name']['placeholder'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>"
							       aria-describedby="contact-name-error"
							       class="w-full rounded-lg border border-secondary/20 bg-dark/50 px-3 py-2.5 text-light placeholder:text-gray-500 focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 focus:border-secondary aria-[invalid=true]:border-red-400">
							<p id="contact-name-error" data-error="name" class="mt-1 text-xs text-red-400" role="alert"></p>
						</div>

						<div>
							<label for="contact-company" class="block text-sm font-medium text-light mb-1.5">
								<?= htmlspecialchars($fields['company']['label'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>
							</label>
							<input type="text"
							       id="contact-company"
							       name="company"
							       maxlength="<?= (int) $fields['company']['maxlength'] ?>"
							       autocomplete="organization"
							       placeholder="<?= htmlspecialchars($fields['company']['placeholder'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>"
							       aria-describedby="contact-company-error"
							       class="w-full rounded-lg border border-secondary/20 bg-dark/50 px-3 py-2.5 text-light placeholder:text-gray-500 focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 focus:border-secondary aria-[invalid=true]:border-red-400">
							<p id="contact-company-error" data-error="company" class="mt-1 text-xs text-red-400" role="alert"></p>
						</div>
					</div>

					<div>
						<label for="contact-email" class="block text-sm font-medium text-light mb-1.5">
							<?= htmlspecialchars($fields['email']['label'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?> <span class="text-secondary" aria-hidden="true">*</span>
						</label>
						<input type="email"
						       id="contact-email"
						       name="email"
						       required
						       maxlength="<?= (int) $fields['email']['maxlength'] ?>"
						       autocomplete="email"
						       inputmode="email"
						       placeholder="<?= htmlspecialchars($fields['email']['placeholder'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>"
						       aria-describedby="contact-email-error"
						       class="w-full rounded-lg border border-secondary/20 bg-dark/50 px-3 py-2.5 text-light placeholder:text-gray-500 focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 focus:border-secondary aria-[invalid=true]:border-red-400">
						<p id="contact-email-error" data-error="email" class="mt-1 text-xs text-red-400" role="alert"></p>
					</div>

					<div>
						<label for="contact-inquiry-type" class="block text-sm font-medium text-light mb-1.5">
							Inquiry type <span class="text-secondary" aria-hidden="true">*</span>
						</label>
						<select id="contact-inquiry-type"
						        name="inquiry_type"
						        required
						        aria-describedby="contact-inquiry-type-error"
						        class="w-full rounded-lg border border-secondary/20 bg-dark/50 px-3 py-2.5 text-light focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 focus:border-secondary aria-[invalid=true]:border-red-400">
							<option value="">Select one</option>
							<?php foreach ($form['inquiry_types'] as $value => $label): ?>
								<option value="<?= htmlspecialchars($value, ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>"><?= htmlspecialchars($label, ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></option>
							<?php endforeach; ?>
						</select>
						<p id="contact-inquiry-type-error" data-error="inquiry_type" class="mt-1 text-xs text-red-400" role="alert"></p>
					</div>

					<div>
						<label for="contact-subject" class="block text-sm font-medium text-light mb-1.5">
							<?= htmlspecialchars($fields['subject']['label'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?> <span class="text-secondary" aria-hidden="true">*</span>
						</label>
						<input type="text"
						       id="contact-subject"
						       name="subject"
						       required
						       minlength="<?= (int) $fields['subject']['minlength'] ?>"
						       maxlength="<?= (int) $fields['subject']['maxlength'] ?>"
						       placeholder="<?= htmlspecialchars($fields['subject']['placeholder'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>"
						       aria-describedby="contact-subject-error"
						       class="w-full rounded-lg border border-secondary/20 bg-dark/50 px-3 py-2.5 text-light placeholder:text-gray-500 focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 focus:border-secondary aria-[invalid=true]:border-red-400">
						<p id="contact-subject-error" data-error="subject" class="mt-1 text-xs text-red-400" role="alert"></p>
					</div>

					<div>
						<label for="contact-message" class="block text-sm font-medium text-light mb-1.5">
							<?= htmlspecialchars($fields['message']['label'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?> <span class="text-secondary" aria-hidden="true">*</span>
						</label>
						<textarea id="contact-message"
						          name="message"
						          required
						          minlength="<?= (int) $fields['message']['minlength'] ?>"
						          maxlength="<?= (int) $fields['message']['maxlength'] ?>"
						          rows="6"
						          placeholder="<?= htmlspecialchars($fields['message']['placeholder'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>"
						          aria-describedby="contact-message-error"
						          class="w-full rounded-lg border border-secondary/20 bg-dark/50 px-3 py-2.5 text-light placeholder:text-gray-500 focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 focus:border-secondary aria-[invalid=true]:border-red-400 resize-y"></textarea>
						<p id="contact-message-error" data-error="message" class="mt-1 text-xs text-red-400" role="alert"></p>
					</div>

					<div class="flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between pt-2">
						<button type="submit"
						        class="inline-flex items-center justify-center gap-2 bg-linear-to-r from-secondary to-accent hover:from-accent hover:to-secondary text-primary font-semibold py-3 px-6 rounded-lg shadow-lg shadow-secondary/20 transition-transform duration-300 hover:scale-105 focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 disabled:opacity-60 disabled:cursor-not-allowed disabled:hover:scale-100">
							<?= Icon::render('envelope') ?>
							<span><?= htmlspecialchars($form['submit_label'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></span>
						</button>
						<p id="contactStatus" aria-live="polite" class="text-sm text-gray-300 data-[status=error]:text-red-400 data-[status=success]:text-green-400"></p>
					</div>
				</form>
			</article>
		</div>
	</div>
</section>
