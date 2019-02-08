<!-- Should be a seperate 404 template, but because of time constraints this is how I'm doing it right now. -->
<?php 
    if ( isset($pageNotFound) ) {
?>
    <div class="page-not-found">
        <h2><?= $pageNotFound['title'] ?></h2>
        <p><?= $pageNotFound['message'] ?></p>
    </div>
<?php      
    return;
    }
?>

<div class="article-detail">
    <h2><?= $data->title ?></h2>
    <?= $data->content ?>
</div>
<div class="replies-wrapper">
    <div class="divider"></div>

    <div class="filtering">
        Voorbeeld filters:
        <a href="<?= parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) ?>?sort=asc">Oudste items eerst</a>
        <a href="<?= parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) ?>?sort=desc">Nieuwste items eerst</a>
        <a href="<?= parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) ?>?score_threshold=-1">Items tonen vanaf score -1</a>
        <a href="<?= parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) ?>?score_threshold=0">Items tonen vanaf score 0</a>
        <a href="<?= parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) ?>?score_threshold=1">Items tonen vanaf score 1</a>
        <a href="<?= parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) ?>?sort=asc&score_threshold=1">Items tonen vanaf score 1 sortered op oudste eerst</a>
    </div>
    <!-- Because of time constraints and a late realisation I'm not implementing the display of replies nested to infinity. 
        I'm only showing replies in replies and no deeper than that. This can easily be fixed by writing a display method which displays a reply and recursively runs a new display for all its' children untill all replies have been displayed. -->
    <?php foreach ($replies as $reply) { ?>
    <div class="reply">
        <div class="initial">
            <div class="user-profile-small">
                <img src="<?= $reply['account_image']; ?>" alt="" class="user-image">
                <span class="user-name">
                    <?= $reply['account_name']; ?>
                </span>
            </div>
            <div class="reply-message">
                <div class="reply-information">
                    <b class="highlight">#<?= $reply['id']; ?></b> <span>Door <b><?= $reply['account_name']; ?></b> op <?= $reply['created_date']; ?></span>
                </div>
                <div class="reply-score-wrapper">
                    <div data-mutation="-" data-reply_id="<?= $reply['id']; ?>" class="subtract-from-score">-</div>
                    <div class="score"><?= $reply['score']; ?></div>
                    <div data-mutation="+" data-reply_id="<?= $reply['id']; ?>" class="add-to-score">+</div>
                </div>
                <p><?= $reply['content']; ?></p>

                <?php if ( isset($_SESSION['account']) && $_SESSION['account']['loggedIn'] === true ) { ?>
                <div class="interaction-bar">
                    <a class="respond-to-reply" href="#" class="reply-to" data-account_name="<?= $reply['account_name'] ?>" data-reply_id="<?= $reply['id'] ?>">Reageer op dit bericht</a>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php if (isset($reply['replies'])) { ?>
            <div class="children">
                <?php foreach ($reply['replies'] as $reply) { ?>
                    <div class="reply small">
                        <div class="reply-information">
                        <b class="highlight">#<?= $reply['id']; ?></b> <span>Door <b><?= $reply['account_name']; ?></b> op <?= $reply['created_date']; ?></span>
                        </div>
                        <div class="reply-score-wrapper">
                            <div data-mutation="-" data-reply_id="<?= $reply['id']; ?>" class="subtract-from-score">-</div>
                            <div class="score"><?= $reply['score']; ?></div>
                            <div data-mutation="+" data-reply_id="<?= $reply['id']; ?>" class="add-to-score">+</div>
                        </div>
                        <p><?= $reply['content'] ?></p>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <?php } ?>
</div>
<?php if ( isset($_SESSION['account']) && $_SESSION['account']['loggedIn'] === true ) { ?>
<div class="leave-reply-to-article">
    <h2>Laat een reactie achter</h2>
    <span id="form_tooltip" class="hidden"></span>
    <form id="post_reply" method="post" action="/Reply/create/">
        <textarea name="message" type="text"></textarea>
        <input id="article_id" name="article_id" type="text" hidden value="<?= $data->id; ?>">
        <input id="account_id" name="account_id" type="text" hidden value="<?= $_SESSION['account']['id']; ?>">
        <input id="reply_id" name="reply_id" type="text" hidden value="">
        <div class="align-right">
            <input type="submit" class="button">
        </div>
    </form>
</div>
<?php } else { ?>
    <div>
        <p>Om een reactie achter te laten moet je ingelogd zijn.</p>
    </div>
<?php } ?>