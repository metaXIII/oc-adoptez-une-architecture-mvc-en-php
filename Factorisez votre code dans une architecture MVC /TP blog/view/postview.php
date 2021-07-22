<h2>Commentaires</h2>
<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <input type="hidden" name="edit" value="<?= isset($valueEdit) ? $valueEdit['id'] : '' ?>">
    <div>
        <label for="author">Auteur</label><br/>
        <input type="text" id="author" name="author" value="<?= isset($valueEdit) ? $valueEdit['author'] : '' ?>"/>
    </div>
    <div>
        <label for="comment">Commentaire</label><br/>
        <textarea id="comment" name="comment"><?= isset($valueEdit) ? $valueEdit['comment'] : '' ?></textarea>
    </div>
    <div>
        <input type="submit"/>
    </div>
</form>

