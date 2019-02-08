document.addEventListener('DOMContentLoaded', function () {

    // mutatescore does ajax call to replyController->mutateScore(reply_id, mutation)
    // on return, update score in frontend immediately?
    // Normally there should be a more formal way to do this to also prevent spamming of additions and subtractions, but for time-saving sake this won't be implemented in this test project.
    var mutateScore = function () {
        var replyId = this.getAttribute('data-reply_id');
        var mutation = this.getAttribute('data-mutation');
        console.log(mutation + ' score reply:' + replyId);

        // Send ajax request to ReplyController/Mutate to mutate score of reply
        var formData = new FormData();
        formData.append('mutation', mutation);
        formData.append('reply_id', replyId);

        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var responseData = JSON.parse(this.responseText);

                alert(responseData.message);
                if (responseData.status === true) {
                    location.reload();
                }
            }
        }
        xmlHttp.open("post", "/Reply/mutate", true);
        xmlHttp.send(formData);
    };

    /**
     * Populates reply form with necessary information and QoL text. Also scrolls down to reply form.
     */
    var replyToArticle = function (event) {
        var replyId = this.getAttribute('data-reply_id');
        var replyTo = this.getAttribute('data-account_name');
        var formToolTipText = 'Je reageert nu op reactie #' + replyId + ' van ' + replyTo;

        document.getElementById('form_tooltip').textContent = formToolTipText;
        document.getElementById('reply_id').value = replyId;
        document.getElementById('post_reply').scrollIntoView({
            behaviour: 'smooth'
        });
    }

    // Binding all add-to-score buttons to mutateScore
    var addToScoreButtons = document.getElementsByClassName('add-to-score');

    for (var i = 0; i < addToScoreButtons.length; i++) {
        addToScoreButtons[i].addEventListener('click', mutateScore, false);
    }

    // Binding all subtract-from-score buttons to mutateScore
    var subtractFromScoreButtons = document.getElementsByClassName('subtract-from-score');

    for (var i = 0; i < subtractFromScoreButtons.length; i++) {
        subtractFromScoreButtons[i].addEventListener('click', mutateScore, false);
    }

    // Binding reply-to buttons to replyToArticle
    var respondToReplyButtons = document.getElementsByClassName('respond-to-reply');

    for (var i = 0; i < respondToReplyButtons.length; i++) {
        respondToReplyButtons[i].addEventListener('click', function (event) {
            event.preventDefault();

            replyToArticle.call(this);
        });
    }

});