var changed = false;


document.getElementById('current').innerText = page;

if (page == 1) {
    document.getElementById('buttonPrevious').disabled = true;
}

function submitForm(offset = 0) {
    document.getElementById('page').value = page + offset;
    if (changed) document.getElementById('page').value = 1;
    document.querySelector('form').submit();
}

document.querySelector('form').addEventListener('formdata', function(event) {
    let formData = event.formData;
    for (let [name, value] of Array.from(formData.entries())) {
        if (value === '') formData.delete(name);
    }
});

document.querySelectorAll('thead input[type="text"]').forEach(input => {
    input.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') submitForm();
    });
});

document.getElementById('clearFilters').addEventListener('click', function(event) {
    event.preventDefault();
    window.location = window.location.href.split('?')[0];
});