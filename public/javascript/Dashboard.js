function toggleCommentSection(postId) {
    var element = document.getElementById('comment-section-' + postId);
    element.style.display = element.style.display === 'none' ? 'block' : 'none';
}
