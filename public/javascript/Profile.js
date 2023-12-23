document.addEventListener('DOMContentLoaded', (event) => {
    let togglePostsButton = document.querySelector('.toggle-posts-btn');
    let toggleCommentsButton = document.querySelector('.toggle-comments-btn');

    if (togglePostsButton) {
        togglePostsButton.addEventListener('click', function() {
            togglePosts();
        });
    }

    if (toggleCommentsButton) {
        toggleCommentsButton.addEventListener('click', function() {
            toggleComments();
        });
    }
});

function togglePosts() {
    var x = document.getElementById("user-posts");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function toggleComments() {
    var x = document.getElementById("user-comments");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
