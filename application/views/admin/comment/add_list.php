<?php if(isset($comments) && !empty($comments)): ?>
    <div class="row form-section comment">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="list-group">
                <?php foreach($comments as $comment): ?>
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading"><?php echo $comment->name; ?> - <?php echo $comment->date; ?></h4>
                        <p class="list-group-item-text">
                            <?php echo $comment->description; ?>
                            <?php if($is_admin): ?>
                                <button type="button" id="comment-delete" class="btn btn-danger pull-right" data-id="<?php echo $comment->id; ?>">Excluir</button>
                            <?php endif; ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if($can_post): ?>
    <div class="row form-section comment">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for="comment"><?php echo $title; ?></label>
                <textarea name="comment" id="comment" class="form-control" ></textarea>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <button type="button" class="btn btn-primary" id="comment-save" data-id="<?php //echo $item->id; ?>">Salvar Comentário</button>
        </div>
    </div>
<?php endif; ?>