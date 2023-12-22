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
    }




}