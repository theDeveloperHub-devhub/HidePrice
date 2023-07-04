define([
        "jquery", "Magento_Ui/js/modal/modal",'mage/url'
    ], function($,modal,url){
    var options= {
        wrapperClass: 'devhub-modals-wrapper',
        modalClass: 'devhub-modal',
        overlayClass: 'devhub-modals-overlay',
        responsiveClass: 'devhub-modal-slide',
        type: 'popup',
        responsive: true,
        innerScroll: true,
        title: 'Price Show Request',
        buttons: [{
            text: $.mage.__('Send Request'),
            class: 'devhub-popup-button',
            click: function (data){
                var form_data = $("#hide-price-form").serialize();
                if ($('#hide-price-form').valid()) {
                    $.ajax({
                        showLoader: true,
                        url: url.build('developer_hub/path/path'),
                        type: 'POST',
                        data: form_data
                    }).done(function (data) {
                        $("#devhub-cancel-order-modal").modal('closeModal');
                    }).fail(function () {
                        $("#devhub-cancel-order-modal").modal('closeModal');
                    });
                }
            }
        },
            {
                text: $.mage.__('Close Model'),
                class: 'devhub-popup-button',
                click: function (data) {
                    $("#hide-price-form")[0].reset();
                    $('#devhub-cancel-order-modal').modal('closeModal');
                }
            }
        ]
    };
    modal(options, $("#devhub-cancel-order-modal"));
    modal(options, $("#devhub-cancel-order-modal"));
    modal(options, $("#devhub-cancel-order-modal"));
    modal(options, $("#devhub-cancel-order-modal"));
    modal(options, $("#devhub-cancel-order-modal"));
    modal(options, $("#devhub-cancel-order-modal"));

    $(document).on('click', '.hide-price', function () {
        var name = $(this).attr('data-order-name');
        var id = $(this).attr('data-order-id');
        var price = $(this).attr('data-order-price');
        modal(options, $("#devhub-cancel-order-modal"));
        $("#devhub-cancel-order-modal").modal('openModal');
        $(".product-name").attr('value', name);
        $(".id").attr('value', id);
        $(".price").attr('value', price);
    });
});

