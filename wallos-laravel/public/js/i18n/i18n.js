// Internationalization support for WallOS
class I18n {
    constructor(translations) {
        this.translations = translations || {};
    }

    translate(key) {
        return this.translations[key] || `[${key}]`;
    }

    static init(translations) {
        if (!window.i18n) {
            window.i18n = new I18n(translations);
        }
        return window.i18n;
    }
}

// Expose translate function globally for backward compatibility
function translate(key) {
    if (window.i18n) {
        return window.i18n.translate(key);
    }
    return `[${key}]`;
}

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        I18n,
        translate
    };
}