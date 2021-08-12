/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function populateForm(frm, data) {

    $.each(data, function (key, value) {

        var $ctrl = $('[name=' + key + ']', frm);

        if ($ctrl.is('select')) {

            $("option", $ctrl).each(function () {
                if (this.value == value) {
                    this.selected = true;
                }
            });
        } else {
            switch ($ctrl.attr("type"))
            {
                case "text" :
                case "hidden":
                case "number":
                case "textarea":
                    $ctrl.val(value);
                    break;
                case "radio" :
                case "checkbox":
                    $ctrl.each(function () {
                        if ($(this).attr('value') == value) {
                            $(this).attr("checked", value);
                        }
                    });
                    break;
            }
        }
    });
}
;

