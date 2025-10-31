<section id="home" class="min-h-screen relative overflow-hidden flex items-center pt-20 sm:pt-24 md:pt-32" role="main">
	<div class="absolute top-16 sm:top-20 right-1/6 sm:right-1/4 w-60 sm:w-80 lg:w-96 h-60 sm:h-80 lg:h-96 bg-secondary opacity-10 rounded-full blur-3xl -z-10 animate-pulse-slow" aria-hidden="true"></div>
	<div class="absolute bottom-16 sm:bottom-20 left-1/6 sm:left-1/4 w-48 sm:w-72 lg:w-80 h-48 sm:h-72 lg:h-80 bg-accent opacity-5 rounded-full blur-3xl -z-10 animate-pulse-slow" style="animation-delay: 0.5s;" aria-hidden="true"></div>
	<div x-data="{ 
		codes: Array(8).fill('').map((_, i) => ({ 
			code: ['<html>', 'function()', 'const x =', 'if(true)', 'return {}', 'async fn'][i % 6], 
			delay: i * 0.5, 
			left: (i * 12 + 5) + '%' 
		})) 
	}" class="absolute inset-0 overflow-hidden -z-10" aria-hidden="true">
		<template x-for="item in codes" :key="item.left">
			<div class="absolute opacity-5 text-secondary font-mono text-xs"
				:style="`left: ${item.left}; animation: codeRain 10s infinite linear; animation-delay: ${item.delay}s;`"
				x-text="item.code">
			</div>
		</template>
	</div>
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
			<div class="text-center lg:text-left">
				<div class="inline-block mb-4 sm:mb-6">
					<span class="bg-gradient-to-r from-green-500/20 to-green-400/20 text-green-400 border border-green-400/30 rounded-full py-1.5 sm:py-2 px-4 sm:px-6 text-xs sm:text-sm font-medium animate-pulse-slow backdrop-blur-sm">
						<i class="fas fa-briefcase mr-1 sm:mr-2 text-xs" aria-hidden="true"></i>Currently Employed
					</span>
				</div>
				<h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-6 sm:mb-8 bg-gradient-to-r from-white via-light to-gray-300 bg-clip-text text-transparent leading-[1.5] whitespace-nowrap pb-2">
					Rayyan Tubaishat
				</h1>
				<div class="mb-6 sm:mb-8">
					<p class="text-lg sm:text-xl md:text-2xl text-gray-300 mb-1 sm:mb-2">
						<span x-data="{}" 
							x-init="() => {
								let text = 'Technical Project Manager';
								let chars = text.split('');
								let delay = 0;
								chars.forEach((char, i) => {
									setTimeout(() => {
										$el.innerHTML += char;
									}, delay);
									delay += 50;
								});
							}"
							class="inline-block" aria-live="polite"></span>
					</p>
				</div>
				<div x-data="{ 
					currentLine: 0,
					lines: [
						'<span class=\'text-secondary\'>const</span> <span class=\'text-green-400\'>developer</span> = {',
						'&nbsp;&nbsp;&nbsp;&nbsp;<span class=\'text-purple-400\'>name</span>: <span class=\'text-yellow-300\'>\'Rayyan Tubaishat\'</span>,',
						'&nbsp;&nbsp;&nbsp;&nbsp;<span class=\'text-purple-400\'>skills</span>: [<span class=\'text-yellow-300\'>\'PHP\'</span>, <span class=\'text-yellow-300\'>\'JavaScript\'</span>, <span class=\'text-yellow-300\'>\'SQL\'</span>],',
						'&nbsp;&nbsp;&nbsp;&nbsp;<span class=\'text-purple-400\'>passion</span>: <span class=\'text-yellow-300\'>\'Building awesome solutions\'</span>',
						'};'
					],
					typedLines: [],
					isTyping: false,
					init() {
						this.typedLines = this.lines.map(() => '');
						setTimeout(() => {
							this.typeNextLine();
						}, 1500);
					},
					typeNextLine() {
						if (this.currentLine >= this.lines.length) return;
						this.isTyping = true;
						const line = this.lines[this.currentLine];
						let charIndex = 0;
						const typeChar = () => {
							if (charIndex < line.length) {
								this.typedLines[this.currentLine] += line[charIndex];
								charIndex++;
								setTimeout(typeChar, 15);
							} else {
								this.isTyping = false;
								this.currentLine++;
								setTimeout(() => {
									this.typeNextLine();
								}, 300);
							}
						};
						typeChar();
					}
				}" class="mb-8 sm:mb-10 lg:mb-12 hidden lg:block">
					<div class="bg-dark/80 backdrop-blur-md border border-secondary/20 rounded-lg p-4 sm:p-6 max-w-full lg:max-w-md font-mono text-xs sm:text-sm overflow-x-auto">
						<div class="flex items-center mb-3 sm:mb-4">
							<div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-red-500 mr-1.5 sm:mr-2" aria-hidden="true"></div>
							<div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-yellow-500 mr-1.5 sm:mr-2" aria-hidden="true"></div>
							<div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-green-500" aria-hidden="true"></div>
							<span class="ml-3 sm:ml-4 text-secondary opacity-70">developer.js</span>
						</div>
						<div class="text-gray-300 min-h-[100px]">
							<template x-for="(line, index) in typedLines" :key="index">
								<div x-show="index <= currentLine">
									<span x-html="line"></span>
									<span x-show="index === currentLine && isTyping" class="animate-pulse">|</span>
								</div>
							</template>
						</div>
					</div>
				</div>
				<div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center lg:justify-start">
					<a href="#contact" 
					   class="group bg-gradient-to-r from-secondary to-accent hover:from-accent hover:to-secondary text-primary font-semibold py-3 sm:py-4 px-6 sm:px-8 rounded-lg transition-all duration-300 shadow-lg shadow-secondary/20 inline-flex items-center justify-center transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-secondary/50"
					   aria-label="Contact me via email">
						<i class="fas fa-envelope mr-2 group-hover:animate-bounce" aria-hidden="true"></i> 
						Contact Me
					</a>
					<a href="<?= CV_PATH ?>" 
					   download 
					   class="bg-transparent hover:bg-gradient-to-r from-secondary/10 to-accent/10 text-secondary border border-secondary/40 hover:border-secondary font-semibold py-3 sm:py-4 px-6 sm:px-8 rounded-lg transition-all duration-300 inline-flex items-center justify-center backdrop-blur-sm transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-secondary/50"
					   aria-label="Download my CV">
						<i class="fas fa-download mr-2" aria-hidden="true"></i> 
						Download CV
					</a>
				</div>
			</div>
			<div class="hidden lg:block">
				<div class="relative h-80 lg:h-96 w-full">
					<div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
						<div class="w-20 lg:w-24 h-20 lg:h-24 bg-gradient-to-br from-secondary to-accent rounded-full flex items-center justify-center shadow-lg shadow-secondary/30 animate-pulse-slow" aria-hidden="true">
							<i class="fas fa-code text-xl lg:text-2xl text-primary" aria-hidden="true"></i>
						</div>
					</div>
					<div x-data="{
						techs: [
							{ name: 'PHP', icon: 'fab fa-php', color: 'text-blue-400', angle: 0 },
							{ name: 'JS', icon: 'fab fa-js', color: 'text-yellow-400', angle: 72 },
							{ name: 'HTML', icon: 'fab fa-html5', color: 'text-orange-500', angle: 144 },
							{ name: 'CSS', icon: 'fab fa-css3-alt', color: 'text-blue-500', angle: 216 },
							{ name: 'SQL', icon: 'fas fa-database', color: 'text-purple-400', angle: 288 }
						]
					}" x-init="() => {
						setInterval(() => {
							techs.forEach(tech => {
								tech.angle += 0.5;
							});
						}, 50);
					}" class="relative w-full h-full" aria-hidden="true">
						<template x-for="tech in techs" :key="tech.name">
							<div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
								:style="`transform: translate(-50%, -50%) rotate(${tech.angle}deg) translateY(-100px) rotate(-${tech.angle}deg);`">
								<div class="flex flex-col items-center space-y-1 sm:space-y-2 p-3 sm:p-4 bg-dark/80 backdrop-blur-md rounded-lg border border-secondary/20 hover:border-secondary/40 transition-all duration-300 transform hover:scale-110" :aria-label="tech.name">
									<i :class="tech.icon + ' text-lg lg:text-xl ' + tech.color"></i>
									<span class="text-xs text-gray-300" x-text="tech.name"></span>
								</div>
							</div>
						</template>
					</div>
				</div>
			</div>
		</div>
		<div class="absolute bottom-6 sm:bottom-8 left-1/2 transform -translate-x-1/2">
			<a href="#about" 
			   class="text-secondary inline-block animate-bounce-slow hover:text-accent transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-secondary/50 rounded p-2"
			   aria-label="Scroll to about section">
				<i class="fas fa-chevron-down text-lg sm:text-2xl" aria-hidden="true"></i>
			</a>
		</div>
	</div>
</section>
