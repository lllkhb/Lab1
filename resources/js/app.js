import './bootstrap';
import $ from 'jquery';
import select2 from 'select2';
import 'select2/dist/css/select2.css';
import duallistbox from 'bootstrap4-duallistbox';
import 'bootstrap4-duallistbox/dist/bootstrap-duallistbox.css';

window.$ = window.jQuery = $;
select2(window, $);
$(function () {
    $('#filters').select2({
        width: '340px',
        placeholder: 'Оберіть мітки',
    });
});

duallistbox(window, $);
$('#duallist').bootstrapDualListbox({nonSelectedListLabel: 'Доступні мітки',
    selectedListLabel: 'Обрані мітки',
    preserveSelectionOnMove: 'moved',
    moveOnSelect: false,
    infoText: 'Усього {0}',
    filterPlaceHolder: 'Пошук',
});
