@include("layouts.header")
    <main class="container mt-5 pt-5">
        <div class="row">
            <div class="col-12">
                <center><h2>Comment</h2></center>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div id="comment-form-container" style="margin:0px 100px; padding:20px; border:1px solid lightgrey; box-shadow: 0px 0px 1px lightgrey; background-color:ghostwhite;">
                    <form action="{{ url('create_comment') }}" method="POST" class="form">
                        @csrf

                        <div class="row">
                            <!-- Plateform -->
                            <div class="form-group col-lg-6  col-sm-12">
                                <label for="post_link">Platform</label>
                                <select name="platform" id="" class="form-control">
                                    <option disabled selected value> -- select a platform -- </option>
                                    <!--<option value="youtube">Instagram</option>-->
                                    <option value="https://www.facebook.com/sharer/sharer.php?app_id=676241010363950&sdk=joey&u=">Facebook</option>
                                    <option value="https://twitter.com/intent/tweet?text=">Twitter</option>
                                    <option value="https://www.linkedin.com/shareArticle?url=">LinkedIn</option>
                                    <option value="https://pinterest.com/pin/create/button/?url=">Pintrest</option>
                                    
                                </select>
                            </div>

                            <!-- Post link -->
                            <div class="form-gourp col-lg-6 col-sm-12">
                                <label for="post_link">Comment Type</label>
                                <select name="comment_type" id="" class="form-control">
                                    <option disabled selected value> -- select a comment type -- </option>
                                    <option value="comment">Comment</option>
                                    <option value="review">Review</option>
                                    <option value="direct quote">Direct Quote</option>
                                </select>
                            </div>
                        </div>


                        <!-- Post link -->
                        <div class="form-group">
                            <label for="post_link">Post Link</label>
                            <input type="text" name="url" id="post_link" class="form-control">
                        </div>
                        

                        <div class="row">
                            <!-- Comment -->
                            <div class="form-group col-lg-6">
                                <label for="comment">Comment</label>
                                <textarea name="actual_comment" id="comment" cols="10" rows="5" class="form-control"></textarea>    
                            </div>

                            <!-- Feedback -->
                            <div class="form-group col-lg-6">
                                <label for="feedback">Feedback</label>
                                <textarea name="feedback" id="feedback" cols="10" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                            
                        <!-- Submit button -->
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="SEND">
                        </div>

                    </form>
                    <!-- end comment form -->
                </div>

            </div>
        </div>

    </main>
@include("layouts.footer")