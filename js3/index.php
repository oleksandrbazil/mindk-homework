<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Practice 13</title>

        <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://rawgit.com/wenzhixin/bootstrap-table/master/src/bootstrap-table.css">
   
    <style>
        .tasks {
            padding: 20px;
            padding-left: 40px;
        }
        .loader {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            background-color: #000;
            border-radius: 5px;
            opacity: 0.3;
            text-align: center;
            padding: 20px;
            min-height: 140px;
        }
    </style>
    
</head>
<body>
<div class="tasks">
<h4>
Данные для таблицы должны подтягиваться по ajax по url <code>ajax.php</code>.
Номенр текущей страницы должен быть чаcтью url (<i class="text-info">/page1</i>, <i class="text-info">/page2</i>...).<br />
Дожна быть возможность сортировки по всем с толбцам, параметры сортировки записывать как GET параметры (<i class="text-info">sort</i> и <i class="text-info">dir</i>).
Если приложение открыто в нескольких вкладках - то при изменении сортировки - она должна поменяться во всех вкладках.<br />
Когда сайт открывается первый раз (по <a href="http://main.hz/">ссылке</a>) - то в адресной строке должно отображаться <code>http://main.hz/page1</code>,
при этом данный адресс должен быть первым в истории посещений.<br />
Во время загрузки данных нужно отображать лоадер, а потом его скрывать.
</h4>
<br />

<div class="bootstrap-table">
    <div class="fixed-table-container">
        <div class="loader"><img src="https://i.giphy.com/Mf9o6Z2CNs1eE.gif" height="100"></div>
        <table id="example" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
            <thead>
                <tr class="info">
                    <th data-field="id">
                        <div class="th-inner sortable both">
                            ID
                        </div>
                    </th>
                    <th data-field="name">
                        <div class="th-inner sortable both desc">
                            Марка
                        </div>
                    </th>
                    <th data-field="year">
                        <div class="th-inner sortable both asc">
                            Год выпуска
                        </div>
                    </th>
                    <th data-field="color">
                        <div class="th-inner sortable both">
                            Цвет
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Renault Sandero</td>
                    <td>2012</td>
                    <td>Красный</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Renault Stepway</td>
                    <td>2015</td>
                    <td>Синий</td>
                </tr>
           
        </table>
    </div>
</div>
<div class="pull-right pagination">
    <ul class="pagination">
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">4</a></li>
        <li class="page-item"><a class="page-link" href="#">5</a></li>
    </ul>
</div>


<script>
// script for task
</script>
</div>
<br><br><br>



</body>
</html>




