/** @type {import('tailwindcss').Config}*/
const config = {
	content: ['./src/**/*.{html,js,svelte,ts}'],

	theme: {
		extend: {
			colors: {
				'base--52': '#525252',
				'base--black': '#121212',
				'base--gray': '#292929',
				'base--icon': '#DADADA',
				'text--black': '#121212',
				'text--gray': '#AEAEAE',
				'--purple': '#D8B4FE',
				'input--gray': '#303030',
				'input--border': '#939393',
				'--success': '#5AE4BB',
				'--error': '#F17373',
				'button--socondary': '#424242',
				'button--primary': '#895AED',
				'score--gray': '#555',
				'score--up': '#3CB28F',
				'score--low': '#F31260',
				'score--mid': '#F5A524',
				'score--rang': '#36ACE5',
				'wizard--select': '#002E48',
				'wizard--line': '#434343',
				'table--item': '#393939',
				'table--item2': '#4C4C4C',
				'table--title': '#303030',
				'table--purple': '#896DC3',
				'file--border': '#E3E3E3',
				'button--success': '#2C9B7A'
			},
			opacity: {
				12: '0.12'
			},
			zIndex: {
				'-1': '-1'
			},
			minWidth: {
				'60p': '60%'
			}
		}
	},

	plugins: [require('daisyui')],
	daisyui: {
		themes: false, // true: all themes | false: only light + dark | array: specific themes like this ["light", "dark", "cupcake"]
		darkTheme: 'dark', // name of one of the included themes for dark mode
		base: true, // applies background color and foreground color for root element by default
		styled: true, // include daisyUI colors and design decisions for all components
		utils: true, // adds responsive and modifier utility classes
		rtl: true, // rotate style direction from left-to-right to right-to-left. You also need to add dir="rtl" to your html tag and install `tailwindcss-flip` plugin for Tailwind CSS.
		prefix: '', // prefix for daisyUI classnames (components, modifiers and responsive class names. Not colors)
		logs: true // Shows info about daisyUI version and used config in the console when building your CSS
	}
};

module.exports = config;
