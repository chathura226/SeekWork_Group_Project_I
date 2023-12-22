class Reviews{
    constructor(options){

        let defaults = {
            page_id:1 ,
            container: document.querySelector(".reviews"),
            php_file_url:"reviews.php"
        };

        this.options = Object.assign(defaults,options);
        this.fetchReviews();


    }

    
    fetchReviews(){
        let url = `${this.phpFileUrl}?page_id={this.page_ID}`;
        url+=" current_pagination_page" in this.options? `& current_pagination_page=${this. currentPaginationPage}`:'';
        url += "reviews_per_pagination_page" in this.options?`&reviews_per_pagination_page=${this.reviewsPerPagination}`:'';
        url += "sort_by" in this.options ? `&sort_by=${this.sortBy};` :'';
        fetch(url).then(response=>response.text()).then(data=> {

            this.container.innerHTML = data;
            this

        })
    }




}