import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.openDeleteModal = function(event, deleteUrl, name) {
    event.preventDefault();
    document.getElementById('deleteModal').querySelector('form').action = deleteUrl;
    document.getElementById('deleteName').textContent = name;
    document.getElementById('deleteModal').classList.remove('hidden');
}

window.openEditModal = function(event, editUrl, fileName) {
    event.preventDefault();
    const editModal = document.getElementById('editModal');
    editModal.querySelector('form').action = editUrl;
    editModal.querySelector('input[name="name"]').value = fileName;
    editModal.classList.remove('hidden');
}

window.closeModal = function() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('editModal').classList.add('hidden');
}

window.onload = function() {
    let errorPopups = document.querySelectorAll('.error-popup');
    let successPopups = document.querySelectorAll('.success-popup');
    let closeErrorButtons = document.querySelectorAll('.close-error');
    let closeSuccessButtons = document.querySelectorAll('.close-success');

    let displayPopups = function(popups, closeButtons) {
        popups.forEach((popup, index) => {
            popup.style.bottom = `${index * 70 + 20}px`; // Position each popup
            setTimeout(() => {
                popup.classList.add('show'); // Show the popup
            }, index * 500); // Delay before showing each popup
        });

        closeButtons.forEach((button, index) => {
            button.addEventListener('click', () => {
                popups[index].classList.remove('show'); // Close the popup
            });
        });
    };

    displayPopups(errorPopups, closeErrorButtons);
    displayPopups(successPopups, closeSuccessButtons);
};
