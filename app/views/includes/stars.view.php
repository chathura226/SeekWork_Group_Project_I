<style>
    .rateNew {
        display: inline-block;
        border: 0;
    }

    .rateNew > .rating-star-input {
        display: none;
    }

    .rateNew > label {
        float: right;
    }

    .rateNew > label:before {
        display: inline-block;
        font-size: 1.1rem;
        padding: .3rem .2rem;
        margin: 0;
        font-family: FontAwesome;
        content: "\f005 ";
    }

    .rateNew > label:last-child:before {
        content: "\f006 ";
    }

    .rateNew .half:before {
        content: "\f089 ";
        position: absolute;
        padding-right: 0;
    }

    .rating-star-input:checked ~ label,
    .rating-star-input:checked {
        color: rgb(255, 123, 0);
    }

</style>
<?php $correctRatingID=0;
if (!empty($nStars)) {

    $rounded = roundToNearestHalf($nStars);
    $correctRatingID=$rounded*2;
//    show($nStars);
//    show($correctRatingID);
} ?>
<div style="display: flex; align-items: center;">
<fieldset class="rateNew">
    <input <?=($correctRatingID==10)?'checked':''?> class="rating-star-input" disabled type="radio" id="rating10" name="rating" value="10"/><label for="rating10"
                                                                                                          title="5 stars"></label>
    <input <?=($correctRatingID==9)?'checked':''?> class="rating-star-input" disabled type="radio" id="rating9" name="rating" value="9"/><label
            class="half" for="rating9" title="4 1/2 stars"></label>
    <input <?=($correctRatingID==8)?'checked':''?> class="rating-star-input" disabled type="radio" id="rating8" name="rating" value="8"/><label for="rating8"
                                                                                                        title="4 stars"></label>
    <input <?=($correctRatingID==7)?'checked':''?> class="rating-star-input" disabled type="radio" id="rating7" name="rating" value="7"/><label class="half"
                                                                                                        for="rating7"
                                                                                                        title="3 1/2 stars"></label>
    <input <?=($correctRatingID==6)?'checked':''?> class="rating-star-input" disabled type="radio" id="rating6" name="rating" value="6"/><label for="rating6"
                                                                                                        title="3 stars"></label>
    <input <?=($correctRatingID==5)?'checked':''?> class="rating-star-input"  disabled type="radio" id="rating5" name="rating" value="5"/><label class="half"
                                                                                               for="rating5"
                                                                                               title="2 1/2 stars"></label>
    <input <?=($correctRatingID==4)?'checked':''?> class="rating-star-input" disabled type="radio" id="rating4" name="rating" value="4"/><label for="rating4"
                                                                                                        title="2 stars"></label>
    <input <?=($correctRatingID==3)?'checked':''?> class="rating-star-input" disabled type="radio" id="rating3" name="rating" value="3"/><label class="half"
                                                                                                        for="rating3"
                                                                                                        title="1 1/2 stars"></label>
    <input <?=($correctRatingID==2)?'checked':''?> class="rating-star-input" disabled type="radio" id="rating2" name="rating" value="2"/><label for="rating2"
                                                                                                        title="1 star"></label>
    <input <?=($correctRatingID==1)?'checked':''?> class="rating-star-input" disabled type="radio" id="rating1" name="rating" value="1"/><label class="half"
                                                                                                        for="rating1"
                                                                                                        title="1/2 star"></label>
</fieldset>
<span style="padding-top: 8px;">(<?=$nReviews?>)</span>
</div>
