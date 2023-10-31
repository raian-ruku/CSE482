function likeMovie(id) {
    if (localStorage.getItem('like-' + id) === 'liked') {
        localStorage.setItem('like-' + id, 'unliked');
        decrementLikeCount(id);
        document.getElementById('like-button-' + id).textContent = 'Like';
    } else {
        if (localStorage.getItem('dislike-' + id) === 'disliked') {
            localStorage.setItem('dislike-' + id, 'undisliked');
            decrementDislikeCount(id);
        }
        localStorage.setItem('like-' + id, 'liked');
        incrementLikeCount(id);
        document.getElementById('like-button-' + id).textContent = 'Liked';
    }
}
function dislikeMovie(id) {
    if (localStorage.getItem('dislike-' + id) === 'disliked') {
        localStorage.setItem('dislike-' + id, 'undisliked');
        decrementDislikeCount(id);
        document.getElementById('dislike-button-' + id).textContent = 'Dislike';
    } else {
        if (localStorage.getItem('like-' + id) === 'liked') {
            localStorage.setItem('like-' + id, 'unliked');
            decrementLikeCount(id);
        }
        localStorage.setItem('dislike-' + id, 'disliked');
        incrementDislikeCount(id);
        document.getElementById('dislike-button-' + id).textContent = 'Disliked';
    }
}
function incrementLikeCount(id) {
    const likeCountElement = document.getElementById('like-count-' + id);
    likeCountElement.textContent = parseInt(likeCountElement.textContent) + 1;
}
function decrementLikeCount(id) {
    const likeCountElement = document.getElementById('like-count-' + id);
    likeCountElement.textContent = parseInt(likeCountElement.textContent) - 1;
}
function incrementDislikeCount(id) {
    const dislikeCountElement = document.getElementById('dislike-count-' + id);
    dislikeCountElement.textContent = parseInt(dislikeCountElement.textContent) + 1;
}
function decrementDislikeCount(id) {
    const dislikeCountElement = document.getElementById('dislike-count-' + id);
    dislikeCountElement.textContent = parseInt(dislikeCountElement.textContent) - 1;
}
