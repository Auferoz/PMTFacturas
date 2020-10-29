document.getElementById('submitExport').addEventListener('click', function(e) {
    e.preventDefault();
    let dtBasicExample = document.getElementById('dtBasicExample');
    let data_to_send = document.getElementById('data_to_send');
    data_to_send.value = dtBasicExample.outerHTML;
    document.getElementById('formExport').submit();
});