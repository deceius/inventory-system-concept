export default () => ({
    isLoading: false,
    filter: {
        'search' : '',
        'inactive': false
    },
    result: [],
    loadBranches() {
        this.$watch('filter.inactive', () => {
            this.reloadBranches();
        });
        this.isLoading = true;
        this.result = [];
        let url = '/admin/branch/fetch';
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
    reloadBranches() {
        this.isLoading = true;
        this.result = [];
        let url = '/admin/branch/fetch?search=' + this.filter.search + '&inactive=' + this.filter.inactive;
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
