/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        dark: {
          bg: '#0B0F19', // Sleek deep space blue/black
          card: '#161B2E', // Subtle dark card bg
          cardBorder: '#2E354F', // Dark border
          text: '#F3F4F6', // Off-white
          muted: '#9CA3AF',
        },
        light: {
          bg: '#F9FAFB', // Clean light gray
          card: '#FFFFFF', // Clean white card
          cardBorder: '#E5E7EB', // Light border
          text: '#111827', // Dark gray
          muted: '#6B7280',
        },
        accent: {
          primary: '#6366F1', // Indigo glow
          secondary: '#10B981', // Emerald green accent
          teal: '#14B8A6',
          violet: '#8B5CF6',
          rose: '#F43F5E',
        }
      },
      fontFamily: {
        sans: ['Instrument Sans', 'sans-serif'],
        display: ['Cal Sans', 'Instrument Sans', 'sans-serif'],
      },
      animation: {
        'float': 'float 6s ease-in-out infinite',
        'pulse-glow': 'pulse-glow 3s ease-in-out infinite',
        'shimmer': 'shimmer 2.5s infinite linear',
        'slide-infinite': 'slide-infinite 25s linear infinite',
      },
      keyframes: {
        float: {
          '0%, 100%': { transform: 'translateY(0)' },
          '50%': { transform: 'translateY(-10px)' },
        },
        'pulse-glow': {
          '0%, 100%': { opacity: '0.6', transform: 'scale(1)' },
          '50%': { opacity: '1', transform: 'scale(1.05)' },
        },
        shimmer: {
          '0%': { backgroundPosition: '-200% 0' },
          '100%': { backgroundPosition: '200% 0' },
        },
        'slide-infinite': {
          '0%': { transform: 'translateX(0)' },
          '100%': { transform: 'translateX(-50%)' },
        }
      },
      boxShadow: {
        'glass-dark': '0 8px 32px 0 rgba(0, 0, 0, 0.37)',
        'glass-light': '0 8px 32px 0 rgba(31, 38, 135, 0.07)',
        'glow-primary': '0 0 20px rgba(99, 102, 241, 0.15)',
        'glow-emerald': '0 0 20px rgba(16, 185, 129, 0.15)',
      }
    },
  },
  plugins: [],
}
