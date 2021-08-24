require('./bootstrap');

import Swal from 'sweetalert2';

window.deleteConfirm = function(formId)
{
    Swal.fire({
        icon: 'warning',
        text: 'Haqiqatdan ham o\'chirishni xohlaysizmi?',
        showCancelButton: true,
        confirmButtonText: 'Tasdiqlayman',
        confirmButtonColor: '#e3342f',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

window.saveConfirm = function(formId)
{
    Swal.fire({
        title: 'Haqiqatdan ham saqlashni xohlaysizmi?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Saqlash`,
        denyButtonText: `Bekor qilish`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            // Swal.fire('Saqlandi!', '', 'success'),
                document.getElementById(formId).submit();
        } else if (result.isDenied) {
            Swal.fire('Ma\'lumotlar saqlanmadi!', '', 'info')
        }
    })
}
