export default () => ({
    isLoading: false,
    filter: {
        'search' : '',
        'inactive': false
    },
    result: [],
    load(reload = false) {
        if (!reload) {
            this.$watch('filter.inactive', () => {
                this.load(true);
            });
        }
        this.isLoading = true;
        this.result = [];
        let url = '/expenses/fetch?search=' + this.filter.search + '&inactive=' + this.filter.inactive;
        axios.get(url).then(
            response => {
                this.result = response.data.result;
                console.log(this.result);
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
