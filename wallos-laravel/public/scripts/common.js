// Common JavaScript functions for WallOS
document.addEventListener('DOMContentLoaded', function() {
  let isDropdownOpen = false;

  // Initialize dropdown functionality
  function initDropdowns() {
    const dropdowns = document.querySelectorAll('.dropdown');
    
    dropdowns.forEach(dropdown => {
      const toggle = dropdown.querySelector('.dropdown-toggle');
      const content = dropdown.querySelector('.dropdown-content');
      
      if (!toggle || !content) return;
      
      toggle.addEventListener('click', function(e) {
        e.preventDefault();
        isDropdownOpen = !dropdown.classList.contains('is-open');
        dropdown.classList.toggle('is-open', isDropdownOpen);
      });
    });

    // Close dropdown when clicking outside
    document.addEventListener('mousedown', function(event) {
      dropdowns.forEach(dropdown => {
        if (dropdown && !dropdown.contains(event.target)) {
          dropdown.classList.remove('is-open');
          isDropdownOpen = false;
        }
      });
    });
  }

  // Initialize all common functionality
  function init() {
    initDropdowns();
    // Other common initializations...
  }

  init();
});

// Existing utility functions
function debounce(func, wait) {
  let timeout;
  return function() {
    const context = this;
    const args = arguments;
    clearTimeout(timeout);
    timeout = setTimeout(() => func.apply(context, args), wait);
  };
}

function throttle(func, limit) {
  let inThrottle;
  return function() {
    const args = arguments;
    const context = this;
    if (!inThrottle) {
      func.apply(context, args);
      inThrottle = true;
      setTimeout(() => inThrottle = false, limit);
    }
  };
}

// Theme switching functionality
function initThemeSwitcher() {
  const themeSwitcher = document.getElementById('theme-switcher');
  if (themeSwitcher) {
    themeSwitcher.addEventListener('change', function(e) {
      document.documentElement.setAttribute('data-theme', e.target.value);
      localStorage.setItem('theme', e.target.value);
    });
  }
}

// Initialize theme on load
const currentTheme = localStorage.getItem('theme') || 'light';
document.documentElement.setAttribute('data-theme', currentTheme);