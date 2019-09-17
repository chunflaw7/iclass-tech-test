<html>

<head>
    <title> Employees report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet" />
</head>

<body>
    <form action="/" method="GET">
        <input id="inputKeyword" type="text" name="search"/> <button type="button" class="btn btn-primary" onclick="searchKeyword()">Search</button>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    Employee No.
                </div>
                <div class="col-sm">
                    Name
                </div>
                <div class="col-sm">
                    Gender
                </div>
                <div class="col-sm">
                    Currently hired
                </div>
                <div class="col-sm">
                    Current salary
                </div>
            </div>

            @foreach ($items as $item)
            <div class="row">
                <div class="col-sm">
                    {{ $item->emp_no }}
                </div>
                <div class="col-sm">
                    {{ $item->first_name }} {{ $item->last_name }}
                </div>
                <div class="col-sm">
                    {{ $item->gender }}
                </div>
                <div class="col-sm">
                </div>
                <div class="col-sm">
                </div>
            </div>
            @endforeach
        </div>
        <div>
            {{ $items->links() }}
        </div>
        <select id="perNumSelector" class="custom-select" onchange="changePerPage()">
            <option>Employee Per Page Seletor</option>
            <option value="5">5 entries per page</option>
            <option value="10">10 entries per page</option>
            <option value="20">20 entries per page</option>
            <option value="50">50 entries per page</option>
        </select>
    </form>

<script>
function changePerPage() {
    var perNum = document.getElementById("perNumSelector").value;
    var origin = window.location.origin;
    var query = window.location.search;
    var keyword = query.split('search=')[1];

    if (keyword!=null)
        window.location.href = origin + '/?search=' + keyword.split('&')[0] + '&per=' + perNum;
    else
        window.location.href = origin + '/?per=' + perNum;
}
function searchKeyword() {
    var keyword = document.getElementById("inputKeyword").value;
    var origin = window.location.origin;
    var query = window.location.search;
    var per = query.split('per=')[1];

    if (per!=null)
        window.location.href = origin + '/?search=' + keyword + "&per=" + per.split("&")[0];
    else 
        window.location.href = origin + '/?search=' + keyword; 
}
function init() {
    var query = window.location.search;
    var keyword = "";
    var per = "";
    var newQuery = "";

    if (query.includes("search")){
        keyword = query.split("search=")[1].split("&")[0];
        document.getElementById("inputKeyword").value = keyword;
        newQuery += "&search=" + keyword;
    }
        
    if (query.includes("per")) {
        per = parseInt(query.split("per=")[1].split("&")[0]);
        var options = document.getElementsByTagName("option");
        for (var i = 0; i < options.length; i++) {
            if (options[i].value == per) 
                options[i].selected = true;
        }
        newQuery += "&per=" + per;
    }

    var pageItems = document.getElementsByClassName("page-link");
    for (var i = 0; i < pageItems.length; i++) {
        var href = pageItems[i].getAttribute("href");
        pageItems[i].setAttribute("href", href + newQuery);
    }

}
window.onload = init();
</script>
</body>

</html>