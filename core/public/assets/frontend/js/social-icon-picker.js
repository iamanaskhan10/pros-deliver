// Social media icons with their FontAwesome classes and display names
const socialMediaIcons = [
    { class: 'fas fa-globe', name: 'Website' },
    { class: 'fab fa-facebook-f', name: 'Facebook' },
    { class: 'fab fa-instagram', name: 'Instagram' },
    { class: 'fab fa-twitter', name: 'Twitter' },
    { class: 'fab fa-linkedin-in', name: 'LinkedIn' },
    { class: 'fab fa-youtube', name: 'YouTube' },
    { class: 'fab fa-tiktok', name: 'TikTok' },
    { class: 'fab fa-snapchat-ghost', name: 'Snapchat' },
    { class: 'fab fa-pinterest-p', name: 'Pinterest' },
    { class: 'fab fa-reddit-alien', name: 'Reddit' },
    { class: 'fab fa-discord', name: 'Discord' },
    { class: 'fab fa-telegram-plane', name: 'Telegram' },
    { class: 'fab fa-whatsapp', name: 'WhatsApp' },
    { class: 'fab fa-twitch', name: 'Twitch' },
    { class: 'fab fa-spotify', name: 'Spotify' },
    { class: 'fab fa-medium-m', name: 'Medium' },
    { class: 'fab fa-behance', name: 'Behance' },
    { class: 'fab fa-dribbble', name: 'Dribbble' },
    { class: 'fab fa-vimeo-v', name: 'Vimeo' },
    { class: 'fab fa-slack', name: 'Slack' },
    { class: 'fab fa-tumblr', name: 'Tumblr' },
    { class: 'fab fa-weixin', name: 'WeChat' },
    { class: 'fab fa-line', name: 'Line' },
    { class: 'fab fa-quora', name: 'Quora' },
    { class: 'fab fa-weibo', name: 'Weibo' },
];

class SocialIconPicker {
    constructor(containerId, iconGridId, searchInputId, hiddenInputId) {
        this.container = document.getElementById(containerId);
        this.iconGrid = document.getElementById(iconGridId);
        this.searchInput = document.getElementById(searchInputId);
        this.hiddenInput = document.getElementById(hiddenInputId);

        if (!this.container) return; // Exit if container doesn't exist

        // NO DEFAULT SELECTION
        this.currentSelection = null;
        this.filteredIcons = [...socialMediaIcons];

        this.init();
    }

    init() {
        this.renderIcons();
        this.bindEvents();
        // NO DEFAULT VALUE - leave empty
        this.hiddenInput.value = '';
    }

    renderIcons() {
        this.iconGrid.innerHTML = '';
        this.filteredIcons.forEach(icon => {
            const iconElement = document.createElement('div');
            iconElement.className = 'icon-option';

            // Only add selected class if there's actually a selection AND it matches
            if (this.currentSelection && icon.class === this.currentSelection.class) {
                iconElement.classList.add('selected');
            }

            iconElement.innerHTML = `<i class="${icon.class}"></i>`;
            iconElement.title = icon.name;
            iconElement.addEventListener('click', () => this.selectIcon(icon));
            this.iconGrid.appendChild(iconElement);
        });
    }

    selectIcon(icon) {
        // If the clicked icon is already selected, deselect it
        if (this.currentSelection && this.currentSelection.class === icon.class) {
            this.currentSelection = null;
            this.hiddenInput.value = '';
        } else {
            // Otherwise, select it
            this.currentSelection = icon;
            this.hiddenInput.value = this.currentSelection.class;
        }

        this.renderIcons(); // Re-render to update selected state
    }

    filterIcons(searchTerm) {
        const term = searchTerm.toLowerCase();
        this.filteredIcons = socialMediaIcons.filter(icon =>
            icon.name.toLowerCase().includes(term) ||
            icon.class.toLowerCase().includes(term)
        );
        this.renderIcons();
    }

    bindEvents() {
        this.searchInput.addEventListener('input', (e) => {
            this.filterIcons(e.target.value);
        });
    }

    // Method to set the selected icon (useful for edit modal)
    setSelectedIcon(iconClass) {
        if (iconClass) {
            const icon = socialMediaIcons.find(i => i.class === iconClass);
            if (icon) {
                this.currentSelection = icon;
                this.hiddenInput.value = this.currentSelection.class;
                this.renderIcons();
            }
        } else {
            // Clear selection
            this.currentSelection = null;
            this.hiddenInput.value = '';
            this.renderIcons();
        }
    }

    // Method to clear selection
    clearSelection() {
        this.currentSelection = null;
        this.hiddenInput.value = '';
        this.renderIcons();
    }

    // Method to clear search and reset icons
    resetSearch() {
        this.searchInput.value = '';
        this.filteredIcons = [...socialMediaIcons];
        this.renderIcons();
    }
}

// Global instances
let addModalIconPicker = null;
let editModalIconPicker = null;

// Initialize icon pickers when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Add Modal Icon Picker
    addModalIconPicker = new SocialIconPicker(
        'addModalIconPicker',
        'addModalIconGrid',
        'addModalSearchInput',
        'platform_icon'
    );

    // Initialize Edit Modal Icon Picker
    editModalIconPicker = new SocialIconPicker(
        'editModalIconPicker',
        'editModalIconGrid',
        'editModalSearchInput',
        'edit_platform_icon'
    );
});

// Function to set icon in edit modal (call this when opening edit modal)
function setEditModalIcon(iconClass) {
    if (editModalIconPicker) {
        editModalIconPicker.setSelectedIcon(iconClass);
    }
}

// Function to clear selection in add modal (call when opening add modal)
function clearAddModalSelection() {
    if (addModalIconPicker) {
        addModalIconPicker.clearSelection();
        addModalIconPicker.resetSearch();
    }
}

// Function to clear selection in edit modal
function clearEditModalSelection() {
    if (editModalIconPicker) {
        editModalIconPicker.clearSelection();
        editModalIconPicker.resetSearch();
    }
}