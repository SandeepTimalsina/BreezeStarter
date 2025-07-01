function applyTheme(theme) {
    const html = document.documentElement;
    if (theme === 'dark') {
        html.classList.add('dark');
    } else {
        html.classList.remove('dark');
    }

    // Update UI label and icon
    updateThemeToggleLabel(theme);
}

function initTheme() {
    const savedTheme = localStorage.getItem('theme');
    const theme = savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)
        ? 'dark'
        : 'light';
    applyTheme(theme);
}

function toggleTheme() {
    const current = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
    const next = current === 'dark' ? 'light' : 'dark';
    localStorage.setItem('theme', next);
    applyTheme(next);
}

function updateThemeToggleLabel(theme) {
    const textSpan = document.getElementById('theme-text');
    const icon = document.getElementById('theme-icon');

    if (!textSpan || !icon) return;

    if (theme === 'dark') {
        textSpan.textContent = 'Toggle Light Mode';
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 3v1m0 16v1m8.49-8.49h1M3.51 12.51h1m15.36-6.36l.71.71M4.93 19.07l.71.71
                m12.02 0l-.71.71M4.93 4.93l.71.71M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
        `;
    } else {
        textSpan.textContent = 'Toggle Dark Mode';
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 12.79A9 9 0 0112.21 3
                c-.57 0-1.13.05-1.67.15a1 1 0 00-.34 1.91
                A7 7 0 1017.94 15a1 1 0 001.91-.34
                c.1-.54.15-1.1.15-1.67z" />
        `;
    }
}

window.toggleTheme = toggleTheme;
window.addEventListener('DOMContentLoaded', initTheme);
