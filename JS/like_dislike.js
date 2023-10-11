function likeMovie(id) {
    // Check if the user has already liked this movie
    if (localStorage.getItem('like-' + id) === 'liked') {
        // The user has already liked this movie, so undo the like
        localStorage.setItem('like-' + id, 'unliked');
        decrementLikeCount(id);
        document.getElementById('like-button-' + id).textContent = 'Like';
    } else {
        // The user hasn't liked the movie, so like it
        if (localStorage.getItem('dislike-' + id) === 'disliked') {
            // Check if the user has previously disliked it
            localStorage.setItem('dislike-' + id, 'undisliked');
            decrementDislikeCount(id);
        }
        localStorage.setItem('like-' + id, 'liked');
        incrementLikeCount(id);
        document.getElementById('like-button-' + id).textContent = 'Liked';
    }
}

function dislikeMovie(id) {
    // Check if the user has already disliked this movie
    if (localStorage.getItem('dislike-' + id) === 'disliked') {
        // The user has already disliked this movie, so undo the dislike
        localStorage.setItem('dislike-' + id, 'undisliked');
        decrementDislikeCount(id);
        document.getElementById('dislike-button-' + id).textContent = 'Dislike';
    } else {
        // The user hasn't disliked the movie, so dislike it
        if (localStorage.getItem('like-' + id) === 'liked') {
            // Check if the user has previously liked it
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
