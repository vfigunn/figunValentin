/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye-fill');
            icon.classList.add('bi-eye-slash-fill');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash-fill');
            icon.classList.add('bi-eye-fill');
        }
    }

    const eyeIcon = document.getElementById('togglePasswordIcon');
    if (eyeIcon) {
        eyeIcon.style.cursor = 'pointer';
        eyeIcon.addEventListener('click', () => togglePassword('password', 'togglePasswordIcon'));
    }

    const eyeIconCheck = document.getElementById('togglePasswordCheckIcon');
    if (eyeIconCheck) {
        eyeIconCheck.style.cursor = 'pointer';
        eyeIconCheck.addEventListener('click', () => togglePassword('password_check', 'togglePasswordCheckIcon'));
    }

    function editUser(id, email, rol) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_rol').value = rol;
        const modal = new bootstrap.Modal(document.getElementById('editModal'));
        modal.show();
    }

    function deleteUser(id, email) {
        document.getElementById('delete_id').value = id;
        document.getElementById('delete_email').innerText = email;
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }

});

