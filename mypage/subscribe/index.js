function arrTest() {
    var testArr = ["1", "2", "3"];
    $.ajax({
        type: "POST",
        data: JSON.stringify({
            test: testArr
        }),
        url: "/api/user_data/test.php",
        success: function(data) {
            console.log(data);
        },
        error: function(error) {
            console.log(error);
        }
    })
}