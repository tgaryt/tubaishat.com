tailwind.config = {
	theme: {
		extend: {
			colors: {
				primary: '#0f172a',
				secondary: '#0ea5e9',
				accent: '#06b6d4',
				dark: '#020617',
				light: '#f8fafc'
			},
			fontFamily: {
				sans: ['Inter', 'system-ui', 'sans-serif'],
				mono: ['JetBrains Mono', 'Consolas', 'Monaco', 'Courier New', 'monospace']
			},
			animation: {
				'float': 'float 3s ease-in-out infinite',
				'pulse-slow': 'pulse 3s ease-in-out infinite',
				'slide-in': 'slideIn 0.5s ease-out',
				'bounce-slow': 'bounce 2s infinite'
			},
			keyframes: {
				float: {
					'0%, 100%': { transform: 'translateY(0)' },
					'50%': { transform: 'translateY(-10px)' }
				},
				slideIn: {
					'0%': { transform: 'translateY(20px)', opacity: '0' },
					'100%': { transform: 'translateY(0)', opacity: '1' }
				}
			}
		}
	}
};
