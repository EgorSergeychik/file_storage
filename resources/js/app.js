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
    let popups = document.querySelectorAll('.error-popup');
    let closeButtons = document.querySelectorAll('.close-error');

    popups.forEach((popup, index) => {
        popup.style.bottom = `${index * 70 + 20}px`;
        setTimeout(() => {
            popup.classList.add('show');
        }, index * 500);
    });

    closeButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            popups[index].classList.remove('show');
        });
    });
};
