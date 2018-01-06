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
Номер текущей страницы должен быть чаcтью url (<i class="text-info">/page1</i>, <i class="text-info">/page2</i>...).<br />
Дожна быть возможность сортировки по всем столбцам, параметры сортировки записывать как GET параметры (<i class="text-info">sort</i> и <i class="text-info">dir</i>).
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
                        <div class="th-inner sortable both">
                            Марка
                        </div>
                    </th>
                    <th data-field="year">
                        <div class="th-inner sortable both">
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
document.querySelector('.loader').style.display = 'none';
var itemFields = [],
    doucmentTitle = document.title,
    sortSettingField = 'sort_by',
    sortSettingDir = 'sort_dir';


function getSortSetting(name){
    return window.localStorage.getItem(name);
}

function setSortSetting(name, value) {
    if (typeof(value) == 'string') {
        window.localStorage.setItem(name, value);
    } else {
        if (getSortSetting(name) != null){
            window.localStorage.removeItem(name);
        }
    }
}

// 2. Controlling sorting data in localStorage and classList for .sortable
document.querySelectorAll('.sortable').forEach(function(item) {
    var sortName = item.parentNode.getAttribute('data-field');
    var sortingSetting = getSortSetting();

    // 2.1 Prepare itemFields array for a future ajax requeest
    itemFields.push(sortName);

    // 2.2 Setting up classList for .sortable by sorting data from localStorage
    if (sortName != null && getSortSetting(sortSettingField) != null && getSortSetting(sortSettingField) == sortName) {
        item.classList.add(getSortSetting(sortSettingDir));
    }

    // 2.3 Setup Handler for updating .sortable classList and sorting data in localStorage
    ['click', 'touch'].map(function(eventType) {
        item.addEventListener(eventType, function(event) {
            event.preventDefault();
            if (item.classList.contains('asc')) {
                item.classList.remove('asc');
                item.classList.add('desc');
                setSortSetting(sortSettingField, sortName);
                setSortSetting(sortSettingDir, 'desc')
            } else if (item.classList.contains('desc')) {
                item.classList.remove('desc');
                setSortSetting(sortSettingField);
                setSortSetting(sortSettingDir);
            } else {
                item.classList.add('asc');
                setSortSetting(sortSettingField, sortName);
                setSortSetting(sortSettingDir, 'asc');
            }
            sendRequest(event);
        });
    })
})


function sendRequest(event){

    var pageNumber = document.querySelector('.pagination .page-item.active').innerText,
        pageTitle = 'Page ' + pageNumber,
        url = window.location.origin + '/ajax.php',
        query = '?page=' + pageNumber;

    // 3.1 Update pathname and document title
    window.history.pushState(null, pageTitle, 'page' + pageNumber);
    document.title = doucmentTitle + ' - ' + pageTitle;

    function handler(xhttp){
        document.querySelector('.loader').style.display = 'block';
        setTimeout(function (){
            if(xhttp.status == 200) {
                var tableBody = document.querySelector('#example tbody'),
                    items = JSON.parse(xhttp.response);

                // remove old items from table
                while (tableBody.firstChild) {
                    tableBody.removeChild(tableBody.firstChild);
                }

                // append new items into table
                items.map(function(item) {
                    var itemRow = document.createElement('tr');
                    // build table row by related item fields
                    itemFields.map(function(field){
                        if (item.hasOwnProperty(field)){
                            var itemTd = document.createElement('td');
                            itemTd.innerText = item[field];
                            itemRow.appendChild(itemTd);
                        }
                    })
                    tableBody.appendChild(itemRow);
                })
            }
            document.querySelector('.loader').style.display = 'none';
        }, 3000);
    }

    // 3.2 Prepare ajax url and query
    var sortBy = getSortSetting(sortSettingField);
    if (sortBy != null){
        query += '&sort=' + sortBy;
    }
    var sortDir = getSortSetting(sortSettingDir);
    if (sortDir != null){
        query += '&dir=' + sortDir;
    }

    // 3.3. Send ajax request
    var xhttp = new XMLHttpRequest();
    xhttp.onload = handler.apply(this, [xhttp]);
    xhttp.open('GET', url + query, true);
    xhttp.send();
}

function updatePagination(target) {
    document.querySelector('.page-item.active').classList.remove('active');
    target.classList.add('active');
}

// 3. Handle pagination clicks
document.querySelectorAll('.page-link').forEach(function(item){
    ['click', 'touch'].map(function(eventType){
        item.addEventListener(eventType, function(event){
            event.preventDefault();
            updatePagination(item.parentNode);
            sendRequest(event);
        });
    })
})


// 4. Controlling pathname url
// 4.1. Set default url page1
if (window.location.pathname == '/'){
    window.history.replaceState(null, null, 'page1');
}
// 4.2. Catch existing pagination
if (window.location.pathname.match('page.?')) {
    // check if pageNumber exist in pagination
    var requestedPageNumber = window.location.pathname.replace( /^\D+/g, '');
    if (requestedPageNumber <= document.querySelectorAll('.pagination .page-item').length){
        var pageNodes = document.querySelectorAll('.pagination .page-item');
        if (pageNodes != null){
            --requestedPageNumber;
            updatePagination(pageNodes[requestedPageNumber]);
        }
        sendRequest();
    }
}

</script>
</div>
<br><br><br>



</body>
</html>
