import { ref, onMounted, watch } from 'vue'

const isDark = ref(false)

export function useTheme() {
    // Initialize theme from localStorage or system preference
    const initTheme = () => {
        const savedTheme = localStorage.getItem('theme')
        if (savedTheme) {
            isDark.value = savedTheme === 'dark'
        } else {
            // Check system preference
            isDark.value = window.matchMedia('(prefers-color-scheme: dark)').matches
        }
        applyTheme()
    }

    // Apply theme to HTML element
    const applyTheme = () => {
        const html = document.documentElement
        if (isDark.value) {
            html.classList.add('dark')
        } else {
            html.classList.remove('dark')
        }
    }

    // Toggle theme
    const toggleTheme = () => {
        isDark.value = !isDark.value
        localStorage.setItem('theme', isDark.value ? 'dark' : 'light')
        applyTheme()
    }

    // Initialize on mount
    onMounted(() => {
        initTheme()
        
        // Listen for system theme changes
        const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)')
        const handleChange = (e) => {
            if (!localStorage.getItem('theme')) {
                isDark.value = e.matches
                applyTheme()
            }
        }
        mediaQuery.addEventListener('change', handleChange)
        
        return () => {
            mediaQuery.removeEventListener('change', handleChange)
        }
    })

    return {
        isDark,
        toggleTheme,
        initTheme
    }
}

