export default () => ({
    isLoading: false,
    data: [],
    selectedBranch: [],
    loadBranches() {
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
    }
})
