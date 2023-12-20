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

window.openEditModal = function(event, editUrl, name, id, type) {
    event.preventDefault();
    const editModal = document.getElementById('editModal');
    editModal.querySelector('form').action = editUrl;
    editModal.querySelector('input[name="name"]').value = name;

    var obj_input = editModal.querySelector('#obj_id');
    if (type === 'folder') {
        obj_input.name = 'folder_id';
    } else if (type === 'file') {
        obj_input.name = 'file_id';
    }

    obj_input.value = id;
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
            popup.style.top = `${index * 70 + 20}px`; // Position each popup
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

document.addEventListener('DOMContentLoaded', function () {
    var commandButton = document.getElementById('commandButton');
    var commandMenu = document.getElementById('commandMenu');
    var formContainerList = document.querySelectorAll('.form-container');

    if (commandButton && commandMenu && formContainerList.length > 0) {
        commandButton.addEventListener('click', function () {
            if (commandMenu.style.display === 'block') {
                formContainerList.forEach(function (formContainer) {
                    formContainer.style.display = 'none';
                });
            }

            commandMenu.style.display = (commandMenu.style.display === 'block') ? 'none' : 'block';
        });

        var menuButtons = commandMenu.querySelectorAll('button');
        menuButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var action = button.getAttribute('data-action');
                var form_id = button.getAttribute('data-form');
                var form = document.getElementById(form_id);

                performAction(action, form);

            });
        });

        function performAction(action, form) {
            switch (action) {
                case 'upload_file':
                    form.style.display = (form.style.display === 'block') ? 'none' : 'block';
                    calculateAndSetFormPosition(form);

                    break;
                case 'new_folder':
                    form.style.display = (form.style.display === 'block') ? 'none' : 'block';
                    calculateAndSetFormPosition(form);

                    break;
            }
        }

        function calculateAndSetFormPosition(form) {
            var commandMenuRect = commandMenu.getBoundingClientRect();
            form.style.left = (commandMenuRect.x / commandMenuRect.left) * 10% + 'px';
            form.style.top = (commandMenuRect.y / commandMenuRect.top) * 10% + 'px';
        }
    }
});

