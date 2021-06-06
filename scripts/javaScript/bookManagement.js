var allBooks;
var allAuthors;
var allGenres;

var bookSortKey = 'title';
var bookSortOrder = true;

var findText = "";
var findCat = "title";

var searchBook = "Nazwie książki";
var searchAuthor = "Autorze";
var searchPages = "Liczbie stron";
var searchGenre = "Gatunku";
var searchCompletion = "Liczbie przeczytanych stron";
var searchRating = "Ocenie";
var searchDescription = "Opisie"; //Ad autodetection

let prefShowReadingBooks;
let prefShowQuequeBooks;
let prefShowReadBooks;

$(document).ready(function () {
    downloadBooks();
    downloadAuthors();
    downloadGenres();
});

$("#show").on('submit', function (e) {
    e.preventDefault();
    var details = $('#show').serialize();
    $.post('pages/showBooks.php', details, function (data) {
        allBooks = JSON.parse(data);
        showBooks(allBooks);
    });
});

$("#find-book").on('keyup', function () {
    findText = $("#find-book").val().toLocaleLowerCase();
    showBooks(allBooks);
});

$('#serach-select').change(function () {
    findCat = $(this).val();
    showBooks(allBooks);
});

$('.site-menu-check-input').change(function () {
    ($('#showReadingBooks').is(":checked")) ? prefShowReadingBooks = true : prefShowReadingBooks = false;
    ($('#showQuequeBooks').is(":checked")) ? prefShowQuequeBooks = true : prefShowQuequeBooks = false;
    ($('#showReadBooks').is(":checked")) ? prefShowReadBooks = true : prefShowReadBooks = false;

    //alert("reading: " + prefShowReadingBooks + " quequed: " + prefShowQuequeBooks + " read: " + prefShowReadBooks);

    //var details = $("#change-preferences-form").serialize();

    $.post('pages/changePreferences.php', details, function (data) {
        showAlert(data);
        //downloadAuthors();
        /*var currentAuthor = $("#author-modal-aname").val();
        var addAuthor = true;
        var authors = "";
        allAuthors.forEach(function (item, index) {
            authors += "<option>" + item.a_name + "</option>";
            //alert("czy " + item.a_name + "==" + currentAuthor);
            if (item.a_name == currentAuthor) addAuthor = false;
        });

        $("#add-author-modal").modal("hide");

        if (addAuthor) authors += "<option>" + currentAuthor + "</option>";

        $("#b-author").html(authors);
        $("#b-author").val(currentAuthor);*/
    });

})

function showBooks(responseObject) {
    allBooks.sort(compareValues(bookSortKey, bookSortOrder));

    var newContent = '';

    /*newContent += "<tr>"
        + "<th class='title' id='sort-title'>Nazwa</th>"
        + "<th class='a_name' id='sort-author'>Autor</th>"
        + "<th class='g_name' id='sort-genre'>Gatunek</th>"
        + "<th class='completion' id='sort-completion'>Ukończenie</th>"
        + "<th class='rating' id='sort-rating'>Ocena</th>"
        + "<th class='description'>Opis</th>"
        + "</tr>";*/

    responseObject.forEach(function (item, index) {

        var toFind;

        if (findCat == searchAuthor) toFind = item.a_name;
        else if (findCat == searchPages) toFind = item.pages;
        else if (findCat == searchGenre) toFind = item.g_name;
        else if (findCat == searchCompletion) toFind = item.completion;
        else if (findCat == searchRating) toFind = item.rating;
        else if (findCat == searchDescription) toFind = item.description;
        else toFind = item.title;

        if (toFind.toLocaleLowerCase().indexOf(findText) >= 0 || findText == undefined || findText == "") {
            newContent += "<tr data-toggle='modal' data-target='#book-modal' onclick='bookEdit(\"" + item.bookID + "\")'";
            if (item.completion >= 100) newContent += " class='read'>";
            else if (item.completion < 100 && item.completion > 0) newContent += " class='reading'>";
            else newContent += ">";
            newContent += "<td class='title'><b>" + item.title + "</b></td>";
            newContent += "<td class='a_name'>" + item.a_name + "</td>";
            newContent += "<td class='g_name'>" + item.g_name + "</td>";
            newContent += "<td class='completion'>" + item.completion + "%";
            if (item.completion > 0 && item.completion < 100)
                newContent += "<hr class='lineCompletion' style='width:" + item.completion + "%; class='lineCompletion'></td>";
            newContent += "<td class='rating'>" + item.rating + "</td>";
            newContent += "<td class='description'>" + item.description + "</td>";
            newContent += "</tr>";
        }

    });

    $('#content').hide();
    $('#content').html(newContent);
    $('#content').fadeIn('fast');
}

//Sort

$('#sort-title').on('click', function () {
    if (bookSortKey == "title") bookSortOrder = !bookSortOrder;
    else {
        bookSortKey = 'title';
        bookSortOrder = true;
    }
    showBooks(allBooks);
}); $('#sort-author').on('click', function () {
    if (bookSortKey == "author") bookSortOrder = !bookSortOrder;
    else {
        bookSortKey = 'author';
        bookSortOrder = true;
    }
    showBooks(allBooks);
}); $('#sort-pages').on('click', function () {
    if (bookSortKey == "pages") bookSortOrder = !bookSortOrder;
    else {
        bookSortKey = 'pages';
        bookSortOrder = true;
    }
    showBooks(allBooks);
}); $('#sort-genre').on('click', function () {
    if (bookSortKey == "genre") bookSortOrder = !bookSortOrder;
    else {
        bookSortKey = 'genre';
        bookSortOrder = true;
    }
    showBooks(allBooks);
}); $('#sort-completion').on('click', function () {
    if (bookSortKey == "completion") bookSortOrder = !bookSortOrder;
    else {
        bookSortKey = 'completion';
        bookSortOrder = true;
    }
    showBooks(allBooks);
}); $('#sort-rating').on('click', function () {
    if (bookSortKey == "rating") bookSortOrder = !bookSortOrder;
    else {
        bookSortKey = 'rating';
        bookSortOrder = true;
    }
    showBooks(allBooks);
});

//Sorting algorithm

function compareValues(key, order = true) {
    return function innerSort(a, b) {
        if (!a.hasOwnProperty(key) || !b.hasOwnProperty(key)) return 0;
        const comparison = a[key].localeCompare(b[key]);

        return (
            (order === false) ? (comparison * -1) : comparison
        );
    };
}

//Download data

function downloadBooks() {
    var details = $('#show').serialize();

    $.post('pages/showBooks.php', details, function (data) {

        allBooks = JSON.parse(data);

        showBooks(allBooks);
    });
}

function downloadAuthors() {
    var details = $('#show').serialize();

    $.post('pages/showAuthors.php', details, function (data) {

        //alert(data);
        allAuthors = JSON.parse(data);

        //showAuthors(allAuthors);
    });
}

function downloadGenres() {
    var details = $('#show').serialize();

    $.post('pages/showGenres.php', details, function (data) {

        allGenres = JSON.parse(data);

        //showGenres(allGenres);
    });
}
