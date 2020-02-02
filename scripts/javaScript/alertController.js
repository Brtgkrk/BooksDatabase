function showAlert(data)
{
    var type = parseInt(data.slice(0,1),10);
    var text = data.slice(1,data.length);

    switch (type)
    {
      case 1:
        $("#alert-show").html("<div class='alert alert-success alert-dismissible fade show'>" + text + "<button type='button' class='close' data-dismiss='alert'>&times;</button><span id='book-alert-box'></span></div>");
        break;
      case 2:
        $("#alert-show").html("<div class='alert alert-warning alert-dismissible fade show'>" + text + "<button type='button' class='close' data-dismiss='alert'>&times;</button><span id='book-alert-box'></span></div>");
        break;
      case 3:
        $("#alert-show").html("<div class='alert alert-danger alert-dismissible fade show'>" + text + "<button type='button' class='close' data-dismiss='alert'>&times;</button><span id='book-alert-box'></span></div>");
          break;
      default:
        $("#alert-show").html("<div class='alert alert-danger alert-dismissible fade show'>"+ text +"<button type='button' class='close' data-dismiss='alert'>&times;</button><span id='book-alert-box'></span></div>");
    }
}
