const URL_ROOT = 'http://localhost:8080/Cipher/';
function upvote(questionId, userId) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'vote.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        // Update the vote count on the page
        document.getElementById('question_upvote').textContent = response.upvotes;
      }
    };
    xhr.send('question_id=' + questionId + '&user_id=' + userId + '&vote_type=upvote');
  }
  
  function downvote(questionId, userId) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'vote.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        // Update the vote count on the page
        document.getElementById('question_downvote').textContent = response.downvotes;
      }
    };
    xhr.send('question_id=' + questionId + '&user_id=' + userId + '&vote_type=downvote');
  }