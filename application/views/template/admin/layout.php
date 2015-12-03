<!DOCTYPE HTML>
<html lang="pt-br">
    <?php echo $header; ?>
    <body>
        <div id="all">
            <div id="aside" class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <?php echo $navbar; ?>
            </div>
            <div id="section" class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                <?php if(isset($breadcrumbs) && $breadcrumbs ): ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                <?php echo $breadcrumbs; ?>
                            </div>
                        </div>
                <?php endif; ?>
                <?php echo $content; ?>
            </div>
            <!--<div id="footer" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">-->
                <?php //echo $footer; ?>
            <!--</div>-->
        </div>
    </body>
</html>