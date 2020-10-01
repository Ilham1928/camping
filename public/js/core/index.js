$("document").ready(function(){
    setTimeout(function(){
       $(".alert-danger").css('display', 'none');
   }, 3000 ); // 5 secs
});

$("#searchBar").on("keyup", function () {
    var keyword = this.value;
    $(".content-inner").highlite({
        text: keyword
    });
});
