<?php

class Hattat
{
    public static function createDatatable($url, $fields)
    {
        $cols = [];
        $ths = [];
        foreach ($fields as $field_key => $field_name) {
            $cols[] = "{data: '$field_key', name: '$field_key'}";
            $ths[] = '<td>' . $field_name . '</td>';
        }

        $html = '<table id="data-table" class="table table-auto">
                    <tr> ' . implode('', $ths) . '</tr>
                </table>';
        $html .= "<script type='text/javascript'>
                    var table = $('#data-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '$url',
                        columns: [" . implode(',', $cols) . "],
                        order: [[1, 'asc']]
                    });
                    table.on('order.dt search.dt', function () {
                        let i = 1;
                        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                            this.data(i++);
                        });
                    }).draw();
                </script>";
        return $html;
    }
}
