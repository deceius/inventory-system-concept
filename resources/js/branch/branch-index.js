export default () => ({
    isLoading: false,
    filter: {
        'search' : '',
        'inactive': false
    },
    data: [],
    selectedBranch: [],
    loadBranches() {
        this.$watch('filter.inactive', () => {
            this.reloadBranches();
        });
        this.isLoading = true;
        this.data = [];
        let url = '/admin/branch/fetch';
        axios.get(url).then(
            response => {
                this.data = response.data.branches;
                this.isLoading = false;
            }
        ).catch(error => {
               this.isLoading = false;
            }
        );
    },
    reloadBranches() {
        this.isLoading = true;
        this.data = [];
        let url = '/admin/branch/fetch?search=' + this.filter.search + '&inactive=' + this.filter.inactive;
        axios.get(url).then(
            response => {
                this.data = response.data.branches;
                this.isLoading = false;
            }
        ).catch(error => {
               this.isLoading = false;
            }
        );
    }
})
