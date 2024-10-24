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
            onEnd: function (evt) {
                var taskId = evt.item.dataset.taskId; // احصل على معرّف المهمة
                var newCategoryId = evt.to.closest('.task-group').dataset.categoryId; // احصل على الفئة الجديدة

                // إرسال طلب AJAX لتحديث الفئة في Laravel
                fetch(`/tasks/${taskId}/update-category`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // توكن الحماية CSRF
                    },
                    body: JSON.stringify({
                        category_id: newCategoryId
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Category updated successfully');
                        } else {
                            console.error('Failed to update category');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        });
    });
});


