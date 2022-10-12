$(document).ready(function () {
    /* LIKE */
    $(document).ready(function () {
        /* LIKE */
        $(".upvoteBtn, .downvoteBtn").click(function () {
            var post_id = this.id;
            var type;
            var split_post_id = post_id.split("-");
            var user_id = split_post_id[2];
            if (user_id == "no_session") {
                window.location = "login_form.php";
            }
            var vote_container = "#vote-count" + "-" + split_post_id[1];
            var like_container = "#like" + "-" + split_post_id[1];
            var dislike_container = "#dislike" + "-" + split_post_id[1];
            if (split_post_id[0] == "like") {
                $("#like-" + split_post_id[1] + "-" + user_id).children("i").css("color", "blue");
                $("#dislike-" + split_post_id[1] + "-" + user_id).children("i").css("color", "gray");
                $(like_container).prop("disabled", true);
                $(dislike_container).prop("disabled", false);
                type = 0;
            } else {
                $("#dislike-" + split_post_id[1] + "-" + user_id).children("i").css("color", "red");
                $("#like-" + split_post_id[1] + "-" + user_id).children("i").css("color", "gray");
                $(like_container).prop("disabled", false);
                $(dislike_container).prop("disabled", true);
                type = 1;
            }
            $(vote_container).load("like.php", {
                post_id: split_post_id[1],
                post_type: type,
                user_id: split_post_id[2]
            });
        });
        /* -LIKE */

        /* COMMENT */
        show_comment_toggler = 0;
        // hide comments
        $(".comment-container").hide();
        $(".btn-show-comment").click(function () {
            var id = this.id;
            var split_id = id.split("-");
            var post_id = split_id[1];
            var comment_container = ".comment-" + post_id;
            // console.log(split_post_id[1]);
            // console.log(split_post_id[2]);
            console.log(comment_container);
            if (show_comment_toggler == 0) {
                show_comment_toggler = 1;
                $(".show_comment_container-" + post_id).show();
            } else {
                show_comment_toggler = 0;
                $(".show_comment_container-" + post_id).hide();
            }
        })
        $(".btn-add").click(function () {
            var id = this.id;
            var split_id = id.split("-");
            var post_id = split_id[1];
            var body = $("#comment_body" + "-" + post_id).val();
            var comment_container = "#test-" + post_id;
            // console.log(split_id[1]);
            // console.log(split_id[2]);
            console.log(body);
            console.log(comment_container);
            $(comment_container).load("add_comment.php", {
                post_id: post_id,
                body: body
            });
            $("#comment_body" + "-" + post_id).val("");
            var total_comment = $("#total_comment-" + post_id).html();
            total_comment = total_comment.split(" ");
            total_comment[0]++;
            console.log(total_comment[0]);
            $("#total_comment-" + post_id).html(total_comment[0] + " " + total_comment[1]);

        })
        /* -COMMENT */
        $('.floating-btn').click(function () {
            $('.social-panel-container').addClass("visible");
        });

        $('.close-btn').click(function () {
            console.log("test!");
            $('.social-panel-container').removeClass("visible");
        });
    })
    // typed js
    new Typed('#typed', {
        strings: ['PHP', 'C', 'Javascript', 'C++', 'Python', 'Java', 'Ruby', 'SQL'],
        typeSpeed: 175,
        delaySpeed: 50,
        loop: true
    });

    // tabs for sorting
    var tabs = document.querySelectorAll(".tabs-wrap ul li");

    tabs.forEach((tab) => {
        tab.addEventListener("click", () => {
            tabs.forEach((tab) => {
                tab.classList.remove("active");
            })
            tab.classList.add("active");
        })
    })
})

//smooth scroll buat tombol di hero
$(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top
    }, 500);
});