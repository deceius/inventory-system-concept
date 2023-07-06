export default () => ({
    isLoading: false,
    filter: {
        'search' : '',
        'inactive': false
    },
    result: [],
    loadEverything() {
        this.$watch('filter.inactive', () => {
            this.loadTypes();
        });
        this.isLoading = true;
        this.loadTypes();
    },
    nextPage() {
        this.loadFromUrl(this.result.next_page_url);
    },
    prevPage() {
        this.loadFromUrl(this.result.prev_page_url);
    },
    loadTypes() {
        this.isLoading = true;
        this.data = [];
        let url = '/items/settings/types/fetch?search=' + this.filter.search + '&inactive=' + this.filter.inactive;
        axios.get(url).then(
            response => {
                this.result = response.data.result;
                this.isLoading = false;
            }
        ).catch(error => {
               this.isLoading = false;
            }
        );
    },
    loadPage(url){
        if (url) {
            this.loadFromUrl(url + '&search=' + this.filter.search + '&inactive=' + this.filter.inactive);
        }
    },
    loadFromUrl(url) {
        this.isLoading = true;
        this.data = [];
        axios.get(url).then(
            response => {
                this.result = response.data.result;
                this.isLoading = false;
            }
        ).catch(error => {
               this.isLoading = false;
            }
        );
    }
})
