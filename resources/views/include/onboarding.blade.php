<!-- Onboarding Modal -->
<div class="modal fade" id="modal-onboarding" tabindex="-1" role="dialog" aria-labelledby="modal-onboarding"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content rounded overflow-hidden bg-image"
            style="background-image: url('/media/photos/photo24.jpg');">
            <div class="row">
                <div class="col-md-5">
                    <div class="p-3 text-right text-md-left">
                        <a class="font-w600 text-white" href="#" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-share text-danger-light mr-1"></i> Skip Intro
                        </a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="bg-white shadow-lg">
                        <div class="js-slider slick-dotted-inner" data-dots="true" data-arrows="false"
                            data-infinite="false">
                            <div class="p-4">
                                <i class="fa fa-award fa-3x text-muted my-4"></i>
                                <h3 class="font-size-h2 font-w300 mb-2">Welcome to your app!</h3>
                                <p class="text-muted">
                                    This is a modal you can show to your users when they first sign in to their
                                    dashboard. It is a great place to welcome and introduce them to your application and
                                    its functionality.
                                </p>
                                <button type="button" class="btn btn-hero btn-primary mb-4"
                                    onclick="jQuery('.js-slider').slick('slickGoTo', 1);">
                                    More Info <i class="fa fa-arrow-right ml-1"></i>
                                </button>
                            </div>
                            <div class="slick-slide p-4">
                                <h3 class="font-size-h2 font-w300 mb-2">Invoices</h3>
                                <p class="text-muted">
                                    They are sent automatically to your clients with the completion of every project, so
                                    you don't have to worry about getting paid.
                                </p>
                                <h3 class="font-size-h2 font-w300 mb-2">Backup</h3>
                                <p class="text-muted">
                                    Backups are taken with every new change to ensure complete piece of mind. They are
                                    kept safe for immediate restores.
                                </p>
                                <button type="button" class="btn btn-hero btn-primary mb-4"
                                    onclick="jQuery('.js-slider').slick('slickGoTo', 2);">
                                    Complete Profile <i class="fa fa-arrow-right ml-1"></i>
                                </button>
                            </div>
                            <div class="slick-slide p-4">
                                <i class="fa fa-user-check fa-3x text-muted my-4"></i>
                                <h3 class="font-size-h2 font-w300">Let us know your name</h3>
                                <form class="mb-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="onboard-first-name"
                                            name="onboard-first-name" placeholder="Enter your first name..">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="onboard-last-name"
                                            name="onboard-last-name" placeholder="Enter your last name..">
                                    </div>
                                </form>
                                <button type="button" class="btn btn-hero btn-success mb-4" data-dismiss="modal"
                                    aria-label="Close">
                                    Get Started <i class="fa fa-check ml-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Onboarding Modal -->