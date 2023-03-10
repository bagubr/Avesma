var app = new Vue({
    el: '#app',
    data: {
        fish_category_id: "",
        fish_name: "",
        region_id: "",
        markets: [],
        loading: false,
        local: "http://localhost:8000/api/v1/markets",
        live: "https://avesma.id/api/v1/markets"
    },
    mounted() {
        this.getMarkets();
    },
    methods: {
        getMarkets() {
            this.loading = true,
                this.markets = [],
                axios
                    .get(this.live, {
                        params: {
                            fish_name: this.fish_name,
                            fish_category_id: this.fish_category_id,
                            region_id: this.region_id
                        }
                    })
                    .then(response => {
                        this.markets = response.data;
                        this.loading = false;
                    })
        }
    },
})