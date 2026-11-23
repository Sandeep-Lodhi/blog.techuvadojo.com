export default {
  content: [
    './*.php',
    './inc/**/*.php',
    './template-parts/**/*.php',
    './patterns/**/*.php',
    './assets/js/**/*.js'
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          50: '#eff6ff',
          100: '#dbeafe',
          200: '#bfdbfe',
          300: '#93c5fd',
          400: '#60a5fa',
          500: '#2563eb',
          600: '#1d4ed8',
          700: '#1e40af',
          800: '#1e3a8a',
          900: '#172554'
        },
        accent: '#0fb7f1',
        success: '#22c55e',
        warning: '#f59e0b',
        danger: '#ef4444',
        surface: '#ffffff',
        card: '#f8fafc',
        border: '#e5e7eb',
        dark: '#0f172a'
      },
      fontFamily: {
        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
        display: ['Poppins', 'ui-sans-serif', 'system-ui', 'sans-serif']
      },
      boxShadow: {
        soft: '0 20px 50px rgba(15, 23, 42, 0.08)'
      }
    }
  },
  plugins: [],
};
