		
        <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
        <div id="blueimp-gallery" class="blueimp-gallery">
            <!-- The container for the modal slides -->
            <div class="slides"></div>
            <!-- Controls for the borderless lightbox -->
            <h3 class="title"></h3>
            <a class="prev">‹</a>
            <a class="next">›</a>
            <a class="close">×</a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
            <!-- The modal dialog, which will be used to wrap the lightbox content -->
            <div class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body next"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left prev">
                                <i class="glyphicon glyphicon-chevron-left"></i>
                                Anterior
                            </button>
                            <button type="button" class="btn btn-primary next">
                                Próximo
                                <i class="glyphicon glyphicon-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
              <div class="container">
                <p class="text-muted">ZombieSide 2015. All rigths reserved.</p>
              </div>
    	</footer>
        <script src="/js/jquery-1.11.2.min.js"></script>
        <script src="/js/funcoes_front.js"></script>
        <script src="/js/bootstrap.min.js"></script>

        <script src="/js/vex-2.2.1/js/vex.combined.min.js"></script>

        <script src="/js/Bootstrap-Image-Gallery-3.1.1/js/jquery.blueimp-gallery.min.js"></script>
        <script src="/js/Bootstrap-Image-Gallery-3.1.1/js/bootstrap-image-gallery.min.js"></script>

        <script>vex.defaultOptions.className = 'vex-theme-flat-attack';</script>

    </body>
</html>