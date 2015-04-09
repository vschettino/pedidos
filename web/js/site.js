$(document).ready(function () {
    $('#criar-pedido').click(function () {
        keys = $('.grid-view').yiiGridView('getSelectedRows');
        urlData = 'index.php?r=pedido/checkout&produto_id=' + keys.join('|');
        console.log(urlData);
        window.location = urlData;
        return false;
    })
});
$(document).ready(function () {
    $('.mudar-status').click(function () {
        var pedido_id = $("#pedido_id").val();
        var status_id = $("#status_id").val();
        var request = $.ajax({
            url: "index.php?r=pedido/muda-status",
            method: "GET",
            data: {pedido_id: pedido_id, status_id: status_id},
            dataType: "JSON",
            success: function (data) {
                $container = $(".log-mudancas");
                if (data.error == true) {
                    var classe = 'alert-warning'
                }
                else {
                    var classe = 'alert-success'
                }
                $container.append('<div class="' + classe + '">' + data.msg + '</div>')
            }
        });

    })
})