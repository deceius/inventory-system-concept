export default () => ({
    isLoading: false,
    filter: {
        'search' : '',
        'inactive': false
    },
    result: [],
    loadEverything() {
        this.$watch('filter.inactive', () => {
            this.loadItems();
        });
        this.isLoading = true;
        this.loadItems();
    },
    nextPage() {
        this.loadFromUrl(this.result.next_page_url);
    },
    prevPage() {
        this.loadFromUrl(this.result.prev_page_url);
    },
    getItemFullName(item){
        if (item.brand) {
            return item.brand.name + ' ' + item.name;
        }
        return item.name;

    },
    loadItems() {
        this.isLoading = true;
        this.data = [];
        let url = '/items/fetch?search=' + this.filter.search + '&inactive=' + this.filter.inactive;
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
    setPaginationLabel(label, index){
        if (index == 0) {
            return '<';
        }
        else if (index == this.result.links.length - 1) {
            return '>';
        }

        return label;
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
