import './bootstrap';


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


document.addEventListener('DOMContentLoaded', function () {
    // تفعيل Sortable لكل قائمة مهام داخل مجموعة
    var taskGroups = document.querySelectorAll('.tasks-list');
    taskGroups.forEach(function (group) {
        new Sortable(group, {
            group: 'shared', // لجعل المهام قابلة للنقل بين المجموعات
            animation: 150,
            ghostClass: 'sortable-ghost',
            onEnd: function (/**Event*/evt) {
                console.log(`Task moved from index ${evt.oldIndex} to ${evt.newIndex}`);
            }
        });
    });


});



