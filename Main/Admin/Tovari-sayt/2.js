function enableEdit(id) {
    document.getElementById('view_' + id).style.display = 'none';
    document.getElementById('edit_' + id).style.display = 'table-row';
}

function cancelEdit(id) {
    document.getElementById('view_' + id).style.display = 'table-row';
    document.getElementById('edit_' + id).style.display = 'none';
}

function confirmDelete(id) {
    if (confirm('Вы уверены, что хотите удалить этот товар?')) {
        var form = document.createElement('form');
        form.method = 'post';
        form.action = '';
        
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'delete_product';
        input.value = '1';
        form.appendChild(input);
        
        var idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'id';
        idInput.value = id;
        form.appendChild(idInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}