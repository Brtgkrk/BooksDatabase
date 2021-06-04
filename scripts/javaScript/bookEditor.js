var actualBookID;

$("#delete-book-button").on('click', function () {
    sendForm('&to_delete=true');
    $("#book-modal").modal("hide");
    $("#delete-book-modal").modal("hide");
});

$("#button-remove-book").on('click', function () {
    $("#delete-modal-book-title").html("<strong>" + findBook(actualBookID).title + "</strong>");
});

$("#add-book").on('click', bookButton);

$("#add-book-button").on('click', bookButton);

function bookButton() {
    actualBookID = 0;
    bookEdit(0);
    $("#b-name").val("");
    $("#b-author").val("");
    $("#b-genre").val("");
    $("#b-pages").val("");
    $("#b-competion").val("");
    $("#b-rating").val("");
    $("#b-description").val("");
}

$("#book-change-form").on('submit', function (e) {
    e.preventDefault();
    sendForm('&to_delete=false');
    $("#book-modal").modal("hide");
});

function sendForm(another_data) {
    var author = ANameToId($('#b-author').val());

    var genre = GNameToId($('#b-genres').val());

    var details = $("#book-change-form").serialize();

    details = details + another_data;

    details = details + "&book_id=" + actualBookID + "&author_id=" + author + "&genre_id=" + genre;

    $.post('pages/updateData.php', details, function (data) {
        showAlert(data);
    });
    downloadBooks();
    showBooks(allBooks);
    //$('#book-change-form').modal('toggle');
}

function bookEdit(bookID) {
    var authors = "";

    allAuthors.forEach(function (item, index) {
        authors += "<option>" + item.a_name + "</option>";
    });
    $("#b-author").html(authors);

    var genres = "";

    allGenres.forEach(function (item, index) {
        genres += "<option>" + item.g_name + "</option>";
    });
    $("#b-genres").html(genres);
    if (bookID == 0) {
        $('#book-change-title').html('Dodaj nową książkę');

        //alert("dodawanie nowej ksiazki");
    }
    else {
        actualBookID = bookID;

        var book;
        book = findBook(bookID);

        $('#book-change-title').html('Wprowadź zmiany w książce');

        $('#b-name').val(book.title);

        $('#b-pages').val(book.pages);
        $('#b-author').val('opcja2');
        $('#b-completion').val(book.completion);
        $('#b-rating').val(book.rating);
        $('#b-description').val(book.description);

        $("#b-author").val(book.a_name);
        $("#b-genres").val(book.g_name);
    }


}

function findBook(bid) {
    var book;
    allBooks.forEach(function (item, index) {
        if (item.bookID == bid) book = item;
    });
    return book;
}

function ANameToId(authorName) {
    var author;
    allAuthors.forEach(function (item, index) {
        if (item.a_name == authorName) author = item.authorID;
    });
    return author;
}

function GNameToId(genreName) {
    var genre;
    allGenres.forEach(function (item, index) {
        //alert("Aktualnie sprawdzany element: "+item.g_name+" czy == " + genreName);
        if (item.g_name == genreName) genre = item.genreID;
    });
    return genre;
}
