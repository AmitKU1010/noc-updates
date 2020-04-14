// Footer Popup 
    $(document).ready(function() {
    
    $( "#clickme" ).click(function() {
    if($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).addClass('active');
        }
    $( "#book" ).slideToggle( "slow", function() {
        ///
    });
    
    });
    });

// Services Page
    // Read more #1
    function myFunction() {
        var dots = document.getElementById("dots");
        var moreText = document.getElementById("more");
        var btnText = document.getElementById("myBtn");
    
        if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Read more";
        moreText.style.display = "none";
        } else {
        dots.style.display = "none";
        btnText.innerHTML = "Read less";
        moreText.style.display = "inline";
        }
    }

    // Read more #2
    function button2() {
        var dots2 = document.getElementById("dots2");
        var moreText2 = document.getElementById("more2");
        var btnText2 = document.getElementById("myBtn2");
    
        if (dots2.style.display === "none") {
        dots2.style.display = "inline";
        btnText2.innerHTML = "Read more";
        moreText2.style.display = "none";
        } else {
        dots2.style.display = "none";
        btnText2.innerHTML = "Read less";
        moreText2.style.display = "inline";
        }
    }

    // Read more #3
    function button3() {
        var dots3 = document.getElementById("dots3");
        var moreText3 = document.getElementById("more3");
        var btnText3 = document.getElementById("myBtn3");
    
        if (dots3.style.display === "none") {
        dots3.style.display = "inline";
        btnText3.innerHTML = "Read more";
        moreText3.style.display = "none";
        } else {
        dots3.style.display = "none";
        btnText3.innerHTML = "Read less";
        moreText3.style.display = "inline";
        }
    }

    // Read more #4
    function button4() {
        var dots4 = document.getElementById("dots4");
        var moreText4 = document.getElementById("more4");
        var btnText4 = document.getElementById("myBtn4");
    
        if (dots4.style.display === "none") {
        dots4.style.display = "inline";
        btnText4.innerHTML = "Read more";
        moreText4.style.display = "none";
        } else {
        dots4.style.display = "none";
        btnText4.innerHTML = "Read less";
        moreText4.style.display = "inline";
        }
    }

    // Read more #5
    function button5() {
        var dots5 = document.getElementById("dots5");
        var moreText5 = document.getElementById("more5");
        var btnText5 = document.getElementById("myBtn5");
    
        if (dots5.style.display === "none") {
        dots5.style.display = "inline";
        btnText5.innerHTML = "Read more";
        moreText5.style.display = "none";
        } else {
        dots5.style.display = "none";
        btnText5.innerHTML = "Read less";
        moreText5.style.display = "inline";
        }
    }