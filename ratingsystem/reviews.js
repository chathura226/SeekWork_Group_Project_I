//review class
class Reviews {
    constructor(options) {
        let defaults = {
            page_id: 1,
            container: document.querySelector(".reviews"),
            php_file_url: "reviews.php",
            reviewForm: null,
        };

        this.options = Object.assign(defaults, options);
        this.fetchReviews();
        this.setupEventHandlers();
    }

    fetchReviews() {
        let url = `${this.phpFileUrl}?page_id=${this.page_ID}`;
        url += "current_pagination_page" in this.options ? `&current_pagination_page=${this.currentPaginationPage}` : "";
        url += "reviews_per_pagination_page" in this.options ? `&reviews_per_pagination_page=${this.reviewsPerPaginationPage}` : "";
        url += "sort_by" in this.options ? `&sort_by=${this.sortBy}` : "";

        fetch(url)
            .then((response) => response.text())
            .then((data) => {
                this.container.innerHTML = data;
            });
    }

    setupEventHandlers() {
        if (this.options.reviewForm) {
            this.options.reviewForm.addEventListener("submit", (event) => {
                event.preventDefault();
                this.submitReview();
            });
        }

        this.container.querySelector(".write_review_btn").onclick = (event) => {
            event.preventDefault();
            this.container.querySelector(".write_review").style.display = 'block';
            this.container.querySelector(".write_review input[name='name']").focus();
        };

        this.container.querySelector(".sort_by").onchange = (event) => {
            this.sortBy = event.value;
            this.fetchReviews();
        };

        if (this.reviewsPerPaginationPage && this.currentPaginationPage) {
            this.container.querySelectorAll(".pagination a").forEach((a) => {
                a.onclick = (event) => {
                    event.preventDefault();
                    this.currentPaginationPage = event.target.dataset.pagination_page;
                    this.reviewsPerPaginationPage = event.target.dataset.records_per_page;
                    this.fetchReviews();
                };
            });
        }
    }

    submitReview() {
        fetch(`${this.phpFileUrl}?page_id=${this.page_ID}`, {
            method: 'POST',
            body: new FormData(this.options.reviewForm),
        })
        .then((response) => response.text())
        .then((data) => {
            this.container.querySelector(".write_review").innerHTML = data;
            this.fetchReviews(); // Refresh reviews after submission
        });
    }

    get reviewsPerPaginationPage() {
        return this.options.reviews_per_pagination_page;
    }

    set reviewsPerPaginationPage(value) {
        this.options.reviews_per_pagination_page = value;
    }

    get currentPaginationPage() {
        return this.options.current_pagination_page;
    }

    set currentPaginationPage(value) {
        this.options.current_pagination_page = value;
    }

    get page_ID() {
        return this.options.page_id;
    }

    set page_ID(value) {
        this.options.page_id = value;
    }

    get phpFileUrl() {
        return this.options.php_file_url;
    }

    set phpFileUrl(value) {
        this.options.php_file_url = value;
    }

    get container() {
        return this.options.container;
    }

    set container(value) {
        this.options.container = value;
    }

    get sortBy() {
        return this.options.sort_by;
    }

    set sortBy(value) {
        this.options.sort_by = value;
    }
}
