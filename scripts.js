document.getElementById('current').innerText = pageNumber;
document.getElementById('file').value = fileName;
if (pageNumber == 1) document.getElementById('buttonPrevious').disabled = true;

var changed = false;



document.querySelector('form').addEventListener('formdata', function(event) {
    let formData = event.formData;
    for (let [name, value] of Array.from(formData.entries())) {
        if (value === '') formData.delete(name);
    }
});

// document.querySelectorAll('thead input[type="text"]').forEach(input => {
//     input.addEventListener('keydown', function(event) {
//         if (event.key === 'Enter') submitForm();
//     });
// });

document.getElementById('clearFilters').addEventListener('click', function(event) {
    event.preventDefault();
    window.location = window.location.href.split('?')[0] + "?file=" + fileName;
});



function submitForm(offset = 0) {
    document.getElementById('page').value = pageNumber + offset;
    if (changed) document.getElementById('page').value = 1;
    document.querySelector('form').submit();
}

function changeFile(v) {
    document.getElementById('file').value = v;
    window.location = window.location.href.split('?')[0] + "?file=" + v;
}