$(document).ready(function () {
    $('#criar-pedido').click(function () {
        keys = $('.grid-view').yiiGridView('getSelectedRows');
        urlData = 'index.php?r=pedido/checkout&produto_id=' + keys.join('|');
        console.log(urlData);
        window.location = urlData;
        return false;
    })
});